<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Str;
use App\Http\Helpers\helpers;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $_data;
    private $_pathType;
    private $_model;

    public function __construct(Role $role,Permission $permission,Request $request)
    {
        $this->_model = $role;
        $this->_pathType = '';
        $this->_data['pageIndex'] = route('admin.role.index');
        $this->_data['permissions'] = Permission::all()->groupBy('module');
        $this->_data['table'] = 'roles';
        $this->_data['title'] = 'Vai trò';
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
        $this->_data['items'] = $sql->orderBy('id','desc')->paginate(10)->withPath(url()->current().$this->_pathType);
        return view('backend.role.index', $this->_data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.role.add',$this->_data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token','permission');
        $data['slug'] = Str::slug($request->name, '-');
        if($roleId = $this->_model->create($data)->id){
            $role = $this->_model::find($roleId);
            $role->permissions()->attach($request->permission);
            return redirect()->route('admin.role.index')->with('success', 'Thêm vai trò <b>'. $request->name .'</b> thành công');
        }else{
            return redirect()->route('admin.role.index')->with('danger', 'Thêm vai trò <b>'. $request->name .'</b> thất bại.Xin vui lòng thử lại');
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
        $this->_data['permission_array'] = [];
        foreach($this->_data['item']->permissions as $v){array_push($this->_data['permission_array'],$v['id']);}
        return view('backend.role.edit',$this->_data);
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
        $role = $this->_model->findOrFail($id);
        $data = $request->except('_token','_method','permission');//# request only
        $data['slug'] = Str::slug($request->name, '-');
        if($role->where('id', $id)->update($data)){
            $role->permissions()->sync($request->permission);
            return redirect()->route('admin.role.index')->with('success', 'Chỉnh sửa vai trò <b>'. $request->name .'</b> thành công');
        }else{
            return redirect()->route('admin.role.index')->with('danger', 'Chỉnh sửa vai trò <b>'. $request->name .'</b> thất bại.Xin vui lòng thử lại');
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
            return ['success' => true, 'message' => 'Xóa vai trò thành công !!'];
        }else{
            return ['error' => true, 'message' => 'Xóa vai trò thất bại.Xin vui lòng thử lại !!'];
        }
    }
    public function deleteMultiple($listId)
    {
        if($this->_model->whereIn('id',explode(",",$listId))->delete()){
            return ['success' => true, 'message' => 'Xóa vai trò thành công !!'];
        }else{
            return ['error' => true, 'message' => 'Xóa vai trò thất bại.Xin vui lòng thử lại !!'];
        }
    }
}
