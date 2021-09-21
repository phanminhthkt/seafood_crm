@extends('backend.layouts.index') 
@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-left">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href=""><i class="remixicon-home-8-line"></i></a>
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="widget-bg-color-icon card-box">
            <div class="avatar-lg rounded-circle bg-icon-info float-left">
                <i class="mdi mdi-android-studio font-24 avatar-title text-white"></i>
                
            </div>
            <div class="text-right">
                <h3 class="font-17 text-info mt-1"><b class="bold"><span class="counter">{{number_format($report->totalOrder, 0,'',',');}} đ</span></b></h3>
                <p class="text-muted mb-0">Bán hôm nay</p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="widget-bg-color-icon card-box">
            <div class="avatar-lg rounded-circle bg-icon-danger float-left">
                <i class="mdi mdi-bullseye font-24 avatar-title text-white"></i>
            </div>
            <div class="text-right">
                <h3 class="font-17 text-danger mt-1"><span class="counter">{{$report->countOrder}}</span></h3>
                <p class="text-muted mb-0">đơn hàng</p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="widget-bg-color-icon card-box">
            <div class="avatar-lg rounded-circle bg-icon-purple  float-left">
                <i class="mdi mdi-black-mesa font-24 avatar-title text-white"></i>
                
            </div>
            <div class="text-right">
                <h3 class="font-17 text-purple mt-1"><span class="counter">{{$report->countProduct}}</span></h3>
                <p class="text-muted mb-0">Top sản phẩm</p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- end col -->
    <div class="col-xl-3 col-md-6">
        <div class="widget-bg-color-icon card-box">
            <div class="avatar-lg rounded-circle bg-icon-primary float-left">
                <i class="mdi mdi-check-circle font-24 avatar-title text-white"></i>
            </div>
            <div class="text-right">
                <h3 class="font-17 text-primary mt-1"><span class="counter ">{{$report->maxProduct->product_name}}</span></h3>
                <p class="text-muted mb-0">Bán nhiều nhất</p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    
    <!-- end col -->
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="card-box">
            <h4 class="header-title">Báo cáo tháng</h4>
            <canvas id="revenue-chart-date" width="1000" height="400"></canvas>
        </div>
        <!-- end card-box -->
    </div>
    <!-- end col -->
</div>
<script type="text/javascript">
    var report = {
        total_year:'<?=implode(',',$report->date)?>',
    };
</script>
@endsection