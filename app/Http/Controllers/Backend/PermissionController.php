<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;
use Illuminate\Support\Str;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $_data;
    private $_pathType;
    private $_model;

    public function __construct(Permission $permission,Request $request)
    {
        $this->_model = $permission;
        $this->_pathType = '';
        $this->_data['pageIndex'] = route('admin.permission.index');
        $this->_data['table'] = 'permissions';
        $this->_data['title'] = 'Phân quyền';
        $this->_data['type'] = $request->type;
        $this->_data['path_type'] = isset($_GET['type']) ? '?type='.$_GET['type']:'';
    }

    public function index(Request $request)
    {
        $sql  = $this->_model::where('id','<>', 0);
        if($request->has('term')){
            $sql->where('name', 'Like', '%' . $request->term . '%');
            $this->_pathType .= '?term='.$request->term;
        }
        $this->_data['items'] = $sql->orderBy('module','desc')->paginate(10)->withPath(url()->current().$this->_pathType);
        return view('backend.permission.index', $this->_data);
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
        if($this->_model->create($data)){
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
        $this->_data['item'] = $this->_model->findOrFail($id);
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
        $this->_model->findOrFail($id);
        $data = $request->except('_token','_method');//# request only
        $data['slug'] = Str::slug($request->action.' '.$request->module, '-');
        if($this->_model->where('id', $id)->update($data)){
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
        $this->_model->findOrFail($id);
        if($this->_model->where('id', $id)->delete()){
            return ['success' => true, 'message' => 'Xóa quyền thành công !!'];
        }else{
            return ['error' => true, 'message' => 'Xóa quyền thất bại.Xin vui lòng thử lại !!'];
        }
    }
    public function deleteMultiple($listId)
    {
        if($this->_model->whereIn('id',explode(",",$listId))->delete()){
            return ['success' => true, 'message' => 'Xóa quyền thành công !!'];
        }else{
            return ['error' => true, 'message' => 'Xóa quyền thất bại.Xin vui lòng thử lại !!'];
        }
    }

    
}
