@extends('frontend.layouts.index')
@section('content')
<!-- start page title -->
<div class="row">
   <div class="col-12">
      <div class="page-title-box">
         <div class="page-title-left">
            <ol class="breadcrumb m-0">
               <li class="breadcrumb-item"><a href=""><i class="remixicon-home-8-line"></i></a></li>
            </ol>
         </div>
      </div>
   </div>
</div>
<div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card-box">
                                    <div class="float-left" dir="ltr">
                                        <input data-plugin="knob" data-width="70" data-height="70" data-fgcolor="#1abc9c" data-bgcolor="#d1f2eb" value="58" data-skin="tron" data-angleoffset="0" data-readonly="true" data-thickness=".15">
                                    </div>
                                    <div class="text-right">
                                        <h3 class="mb-1"> 268 </h3>
                                        <p class="text-muted mb-1">New Customers</p>
                                    </div>
                                </div>
                            </div><!-- end col -->

                            <div class="col-xl-3 col-md-6">
                                <div class="card-box">
                                    <div class="float-left" dir="ltr">
                                        <input data-plugin="knob" data-width="70" data-height="70" data-fgcolor="#3bafda" data-bgcolor="#d8eff8" value="80" data-skin="tron" data-angleoffset="0" data-readonly="true" data-thickness=".15">
                                    </div>
                                    <div class="text-right">
                                        <h3 class="mb-1"> 8715 </h3>
                                        <p class="text-muted mb-1">Online Orders</p>
                                    </div>
                                </div>
                            </div><!-- end col -->

                            <div class="col-xl-3 col-md-6">
                                <div class="card-box">
                                    <div class="float-left" dir="ltr">
                                        <input data-plugin="knob" data-width="70" data-height="70" data-fgcolor="#f672a7" data-bgcolor="#fde3ed" value="77" data-skin="tron" data-angleoffset="0" data-readonly="true" data-thickness=".15">
                                    </div>
                                    <div class="text-right">
                                        <h3 class="mb-1"> $925.78 </h3>
                                        <p class="text-muted mb-1">Revenue</p>
                                    </div>
                                </div>
                            </div><!-- end col -->

                            <div class="col-xl-3 col-md-6">
                                <div class="card-box">
                                    <div class="float-left" dir="ltr">
                                        <input data-plugin="knob" data-width="70" data-height="70" data-fgcolor="#6c757d" data-bgcolor="#e2e3e5" value="35" data-skin="tron" data-angleoffset="0" data-readonly="true" data-thickness=".15">
                                    </div>
                                    <div class="text-right">
                                        <h3 class="mb-1"> $78.58 </h3>
                                        <p class="text-muted mb-1">Daily Average</p>
                                    </div>
                                </div>
                            </div><!-- end col -->

                        </div>
