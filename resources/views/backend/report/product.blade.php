@extends('backend.layouts.index') 
@section('content')
<!-- start page title -->
<div class="row mt-2">
    <div class="col-xl-12">
        <div class="card-box pb-2">
            <ul class="nav nav-dev-block nav-pills nav-justified form-wizard-header">
                <li class="nav-item">
                    <a href="javascript:void(0)" 
                    data-href="{{Route('admin.report.product.index')}}?time=daynow" 
                    class="nav-link nav-link-ajax {{request()->time == 'daynow' || (!request()->time && !request()->timeline) ? 'active' : '' }}"> 
                        <span class="d-block d-md-inline">Hôm nay</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void(0)" data-href="{{Route('admin.report.product.index')}}?time=datenow" 
                    class="nav-link nav-link-ajax {{request()->time == 'datenow' ? 'active' : '' }}">
                        <span class="d-block d-md-inline">Tháng hiện tại</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void(0)" data-href="{{Route('admin.report.product.index')}}?time=yearnow" 
                    class="nav-link nav-link-ajax {{request()->time == 'yearnow' ? 'active' : '' }}">
                        <span class="d-block d-md-inline">Năm hiện tại</span>
                    </a>
                </li>
                <li class="nav-item">
                    <form role="form" class="search-form" class="d-flex " method="GET" action="{{url()->current()}}" enctype="multipart/form-data" >
                        <div class="form-group d-flex">
                          <div class="input-group">
                            <input 
                              type="text" 
                              name="timeline" 
                              class="form-control input-dev-default flatpickr-input flatpickr-input-range" 
                              id="timeline" 
                              value="{{request()->timeline}}" 
                              placeholder="{{request()->timeline ?? 'Mốc thời gian'}}"
                              >
                            
                          </div>
                          <button class="btn btn-success text-white ml-1" type="submit">
                              <i class="mdi mdi-filter-outline"></i>
                          </button>
                        </div>
                    </form>
                </li>
            </ul>
        </div>
    </div>
    <div class="col-xl-12">
        <div class="card-box">
            <h4 class="header-title">Top 10 hàng hoá bán chạy</h4>
            <div class="report-canvas">
                <canvas id="top-product-chart" width="1000" height="400"></canvas>
            </div>
        </div>
        <!-- end card-box -->
    </div>
    <!-- end col -->
    <?php /*
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
    */ ?>
    <!-- end col -->
</div>
<script type="text/javascript">
    var report = {
        total: { 
            revenue:<?=$product->total_revenue?>,
        },
        revenue:'<?=implode(',',$product->top10_revenue)?>',
        name:'<?=implode(',',$product->top10_name)?>',
    };
</script>
@endsection