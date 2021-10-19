<div id="attribute-product">
  <h5 class="text-uppercase bg-light p-2 mb-0">
    <i class="mdi mdi-settings mr-1"></i>Thuộc tính
  </h5>
  <div class="card">
    <div class="card-body">
      <div class="list-attribute">
          <div class="first-attribute">
          @if(count($item->attributes))
            @foreach($item->attributes as $vPivot)
            <div class="item-attribute mb-2">
                <div class="row">
                  <div class="col-lg-3 col-md-5">
                    <div class="input-group flex-wrap-initial">
                      <select class="select2 group_attribute"  id=''>
                        <option value="" >Nhóm thuộc tính</option>
                        @foreach($group_attributes as $v)
                        <option value="{{$v->id}}"
                        {{ $vPivot->group->id == $v->id ? 'selected' : ''}}
                          >{{$v->name}}</option>
                        @endforeach
                      </select>
                      <div class="input-group-append">
                        <button type='button'
                        class="btn waves-effect waves-light btn-info ml-1 ajax-form"
                        data-title='Tạo nhóm thuộc tính'
                        data-form-size = 'modal-md'
                        data-form-rel = 'true'
                        data-url="{{Route('admin.group_attribute.add')}}">
                          <i class="mdi mdi-plus-circle-outline"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-8 col-md-6">
                    <div class="input-group flex-wrap-initial mtb-sm-0-5">
                      <select class="select2 select2-multiple attribute attribute__child--edit" name="attribute_id[]" multiple="multiple" required="">
                        <option value="" >Thuộc tính</option>
                        @foreach($vPivot->group->attributes as $v)
                        <option value="{{$v->id}}"
                        {{ $vPivot->id == $v->id ? 'selected' : ''}}
                          >{{$v->name}}</option>
                        @endforeach
                      </select>
                      <div class="input-group-append">
                        <button type='button'
                        class="btn btn-attribute waves-effect waves-light btn-info ml-1 ajax-form"
                        data-title='Tạo thuộc tính'
                        data-form-size = 'modal-md'
                        data-form-rel = 'true'
                        data-url="{{Route('admin.attribute.group.add',['group_id' => $vPivot->group->id])}}">
                          <i class="mdi mdi-plus-circle-outline"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-1 col-md-1">
                    <button type='button'
                      class="btn btn_remove--row-attribute waves-effect waves-light btn-danger"
                      data-title='Xoá thuộc tính'
                      data-form-size = 'modal-md'
                      data-form-rel = 'true'
                      data-url="">
                        <i class="mdi mdi-trash-can-outline"></i>
                    </button>
                  </div>
                </div>
              </div>
              @endforeach
          @endif
          </div>
      </div>
      <a href="javascript: void(0);" 
      class="btn add-attr-pattern btn-info waves-effect waves-light">
        <i class="mdi mdi-plus-circle mr-1"></i>Thêm thuộc tính
      </a>
    </div>
  </div>
</div>