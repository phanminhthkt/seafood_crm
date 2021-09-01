<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;
use Illuminate\Support\Str;
use DataTables;
use App\Repositories\Permission\PermissionRepositoryInterface;
use Illuminate\Support\Arr;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $_data;
    private $_pathType;
    private $_repository;

    public function __construct(PermissionRepositoryInterface $permissionRepository,Request $request)
    {
        $this->_repository = $permissionRepository;
        $this->_pathType = '';
        $this->_data['pageIndex'] = route('admin.permission.index');
        $this->_data['table'] = 'permissions';
        $this->_data['form'] = (object)['devform'=>'dev-form','ajaxform'=>'ajax-form'];
        $this->_data['title'] = 'Phân quyền';
        $this->_data['type'] = $request->type;
        $this->_data['path_type'] = isset($_GET['type']) ? '?type='.$_GET['type']:'';
    }

    public function index(Request $request)
    {
        return view('backend.permission.index', $this->_data);
    }

    public function getData(Request $request)
    {   
        return $this->_repository->getDataByCondition($request,$this->_data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.permission.add',$this->_data);
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
        $data['slug'] = Str::slug($request->action.' '.$request->module, '-');
        if($this->_repository->create($data)){
            return redirect()->route('admin.permission.index')->with('success', 'Thêm quyền <b>'. $request->name .'</b> thành công');
        }else{
            return redirect()->route('admin.permission.index')->with('danger', 'Thêm quyền <b>'. $request->name .'</b> thất bại.Xin vui lòng thử lại');
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
        return view('backend.permission.edit',$this->_data);
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
        $this->_repository->findOrFail($id);
        $data = $request->except('_token','_method');//# request only
        $data['slug'] = Str::slug($request->action.' '.$request->module, '-');
        if($this->_repository->update($id,$data)){
            return redirect()->route('admin.permission.index')->with('success', 'Chỉnh sửa quyền <b>'. $request->name .'</b> thành công');
        }else{
            return redirect()->route('admin.permission.index')->with('danger', 'Chỉnh sửa quyền <b>'. $request->name .'</b> thất bại.Xin vui lòng thử lại');
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
            return ['success' => true, 'message' => 'Xóa quyền thành công !!'];
        }else{
            return ['error' => true, 'message' => 'Xóa quyền thất bại.Xin vui lòng thử lại !!'];
        }
    }
    public function deleteMultiple($listId)
    {
        if($this->_repository->deleteMultiple($listId)){
            return ['success' => true, 'message' => 'Xóa quyền thành công !!'];
        }else{
            return ['error' => true, 'message' => 'Xóa quyền thất bại.Xin vui lòng thử lại !!'];
        }
    }

    
}
