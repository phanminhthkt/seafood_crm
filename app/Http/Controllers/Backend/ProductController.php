<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\GroupAttribute;
use App\Models\Unit;
use DataTables;
use App\Repositories\Product\ProductRepositoryInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $_data;
    private $_pathType;
    private $_repository;

    public function __construct(ProductRepositoryInterface $productRepository,Request $request)
    {
        $this->_repository = $productRepository;
        $this->_pathType = '';
        $this->_data['categories'] = Category::get(['name','id']);
        $this->_data['units'] = Unit::get(['name','id']);
        $this->_data['group_attributes'] = GroupAttribute::with(['attributes:id,name,group_id'])->get([ 'id','name']);
        $this->_data['pageIndex'] = route('admin.product.index');
        $this->_data['title'] = config('siteconfig.product.title');
        $this->_data['table'] = config('siteconfig.product.table');
        //Load ajax if ajax-form,dev-form for add,edit.
        //Direct in if devform '' and ajaxForm=direct-form
        $this->_data['form'] = (object)['devform'=>'','ajaxform'=>'direct-form'];
        $this->_data['type'] = $request->type;
        $this->_data['path_type'] = isset($_GET['type']) ? '?type='.$_GET['type']:'';
    }

    public function index(Request $request)
    {
        $value = Product::with(['category','unit','children'])->select('name','id','export_price','import_price','unit_id','category_id','is_status','is_priority')->where('id','<>', 0)->where('parent_id','=', null)->get();
        return view('backend.product.index', $this->_data);
    }
    public function getData(Request $request)
    {   
        return $this->_repository->getDataByCondition($request,Arr::except($this->_data, 'groups'));
    }
    public function getDataChild($id,Request $request)
    {   
        return $this->_repository->getDataChildByCondition($id,$request,Arr::except($this->_data, 'groups'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.product.add',$this->_data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($this->_repository->createHasRelation($request)){
            return redirect()->route('admin.product.index')->with('success', 'Thêm sản phẩm <b>'. $request->name .'</b> thành công');
        }else{
            return redirect()->route('admin.product.index')->with('danger', 'Thêm sản phẩm <b>'. $request->name .'</b> thất bại.Xin vui lòng thử lại');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if($this->_repository->findOrFail($id)->children->count() > 0 || $this->_repository->findOrFail($id)->parent_id!=NULL){
            return redirect()->route('admin.product.index')->with('warning', 'Vui lòng chọn sản phẩm cùng loại để chỉnh sửa');
        }
        $this->_data['item'] = $this->_repository->getModel()::with('photos')->findOrFail($id);
        // dd($this->_data['item']);
        return view('backend.product.edit',$this->_data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        if($this->_repository->updateHasRelation($request, $id) ){
            return redirect()->route('admin.product.index')->with('success', 'Chỉnh sửa sản phẩm <b>'. $request->name .'</b> thành công');
        }else{
            return redirect()->route('admin.product.index')->with('danger', 'Chỉnh sửa sản phẩm <b>'. $request->name .'</b> thất bại.Xin vui lòng thử lại');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {   
        $this->deletePhoto($id);
        
        $this->_repository->deleteProductPhotos($id);
        $childProducts = Product::select(['id','photo'])->where('parent_id','=',$id)->get();
        foreach($childProducts as $child){
            $this->_repository->deleteProductPhotos($child->id);
        }
            if($this->_repository->delete($id)){
                return ['success' => true, 'message' => 'Xóa sản phẩm thành công !!'];
            }else{
                return ['error' => true, 'message' => 'Xóa sản phẩm thất bại.Xin vui lòng thử lại !!'];
            }
        
    }
    public function deleteMultiple($listId)
    {
        $arrId = explode(",",$listId);
        foreach($arrId as $itemId){
            $this->deletePhoto($itemId);
            $this->_repository->deleteProductPhotos($itemId);
            $childProducts = Product::select(['id','photo'])->where('parent_id','=',$itemId)->get();
            foreach($childProducts as $child){
                $this->_repository->deleteProductPhotos($child->id);
            }
        }
        if($this->_repository->deleteMultiple($listId)){
            return ['success' => true, 'message' => 'Xóa sản phẩm thành công !!'];
        }else{
            return ['error' => true, 'message' => 'Xóa sản phẩm thất bại.Xin vui lòng thử lại !!'];
        }
    }
    public function deletePhoto($id)
    {
        $item = $this->_repository->findOrFail($id);
        if(File::exists(public_path('uploads/products/').$item->photo)){
            File::delete(public_path('uploads/products/').$item->photo);
        }
    }
    public function createChild($id)
    {
        $this->_data['item'] = $this->_repository->findOrFail($id);
        $this->_data['item']->setRelation('photos', null);
        $this->_data['item']->photo = null;
        return view('backend.product.add_child',$this->_data);
    }
    public function storeChild(Request $request, $id)
    {
        $data = $request->except('_token','_method');//# request only
        if($request->hasFile('file_photo')){
          $this->_repository->checkValidateFile($request);
          $data['photo']  = generateFile($request->file_photo,'uploads/products/');
        }
        $data['export_price'] = str_replace(',', '', $request->export_price);
        $data['import_price'] = str_replace(',', '', $request->import_price);
        $data['parent_id'] = $id;
        $dataAlbum = $request->only('data_album');
        if($idChild = $this->_repository->create($data)->id){
            $this->_repository->addPhotoChild($dataAlbum,$request,$idChild);//Delete album
            $product = $this->_repository->findOrFail($idChild);
            $product->attributes()->attach($request->attribute_id);
            return redirect()->route('admin.product.index')->with('success', 'Tạo sản phẩm con <b>'. $request->name .'</b> thành công');
        }else{
            return redirect()->route('admin.product.index')->with('danger', 'Tạo sản phẩm con <b>'. $request->name .'</b> thất bại.Xin vui lòng thử lại');
        }
    }
    public function editChild($id)
    {
        $this->_data['item'] = $this->_repository->findOrFail($id);
        // dd($this->_data['item']);
        return view('backend.product.edit_child',$this->_data);
    }
    public function updateChild(Request $request, $id)
    {
        $data = $request->except('_token','_method');//# request only
        if($request->hasFile('file_photo')){
          $this->_repository->checkValidateFile($request);
          $productPhoto = $this->_repository->findOrFail($id)->photo;
          if(File::exists(public_path('uploads/products/').$productPhoto)){
            File::delete(public_path('uploads/products/').$productPhoto);
          }
          $data['photo']  = generateFile($request->file_photo,'uploads/products/');
        }
        $product = $this->_repository->findOrFail($id);
        $data['export_price'] = str_replace(',', '', $request->export_price);
        $data['import_price'] = str_replace(',', '', $request->import_price);
        $dataAlbum = $request->only('data_album');
        if($this->_repository->update($id,$data)){
            $this->_repository->addPhotoChild($dataAlbum,$request,$id);
            $product->attributes()->sync($request->attribute_id);
            return redirect()->route('admin.product.index')->with('success', 'Chỉnh sửa sản phẩm <b>'. $request->name .'</b> thành công');
        }else{
            return redirect()->route('admin.product.index')->with('danger', 'Chỉnh sửa sản phẩm <b>'. $request->name .'</b> thất bại.Xin vui lòng thử lại');
        }
    }
}
