<!-- start page title -->
<div class="row">
   <div class="col-12">
      @include('blocks.messages')
    </div>
 </div>
 <form 
  class='needs-validation {{$form->devform}}'
  role="form" 
  method="POST" 
  action="{{$pageIndex.'/update/'.$item->id.$path_type}}" 
  enctype="multipart/form-data" 
  novalidate>
   @csrf
   {{ method_field('PUT') }}
  <div class="row d-flex flex-sm-row-reverse">
   <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <div class="form-group row">
            <label class="col-sm-3">{{$title}}</label>
            <div class="col-sm-9">
              <div class="input-group">
                <input type="text" class="form-control" id="name" name="name" placeholder="{{$title}}" value="{{$item->name}}" required="">
                <div class="invalid-feedback">Vui lòng nhập {{$title}}</div>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3">Điện thoại</label>
            <div class="col-sm-9">
              <div class="input-group">
                <input type="text" class="form-control" id="phone" name="phone" placeholder="Số điện thoại" value="{{$item->phone}}">
                <div class="invalid-feedback">Vui lòng nhập số điện thoại</div>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3">Địa chỉ</label>
            <div class="col-sm-9">
              <div class="input-group">
                <input type="text" class="form-control" id="address" name="address" placeholder="Địa chỉ" value="{{$item->address}}">
                <div class="invalid-feedback">Vui lòng nhập địa chỉ</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <button type="submit" class="btn btn-success waves-effect waves-light"><i class="far fa-plus-square mr-1"></i>Sửa</button>
      <button type="reset" class="btn btn-secondary waves-effect waves-light"><i class="fa fas fa-redo mr-1"></i>Làm mới</button>
   </div>
</div>
</form>