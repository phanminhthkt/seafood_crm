<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Repositories\Customer\CustomerRepositoryInterface;
use Illuminate\Support\Arr;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $_data;
    private $_pathType;
    private $_repository;

    public function __construct(CustomerRepositoryInterface $customerRepository,Request $request)
    {
        $this->_repository = $customerRepository;
        $this->_pathType = '';
        $this->_data['pageIndex'] = route('admin.customer.index');
        $this->_data['title'] = config('siteconfig.customer.title');
        $this->_data['table'] = config('siteconfig.customer.table');
        //Load ajax if ajax-form,dev-form for add,edit.
        //Direct in if devform '' and ajaxForm=direct-form
        $this->_data['form'] = (object)['devform'=>'dev-form','ajaxform'=>'ajax-form'];
        $this->_data['type'] = $request->type;
        $this->_data['path_type'] = isset($_GET['type']) ? '?type='.$_GET['type']:'';
    }

    public function index(Request $request)
    {
        return view('backend.customer.index', $this->_data);
    }
    public function getData(Request $request)
    {   
        return $this->_repository->getDataByCondition($request,Arr::except($this->_data, ''));
    }
    public function getDataOrders($id)
    {   
        return $this->_repository->getDataOrders($id,Arr::except($this->_data, ''));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.customer.add',$this->_data);
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
            return redirect()->route('admin.customer.index')->with('success', 'Th??m kh??ch h??ng <b>'. $request->name .'</b> th??nh c??ng');
        }else{
            return redirect()->route('admin.customer.index')->with('danger', 'Th??m kh??ch h??ng <b>'. $request->name .'</b> th???t b???i.Xin vui l??ng th??? l???i');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {   
        $query = $this->_repository->getModel()::select(['id','name','phone','address']);


        if($request->has('term')){
            $query->where('name', 'Like', '%' . $request->term . '%')->orWhere('phone', 'Like', '%' . $request->term . '%');
        }
        $this->_data['item'] = $query->get();
        return response(["items" =>$this->_data['item'],"total_count" => count($this->_data['item'])]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->_data['item'] = $this->_repository->getModel()::with(['orders'])->findOrFail($id);
        return view('backend.customer.edit',$this->_data);
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
            return redirect()->route('admin.customer.index')->with('success', 'Ch???nh s???a kh??ch h??ng <b>'. $request->name .'</b> th??nh c??ng');
        }else{
            return redirect()->route('admin.customer.index')->with('danger', 'Ch???nh s???a kh??ch h??ng <b>'. $request->name .'</b> th???t b???i.Xin vui l??ng th??? l???i');
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
            return ['success' => true, 'message' => 'X??a kh??ch h??ng th??nh c??ng !!'];
        }else{
            return ['error' => true, 'message' => 'X??a kh??ch h??ng th???t b???i.Xin vui l??ng th??? l???i !!'];
        }
    }
    public function deleteMultiple($listId)
    {
        if($this->_repository->deleteMultiple($listId)){
            return ['success' => true, 'message' => 'X??a kh??ch h??ng th??nh c??ng !!'];
        }else{
            return ['error' => true, 'message' => 'X??a kh??ch h??ng th???t b???i.Xin vui l??ng th??? l???i !!'];
        }
    }
}
