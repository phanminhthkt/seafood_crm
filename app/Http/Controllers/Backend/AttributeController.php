<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GroupAttribute;
use DataTables;
use App\Repositories\Attribute\AttributeRepositoryInterface;
use Illuminate\Support\Arr;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $_data;
    private $_pathType;
    private $_repository;

    public function __construct(AttributeRepositoryInterface $attributeRepository,Request $request)
    {
        $this->_repository = $attributeRepository;
        $this->_pathType = '';
        $this->_data['groups'] = GroupAttribute::get(['name','id']);
        $this->_data['pageIndex'] = route('admin.attribute.index');
        $this->_data['title'] = config('siteconfig.attribute.title');
        $this->_data['table'] = config('siteconfig.attribute.table');
        //Load ajax if ajax-form,dev-form for add,edit.
        //Direct in if devform '' and ajaxForm=direct-form
        $this->_data['form'] = (object)['devform'=>'dev-form','ajaxform'=>'ajax-form'];
        $this->_data['type'] = $request->type;
        $this->_data['path_type'] = isset($_GET['type']) ? '?type='.$_GET['type']:'';
    }

    public function index(Request $request)
    {
        return view('backend.attribute.index', $this->_data);
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
    public function create($group_id='')
    {
        $this->_data['group_id'] = $group_id;
        return view('backend.attribute.add',$this->_data);
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
            return response()->json(['status' => 'Th??m thu???c t??nh th??nh c??ng','type'=>'item','item' =>['id' => $id,'name' => $data['name'],'group_id' => $data['group_id']] ]);
        }else{
            return redirect()->route('admin.attribute.index')->with('danger', 'Th??m thu???c t??nh <b>'. $request->name .'</b> th???t b???i.Xin vui l??ng th??? l???i');
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
        return view('backend.attribute.edit',$this->_data);
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
            return redirect()->route('admin.attribute.index')->with('success', 'Ch???nh s???a thu???c t??nh <b>'. $request->name .'</b> th??nh c??ng');
        }else{
            return redirect()->route('admin.attribute.index')->with('danger', 'Ch???nh s???a thu???c t??nh <b>'. $request->name .'</b> th???t b???i.Xin vui l??ng th??? l???i');
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
            return ['success' => true, 'message' => 'X??a thu???c t??nh th??nh c??ng !!'];
        }else{
            return ['error' => true, 'message' => 'X??a thu???c t??nh th???t b???i.Xin vui l??ng th??? l???i !!'];
        }
    }
    public function deleteMultiple($listId)
    {
        if($this->_repository->deleteMultiple($listId)){
            return ['success' => true, 'message' => 'X??a thu???c t??nh th??nh c??ng !!'];
        }else{
            return ['error' => true, 'message' => 'X??a thu???c t??nh th???t b???i.Xin vui l??ng th??? l???i !!'];
        }
    }
}
