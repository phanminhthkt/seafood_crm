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
    <form 
    class='needs-validation'
    role="form" 
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
            <div class="row">
              <div class="col-sm-6 col-12">
                <div class="form-group">
                <label>Tình trạng</label>
                <select class="selectpicker" name="is_status">
                    <option value="1" checked> Hiển thị</option>
                    <option value="0"> Ẩn</option>
                </select>
              </div>
              </div>
              <div class="col-sm-6 col-12">
                <div class="form-group">
                  <label id="priority">Thứ tự</label>
                    <input type="text" class="form-control" id="priority" name='is_priority' placeholder="Thứ tự" value="0">
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
          <ul class="nav nav-tabs nav-bordered">
            <li class="nav-item">
                <a href="#vi" data-toggle="tab" aria-expanded="false" class="nav-link active">
                    <span class="d-inline-block d-sm-none"><i class="fas fa-home"></i></span>
                    <span class="d-none d-sm-inline-block">Tiếng Việt</span> 
                </a>
            </li>
            <li class="nav-item d-none">
                <a href="#en" data-toggle="tab" aria-expanded="true" class="nav-link">
                    <span class="d-inline-block d-sm-none"><i class="far fa-user"></i></span>
                    <span class="d-none d-sm-inline-block">Tiếng Anh</span> 
                </a>
            </li>
            <li class="nav-item d-none">
                <a href="#kr" data-toggle="tab" aria-expanded="false" class="nav-link">
                    <span class="d-inline-block d-sm-none"><i class="far fa-envelope"></i></span>
                    <span class="d-none d-sm-inline-block">Tiếng Hàn</span>  
                </a>
            </li>
          </ul>
          <div class="tab-content">
              <div class="tab-pane fade active show" id="vi">
                <div class="form-group">
                  <label>Quyền</label>
                    <div class="input-group">
                      <input type="text" class="form-control" id="name" name="name" placeholder="Quyền" value="{{old('name')}}" required="">
                      <div class="invalid-feedback">Vui lòng nhập quyền</div>
                    </div>
                </div>
                <div class="form-group">
                  <label>Module</label>
                    <div class="input-group">
                       <input type="text" class="form-control" name="module" placeholder="Quyền" value="{{old('module')}}" required="">
                      <div class="invalid-feedback">Vui lòng nhập module( Ex: product,post,project... )</div>
                    </div>
                </div>
                <div class="form-group">
                  <label>Hành động</label>
                    <div class="input-group">
                      <input type="text" class="form-control" id="action" name="action" placeholder="Hành động" value="{{old('action')}}" required="">
                      <div class="invalid-feedback">Vui lòng nhập hành động( Ex: view,create,edit,... )</div>
                    </div>
                </div>
                <div class="form-group">
                  <label>Kiểu</label>
                    <div class="input-group">
                      <input type="text" class="form-control" id="type" name="type" placeholder="Kiểu" value="{{old('type')}}">
                    </div>
                </div>
            </div>
            <div class="tab-pane fade d-none" id="en">Anh</div>
            <div class="tab-pane fade d-none" id="kr">Hàn</div>
          </div>
        </div>
      </div>
      <button type="submit" class="btn btn-success waves-effect waves-light"><i class="far fa-plus-square mr-1"></i>Submit</button>
      <button type="reset" class="btn btn-secondary waves-effect waves-light"><i class="fa fas fa-redo mr-1"></i>Reset</button>
   </div>
   
</div>
 </form>


@endsection