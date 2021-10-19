<?php
namespace App\Repositories\Product;
use App\Repositories\BaseRepository;
use Validator;
use App\Models\WmsImportDetail;
use App\Traits\WmsTrait;
use App\Models\ProductPhotos;
use DataTables;
use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    use WmsTrait;
    
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Product::class;
    }
    
    public function queryProductDefault(){
      $value = $this->_model::with(['category','unit','children'])
            ->select('name','id','export_price','import_price','unit_id','category_id','is_status','is_priority')
            ->where('id','<>', 0)
            ->where('parent_id','=',null);
      return $value;
    }
    //Load product have child
    public function dataProductByCondition($request){
      switch ($request) {
        case ($request->type=='noparent'):
          $value = $this->queryProductNoParent();
          break;
        case $request->has('store'):
          $value = $this->fullQueryWareHouse($request);
          break;
        default:
          $value = $this->queryProductDefault();
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
    public function deleteProductPhotos($product_id){
      $photos = ProductPhotos::where('product_id','=', $product_id)->pluck('photo');
      foreach($photos as $photo){
        if(File::exists(public_path('uploads/products/'.$photo))){
          File::delete(public_path('uploads/products/').$photo);
        }
      } 
      ProductPhotos::where('product_id','=',$product_id)->delete();
    }
    public function addPhotoChild($dataAlbum,$request,$id){
      if(count($dataAlbum)){
        $dataAlbumC = [];
        $photos = ProductPhotos::where('product_id','=', $id)->pluck('photo');
        if($request->_method == "PUT" && count($photos)>0){ // Check update Product
          foreach($photos as $photo){ // Check delete and update photo
            if(!in_array($photo,$dataAlbum['data_album']['hidden'])){
              if(File::exists(public_path('uploads/products/').$photo)){
                File::delete(public_path('uploads/products/').$photo);
              }
              ProductPhotos::where('photo','=',$photo)->delete();
            }else{
              $dem = 0;
              foreach($dataAlbum['data_album']['hidden'] as $k => $hidden){
                if($hidden==''){
                  $photo = generateFile($request->file_photos[$k - $dem],'uploads/products/');
                  ProductPhotos::insert([
                    'product_id' => $id,
                    'name' => $dataAlbum['data_album']['name'][$k],
                    'is_priority' => $dataAlbum['data_album']['stt'][$k],
                    'photo' => $photo
                  ]);
                }else{
                  ProductPhotos::where('product_id','=',$id)->where('photo','=',$hidden)->update(
                    [
                      'name' => $dataAlbum['data_album']['name'][$k],
                      'is_priority' => $dataAlbum['data_album']['stt'][$k]
                    ]
                  );
                  $dem++;
                }
              }
            }
          }
        }else{ // Check add Product
          if(isset($dataAlbum['data_album']['stt'])){
            foreach($dataAlbum['data_album']['stt'] as $k => $value){
              $dataAlbumC[$k]['product_id'] = $id;
              $dataAlbumC[$k]['name'] = $dataAlbum['data_album']['name'][$k];
              $dataAlbumC[$k]['is_priority'] = $dataAlbum['data_album']['stt'][$k];
              $dataAlbumC[$k]['photo'] = generateFile($request->file_photos[$k],'uploads/products/');
            }
          }
          ProductPhotos::insert($dataAlbumC);
        }
      }else{ // Delete all photo child
        $this->deleteProductPhotos($id);
      }
      return true;  
    }
    public function createHasRelation($request){

        $data = $request->except('_token','data_child','data_album','file_photo','file_photos');
        if($request->hasFile('file_photo')){
          $this->checkValidateFile($request);
          $data['photo']  = generateFile($request->file_photo,'uploads/products/');
        }
        $data['export_price'] = str_replace(',', '', $request->export_price);
        $data['import_price'] = str_replace(',', '', $request->import_price);
        $dataChild = $request->only('data_child');
        $dataAlbum = $request->only('data_album');
        if($id = $this->_model->create($data)->id){
          if($this->addProductChild($dataChild,$data,$id) && $this->addPhotoChild($dataAlbum,$request,$id)){
            return true;
          }
        }else{
            return false;
        }
    }

    public function updateHasRelation($request,$id){
        $data = $request->except('_token','_method');//# request only
        if($request->hasFile('file_photo')){
          $this->checkValidateFile($request);
          $productPhoto = $this->_model->findOrFail($id)->photo;
          if(File::exists(public_path('uploads/products/').$productPhoto)){
            File::delete(public_path('uploads/products/').$productPhoto);
          }
          $data['photo']  = generateFile($request->file_photo,'uploads/products/');
        }
        $data['export_price'] = str_replace(',', '', $request->export_price);
        $data['import_price'] = str_replace(',', '', $request->import_price);
        $dataChild = $request->only('data_child');
        $dataAlbum = $request->only('data_album');
        if($this->_model->findOrFail($id)->update($data)){
            if($this->addProductChild($dataChild,$data,$id) && $this->addPhotoChild($dataAlbum,$request,$id)){
              return true;
            }
        }else{
            return false;
        }
    }

    public function checkValidateFile($request){
      $request->validate([
              'file' => 'mimes:jpg,png,jpeg,gif|max:20000'],          
          [
              'file.mimes' => 'Chỉ chấp nhận file đuôi jpg,png,jpeg,gif',
              'file.max' => 'File giới hạn dung lượng không quá 2M',
          ]
      );
    }
}