<?php
namespace App\Repositories\Product;
use App\Repositories\BaseRepository;
use App\Models\WmsImportDetail;
use DataTables;
use DB;
class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    //lấy model tương ứng
    
    public function getModel()
    {
        return \App\Models\Product::class;
    }
    public function subQueryWms($charTable,$store_id){
      $querySub = DB::table('wms_'.$charTable.'_details')
          ->selectRaw('IFNULL(sum(product_quantity),0) as '.$charTable.'_quantity,product_id as '.$charTable.'_product_id')
          ->groupBy('product_id')
          ->join('wms_'.$charTable.'s','wms_'.$charTable.'s.id','=','wms_'.$charTable.'_details.'.$charTable.'_id')
          ->where('wms_'.$charTable.'s.store_id','=',$store_id);
      return $querySub;
    }
    public function queryProductNoParent(){
      $value = $this->_model::select('name','id','export_price','import_price','unit_id','category_id','is_status','is_priority')
        ->withCount('children')
        ->with(['category:id,name','unit:id,name'])
        ->having('children_count','<',1);
      return $value;
    }
    //Load product have child
    public function dataProductByCondition($request){
      switch ($request) {
        case ($request->type=='noparent'):
          $value = $this->queryProductNoParent();
          break;
        case $request->has('store'): // Check sản phẩm theo kho
          $value = $this->queryProductNoParent()
            ->leftjoinSub($this->subQueryWms('export',$request->store),'export_product_id',function($query){
              $query->on('products.id','=','export_product_id');
            })
            ->leftjoinSub($this->subQueryWms('import',$request->store),'import_product_id',function($query){
              $query->on('products.id','=','import_product_id');
            })
            ->selectRaw('import_quantity - export_quantity  as total_quantity');
          break;
        default:
          $value = $this->_model::with(['category','unit','children'])
            ->select('name','id','export_price','import_price','unit_id','category_id','is_status','is_priority')
            ->where('id','<>', 0)
            ->where('parent_id','=',null);
          break;
      }
      return $value;
    }
    public function getDataByCondition($request,$data){
        $value = $this->dataProductByCondition($request);
        $arrayColumn = ['action','checkbox','status','priority'];
        $datatable = Datatables::of($value)
        ->filter(function ($query) use ($request) {
            if ($request->has('name')) {
                $query->where('name', 'like', "%{$request->get('name')}%");
            }
        });
        if($request->has('store')){
          array_push($arrayColumn,'total_quantity');
          $datatable = $datatable->addColumn('total_quantity', function($value) {
              return number_format($value->total_quantity, 0,'',',');});
        }
        $datatable = $datatable->addColumn('details_url', function($value) {
            return url('/admin/product/data-child/' . $value->id);
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
          }else{ return 'No action';}
        });
        

        return $datatable->rawColumns($arrayColumn)->make(true);
    }

    //Load product child from parent
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
                            data-url="'.$data['pageIndex'].'/child/edit/'.$value->id.$data['path_type'].'"  
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

    public function addProductChild($dataChild,$data,$id){
        if(isset($dataChild['data_child']['name'])){
          $productParent = $this->_model->findOrFail($id);
          foreach($dataChild['data_child']['name'] as $k => $value){
            $dataPerChild = [];
            $dataPerChild['parent_id'] = $id;
            $dataPerChild['category_id'] = $data['category_id'];
            $dataPerChild['unit_id'] = $data['unit_id'];
            $dataPerChild['name'] = $dataChild['data_child']['name'][$k];
            $dataPerChild['sku'] = $dataChild['data_child']['sku'][$k];
            $dataPerChild['export_price'] = str_replace(',', '', $dataChild['data_child']['export_price'][$k]);
            $dataPerChild['import_price'] = str_replace(',', '', $dataChild['data_child']['import_price'][$k]);
            if($idChild = $this->_model->create($dataPerChild)->id){
                $productChild = $this->_model->findOrFail($idChild);
                $productChild->attributes()->attach(explode(",",$dataChild['data_child']['attribute_id'][$k]));
            }
          }
        }
      return true;  
    }

    public function createHasRelation($request){
        $data = $request->except('_token','data_child');
        $data['export_price'] = str_replace(',', '', $request->export_price);
        $data['import_price'] = str_replace(',', '', $request->import_price);
        $dataChild = $request->only('data_child');
        if($id = $this->_model->create($data)->id){
          if($this->addProductChild($dataChild,$data,$id)){
            return true;
          }
        }else{
            return false;
        }
    }

    public function updateHasRelation($request,$id){
        $data = $request->except('_token','_method');//# request only
        $data['export_price'] = str_replace(',', '', $request->export_price);
        $data['import_price'] = str_replace(',', '', $request->import_price);
        $dataChild = $request->only('data_child');
        if($this->_model->findOrFail($id)->update($data)){
            if($this->addProductChild($dataChild,$data,$id)){
                return true;
            }
        }else{
            return false;
        }
    }

}