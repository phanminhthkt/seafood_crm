<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GroupMember;
use App\Models\Role;

class GroupMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $_data;
    private $_pathType;
    private $_model;

    public function __construct(GroupMember $groupMember,Request $request)
    {
        $this->_model = $groupMember;
        $this->_pathType = '';
        $this->_data['pageIndex'] = route('admin.group_member.index');
        $this->_data['roles'] = Role::all();
        $this->_data['table'] = 'group_members';
        $this->_data['form'] = (object)['devform'=>'dev-form','ajaxform'=>'ajax-form'];
        $this->_data['title'] = 'Nhóm thành viên';
        $this->_data['type'] = $request->type;
        $this->_data['path_type'] = isset($_GET['type']) ? '?type='.$_GET['type']:'';
    }

    public function index(Request $request)
    {
        $sql  = $this->_model::where('id','<>', 0)->where('type',$request->type);
        if($request->has('term')){
            $sql->where('name', 'Like', '%' . $request->term . '%');
            $this->_pathType .= '?term='.$request->term;
        }
        $this->_data['items'] = $sql->orderBy('id','desc')->paginate(10)->withPath(url()->current().$this->_pathType);
        return view('backend.group_member.index', $this->_data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.group_member.add',$this->_data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token','role');
        if($groupId = $this->_model->create($data)->id){
            $group = $this->_model::find($groupId);
            $group->roles()->attach($request->role);

            return redirect()->route('admin.group_member.index',['type' => $request->type])->with('success', 'Thêm nhóm <b>'. $request->name .'</b> thành công');
        }else{
            return redirect()->route('admin.group_member.index',['type' => $request->type])->with('danger', 'Thêm nhóm <b>'. $request->name .'</b> thất bại.Xin vui lòng thử lại');
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
        $this->_data['role_array'] = [];
        foreach($this->_data['item']->roles as $v){array_push($this->_data['role_array'],$v['id']);}
        return view('backend.group_member.edit',$this->_data);
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
        $group =$this->_model->findOrFail($id);
        $data = $request->except('_token','_method','role');//# request only
        if($group->where('id', $id)->update($data)){
            $group->roles()->sync($request->role);
            return redirect()->route('admin.group_member.index',['type' => $request->type])->with('success', 'Chỉnh sửa nhóm <b>'. $request->name .'</b> thành công');
        }else{
            return redirect()->route('admin.group_member.index',['type' => $request->type])->with('danger', 'Chỉnh sửa nhóm <b>'. $request->name .'</b> thất bại.Xin vui lòng thử lại');
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
            return ['success' => true, 'message' => 'Xóa nhóm thành công !!'];
        }else{
            return ['error' => true, 'message' => 'Xóa nhóm thất bại.Xin vui lòng thử lại !!'];
        }
    }
    public function deleteMultiple($listId)
    {
        if($this->_model->whereIn('id',explode(",",$listId))->delete()){
            return ['success' => true, 'message' => 'Xóa nhóm thành công !!'];
        }else{
            return ['error' => true, 'message' => 'Xóa nhóm thất bại.Xin vui lòng thử lại !!'];
        }
    }
}
