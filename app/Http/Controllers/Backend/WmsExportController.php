<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wms;
use App\Models\WmsExportDetail;
use App\Models\Status;
use DataTables;
use App\Repositories\Wms\WmsExportRepositoryInterface;
use Illuminate\Support\Arr;
use Auth;
use App\Traits\WmsTrait;

class WmsExportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use WmsTrait;
    private $_data;
    private $_pathType;
    private $_repository;

    public function __construct(WmsExportRepositoryInterface $wmsExportRepository,Request $request)
    {
        $this->_repository = $wmsExportRepository;
        $this->_pathType = '';
        $this->_data['pageIndex'] = route('admin.wms.export.index');
        $this->_data['title'] = config('siteconfig.wmsExport.title');
        $this->_data['table'] = config('siteconfig.wmsExport.table');
        $this->_data['wms'] = Wms::get(['id','name']);
        $this->_data['status'] = Status::where('group_id','=',1)->get(['id','name'])    ;
        //Load ajax if ajax-form,dev-form for add,edit.
        //Direct in if devform '' and ajaxForm=direct-form
        $this->_data['form'] = (object)['devform'=>'','ajaxform'=>'direct-form'];
        $this->_data['type'] = $request->type;
        $this->_data['path_type'] = isset($_GET['type']) ? '?type='.$_GET['type']:'';
    }

    public function index(Request $request)
    {
        return view('backend.wms.export_index', $this->_data);
    }
    public function getData(Request $request)
    {   
        return $this->_repository->getDataByCondition($request,Arr::except($this->_data, ''));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function print($id)
    {
        $this->_data['item'] = $this->_repository->getModel()::with(['customer:id,name,phone,address','store:id,name,phone,address'])->findOrFail($id);
        return view('backend.wms.export_print',$this->_data);
    }
    public function create()
    {
        return view('backend.wms.export_add',$this->_data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        if($data = $this->_repository->createHasRelation($request)){
            $id = $data['id'];
            $status_id = $data['status_id'];
            $action = ($status_id == 1 || $status_id == 3) ? 'view':'edit';
            return redirect()->route('admin.wms.export.'.$action.'',['id'=>$id])->with('success', 'Th??m phi???u phi???u xu???t kho <b>'. $request->code .'</b> th??nh c??ng');
        }else{
            return redirect()->route('admin.wms.export.index')->with('danger', 'Th??m phi???u xu???t kho <b>'. $request->code .'</b> th???t b???i.Xin vui l??ng th??? l???i');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
        $this->_data['item'] = $this->_repository->getModel()::with(['customer:id,name,phone,address'])->findOrFail($id);
        return view('backend.wms.export_view',$this->_data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function edit($id)
    {
        $this->_data['item'] = $this->_repository->getModel()::with(['customer:id,name,phone,address'])->findOrFail($id);
        $this->checkPermissionReEditWmsAction($this->_data['item']->status_id,$id,Auth::user(),'export');
        return view('backend.wms.export_edit',$this->_data);
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

        $status_id = $this->_repository->findOrFail($id)->status_id;
        $this->checkPermissionReEditWmsAction($status_id,$id,Auth::user(),'export');
        if($data = $this->_repository->updateHasRelation($request,$id)){
            $id = $data['id'];
            $status_id = $data['status_id'];
            $action = ($status_id == 1 || $status_id == 3) ? 'view':'edit';
            return redirect()->route('admin.wms.export.'.$action.'',['id'=>$id])->with('success', 'C???p nh???t phi???u xu???t kho <b>'. $request->code .'</b> th??nh c??ng');
        }else{
            return redirect()->route('admin.wms.export.edit',['id'=>$id])->with('danger', 'C???p nh???t phi???u xu???t kho <b>'. $request->code .'</b> th???t b???i.Xin vui l??ng th??? l???i');
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
            return ['success' => true, 'message' => 'X??a phi???u xu???t kho th??nh c??ng !!'];
        }else{
            return ['error' => true, 'message' => 'X??a phi???u xu???t kho th???t b???i.Xin vui l??ng th??? l???i !!'];
        }
    }
    public function deleteMultiple($listId)
    {
        if($this->_repository->deleteMultiple($listId)){
            return ['success' => true, 'message' => 'X??a phi???u xu???t kho th??nh c??ng !!'];
        }else{
            return ['error' => true, 'message' => 'X??a phi???u xu???t kho th???t b???i.Xin vui l??ng th??? l???i !!'];
        }
    }
}
