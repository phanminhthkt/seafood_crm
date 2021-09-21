<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\WmsExport;
use App\Models\WmsExportDetail;
use Carbon\Carbon;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $_data;

    public function __construct(Product $product,WmsExport $wmsExport,WmsExportDetail $wmsExportDetail)
    {
        $this->_data['title'] = 'Báo cáo';
        $this->_data['product'] = $product;
        $this->_data['wms-export'] = $wmsExport;
        $this->_data['wms-export-detail'] = $wmsExportDetail;
    }
    public function filterTime($filter,$request){
        
        if($request->timeline){
            $time = explode('to',str_replace(' ','',$request->timeline));
            if(count($time)>1){
                $start_day = formatDate($time[0],'Y-m-d');
                $end_day = Carbon::parse($time[1])->addDay()->format('Y-m-d');
                $filter->whereBetween('export_created_at', array($start_day,$end_day));
            }else{
                $start_day = formatDate($time[0],'Y-m-d');
                $end_day = Carbon::parse($time[0])->addDay()->format('Y-m-d');
                $filter->whereBetween('export_created_at', array($start_day,$end_day));
            }
        }
        if($request->time == 'daynow' || !$request->time){$filter->whereDay('export_created_at', '=', date('d'));}
        if($request->time == 'datenow'){$filter->whereMonth('export_created_at', '=', date('m'));}
        if($request->time == 'yearnow'){$filter->whereYear('export_created_at', '=', date('Y'));}
        return $filter;
    }

    /**
     * Show the report for top 10 product.
     */


    public function reportTopProduct(Request $request)
    {
        //Total revenue
        $this->_data['product']['total_revenue'] = $this->_data['wms-export']::where('status_id','=',3)->get(['total_price','ship_price','reduce_price'])->sum(function($val){ 
                                return ($val->total_price + $val->ship_price - $val->reduce_price); 
                            });
        //Top 10 revenue for time
        $top10Revenue = $this->_data['wms-export-detail']::with('wmsExport')
        ->whereHas('wmsExport', function ($query) use ($request) {
            $filter = $query->where('status_id', '=', 3);
            $filter = $this->filterTime($filter,$request);//Filter time
            return $filter;
        })
        ->selectRaw('product_name, sum(product_price * product_quantity) as total')->groupBy('product_id')
        ->orderBy('total', 'desc')->limit(10)->get();
        //Add top 10 revenue for array
        $name = [];
        $revenue = [];
        foreach($top10Revenue as $k => $v){
            $name[$k] =$v->product_name;
            $revenue[$k] =$v->total;
        }

        $this->_data['product']['top10_name'] = $name;
        $this->_data['product']['top10_revenue'] = $revenue;
        $this->_data['product'] = (object)$this->_data['product'];
        return view('backend.report.product', $this->_data);
    }

    /**
     * Show the report for revenue.
     */


    public function reportRevenue(Request $request)
    {
        $year = $request->year ?? Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->format('Y');
        $month_now = Carbon::now('Asia/Ho_Chi_Minh')->format('m');
        $total_date_now = Carbon::now('Asia/Ho_Chi_Minh')->daysInMonth;
        for($i=1;$i<=$total_date_now;$i++){
            $this->_data['revenue']['day'][$i] = revenueByTime($i,$month_now,$year,$this->_data['wms-export'],3);
        }
        for($i=1;$i<13;$i++){
            $this->_data['revenue']['date'][$i] = revenueByTime('',$i,$year,$this->_data['wms-export'],3);
        }
        $this->_data['revenue']['year'] = $year;
        $this->_data['revenue'] = (object)$this->_data['revenue'];
        return view('backend.report.revenue', $this->_data);
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
