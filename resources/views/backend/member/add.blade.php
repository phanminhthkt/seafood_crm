@extends('backend.layouts.index')
@section('content')
<!-- start page title -->
<div class="row">
   <div class="col-12">
      <div class="page-title-box">
         <div class="page-title-left">
            <ol class="breadcrumb m-0">
               <li class="breadcrumb-item"><a href="{{route('admin.index') }}"><i class="remixicon-home-8-line"></i></a></li>
               <li class="breadcrumb-item"><a href="{{$pageIndex}}">{{$title}}</a></li>
               <li class="breadcrumb-item active">Thêm {{$title}}</li>
            </ol>
         </div>
      </div>
   </div>

    <div class="col-12">
         @include('blocks.messages')
    </div>
  </div>
    <form role="form" class='needs-validation'
    method="POST" 
    action="{{$pageIndex.'/store'.$path_type}}" 
    enctype="multipart/form-data" 
    novalidate>
   @csrf
   <div class="row d-flex flex-sm-row-reverse">
    <div class="col-lg-4">
      <div class="card">
        <div class="card-header py-2">
            <h5 class="card-title mb-0">THÔNG TIN CHUNG</h5>
        </div>
        <div class="card-body">
          <div class="form-group">
              <label>Nhóm</label>
              <select class="selectpicker" data-live-search="true" name="group_id" id="group" required="">
              <option value="" >Chọn nhóm</option>
                @foreach($groups as $group)
                <option value="{{$group->id}}">
                {{$group->name}}
                </option>
                @endforeach
              </select>
              <div class="invalid-feedback">Vui lòng chọn nhóm</div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-sm-6 col-12">
                <div class="form-group">
                <label>Tình trạng</label>
                <select class="selectpicker" name="is_status">
                    <option value="1"> Hiển thị</option>
                    <option value="0"> Ẩn</option>
                </select>
              </div>
              </div>
              <div class="col-sm-6 col-12">
                <div class="form-group">
                  <label id="priority">Thứ tự</label>
                    <input type="text" class="form-control" id="priority" name='is_priority' placeholder="Thứ tự" value="1">
                </div>
              </div>
            </div>
              
          </div>

        </div>
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
                <input type="text" class="form-control" id="username" name="username" placeholder="Tên người dùng" value="{{old('username')}}" required="">
                <div class="invalid-feedback">Vui lòng nhập username</div>
              </div>
          </div>
          <div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupPrepend"><i class="fa fa-envelope"></i></span>
                </div>
                <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="{{old('email')}}" required="">
                <div class="invalid-feedback">Vui lòng nhập email</div>
              </div>
          </div>
          <div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupPrepend"><i class="fa fa-lock"></i></span>
                </div>
                <input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu" value="" required="">
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
                <input type="text" class="form-control" id="name" name="name" placeholder="Họ và tên" value="{{old('name')}}" required="">
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