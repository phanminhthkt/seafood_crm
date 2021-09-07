<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Repositories\Unit\UnitRepositoryInterface;
use Illuminate\Support\Arr;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $_data;
    private $_pathType;
    private $_repository;

    public function __construct(UnitRepositoryInterface $UnitRepository,Request $request)
    {
        $this->_repository = $UnitRepository;
        $this->_pathType = '';
        $this->_data['pageIndex'] = route('admin.unit.index');
        $this->_data['title'] = config('siteconfig.unit.title');
        $this->_data['table'] = config('siteconfig.unit.table');
        $this->_data['form'] = (object)['devform'=>'dev-form','ajaxform'=>'ajax-form'];
        $this->_data['type'] = $request->type;
        $this->_data['path_type'] = isset($_GET['type']) ? '?type='.$_GET['type']:'';
    }

    public function index(Request $request)
    {
        return view('backend.unit.index', $this->_data);
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
        return view('backend.unit.add',$this->_data);
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
        if($id = $this->_repository->create($data)->id){
            return response()->json(['status' => 'Thêm đơn vị thành công','item' =>['id' => $id,'name' => $data['name']] ]);
        }else{
            return redirect()->route('admin.unit.index',['type' => $request->type])->with('danger', 'Thêm đơn vị <b>'. $request->name .'</b> thất bại.Xin vui lòng thử lại');
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
        return view('backend.unit.edit',$this->_data);
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
            return redirect()->route('admin.status.index')->with('success', 'Chỉnh sửa đơn vị <b>'. $request->name .'</b> thành công');
        }else{
            return redirect()->route('admin.status.index')->with('danger', 'Chỉnh sửa đơn vị <b>'. $request->name .'</b> thất bại.Xin vui lòng thử lại');
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
