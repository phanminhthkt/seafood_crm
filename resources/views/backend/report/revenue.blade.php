@extends('backend.layouts.index') 
@section('content')
<!-- start page title -->
<div class="row mt-2">
    <div class="col-xl-12">
        <div class="card-box pb-2">
            <ul class="nav nav-dev-block nav-pills nav-justified form-wizard-header">
                <li class="nav-item">
                    <form role="form" class="search-form" class="d-flex " method="GET" action="{{url()->current()}}" enctype="multipart/form-data" >
                        <div class="form-group d-flex">
                          <div class="input-group">
                            <select class="form-control select2" name="year" id="year" required="">
                            <option value="" >Chọn năm</option>
                            @for($i=2021;$i< 2050;$i++)
                            <option value="{{$i}}" {{$revenue->year == $i ? 'selected':''}}>{{$i}}</option>
                            @endfor
                            </select>
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
            <h4 class="header-title">Doanh thu hàng ngày</h4>
            <div class="report-canvas">
                <canvas id="revenue-chart-day" width="1000" height="400"></canvas>
            </div>
        </div>
        <div class="card-box">
            <h4 class="header-title">Doanh thu hàng tháng</h4>
            <div class="report-canvas">
                <canvas id="revenue-chart-date" width="1000" height="400"></canvas>
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
        total_year:'<?=implode(',',$revenue->date)?>',
        total_month:{
            number:'<?=implode(',',array_keys($revenue->day))?>',
            reveue:'<?=implode(',',$revenue->day)?>',
        },
    };
</script>
@endsection