<div class="row">
    <div class="col-xl-4">
        <div class="card-box">
            <div class="dropdown float-right">
                <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                    <i class="mdi mdi-dots-horizontal"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item">Settings</a>
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item">Download</a>
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item">Upload</a>
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item">Action</a>
                </div>
            </div>

            <h4 class="header-title">Total Revenue</h4>

            <div class="mt-3 text-center">
                <p class="text-muted font-15 font-family-secondary mb-0">
                    <span class="mx-2"><i class="mdi mdi-checkbox-blank-circle text-success"></i> Desktop</span>
                    <span class="mx-2"><i class="mdi mdi-checkbox-blank-circle text-primary"></i> Laptop</span>
                </p>

                <div id="sparkline1" class="mt-3"><canvas width="285" height="210" style="display: inline-block; width: 285.656px; height: 210px; vertical-align: top;"></canvas></div>

                <div class="row mt-3">
                    <div class="col-4">
                        <p class="text-muted font-15 mb-1 text-truncate">Target</p>
                        <h4> $56,214</h4>
                    </div>
                    <div class="col-4">
                        <p class="text-muted font-15 mb-1 text-truncate">Last week</p>
                        <h4><i class="fe-arrow-up text-success"></i> $840</h4>
                    </div>
                    <div class="col-4">
                        <p class="text-muted font-15 mb-1 text-truncate">Last Month</p>
                        <h4><i class="fe-arrow-down text-danger"></i> $7,845</h4>
                    </div>
                </div>
            </div>
        </div> <!-- end card-box -->
    </div> <!-- end col -->

    <div class="col-xl-4">
        <div class="card-box">
            <div class="dropdown float-right">
                <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                    <i class="mdi mdi-dots-horizontal"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item">Settings</a>
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item">Download</a>
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item">Upload</a>
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item">Action</a>
                </div>
            </div>

            <h4 class="header-title">Yearly Sales Report</h4>

            <div class="mt-3 text-center">
                <p class="text-muted font-15 font-family-secondary mb-0">
                    <span class="mx-2"><i class="mdi mdi-checkbox-blank-circle text-primary"></i> Revenue</span>
                    <span class="mx-2"><i class="mdi mdi-checkbox-blank-circle text-light"></i> Number of Sales</span>
                </p>

                <div id="sparkline2" class="text-center mt-3"><canvas width="213" height="210" style="display: inline-block; width: 213px; height: 210px; vertical-align: top;"></canvas></div>

                <div class="row mt-3">
                    <div class="col-4">
                        <p class="text-muted font-15 mb-1 text-truncate">Target</p>
                        <h4>$8712</h4>
                    </div>
                    <div class="col-4">
                        <p class="text-muted font-15 mb-1 text-truncate">Last week</p>
                        <h4><i class="fe-arrow-up text-success"></i> $523</h4>
                    </div>
                    <div class="col-4">
                        <p class="text-muted font-15 mb-1 text-truncate">Last Month</p>
                        <h4><i class="fe-arrow-down text-danger"></i> $965</h4>
                    </div>
                </div>

            </div>
        </div> <!-- end card-box -->
    </div> <!-- end col -->

    <div class="col-xl-4">
        <div class="card-box">
            <div class="dropdown float-right">
                <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                    <i class="mdi mdi-dots-horizontal"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item">Settings</a>
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item">Download</a>
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item">Upload</a>
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item">Action</a>
                </div>
            </div>

            <h4 class="header-title">Weekly Sales Report</h4>

            <div class="mt-3 text-center">
                <p class="text-muted font-15 font-family-secondary mb-0">
                    <span class="mx-2"><i class="mdi mdi-checkbox-blank-circle text-secondary"></i> Direct</span>
                    <span class="mx-2"><i class="mdi mdi-checkbox-blank-circle text-primary"></i> Affilliate</span>
                    <span class="mx-2"><i class="mdi mdi-checkbox-blank-circle text-light"></i> Sponsored</span>
                </p>

                <div id="sparkline3" class="text-center mt-3"><canvas width="210" height="210" style="display: inline-block; width: 210px; height: 210px; vertical-align: top;"></canvas></div>

                <div class="row mt-3">
                    <div class="col-4">
                        <p class="text-muted font-15 mb-1 text-truncate">Target</p>
                        <h4> $12,365</h4>
                    </div>
                    <div class="col-4">
                        <p class="text-muted font-15 mb-1 text-truncate">Last week</p>
                        <h4><i class="fe-arrow-down text-danger"></i> $365</h4>
                    </div>
                    <div class="col-4">
                        <p class="text-muted font-15 mb-1 text-truncate">Last Month</p>
                        <h4><i class="fe-arrow-up text-success"></i> $8,501</h4>
                    </div>
                </div>

            </div>
        </div> <!-- end card-box -->
    </div> <!-- end col -->

