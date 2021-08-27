<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Status;
use App\Models\GroupStatus;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $_data;
    private $_pathType;
    private $_model;

    public function __construct(Status $status,Request $request)
    {
        $this->_model = $status;
        $this->_pathType = '';
        $this->_data['groups'] = GroupStatus::all();
        $this->_data['pageIndex'] = route('admin.status.index');
        $this->_data['table'] = 'status';
        $this->_data['title'] = 'Tình trạng';
        $this->_data['type'] = $request->type;
        $this->_data['path_type'] = isset($_GET['type']) ? '?type='.$_GET['type']:'';
    }

    public function index(Request $request)
    {
        $sql  = $this->_model::select("id","name")->where('id','<>', 0);
        if($request->has('term')){
            $sql->where('name', 'Like', '%' . $request->term . '%');
            $this->_pathType .= '?term='.$request->term;
        }
        $this->_data['items'] = $sql->orderBy('id','desc')->get();
        return response([
            $this->_data['items']
            // $this->_data
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.status.add',$this->_data);
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
            return redirect()->route('admin.status.index')->with('success', 'Thêm trạng thái <b>'. $request->name .'</b> thành công');
        }else{
            return redirect()->route('admin.status.index')->with('danger', 'Thêm trạng thái <b>'. $request->name .'</b> thất bại.Xin vui lòng thử lại');
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
        return view('backend.status.edit',$this->_data);
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
            return redirect()->route('admin.status.index')->with('success', 'Chỉnh sửa chức vụ <b>'. $request->name .'</b> thành công');
        }else{
            return redirect()->route('admin.status.index')->with('danger', 'Chỉnh sửa chức vụ <b>'. $request->name .'</b> thất bại.Xin vui lòng thử lại');
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
            return ['success' => true, 'message' => 'Xóa trạng thái thành công !!'];
        }else{
            return ['error' => true, 'message' => 'Xóa trạng thái thất bại.Xin vui lòng thử lại !!'];
        }
    }
    public function deleteMultiple($listId)
    {
        if($this->_model->whereIn('id',explode(",",$listId))->delete()){
            return ['success' => true, 'message' => 'Xóa trạng thái thành công !!'];
        }else{
            return ['error' => true, 'message' => 'Xóa trạng thái thất bại.Xin vui lòng thử lại !!'];
        }
    }
}
