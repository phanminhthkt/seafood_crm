    <form 
    class='needs-validation {{$form->devform}}'
    role="form" 
    method="POST" 
    action="{{$pageIndex.'/store'.$path_type}}" 
    enctype="multipart/form-data" 
    novalidate>
   @csrf
      <div class="card">
        <div class="card-body">
          <div class="form-group row">
            <label class="col-sm-3">Quyền</label>
            <div class="col-sm-9">
              <div class="input-group">
                <input type="text" class="form-control" id="name" name="name" placeholder="Quyền" value="{{old('name')}}" required="">
                <div class="invalid-feedback">Vui lòng nhập quyền</div>
              </div>
              </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3">Module</label>
            <div class="col-sm-9">
              <div class="input-group">
                 <input type="text" class="form-control" name="module" placeholder="Module" value="{{old('module')}}" required="">
                <div class="invalid-feedback">Vui lòng nhập module( Ex: product,post,project... )</div>
              </div>
              </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3">Hành động</label>
            <div class="col-sm-9">
              <div class="input-group">
                <input type="text" class="form-control" id="action" name="action" placeholder="Hành động" value="{{old('action')}}" required="">
                <div class="invalid-feedback">Vui lòng nhập hành động( Ex: view,create,edit,... )</div>
              </div>
              </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3">Kiểu</label>
            <div class="col-sm-9">
              <div class="input-group">
                <input type="text" class="form-control" id="type" name="type" placeholder="Kiểu" value="{{old('type')}}">
              </div>
              </div>
          </div>
        </div>
      </div>
      <button type="submit" class="btn btn-success waves-effect waves-light"><i class="far fa-plus-square mr-1"></i>Tạo</button>
      <button type="reset" class="btn btn-secondary waves-effect waves-light"><i class="fa fas fa-redo mr-1"></i>Reset</button>
   
 </form>


