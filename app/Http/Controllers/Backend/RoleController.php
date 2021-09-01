<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;
use Illuminate\Support\Str;
use App\Http\Helpers\helpers;
use App\Repositories\Role\RoleRepositoryInterface;
use Illuminate\Support\Arr;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $_data;
    private $_pathType;
    private $_repository;

    public function __construct(RoleRepositoryInterface $roleRepository,Permission $permission,Request $request)
    {
        $this->_repository = $roleRepository;
        $this->_pathType = '';
        $this->_data['pageIndex'] = route('admin.role.index');
        $this->_data['permissions'] = Permission::all()->groupBy('module');
        $this->_data['title'] = config('siteconfig.role.title');
        $this->_data['table'] = config('siteconfig.role.table');
        $this->_data['form'] = (object)['devform'=>'','ajaxform'=>'direct-form'];
        $this->_data['type'] = $request->type;
        $this->_data['path_type'] = isset($_GET['type']) ? '?type='.$_GET['type']:'';
    }

    public function index(Request $request)
    {
        return view('backend.role.index', $this->_data);
    }
    public function getData(Request $request)
    {   
        return $this->_repository->getDataByCondition($request,Arr::except($this->_data, 'permissions'));
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
        if($roleId = $this->_repository->create($data)->id){
            $role = $this->_repository->findOrFail($roleId);
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
        $this->_data['item'] = $this->_repository->findOrFail($id);
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
        $role = $this->_repository->findOrFail($id);
        $data = $request->except('_token','_method','permission');//# request only
        $data['slug'] = Str::slug($request->name, '-');
        if($this->_repository->update($id,$data)){
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
        if($this->_repository->delete($id)){
            return ['success' => true, 'message' => 'Xóa vai trò thành công !!'];
        }else{
            return ['error' => true, 'message' => 'Xóa vai trò thất bại.Xin vui lòng thử lại !!'];
        }
    }
    public function deleteMultiple($listId)
    {
        if($this->_repository->deleteMultiple($listId)){
            return ['success' => true, 'message' => 'Xóa vai trò thành công !!'];
        }else{
            return ['error' => true, 'message' => 'Xóa vai trò thất bại.Xin vui lòng thử lại !!'];
        }
    }
}