</div>
<div class="row">
    <div class="col-xl-6">
        <div class="card-box">
            <div class="row">
                <div class="col-md-7">
                    <div class="row align-items-center">
                        <div class="col-6 text-center">
                            <h1 class="display-4"><i class="wi wi-day-sleet text-primary"></i></h1>
                        </div>
                        <div class="col-6">
                            <div class="text-muted">
                                <h2 class="mt-1"><b>32°</b></h2>
                                <p>Partly cloudy</p>
                                <p class=" mb-0">15km/h - 37%</p>
                            </div>
                        </div>
                    </div><!-- End row -->
                </div>
                <div class="col-md-5">
                    <div class="row">
                        <div class="col-4 text-center">
                            <h4 class="text-muted mt-0">SAT</h4>
                            <h3 class="my-3"><i class="wi wi-night-alt-cloudy text-primary"></i></h3>
                            <h4 class="text-muted mb-0">30<i class="wi wi-degrees"></i></h4>
                        </div>
                        <div class="col-4 text-center">
                            <h4 class="text-muted mt-0">SUN</h4>
                            <h3 class="my-3"><i class="wi wi-day-sprinkle text-primary"></i></h3>
                            <h4 class="text-muted mb-0">28<i class="wi wi-degrees"></i></h4>
                        </div>
                        <div class="col-4 text-center">
                            <h4 class="text-muted mt-0">MON</h4>
                            <h3 class="my-3"><i class="wi wi-hot text-primary"></i></h3>
                            <h4 class="text-muted mb-0">33<i class="wi wi-degrees"></i></h4>
                        </div>
                    </div><!-- end row -->
                </div>
            </div><!-- end row -->
        </div><!-- cardbox -->
        <!-- END Weather WIDGET 1 -->

    </div><!-- End col-xl-6 -->

    <div class="col-xl-6">

        <!-- WEATHER WIDGET 2 -->
        <div class="card-box">

            <div class="row">
                <div class="col-md-7">
                    <div class="row align-items-center">
                        <div class="col-6 text-center">
                            <h1 class="display-4"><i class="wi wi-night-sprinkle text-primary"></i></h1>
                        </div>
                        <div class="col-6">
                            <div class="text-muted">
                                <h2 class="mt-1"><b>18°</b></h2>
                                <p>Partly cloudy</p>
                                <p class=" mb-0">15km/h - 37%</p>
                            </div>
                        </div>
                    </div><!-- End row -->
                </div>
                <div class="col-md-5">
                    <div class="row">
                        <div class="col-4 text-center">
                            <h4 class="text-muted mt-0">SAT</h4>
                            <h3 class="my-3"><i class="wi wi-day-sprinkle text-primary"></i></h3>
                            <h4 class="text-muted mb-0">30<i class="wi wi-degrees"></i></h4>
                        </div>
                        <div class="col-4 text-center">
                            <h4 class="text-muted mt-0">SUN</h4>
                            <h3 class="my-3"><i class="wi wi-storm-showers text-primary"></i></h3>
                            <h4 class="text-muted mb-0">28<i class="wi wi-degrees"></i></h4>
                        </div>
                        <div class="col-4 text-center">
                            <h4 class="text-muted mt-0">MON</h4>
                            <h3 class="my-3"><i class="wi wi-night-alt-cloudy text-primary"></i></h3>
                            <h4 class="text-muted mb-0">33<i class="wi wi-degrees"></i></h4>
                        </div>
                    </div><!-- end row -->
                </div>
            </div><!-- end row -->
        </div><!-- card-box -->
        <!-- END WEATHER WIDGET 2 -->

    </div><!-- /.col-xl-6 -->
