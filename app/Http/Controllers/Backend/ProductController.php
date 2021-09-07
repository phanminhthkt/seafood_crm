<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\GroupAttribute;
use App\Models\Unit;
use DataTables;
use App\Repositories\Product\ProductRepositoryInterface;
use Illuminate\Support\Arr;

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
        return view('backend.product.index', $this->_data);
    }
    public function getData(Request $request)
    {   
        return $this->_repository->getDataByCondition($request,Arr::except($this->_data, 'groups'));
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
        $data = $request->except('_token');
        if($this->_repository->create($data)){
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
        $this->_data['item'] = $this->_repository->findOrFail($id);
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
        $data = $request->except('_token','_method');//# request only
        if($this->_repository->update($id,$data)){
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
        if($this->_repository->delete($id)){
            return ['success' => true, 'message' => 'Xóa sản phẩm thành công !!'];
        }else{
            return ['error' => true, 'message' => 'Xóa sản phẩm thất bại.Xin vui lòng thử lại !!'];
        }
    }
    public function deleteMultiple($listId)
    {
        if($this->_repository->deleteMultiple($listId)){
            return ['success' => true, 'message' => 'Xóa sản phẩm thành công !!'];
        }else{
            return ['error' => true, 'message' => 'Xóa sản phẩm thất bại.Xin vui lòng thử lại !!'];
        }
    }
}
