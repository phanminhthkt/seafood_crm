<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GroupStatus;
use DataTables;
use App\Repositories\Status\StatusRepositoryInterface;
use Illuminate\Support\Arr;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $_data;
    private $_pathType;
    private $_repository;

    public function __construct(StatusRepositoryInterface $statusRepository,Request $request)
    {
        $this->_repository = $statusRepository;
        $this->_pathType = '';
        $this->_data['groups'] = GroupStatus::get(['name','id']);
        $this->_data['pageIndex'] = route('admin.status.index');
        $this->_data['title'] = config('siteconfig.status.title');
        $this->_data['table'] = config('siteconfig.status.table');
        //Load ajax if ajax-form,dev-form for add,edit.
        //Direct in if devform '' and ajaxForm=direct-form
        $this->_data['form'] = (object)['devform'=>'dev-form','ajaxform'=>'ajax-form'];
        $this->_data['type'] = $request->type;
        $this->_data['path_type'] = isset($_GET['type']) ? '?type='.$_GET['type']:'';
    }

    public function index(Request $request)
    {
        return view('backend.status.index', $this->_data);
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
        if($this->_repository->create($data)){
            return redirect()->route('admin.status.index')->with('success', 'Th??m tr???ng th??i <b>'. $request->name .'</b> th??nh c??ng');
        }else{
            return redirect()->route('admin.status.index')->with('danger', 'Th??m tr???ng th??i <b>'. $request->name .'</b> th???t b???i.Xin vui l??ng th??? l???i');
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
        $data = $request->except('_token','_method');//# request only
        if($this->_repository->update($id,$data)){
            return redirect()->route('admin.status.index')->with('success', 'Ch???nh s???a tr???ng th??i <b>'. $request->name .'</b> th??nh c??ng');
        }else{
            return redirect()->route('admin.status.index')->with('danger', 'Ch???nh s???a tr???ng th??i <b>'. $request->name .'</b> th???t b???i.Xin vui l??ng th??? l???i');
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
            return ['success' => true, 'message' => 'X??a tr???ng th??i th??nh c??ng !!'];
        }else{
            return ['error' => true, 'message' => 'X??a tr???ng th??i th???t b???i.Xin vui l??ng th??? l???i !!'];
        }
    }
    public function deleteMultiple($listId)
    {
        if($this->_repository->deleteMultiple($listId)){
            return ['success' => true, 'message' => 'X??a tr???ng th??i th??nh c??ng !!'];
        }else{
            return ['error' => true, 'message' => 'X??a tr???ng th??i th???t b???i.Xin vui l??ng th??? l???i !!'];
        }
    }
}
