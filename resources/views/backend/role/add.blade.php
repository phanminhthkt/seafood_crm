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
    class='needs-validation {{$form->devform}}'
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
                <div class="form-group">
                  <label>Vai trò</label>
                    <div class="input-group">
                      <input type="text" class="form-control" id="name" name="name" placeholder="Vai trò" value="{{old('name')}}" required="">
                      <div class="invalid-feedback">Vui lòng nhập vai trò</div>
                    </div>
                </div>
                <!-- Add Permission -->
                <div class="group-permission">
                  <h5 class="font-weight-medium">Chọn quyền</h5>
                  <div class="line"></div>
                  @foreach($permissions as $vArr)
                      <h3 class="header-title text-success mb-2">{{$namePer = ucwords(substr($vArr[0]->name,'4'))}}</h4>
                      <div class="row">
                      @foreach($vArr as $k => $v)
                      <div class="col-lg-4 mb-2 d-flex align-content-center justify-content-between">
                        <label class="d-block mb-0 font-weight-normal" for="permission{{$v->id}}">
                          {{$v->name}}</label>
                        <input 
                          type="checkbox" data-plugin="switchery" data-color="#7266ba" data-size="small" class="mt-1"
                          value="{{$v->id}}" 
                          id="permission{{$v->id}}"
                          name="permission[]"
                        >
                        </div>
                      @endforeach
                    </div>
                    <div class="line"></div>
                  @endforeach
                </div>
               <!--End Add Permission -->
        </div>
      </div>
      <button type="submit" class="btn btn-success waves-effect waves-light"><i class="far fa-plus-square mr-1"></i>Submit</button>
      <button type="reset" class="btn btn-secondary waves-effect waves-light"><i class="fa fas fa-redo mr-1"></i>Reset</button>
   </div>
   
</div>
 </form>


@endsection