 <form 
  class='needs-validation dev-form'
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
            <label class="col-sm-3">Nhóm</label>
            <div class="col-sm-9">
              <div class="input-group">
                <input type="text" class="form-control" id="name" name="name" placeholder="Chức vụ" value="{{$item->name}}" required="">
                <div class="invalid-feedback">Vui lòng nhập tên nhóm</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <button type="submit" class="btn btn-success waves-effect waves-light"><i class="far fa-plus-square mr-1"></i>Sửa</button>
      <button type="reset" class="btn btn-secondary waves-effect waves-light"><i class="fa fas fa-redo mr-1"></i>Reset</button>
   </div>
   
</div>
</form>
