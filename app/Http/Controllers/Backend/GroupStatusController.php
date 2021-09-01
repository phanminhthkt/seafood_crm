<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Repositories\GroupStatus\GroupStatusRepositoryInterface;
use Illuminate\Support\Arr;

class GroupStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $_data;
    private $_pathType;
    private $_repository;

    public function __construct(GroupStatusRepositoryInterface $groupStatusRepository,Request $request)
    {
        $this->_repository = $groupStatusRepository;
        $this->_pathType = '';
        $this->_data['pageIndex'] = route('admin.group_status.index');
        $this->_data['title'] = config('siteconfig.group_status.title');
        $this->_data['table'] = config('siteconfig.group_status.table');
        $this->_data['form'] = (object)['devform'=>'dev-form','ajaxform'=>'ajax-form'];
        $this->_data['type'] = $request->type;
        $this->_data['path_type'] = isset($_GET['type']) ? '?type='.$_GET['type']:'';
    }

    public function index(Request $request)
    {
        return view('backend.group_status.index', $this->_data);
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
        if($this->_repository->create($data)){
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
        $this->_data['item'] = $this->_repository->findOrFail($id);
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
        $data = $request->except('_token','_method');//# request only
        if($this->_repository->update($id,$data)){
            return redirect()->route('admin.status.index')->with('success', 'Chỉnh sửa nhóm trạng thái <b>'. $request->name .'</b> thành công');
        }else{
            return redirect()->route('admin.status.index')->with('danger', 'Chỉnh sửa nhóm trạng thái <b>'. $request->name .'</b> thất bại.Xin vui lòng thử lại');
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
            return ['success' => true, 'message' => 'Xóa trạng thái thành công !!'];
        }else{
            return ['error' => true, 'message' => 'Xóa trạng thái thất bại.Xin vui lòng thử lại !!'];
        }
    }
    public function deleteMultiple($listId)
    {
        if($this->_repository->deleteMultiple($listId)){
            return ['success' => true, 'message' => 'Xóa trạng thái thành công !!'];
        }else{
            return ['error' => true, 'message' => 'Xóa trạng thái thất bại.Xin vui lòng thử lại !!'];
        }
    }
}
