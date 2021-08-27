<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Status;
use App\Models\GroupStatus;

class GroupStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $_data;
    private $_pathType;
    private $_model;

    public function __construct(GroupStatus $groupStatus,Request $request)
    {
        $this->_model = $groupStatus;
        $this->_pathType = '';
        $this->_data['pageIndex'] = route('admin.group_status.index');
        $this->_data['table'] = 'group_status';
        $this->_data['title'] = 'Nhóm trạng thái';
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
        return view('backend.group_status.index', $this->_data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.group_status.add',$this->_data);
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
        if($this->_model->create($data)){
            return redirect()->route('admin.group_status.index',['type' => $request->type])->with('success', 'Thêm nhóm trạng thái <b>'. $request->name .'</b> thành công');
        }else{
            return redirect()->route('admin.group_status.index',['type' => $request->type])->with('danger', 'Thêm nhóm trạng thái <b>'. $request->name .'</b> thất bại.Xin vui lòng thử lại');
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
        return view('backend.group_status.edit',$this->_data);
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
        if($this->_model->where('id', $id)->update($data)){
            return redirect()->route('admin.group_status.index',['type' => $request->type])->with('success', 'Chỉnh sửa nhóm trạng thái <b>'. $request->name .'</b> thành công');
        }else{
            return redirect()->route('admin.group_status.index',['type' => $request->type])->with('danger', 'Chỉnh sửa nhóm trạng thái <b>'. $request->name .'</b> thất bại.Xin vui lòng thử lại');
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
            return ['success' => true, 'message' => 'Xóa nhóm trạng thái thành công !!'];
        }else{
            return ['error' => true, 'message' => 'Xóa nhóm trạng thái thất bại.Xin vui lòng thử lại !!'];
        }
    }
    public function deleteMultiple($listId)
    {
        if($this->_model->whereIn('id',explode(",",$listId))->delete()){
            return ['success' => true, 'message' => 'Xóa nhóm trạng thái thành công !!'];
        }else{
            return ['error' => true, 'message' => 'Xóa nhóm trạng thái thất bại.Xin vui lòng thử lại !!'];
        }
    }
}
