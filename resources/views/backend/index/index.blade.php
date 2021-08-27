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
                <h3 class="text-dark mt-1"><span class="counter">{{$report->totalProject}}</span></h3>
                <p class="text-muted mb-0">Tổng dự án</p>
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
                <h3 class="text-dark mt-1"><span class="counter">{{$report->handoverTotalProject}}</span></h3>
                <p class="text-muted mb-0">Đã bàn giao</p>
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
                <h3 class="text-dark mt-1"><span class="counter">{{$report->nohandoverTotalProject}}</span></h3>
                <p class="text-muted mb-0">Chưa bàn giao</p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- end col -->
    <div class="col-xl-3 col-md-6">
        <div class="widget-bg-color-icon card-box">
            <div class="avatar-lg rounded-circle bg-icon-dark float-left">
                <i class="mdi mdi-close-circle font-24 avatar-title text-white"></i>
            </div>
            <div class="text-right">
                <h3 class="text-dark mt-1"><span class="counter">{{$report->cancelTotalProject}}</span></h3>
                <p class="text-muted mb-0">Đã huỷ</p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    
    <!-- end col -->
</div>
<div class="row">
    <div class="col-xl-8">
        <div class="card-box">
            <h4 class="header-title">Báo cáo hàng tháng</h4>
            <canvas id="myChart" width="400" height="190"></canvas>
        </div>
        <!-- end card-box -->
    </div>
    <!-- end col -->

    <div class="col-xl-4">
        <div class="card-box">

            <h4 class="header-title">Báo cáo tổng</h4>
            <div class="mt-3 text-center">
                <p class="text-muted font-15 font-family-secondary mb-0">
                    <span class="mx-2"><i class="mdi mdi-checkbox-blank-circle text-danger"></i> Đã bàn giao</span>
                    <span class="mx-2"><i class="mdi mdi-checkbox-blank-circle text-purple"></i> Chưa bàn giao</span>
                    <span class="d-block"><i class="mdi mdi-checkbox-blank-circle text-secondary"></i> Đã huỷ</span>
                </p>
                <div id="sparkline_total" class="text-center mt-3">
                    <canvas width="210" height="210" style="display: inline-block; width: 210px; height: 210px; vertical-align: top;"></canvas>
                </div>
            </div>
        </div>
        <!-- end card-box -->
    </div>
    <!-- end col -->
</div>
<script type="text/javascript">
    var report = {
        total: { 
            handoverProject:<?=$report->handoverTotalProject?>,
            nohandoverProject:<?=$report->nohandoverTotalProject?>,
            cancelProject:<?=$report->cancelTotalProject?>
        },
        date:'<?=implode(',',$report->date)?>',
    };
</script>
@endsection