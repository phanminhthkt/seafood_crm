    <form role="form" 
    class='needs-validation dev-form'
    method="POST" 
    action="{{$pageIndex.'/store'.$path_type}}" 
    enctype="multipart/form-data" 
    novalidate>
   @csrf
      <div class="card">
        <div class="card-body">
          <div class="form-group row">
              <label class="col-sm-3">Vai trò</label>
              <div class="col-sm-9">  
                <select class="selectpicker"  data-selected-text-format="count > 3" name="role[]" data-style="btn-light">
                    @foreach($roles as $v)
                    <option value="{{$v->id}}">{{$v->name}}</option>
                    @endforeach
                </select>
              </div>
          </div>
          <div class="form-group row">
              <label class="col-sm-3">Tên người dùng</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="username" name="username" placeholder="Tên người dùng" value="{{old('username')}}" required="">
                <div class="invalid-feedback">Vui lòng nhập username</div>
              </div>
          </div>
          <div class="form-group row">
              <label class="col-sm-3">Email</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="{{old('email')}}" required="">
                <div class="invalid-feedback">Vui lòng nhập email</div>
              </div>
          </div>
          <div class="form-group row">
              <label class="col-sm-3">Mật khẩu</label>
              <div class="col-sm-9">
                <input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu" value="" required="">
                <div class="invalid-feedback">Vui lòng nhập mật khẩu</div>
              </div>
          </div>
          <div class="form-group row">
              <label class="col-sm-3">Nhập lại mật khẩu</label>
              <div class="col-sm-9">
                <input type="password" class="form-control" id="password" name="password_confirmation" placeholder="Nhập lại mật khẩu" value="" required="">
                <div class="invalid-feedback">Vui lòng xác nhận lại mật khẩu.</div>
              </div>
          </div>
          <div class="form-group row">
              <label class="col-sm-3">Nhập họ tên</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="name" name="name" placeholder="Họ và tên" value="{{old('name')}}" required="">
                <div class="invalid-feedback">Vui lòng nhập họ và tên</div>
              </div>
          </div>
                
        </div>
      </div>
      <button type="submit" class="btn btn-success waves-effect waves-light"><i class="far fa-plus-square mr-1"></i>Tạo</button>
      <button type="reset" class="btn btn-secondary waves-effect waves-light"><i class="fa fas fa-redo mr-1"></i>Reset</button>
 </form>
