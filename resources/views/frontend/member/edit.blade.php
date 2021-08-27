@extends('frontend.layouts.index')
@section('content')
<!-- start page title -->
<div class="row">
   <div class="col-12">
      <div class="page-title-box">
         <div class="page-title-left">
            <ol class="breadcrumb m-0">
               <li class="breadcrumb-item"><a href="{{route('client.index') }}"><i class="remixicon-home-8-line"></i></a></li>
               <li class="breadcrumb-item active">Sửa {{$title}}</li>
            </ol>
         </div>
      </div>
   </div>
   <div class="col-12">
      @include('blocks.messages')
    </div>
 </div>
 <form 
  class='needs-validation'
  role="form" 
  method="POST" 
  action="{{$pageIndex.'/update/'.$item->id.$path_type}}" 
  enctype="multipart/form-data" 
  novalidate >
   @csrf
   {{ method_field('PUT') }}
  <div class="row d-flex">
   <div class="col-lg-4">
      <div class="card-box text-center">
          <img src="{{asset('frontend/')}}\images\users\avatar-1.jpg" class="rounded-circle avatar-xl img-thumbnail" alt="profile-image">

          <h4 class="mb-0">{{$item->name}}</h4>
          <p class="text-muted">{{$item->group->name}}</p>

          <button type="button" class="btn btn-success btn-xs waves-effect mb-2 waves-light">Follow</button>
          <button type="button" class="btn btn-danger btn-xs waves-effect mb-2 waves-light">Message</button>

          <div class="text-left mt-3">
              <h4 class="font-13 text-uppercase">About Me :</h4>
              <p class="text-muted font-13 mb-3">
                  Hi I'm Johnathn Deo,has been the industry's standard dummy text ever since the
                  1500s, when an unknown printer took a galley of type.
              </p>
              <p class="text-muted mb-2 font-13">
                <strong>Full Name :</strong> <span class="ml-2">{{$item->name}}</span></p>

              <p class="text-muted mb-2 font-13"><strong>Mobile :</strong><span class="ml-2">(123)
                      123 1234</span></p>

              <p class="text-muted mb-2 font-13">
                <strong>Email :</strong> <span class="ml-2 ">{{$item->email}}</span>
              </p>

              <p class="text-muted mb-1 font-13"><strong>Location :</strong> <span class="ml-2">USA</span></p>
          </div>

          <ul class="social-list list-inline mt-3 mb-0">
              <li class="list-inline-item">
                  <a href="javascript: void(0);" class="social-list-item border-purple text-purple"><i class="mdi mdi-facebook"></i></a>
              </li>
              <li class="list-inline-item">
                  <a href="javascript: void(0);" class="social-list-item border-danger text-danger"><i class="mdi mdi-google"></i></a>
              </li>
              <li class="list-inline-item">
                  <a href="javascript: void(0);" class="social-list-item border-info text-info"><i class="mdi mdi-twitter"></i></a>
              </li>
              <li class="list-inline-item">
                  <a href="javascript: void(0);" class="social-list-item border-secondary text-secondary"><i class="mdi mdi-github-circle"></i></a>
              </li>
          </ul>
      </div>
   </div>
   <div class="col-lg-8">
      <div class="card">
        <div class="card-header py-2 text-white">
            <h5 class="card-title mb-0">THÔNG TIN CHI TIẾT</h5>
        </div>
        <div class="card-body">
          <div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupPrepend"><i class="fa fa-user"></i></span>
                </div>
                <input type="text" class="form-control" id="username" name="username"  placeholder="Tên người dùng" value="{{$item->username}}" required="">
                <div class="invalid-feedback">Vui lòng nhập username</div>
              </div>
          </div>
          <div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupPrepend"><i class="fa fa-envelope"></i></span>
                </div>
                <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="{{$item->email}}" required="">
                <div class="invalid-feedback">Vui lòng nhập email</div>
              </div>
          </div>
          <div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupPrepend"><i class="fa fa-lock"></i></span>
                </div>
                <input type="password" class="form-control" id="password" name="password"  placeholder="Mật khẩu" value="" required="">
                <div class="invalid-feedback">Vui lòng nhập mật khẩu</div>
              </div>
          </div>
          <div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupPrepend"><i class="fa fa-lock"></i></span>
                </div>
                <input type="password" class="form-control" id="password" name="password_confirmation" placeholder="Nhập lại mật khẩu" value="" required="">
                <div class="invalid-feedback">Vui lòng xác nhận lại mật khẩu.</div>
              </div>
          </div>
          <div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupPrepend"><i class="fa fa-user"></i></span>
                </div>
                <input type="text" class="form-control" id="name" name="name" placeholder="Họ và tên" value="{{$item->name}}" required="">
                <div class="invalid-feedback">Vui lòng nhập họ và tên</div>
              </div>
          </div>
        </div>
      </div>
      <button type="submit" class="btn btn-success waves-effect waves-light"><i class="far fa-plus-square mr-1"></i>Submit</button>
      <button type="reset" class="btn btn-secondary waves-effect waves-light"><i class="fa fas fa-redo mr-1"></i>Reset</button>
   </div>
   
</div>
</form>

@endsection