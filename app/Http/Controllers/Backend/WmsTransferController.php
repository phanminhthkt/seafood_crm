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


class WmsTransferController extends Controller
{
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
        $this->_data['item'] = $this->_repository->findOrFail($id);
        return view('backend.wms.transfer_print',$this->_data);
    }
    public function create()
    {
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
            return redirect()->route('admin.wms.transfer.edit',['id'=>$id])->with('success', 'Thêm phiếu phiếu xuất kho <b>'. $request->code .'</b> thành công');
        }else{
            return redirect()->route('admin.wms.transfer.index')->with('danger', 'Thêm phiếu xuất kho <b>'. $request->code .'</b> thất bại.Xin vui lòng thử lại');
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
        if($this->_repository->updateHasRelation($request,$id)){
            return redirect()->route('admin.wms.transfer.edit',['id'=>$id])->with('success', 'Cập nhật phiếu xuất kho <b>'. $request->code .'</b> thành công');
        }else{
            return redirect()->route('admin.wms.transfer.edit',['id'=>$id])->with('danger', 'Cập nhật phiếu xuất kho <b>'. $request->code .'</b> thất bại.Xin vui lòng thử lại');
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
            return ['success' => true, 'message' => 'Xóa phiếu xuất kho thành công !!'];
        }else{
            return ['error' => true, 'message' => 'Xóa phiếu xuất kho thất bại.Xin vui lòng thử lại !!'];
        }
    }
    public function deleteMultiple($listId)
    {
        if($this->_repository->deleteMultiple($listId)){
            return ['success' => true, 'message' => 'Xóa phiếu xuất kho thành công !!'];
        }else{
            return ['error' => true, 'message' => 'Xóa phiếu xuất kho thất bại.Xin vui lòng thử lại !!'];
        }
    }
}
