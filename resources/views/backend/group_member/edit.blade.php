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
  novalidate>
   @csrf
   {{ method_field('PUT') }}
  <div class="row d-flex flex-sm-row-reverse">
   <div class="col-lg-4">
      <div class="card">
        <div class="card-header py-2">
            <h5 class="card-title mb-0">THÔNG TIN CHUNG</h5>
        </div>
        <div class="card-body">
          <div class="form-group">
            <div class="row">
              <div class="col-sm-12 col-12">
                  <div class="form-group">
                  <label>Vai trò</label>
                  <select class="selectpicker" data-selected-text-format="count > 3" name="role[]" data-style="btn-light"> <!-- multiple=""  -->

                      @foreach($roles as $v)
                      <option 
                        value="{{$v->id}}" 
                        {{ in_array($v->id,$role_array) ? 'selected' : ''}}
                      >{{$v->name}}</option>
                      @endforeach
                  </select>
                </div>
              </div>
              <div class="col-sm-6 col-12">
                <div class="form-group">
                <label>Tình trạng</label>
                <select class="selectpicker" name="is_status">
                    <option value="1" {{ $item->is_status == 1 ? 'selected' : ''}}> Hiển thị</option>
                    <option value="0" {{ $item->is_status == 0 ? 'selected' : ''}}> Ẩn</option>
                </select>
              </div>
              </div>
              <div class="col-sm-6 col-12">
                <div class="form-group">
                  <label id="priority">Thứ tự</label>
                    <input type="text" class="form-control" id="priority" name='is_priority' placeholder="Thứ tự" value="{{$item->is_priority}}">
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
                  <label>Chức vụ</label>
                    <div class="input-group">
                      <input type="text" class="form-control" id="name" name="name" placeholder="Chức vụ" value="{{$item->name}}" required="">
                      <div class="invalid-feedback">Vui lòng nhập tên nhóm</div>
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