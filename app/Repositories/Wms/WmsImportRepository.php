<?php
namespace App\Repositories\Wms;
use App\Repositories\BaseRepository;
use DataTables;
class WmsImportRepository extends BaseRepository implements WmsImportRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\WmsImport::class;
    }
    public function getDataByCondition($request,$data){
        $value = $this->_model::with(['status','store'])->select('id','code','store_id','status_id','user_id','total_price','is_status','created_at')->where('id','<>', 0);
        return Datatables::of($value)
        ->filter(function ($query) use ($request) {
            if ($request->has('code')) {
                $query->where('code', 'like', "%{$request->get('code')}%");
            }
        })
        ->addColumn('checkbox', function ($value) use ($data) {
                return '<div class="custom-control custom-checkbox text-center">
                                  <input type="checkbox" class="custom-control-input select-checkbox" value="'.$value->id.'" id="autoSizingCheck-'.$value->id.'">
                                  <label class="custom-control-label" for="autoSizingCheck-'.$value->id.'"></label>
                                </div>';})
        ->addColumn('code', function ($value) use ($data) {
                return '<a href="'.$data['pageIndex'].'/edit/'.$value->id.'" class="text-success">'.$value->code.'</a>';})
        ->addColumn('total_price', function ($value) use ($data) {
                return number_format($value->total_price, 0,'',',');})
        ->addColumn('status', function ($value) use ($data) {
                return '<span class="'.classStyleStatus($value->status_id,'button').'">'.$value->status->name.'</span>';})
        ->addColumn('created_at', function ($value) use ($data) {
                return formatDate($value->created_at,'d/m/Y');})
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
        ->rawColumns(['action','status','code','checkbox'])->make(true);
    }
}