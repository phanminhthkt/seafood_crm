<?php
namespace App\Repositories\Customer;
use App\Repositories\BaseRepository;
use DataTables;
use App\Models\WmsExport;
class CustomerRepository extends BaseRepository implements CustomerRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Customer::class;
    }
    public function getDataByCondition($request,$data){
        $value = $this->_model::with(['orders'])->select('name','phone','id','is_status','is_priority')->where('id','<>', 0);

        return Datatables::of($value)
        ->filter(function ($query) use ($request) {
            if ($request->has('name')) {
                $query->where('name', 'like', "%{$request->get('name')}%");
            }
        })
        ->addColumn('checkbox', function ($value) use ($data) {
                return '<div class="custom-control custom-checkbox text-center">
                                  <input type="checkbox" class="custom-control-input select-checkbox" value="'.$value->id.'" id="autoSizingCheck-'.$value->id.'">
                                  <label class="custom-control-label" for="autoSizingCheck-'.$value->id.'"></label>
                                </div>';})
        ->addColumn('priority', function ($value) use ($data) {
                return '<input type="text" 
                                name="is_priority"
                                data-table="'.$data['table'].'"
                                data-id="'.$value->id.'"
                                class="form-control input-mini input-priority p-0 text-center" 
                                value="'.$value->is_priority.'" />';})
        ->addColumn('sum_order', function ($value) use ($data) {
                return '<span class="text-success">'.number_format($value->getTotalPerCustomer(), 0,'',',').' đ</span>';})
        ->addColumn('status', function ($value) use ($data) {
                return '<div class="custom-control custom-checkbox text-center">
                                  <input 
                                  type="checkbox" 
                                  data-table="'.$data['table'].'"
                                  data-id="'.$value->id.'"
                                  data-kind="is_status"
                                  class="custom-control-input dev-checkbox"
                                  id="autoSizingCheckKink-'.$value->id.'"
                                  '.($value->is_status==1 ? 'checked' :'').'
                                  >
                                  <label class="custom-control-label" for="autoSizingCheckKink-'.$value->id.'"></label>
                                </div>';})
        ->addColumn('action', function ($value) use ($data) {
                return '<a  
                            href="javascript:void(0)"
                            class="btn btn-icon waves-effect waves-light btn-info '.$data['form']->ajaxform.'"
                            data-title="Sửa '.$data['title'].'"
                            data-url="'.$data['pageIndex'].'/edit/'.$value->id.$data['path_type'].'"  
                                  >
                            <i class="mdi mdi-pencil"></i>
                        </a>
                        <a  
                            href="javascript:void(0)"
                            data-url="'.$data['pageIndex'].'/delete/'.$value->id.'"
                            data-id="'.$value->id.'"
                            class="delete-item btn btn-icon waves-effect waves-light btn-danger ml-1" 
                            >
                            <i class="mdi mdi-close"></i>
                        </a>';})
        ->rawColumns(['action','checkbox','sum_order','status','priority'])->make(true);
    }

    public function getDataOrders($id,$data){
        $value = WmsExport::with(['status'])->select('id','code','status_id','total_price','ship_price','reduce_price','is_status','export_created_at')->where('id','<>', 0)->where('customer_id','=',$id);
        return Datatables::of($value)
        ->addColumn('code', function ($value) use ($data) {
                return '<a href="javascript:void(0)" onclick="loadOtherPage('."'".route('admin.wms.export.print', ['id' => $value->id])."'".')" class="text-success">'.$value->code.'</a>';})
        ->addColumn('total', function ($value) use ($data) {
                return number_format($value->total_price + $value->ship_price - $value->reduce_price, 0,'',',');})
        ->addColumn('status', function ($value) use ($data) {
                return '<span class="'.classStyleStatus($value->status_id,'button').'">'.$value->status->name.'</span>';})
        ->addColumn('created_at', function ($value) use ($data) {
                return formatDate($value->export_created_at,'d/m/Y H:i');})
        ->rawColumns(['status','total','code'])->make(true);
    }
}