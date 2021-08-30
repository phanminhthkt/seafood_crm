<?php
namespace App\Repositories\Role;
use App\Repositories\BaseRepository;
use DataTables;
class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Role::class;
    }
    public function getDataByCondition($request,$data){
        $value = $this->_model::select('name','id','is_status','is_priority')->where('id','<>', 0);
        return Datatables::of($value)
        ->filter(function ($query) use ($request) {
            if ($request->has('name')) {
                $query->where('name', 'like', "%{$request->get('name')}%");
            }
        })
        ->order(function ($query) {$query->orderBy('id', 'desc');})
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
                            class="btn btn-icon waves-effect waves-light btn-info"
                            data-title="Sửa '.$data['title'].'"
                            href="'.$data['pageIndex'].'/edit/'.$value->id.$data['path_type'].'"  
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
        ->rawColumns(['action','checkbox','status','priority'])->make(true);
    }
}