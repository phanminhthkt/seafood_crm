<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wms;
use App\Models\WmsImportDetail;
use App\Models\Status;
use App\Models\Product;
use DataTables;
use App\Repositories\Wms\WmsImportRepositoryInterface;
use Illuminate\Support\Arr;
use Auth;


class WmsImportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $_data;
    private $_pathType;
    private $_repository;

    public function __construct(WmsImportRepositoryInterface $wmsImportRepository,Request $request)
    {
        $this->_repository = $wmsImportRepository;
        $this->_pathType = '';
        $this->_data['pageIndex'] = route('admin.wms.import.index');
        $this->_data['title'] = config('siteconfig.wmsImport.title');
        $this->_data['table'] = config('siteconfig.wmsImport.table');
        $this->_data['wms'] = Wms::get(['id','name']);
        //Load ajax if ajax-form,dev-form for add,edit.
        //Direct in if devform '' and ajaxForm=direct-form
        $this->_data['form'] = (object)['devform'=>'','ajaxform'=>'direct-form'];
        $this->_data['type'] = $request->type;
        $this->_data['path_type'] = isset($_GET['type']) ? '?type='.$_GET['type']:'';
    }

    public function index(Request $request)
    {
        return view('backend.wms.import_index', $this->_data);
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
    public function create()
    {
        return view('backend.wms.import_add',$this->_data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,WmsImportDetail $wmsImportDetail)
    {   
        $data = $request->except('_token','save_draft','save_success','data_child');
        if($request->has('save_draft')){
            $data['status_id'] = $request->save_draft;
        }
        if($request->has('save_success')){
            $data['status_id'] = $request->save_success;
        }
        if($request->has('data_child') && count($request->data_child)){
            $dataChild = $request->only('data_child');
            $totalPrice = 0;
            foreach($request->data_child['product_id'] as $k => $v){
                $totalPrice = $request->data_child['quantity'][$k] * str_replace(',', '', $request->data_child['import_price'][$k]);
            }
            $data['total_price'] = $totalPrice;
        }

        $data['user_id'] = Auth::guard()->user()->id;
        $data['code'] = config('siteconfig.wmsImport.code').formatDate($request->created_at,'dmYHi');
        if($importId = $this->_repository->create($data)->id){
            if($request->has('data_child') && count($request->data_child)){
                    foreach($request->data_child['product_id'] as $k => $v){
                        $dataDetail = [];
                        $product = Product::with(['unit:id,name'])->select(['name','unit_id','sku'])->findOrFail($v);
                        $dataDetail['product_code'] = $product->sku;
                        $dataDetail['product_name'] = $product->name;
                        $dataDetail['product_unit'] = $product->unit->name;
                        $dataDetail['product_price'] = str_replace(',','',$request->data_child['import_price'][$k]);
                        $dataDetail['import_id'] = $importId;
                        $dataDetail['product_quantity'] = $request->data_child['quantity'][$k];
                        $wmsImportDetail->create($dataDetail);
                }
            }
            return redirect()->route('admin.wms.import.index')->with('success', 'Thêm kho <b>'. $request->name .'</b> thành công');
        }else{
            return redirect()->route('admin.wms.import.index')->with('danger', 'Thêm kho <b>'. $request->name .'</b> thất bại.Xin vui lòng thử lại');
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
        return view('backend.wms.import_edit',$this->_data);
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
            return redirect()->route('admin.wms.import.index')->with('success', 'Chỉnh sửa kho <b>'. $request->name .'</b> thành công');
        }else{
            return redirect()->route('admin.wms.import.index')->with('danger', 'Chỉnh sửa kho <b>'. $request->name .'</b> thất bại.Xin vui lòng thử lại');
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
            return ['success' => true, 'message' => 'Xóa kho thành công !!'];
        }else{
            return ['error' => true, 'message' => 'Xóa kho thất bại.Xin vui lòng thử lại !!'];
        }
    }
    public function deleteMultiple($listId)
    {
        if($this->_repository->deleteMultiple($listId)){
            return ['success' => true, 'message' => 'Xóa kho thành công !!'];
        }else{
            return ['error' => true, 'message' => 'Xóa kho thất bại.Xin vui lòng thử lại !!'];
        }
    }
}
