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
            <label class="col-sm-3">Nhóm</label>
            <div class="col-sm-9">
              <select class="selectpicker" data-live-search="true" name="group_id" id="group" required="">
              <option value="" >Chọn nhóm</option>
                @foreach($groups as $group)
                <option 
                  value="{{$group->id}}" 
                  {{ $item->group_id == $group->id ? 'selected' : ''}}
                >
                {{$group->name}}
                </option>
                @endforeach
              </select>
              <div class="invalid-feedback">Vui lòng chọn nhóm</div>
            </div>
            </div>
            <div class="form-group row">
               <label class="col-sm-3">Thuộc tính</label>
                <div class="col-sm-9">
                  <div class="input-group">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Thuộc tính" value="{{$item->name}}" required="">
                    <div class="invalid-feedback">Vui lòng nhập thuộc tính</div>
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