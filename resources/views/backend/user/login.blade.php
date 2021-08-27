<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Minton - Responsive Admin Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0,user-scalable=0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
        <meta content="Coderthemes" name="author">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('backend')}}\\images\favicon.ico">

        <!-- App css -->
        <link href="{{asset('backend')}}\\css\bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="{{asset('backend')}}\\css\icons.min.css" rel="stylesheet" type="text/css">
        <link href="{{asset('backend')}}\libs\sweetalert2\sweetalert2.css" rel="stylesheet" type="text/css">
        <link href="{{asset('backend')}}\\css\app.min.css" rel="stylesheet" type="text/css">
        <link href="{{asset('backend')}}\\css\app.dev.css" rel="stylesheet" type="text/css">

    </head>

    <body>

        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-4">
                        <div class="card">
                            <div class="card-body p-4">
                                <div class="text-center w-75 m-auto">
                                    <!-- <a href="index.html">
                                        <span><img src="assets\images\logo-dark.png" alt="" height="22"></span>
                                    </a> -->
                                    <h4 class="text-muted mb-3">Đăng nhập hệ thống</h4>
                                </div>
                                <form id="form-login" onsubmit="login('#form-login')" action="POST" class='needs-validation' novalidate>
                                    <div class="form-group mb-3">
                                        <div class="input-group">
						                      <div class="input-group-prepend">
						                          <span class="input-group-text" id="inputGroupPrepend"><i class="fa fa-user"></i></span>
						                      </div>
						                      <input type="text" class="form-control" id="username" name="username" placeholder="Tên người dùng" value="" required="">
						                      <div class="invalid-feedback">Vui lòng nhập tên người dùng</div>
					                    </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <div class="input-group">
						                      <div class="input-group-prepend">
						                          <span class="input-group-text" id="inputGroupPrepend"><i class="fa fa-lock"></i></span>
						                      </div>
						                      <input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu" value="" required="">
						                      <div class="invalid-feedback">Vui lòng nhập mật khẩu</div>
					                    </div>
                                    </div>
                                    <div class="form-group mb-0 text-center">
                                        <button type="submit" class="btn btn-bordered-success waves-effect waves-light btn-block"><i class="fa fa-sign-in"></i>Đăng nhập</button>
                                    </div>
                                    <p class="text-response text-center"></p>
                                </form>
                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->
                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->
        <footer class="footer footer-alt">
           <a href="" class="text-muted">Minh 's Developer</a> 
        </footer>
        <!-- Vendor js -->
    </body>
<script src="{{asset('backend')}}\js\vendor.min.js"></script>
<script src="{{asset('backend')}}\libs\flatpickr/flatpickr.min.js"></script>
<script src="{{asset('backend')}}\libs\sweetalert2\sweetalert2.js"></script>
<script src="{{asset('backend')}}\js\app.min.js"></script>
<script src="{{asset('backend')}}\js\functions.js"></script>
<script src="{{asset('backend')}}\js\app.dev.js"></script>
</html>

