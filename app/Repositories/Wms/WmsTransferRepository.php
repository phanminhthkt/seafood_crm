<?php
namespace App\Repositories\Wms;
use App\Repositories\BaseRepository;
use App\Models\Product;
use Auth;
use DataTables;
use Carbon\Carbon;
use App\Traits\WmsTrait;

class WmsTransferRepository extends BaseRepository implements WmsTransferRepositoryInterface
{
    use WmsTrait;
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\WmsTransfer::class;
    }
    public function getDataByCondition($request,$data){
        $value = $this->_model::with(['status:id,name','fromStore:id,name','toStore:id,name'])->select('id','code','store_from_id','store_to_id','status_id','user_id','total_price','is_status','transfer_created_at')->where('id','<>', 0);
        return Datatables::of($value)
        ->filter(function ($query) use ($request) {
            if ($request->has('status') && $request->status!='') {
                $query->where('status_id', '=', $request->get('status'));
            }
            if ($request->has('store_from') && $request->store_from!='') {
                $query->where('store_from_id', '=', $request->get('store_from'));
            }
            if ($request->has('store_to') && $request->store_to!='') {
                $query->where('store_to_id', '=', $request->get('store_to'));
            }
            if ($request->has('created_at') && $request->created_at!='') {
                $time = explode('to',str_replace(' ','',$request->created_at));
                if(count($time)>1){
                    $next_day = Carbon::parse($time[1])->addDay()->format('Y-m-d');
                    $query->whereBetween('transfer_created_at', array(formatDate($time[0],'Y-m-d'),$next_day));
                }else{
                    $next_day = Carbon::parse($time[0])->addDay()->format('Y-m-d');
                    $query->whereBetween('transfer_created_at', array(formatDate($time[0],'Y-m-d'),$next_day));
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
                return number_format($value->total_price, 0,'',',');})
        ->addColumn('status', function ($value) use ($data) {
                return '<span class="'.classStyleStatus($value->status_id,'button').'">'.$value->status->name.'</span>';})
        ->addColumn('created_at', function ($value) use ($data) {
                return formatDate($value->transfer_created_at,'d/m/Y');})
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
                        onclick="loadOtherPage('."'".route('admin.wms.transfer.print', ['id' => $value->id])."'".')" class="btn btn-icon waves-effect waves-light btn-purple mt-1 mt-lg-0"><i class="mdi mdi-cloud-print-outline"></i></a>';
            }           
            return $str;
        })
        ->rawColumns(['action','status','code','checkbox'])->make(true);
    }
    public function totalPrice($data){
        $totalPrice = 0;
        foreach($data['product_id'] as $k => $v){
            $totalPrice += ($data['quantity'][$k] * str_replace(',', '', $data['import_price'][$k]));
        }
        return $totalPrice;
    }
    public function arrayDetail($request,$transferId){
        $dataDetail = [];
        foreach($request->data_child['product_id'] as $k => $v){
            if($this->checkNumberInventory($request,$v) > 0){
                $product = Product::with(['unit:id,name'])->select(['name','unit_id','sku'])->findOrFail($v);
                $dataDetail[$k]['product_id'] = $v;
                $dataDetail[$k]['product_code'] = $product->sku;
                $dataDetail[$k]['product_name'] = $product->name;
                $dataDetail[$k]['product_unit'] = $product->unit->name;
                $dataDetail[$k]['product_price'] = str_replace(',','',$request->data_child['import_price'][$k]);
                $dataDetail[$k]['transfer_id'] = $transferId;
                $dataDetail[$k]['product_quantity'] = $request->data_child['quantity'][$k];
            }
        }
        return $dataDetail;
    }
    public function createHasRelation($request){
        $data = $request->except('_token','save_draft','save_success','data_child');
        $data['status_id'] = $request->save_draft ?? $request->save_success;
        $data['total_price'] = $this->totalPrice($request->data_child) ?? 0;
        $data['user_id'] = Auth::guard()->user()->id;
        $data['code'] = config('siteconfig.wmsTransfer.code').formatDate($request->transfer_created_at,'dmYHi');
        $data['transfer_created_at'] = formatDate($request->transfer_created_at,'Y-m-d H:i:s');
        if($transferId = $this->_model->create($data)->id){
            if($request->has('data_child') && count($request->data_child)){
                $wmsTransfer = $this->_model->findOrFail($transferId);
                $dataDetail = $this->arrayDetail($request,$transferId);
                $wmsTransfer->details()->createMany($dataDetail);
            }
            $response = ['id' => $transferId,'status_id' => $data['status_id'] ];
            return $response;
        }else{
            return false;
        }
    }

    public function updateHasRelation($request,$id){
        $data = $request->except('_token','_method','data_child');//# request only
        $data['status_id'] = $request->save_draft ?? $request->save_success ?? $request->save_cancel;
        if($request->has('data_child')){
            $data['total_price'] = $this->totalPrice($request->data_child) ?? 0;
        }
        if($request->has('transfer_created_at')){
            $data['transfer_created_at'] = formatDate($request->transfer_created_at,'Y-m-d H:i:s');
        }
        if($this->_model->findOrFail($id)->update($data)){
            if($request->has('data_child') && count($request->data_child)){
                $wmsTransfer = $this->_model->findOrFail($id);
                $wmsTransfer->details()->delete('transfer_id',$id);
                $dataDetail = $this->arrayDetail($request,$id);
                $wmsTransfer->details()->createMany($dataDetail);
            }
            $response = ['id' => $id,'status_id' => $data['status_id'] ];
            return $response;
        }else{
            return false;
        }
    }
}