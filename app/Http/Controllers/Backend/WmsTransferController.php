<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wms;
use App\Models\WmsTransferDetail;
use App\Models\Status;
use DataTables;
use App\Repositories\Wms\WmsTransferRepositoryInterface;
use Illuminate\Support\Arr;
use Auth;
use App\Traits\WmsTrait;

class WmsTransferController extends Controller
{
    use WmsTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $_data;
    private $_pathType;
    private $_repository;

    public function __construct(WmsTransferRepositoryInterface $wmsTransferRepository,Request $request)
    {
        $this->_repository = $wmsTransferRepository;
        $this->_pathType = '';
        $this->_data['pageIndex'] = route('admin.wms.transfer.index');
        $this->_data['title'] = config('siteconfig.wmsTransfer.title');
        $this->_data['table'] = config('siteconfig.wmsTransfer.table');
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
        return view('backend.wms.transfer_index', $this->_data);
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
        $this->_data['item'] = $this->_repository->getModel()::with(['fromStore:id,name,address,phone','toStore:id,name,address,phone'])->findOrFail($id);
        return view('backend.wms.transfer_print',$this->_data);
    }
    public function create(Request $request)
    {
        $this->_data['store_default_id'] = $request->store_from_id ?? $this->_data['wms']->first()->id;
        return view('backend.wms.transfer_add',$this->_data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        if($id = $this->_repository->createHasRelation($request)){
            $id = $data['id'];
            $status_id = $data['status_id'];
            $action = ($status_id == 1 || $status_id == 3) ? 'view':'edit';
            return redirect()->route('admin.wms.transfer.'.$action.'',['id'=>$id])->with('success', 'Th??m phi???u phi???u chuy???n kho <b>'. $request->code .'</b> th??nh c??ng');
        }else{
            return redirect()->route('admin.wms.transfer.index')->with('danger', 'Th??m phi???u chuy???n kho <b>'. $request->code .'</b> th???t b???i.Xin vui l??ng th??? l???i');
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
        $this->_data['item'] = $this->_repository->findOrFail($id);
        return view('backend.wms.transfer_view',$this->_data);
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
        $this->_data['store_default_id'] = $request->store_from_id ?? $this->_data['item']->store_from_id;
        $this->checkPermissionReEditWmsAction($this->_data['item']->status_id,$id,Auth::user(),'transfer');
        return view('backend.wms.transfer_edit',$this->_data);
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
        $this->checkPermissionReEditWmsAction($status_id,$id,Auth::user(),'transfer');

        if($data = $this->_repository->updateHasRelation($request,$id)){
            $id = $data['id'];
            $status_id = $data['status_id'];
            $action = ($status_id == 1 || $status_id == 3) ? 'view':'edit';
            return redirect()->route('admin.wms.transfer.'.$action,['id'=>$id])->with('success', 'C???p nh???t phi???u chuy???n kho <b>'. $request->code .'</b> th??nh c??ng');
        }else{
            return redirect()->route('admin.wms.transfer.edit',['id'=>$id])->with('danger', 'C???p nh???t phi???u chuy???n kho <b>'. $request->code .'</b> th???t b???i.Xin vui l??ng th??? l???i');
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
            return ['success' => true, 'message' => 'X??a phi???u chuy???n kho th??nh c??ng !!'];
        }else{
            return ['error' => true, 'message' => 'X??a phi???u chuy???n kho th???t b???i.Xin vui l??ng th??? l???i !!'];
        }
    }
    public function deleteMultiple($listId)
    {
        if($this->_repository->deleteMultiple($listId)){
            return ['success' => true, 'message' => 'X??a phi???u chuy???n kho th??nh c??ng !!'];
        }else{
            return ['error' => true, 'message' => 'X??a phi???u chuy???n kho th???t b???i.Xin vui l??ng th??? l???i !!'];
        }
    }
}
