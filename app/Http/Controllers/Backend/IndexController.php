<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use Carbon\Carbon;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $_data;

    public function __construct(Project $project)
    {
        $this->_data['title'] = 'Trang chủ';
        $this->_data['project'] = $project;
    }

    public function index()
    {
        // Report All Project
        $this->_data['report']['totalProject'] = $this->_data['project']::count();//Tổng

        $this->_data['report']['cancelTotalProject'] = $this->_data['project']::whereHas('status', function ($query) {$query->where('status.id',6);})->count();//Huỷ

        $this->_data['report']['handoverTotalProject'] = $this->_data['project']::whereHas('status', function ($query) {$query->where('status.id',5);})->count();//Bàn giao

        $this->_data['report']['nohandoverTotalProject'] = $this->_data['project']::whereHas('status', function ($query) {$query->where('status.id',4);})->count();//Chưa bàn giao

        //Report Project by month
        $year_now = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->format('Y');
        for($i=1;$i<13;$i++){
            $this->_data['report']['date'][$i-1] = countByMonthYear($i,$year_now,$this->_data['project']);
        }
        $this->_data['report'] = (object)$this->_data['report'];
        // $this->_data['report']->date = (object)$this->_data['report']->date;
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