</div>
<div class="row">
    <div class="col-xl-4">
        <div class="card-box">
            <div class="dropdown float-right">
                <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                    <i class="mdi mdi-dots-horizontal"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item">Settings</a>
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item">Download</a>
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item">Upload</a>
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item">Action</a>
                </div>
            </div>
            <h4 class="header-title">Earning Reports</h4>
            <p class="text-muted">1 Mar - 31 Mar Showing Data</p>
            <h2 class="mb-4"><i class="mdi mdi-currency-usd text-primary"></i>25,632.78</h2>

            <div class="row mb-4">
                <div class="col-6">
                    <p class="text-muted mb-1">This Month</p>
                    <h3 class="mt-0 font-20">$120,254 <small class="badge badge-light-success font-13">+15%</small></h3>
                </div>

                <div class="col-6">
                    <p class="text-muted mb-1">Last Month</p>
                    <h3 class="mt-0 font-20">$98,741 <small class="badge badge-light-danger font-13">-5%</small></h3>
                </div>
            </div>

            <h5 class="font-16"><i class="mdi mdi-chart-donut text-primary"></i> Weekly Earning Report</h5>

            <div class="mt-5">
                <span data-plugin="peity-bar" data-colors="#1abc9c,#ebeff2" data-width="100%" data-height="92" style="display: none;">5,3,9,6,5,9,7,3,5,2,9,7,2,1,3,5,2,9,7,2,5,3,9,6,5,9,7</span><svg class="peity" height="92" width="100%"><rect data-value="5" fill="#1abc9c" x="1.0579851851851854" y="40.888888888888886" width="8.463881481481481" height="51.111111111111114"></rect><rect data-value="3" fill="#ebeff2" x="11.637837037037038" y="61.333333333333336" width="8.46388148148148" height="30.666666666666664"></rect><rect data-value="9" fill="#1abc9c" x="22.21768888888889" y="0" width="8.46388148148148" height="92"></rect><rect data-value="6" fill="#ebeff2" x="32.79754074074074" y="30.66666666666667" width="8.463881481481472" height="61.33333333333333"></rect><rect data-value="5" fill="#1abc9c" x="43.37739259259259" y="40.888888888888886" width="8.463881481481486" height="51.111111111111114"></rect><rect data-value="9" fill="#ebeff2" x="53.95724444444444" y="0" width="8.463881481481494" height="92"></rect><rect data-value="7" fill="#1abc9c" x="64.53709629629628" y="20.444444444444443" width="8.463881481481508" height="71.55555555555556"></rect><rect data-value="3" fill="#ebeff2" x="75.11694814814815" y="61.333333333333336" width="8.46388148148148" height="30.666666666666664"></rect><rect data-value="5" fill="#1abc9c" x="85.6968" y="40.888888888888886" width="8.463881481481494" height="51.111111111111114"></rect><rect data-value="2" fill="#ebeff2" x="96.27665185185185" y="71.55555555555556" width="8.46388148148148" height="20.444444444444443"></rect><rect data-value="9" fill="#1abc9c" x="106.8565037037037" y="0" width="8.463881481481494" height="92"></rect><rect data-value="7" fill="#ebeff2" x="117.43635555555555" y="20.444444444444443" width="8.463881481481508" height="71.55555555555556"></rect><rect data-value="2" fill="#1abc9c" x="128.0162074074074" y="71.55555555555556" width="8.463881481481508" height="20.444444444444443"></rect><rect data-value="1" fill="#ebeff2" x="138.59605925925928" y="81.77777777777777" width="8.46388148148148" height="10.222222222222229"></rect><rect data-value="3" fill="#1abc9c" x="149.1759111111111" y="61.333333333333336" width="8.463881481481508" height="30.666666666666664"></rect><rect data-value="5" fill="#ebeff2" x="159.75576296296296" y="40.888888888888886" width="8.46388148148148" height="51.111111111111114"></rect><rect data-value="2" fill="#1abc9c" x="170.33561481481485" y="71.55555555555556" width="8.463881481481451" height="20.444444444444443"></rect><rect data-value="9" fill="#ebeff2" x="180.9154666666667" y="0" width="8.463881481481451" height="92"></rect><rect data-value="7" fill="#1abc9c" x="191.49531851851856" y="20.444444444444443" width="8.463881481481451" height="71.55555555555556"></rect><rect data-value="2" fill="#ebeff2" x="202.0751703703704" y="71.55555555555556" width="8.463881481481451" height="20.444444444444443"></rect><rect data-value="5" fill="#1abc9c" x="212.65502222222224" y="40.888888888888886" width="8.463881481481451" height="51.111111111111114"></rect><rect data-value="3" fill="#ebeff2" x="223.2348740740741" y="61.333333333333336" width="8.463881481481451" height="30.666666666666664"></rect><rect data-value="9" fill="#1abc9c" x="233.81472592592596" y="0" width="8.463881481481451" height="92"></rect><rect data-value="6" fill="#ebeff2" x="244.3945777777778" y="30.66666666666667" width="8.463881481481451" height="61.33333333333333"></rect><rect data-value="5" fill="#1abc9c" x="254.97442962962964" y="40.888888888888886" width="8.463881481481451" height="51.111111111111114"></rect><rect data-value="9" fill="#ebeff2" x="265.5542814814815" y="0" width="8.463881481481451" height="92"></rect><rect data-value="7" fill="#1abc9c" x="276.13413333333335" y="20.444444444444443" width="8.463881481481451" height="71.55555555555556"></rect></svg>
            </div>

        </div> <!-- end card-box -->
    </div> <!-- end col -->
    <div class="col-xl-8">
        <div class="card-box">
            <div class="dropdown float-right">
                <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                    <i class="mdi mdi-dots-horizontal"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item">Settings</a>
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item">Download</a>
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item">Upload</a>
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item">Action</a>
                </div>
            </div>
            <h4 class="header-title mb-3">Revenue History</h4>

            <div class="table-responsive">
                <table class="table table-borderless table-hover table-centered m-0">

                    <thead class="thead-light">
                        <tr>
                            <th>Marketplaces</th>
                            <th>Date</th>
                            <th>US Tax Hold</th>
                            <th>Payouts</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <h5 class="m-0 font-weight-normal">Themes Market</h5>
                            </td>

                            <td>
                                Oct 15, 2018
                            </td>
                            
                            <td>
                                $125.23
                            </td>

                            <td>
                                $5848.68
                            </td>

                            <td>
                                <span class="badge badge-light-warning">Upcoming</span>
                            </td>

                            <td>
                                <a href="javascript: void(0);" class="btn btn-xs btn-secondary"><i class="mdi mdi-pencil"></i></a>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <h5 class="m-0 font-weight-normal">Freelance</h5>
                            </td>

                            <td>
                                Oct 12, 2018
                            </td>

                            <td>
                                $78.03
                            </td>

                            <td>
                                $1247.25
                            </td>

                            <td>
                                <span class="badge badge-light-success">Paid</span>
                            </td>

                            <td>
                                <a href="javascript: void(0);" class="btn btn-xs btn-secondary"><i class="mdi mdi-pencil"></i></a>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <h5 class="m-0 font-weight-normal">Share Holding</h5>
                            </td>

                            <td>
                                Oct 10, 2018
                            </td>

                            <td>
                                $358.24
                            </td>

                            <td>
                                $815.89
                            </td>

                            <td>
                                <span class="badge badge-light-success">Paid</span>
                            </td>

                            <td>
                                <a href="javascript: void(0);" class="btn btn-xs btn-secondary"><i class="mdi mdi-pencil"></i></a>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <h5 class="m-0 font-weight-normal">Envato's Affiliates</h5>
                            </td>

                            <td>
                                Oct 03, 2018
                            </td>

                            <td>
                                $18.78
                            </td>

                            <td>
                                $248.75
                            </td>

                            <td>
                                <span class="badge badge-light-danger">Overdue</span>
                            </td>

                            <td>
                                <a href="javascript: void(0);" class="btn btn-xs btn-secondary"><i class="mdi mdi-pencil"></i></a>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <h5 class="m-0 font-weight-normal">Marketing Revenue</h5>
                            </td>

                            <td>
                                Sep 21, 2018
                            </td>

                            <td>
                                $185.36
                            </td>

                            <td>
                                $978.21
                            </td>

                            <td>
                                <span class="badge badge-light-warning">Upcoming</span>
                            </td>

                            <td>
                                <a href="javascript: void(0);" class="btn btn-xs btn-secondary"><i class="mdi mdi-pencil"></i></a>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <h5 class="m-0 font-weight-normal">Advertise Revenue</h5>
                            </td>

                            <td>
                                Sep 15, 2018
                            </td>

                            <td>
                                $29.56
                            </td>

                            <td>
                                $358.10
                            </td>

                            <td>
                                <span class="badge badge-light-success">Paid</span>
                            </td>

                            <td>
                                <a href="javascript: void(0);" class="btn btn-xs btn-secondary"><i class="mdi mdi-pencil"></i></a>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div> <!-- end .table-responsive-->
        </div> <!-- end card-box-->
    </div> <!-- end col -->
</div>
@endsection