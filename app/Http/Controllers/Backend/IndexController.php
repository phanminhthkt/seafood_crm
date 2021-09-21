<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\WmsExport;
use App\Models\WmsExportDetail;
use Carbon\Carbon;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $_data;

    public function __construct(Product $product,WmsExport $wmsExport,WmsExportDetail $wmsExportDetail)
    {
        $this->_data['title'] = 'Trang chủ';
        $this->_data['product'] = $product;
        $this->_data['wms-export'] = $wmsExport;
        $this->_data['wms-export-detail'] = $wmsExportDetail;
    }

    public function index()
    {
        // Report All Project
        $day_now = Carbon::now('Asia/Ho_Chi_Minh')->format('d');

        //Total revenue day now
        $this->_data['report']['totalOrder'] = $this->_data['wms-export']::whereDay('export_created_at','=',$day_now)->where('status_id','=',3)->get(['total_price','ship_price','reduce_price'])->sum(function($val){ 
                                return ($val->total_price + $val->ship_price - $val->reduce_price); 
                            });
        
        //Total buy order day now
        $this->_data['report']['countOrder'] = $this->_data['wms-export']::whereDay('export_created_at','=',$day_now)->count();

        //Total buy product day now

        $this->_data['report']['countProduct'] = $this->_data['wms-export-detail']::with('wmsExport')
        ->whereHas('wmsExport', function ($query) use ($day_now) {
            $query->where('status_id', '=', 3)->whereDay('export_created_at','=',$day_now);
            return $query;
        })->count();
        
        $this->_data['report']['maxProduct'] = $this->_data['wms-export-detail']::with('wmsExport')
        ->whereHas('wmsExport', function ($query) use ($day_now) {
            $query->where('status_id', '=', 3)->whereDay('export_created_at','=',$day_now);
            return $query;
        })
        ->selectRaw('product_name,sum(product_price * product_quantity) as total')->groupBy('product_id')
        ->orderBy('total', 'desc')->first();


        //Report date
        $year = $request->year ?? Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->format('Y');
        for($i=1;$i<13;$i++){
            $this->_data['report']['date'][$i] = revenueByTime('',$i,$year,$this->_data['wms-export'],3);
        }

        $this->_data['report'] = (object)$this->_data['report'];

        return view('backend.index.index', $this->_data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
