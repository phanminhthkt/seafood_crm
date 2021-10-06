<?php
namespace App\Repositories\Wms;
use App\Repositories\BaseRepository;
use App\Models\Product;
use App\Models\Customer;
use Auth;
use DataTables;
use Carbon\Carbon;

class WmsExportRepository extends BaseRepository implements WmsExportRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\WmsExport::class;
    }
    public function getDataByCondition($request,$data){
        $value = $this->_model::with(['status:id,name','store:id,name'])->select('id','code','store_id','status_id','user_id','total_price','ship_price','reduce_price','is_status','export_created_at')->where('id','<>', 0);
        return Datatables::of($value)
        ->filter(function ($query) use ($request) {
            if ($request->has('status') && $request->status!='') {
                $query->where('status_id', '=', $request->get('status'));
            }
            if ($request->has('store') && $request->store!='') {
                $query->where('store_id', '=', $request->get('store'));
            }
            if ($request->has('created_at') && $request->created_at!='') {
                $time = explode('to',str_replace(' ','',$request->created_at));
                if(count($time)>1){
                    $next_day = Carbon::parse($time[1])->addDay()->format('Y-m-d');
                    $query->whereBetween('export_created_at', array(formatDate($time[0],'Y-m-d'),$next_day));
                }else{
                    $next_day = Carbon::parse($time[0])->addDay()->format('Y-m-d');
                    $query->whereBetween('export_created_at', array(formatDate($time[0],'Y-m-d'),$next_day));
                }
            }
            if ($request->has('name')) {
                $query->where('code', 'like', "%{$request->get('name')}%");
            }
        })
        ->addColumn('checkbox', function ($value) use ($data) {
                return '<div class="custom-control custom-checkbox text-center">
                                  <input type="checkbox" class="custom-control-input select-checkbox" value="'.$value->id.'" id="autoSizingCheck-'.$value->id.'">
                                  <label class="custom-control-label" for="autoSizingCheck-'.$value->id.'"></label>
                                </div>';})
        ->addColumn('code', function ($value) use ($data) {
            $action = ($value->status_id == 3 || $value->status_id == 1) ? 'view' : 'edit';
            return '<a href="'.$data['pageIndex'].'/'.$action.'/'.$value->id.'" class="text-success">'.$value->code.'</a>';})
        ->addColumn('total_price', function ($value) use ($data) {
                return number_format($value->total_price + $value->ship_price - $value->reduce_price, 0,'',',');})
        ->addColumn('status', function ($value) use ($data) {
                return '<span class="'.classStyleStatus($value->status_id,'button').'">'.$value->status->name.'</span>';})
        ->addColumn('created_at', function ($value) use ($data) {
                return formatDate($value->export_created_at,'d/m/Y');})
        ->addColumn('action', function ($value) use ($data) {
            $action = ($value->status_id == 3 || $value->status_id == 1) ? 'view' : 'edit';
            $str = '<a  
                            href="javascript:void(0)"
                            class="btn btn-icon waves-effect waves-light btn-info '.$data['form']->ajaxform.'"
                            data-title="'.$action.' '.$data['title'].'"
                            data-url="'.$data['pageIndex'].'/'.$action.'/'.$value->id.$data['path_type'].'"  
                                  >
                            <i class="mdi mdi-pencil"></i>
                        </a>
                        <a  
                            href="javascript:void(0)"
                            data-url="'.$data['pageIndex'].'/delete/'.$value->id.'"
                            data-id="'.$value->id.'"
                            class="delete-item btn btn-icon waves-effect waves-light btn-danger" 
                            >
                            <i class="mdi mdi-close"></i>
                        </a>';
            if($value->status_id == 3){
                $str.='
                <a 
                        href="javascript:void(0)"
                        onclick="loadOtherPage('."'".route('admin.wms.export.print', ['id' => $value->id])."'".')" class="btn btn-icon waves-effect waves-light btn-purple mt-1 mt-lg-0"><i class="mdi mdi-cloud-print-outline"></i></a>';
            }           
            return $str;
        })
        ->rawColumns(['action','status','code','checkbox'])->make(true);
    }


    public function totalPrice($data){
        $totalPrice = 0;
        foreach($data['product_id'] as $k => $v){
            $totalPrice += ($data['quantity'][$k] * str_replace(',', '', $data['export_price'][$k]));
        }
        return $totalPrice;
    }


    public function arrayDetail($data,$exportId){
        $dataDetail = [];
        foreach($data['product_id'] as $k => $v){
            $product = Product::with(['unit:id,name'])->select(['name','unit_id','sku'])->findOrFail($v);
            $dataDetail[$k]['product_id'] = $v;
            $dataDetail[$k]['product_code'] = $product->sku;
            $dataDetail[$k]['product_name'] = $product->name;
            $dataDetail[$k]['product_unit'] = $product->unit->name;
            $dataDetail[$k]['product_price'] = str_replace(',','',$data['export_price'][$k]);
            $dataDetail[$k]['export_id'] = $exportId;
            $dataDetail[$k]['product_quantity'] = $data['quantity'][$k];
        }
        return $dataDetail;
    }


    public function saveCustomerToId($customer = []){
        $id = isset($customer['id']) ? $customer['id'] : '';
        if($id){
            Customer::whereId($id)->update($customer);
        }else{
            $id =Customer::create($customer)->id;
        }
        return $id;
    }


    public function createHasRelation($request){
        $data = $request->except('_token','save_draft','save_success','data_child','customer');
        
        $data['status_id'] = $request->save_draft ?? $request->save_success;
        $data['total_price'] = $this->totalPrice($request->data_child) ?? 0;
        $data['reduce_price'] = str_replace(',','',$request->reduce_price ?: 0);
        $data['ship_price'] = str_replace(',','',$request->ship_price ?: 0);
        $data['customer_id'] = $this->saveCustomerToId($request->customer) ?? 0;
        $data['user_id'] = Auth::guard()->user()->id;
        $data['code'] = config('siteconfig.wmsExport.code').formatDate($request->export_created_at,'dmYHi');
        $data['export_created_at'] = formatDate($request->export_created_at,'Y-m-d H:i:s');
        if($exportId = $this->_model->create($data)->id){
            if($request->has('data_child') && count($request->data_child)){
                $wmsExport = $this->_model->findOrFail($exportId);
                $dataDetail = $this->arrayDetail($request->data_child,$exportId);
                $wmsExport->details()->createMany($dataDetail);
            }
            $response = ['id' => $exportId,'status_id' => $data['status_id'] ];
            return $response;
        }else{
            return false;
        }
    }


    public function updateHasRelation($request,$id){
        $data = $request->except('_token','_method','data_child','customer');//# request only
        $data['status_id'] = $request->save_draft ?? $request->save_success ?? $request->save_cancel;
        if($request->has('data_child')){
            $data['total_price'] = $this->totalPrice($request->data_child);
        }
        $data['reduce_price'] = str_replace(',','',$request->reduce_price ?: 0);
        $data['ship_price'] = str_replace(',','',$request->ship_price ?: 0);
        if($request->has('customer')){
            $data['customer_id'] = $this->saveCustomerToId($request->customer);
        }
        

        if($request->has('export_created_at')){
            $data['export_created_at'] = formatDate($request->export_created_at,'Y-m-d H:i:s');
        }
        if($this->_model->findOrFail($id)->update($data)){
            if($request->has('data_child') && count($request->data_child)){
                $wmsExport = $this->_model->findOrFail($id);
                $wmsExport->details()->delete('export_id',$id);
                $dataDetail = $this->arrayDetail($request->data_child,$id);
                $wmsExport->details()->createMany($dataDetail);
            }
            $response = ['id' => $id,'status_id' => $data['status_id'] ];
            return $response;
        }else{
            return false;
        }
    }
}