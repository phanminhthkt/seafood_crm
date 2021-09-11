<?php
namespace App\Repositories\Product;
use App\Repositories\BaseRepository;
use DataTables;
class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Product::class;
    }
    public function getDataByCondition($request,$data){
        $value = $this->_model::with(['category','unit','children'])->select('name','id','export_price','import_price','unit_id','category_id','is_status','is_priority')->where('id','<>', 0)->where('parent_id','=',null);
        return Datatables::of($value)
        ->filter(function ($query) use ($request) {
            if ($request->has('name')) {
                $query->where('name', 'like', "%{$request->get('name')}%");
            }
        })
        ->addColumn('details_url', function($value) {
            return url('/admin/product/child/' . $value->id);
        })
        ->addColumn('export_price', function ($value) use ($data) {
                return number_format($value->export_price, 0,'',',');})
        ->addColumn('import_price', function ($value) use ($data) {
                return number_format($value->import_price, 0,'',',');})
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
          if($value->children->count() < 1){
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
                        </a>';
          }
                })
        ->rawColumns(['action','checkbox','status','priority'])->make(true);
    }
    public function getDataChildByCondition($id,$request,$data){
        $value = $this->_model::with(['category','unit'])->select('name','id','export_price','import_price','unit_id','category_id','is_status','is_priority')->where('id','<>', 0)->where('parent_id','=',$id);
        return Datatables::of($value)
        ->filter(function ($query) use ($request) {
            if ($request->has('name')) {
                $query->where('name', 'like', "%{$request->get('name')}%");
            }
        })
        ->addColumn('export_price', function ($value) use ($data) {
                return number_format($value->export_price, 0,'',',');})
        ->addColumn('import_price', function ($value) use ($data) {
                return number_format($value->import_price, 0,'',',');})
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
                        </a>';
                })
        ->rawColumns(['action','checkbox','status','priority'])->make(true);
    }
}