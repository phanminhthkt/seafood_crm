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
   <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group row">
                  <label class="col-sm-3">Danh mục</label>
                  <div class="col-sm-9">
                    <div class="input-group flex-wrap-initial">
                    <select class="form-control select2" name="category_id" id="category" required="">
                    <option value="" >Chọn danh mục</option>
                    @foreach($categories as $v)
                    <option value="{{$v->id}}">{{$v->name}}</option>
                    @endforeach
                    </select>
                    <div class="input-group-append">
                      <button type='button'
                      class="btn waves-effect waves-light btn-info ml-1 ajax-form"
                      data-title='Tạo danh mục'
                      data-form-size = 'modal-md'
                      data-form-rel = 'true'
                      data-url="{{Route('admin.category.add')}}">
                        <i class="mdi mdi-plus-circle-outline"></i>
                      </button>
                    </div>
                    <div class="invalid-feedback flex-custom-end"><i class="mdi mdi-block-helper"></i></div>
                  </div>
                  </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3">{{$title}}</label>
                <div class="col-sm-9">
                  <div class="input-group">
                    <input type="text" class="form-control" id="name" name="name" placeholder="{{$title}}" value="{{old('name')}}" required="">
                    <div class="invalid-feedback">Vui lòng nhập {{$title}}</div>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3">SKU</label>
                <div class="col-sm-9">
                  <div class="input-group">
                    <input type="text" class="form-control" id="sku" name="sku" placeholder="Mã hàng" value="{{old('sku')}}" required="">
                    <div class="invalid-feedback">Vui lòng nhập mã</div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group row">
                <label class="col-sm-3">Giá bán</label>
                <div class="col-sm-9">
                  <div class="input-group">
                    <input type="text" data-toggle="input-mask" data-mask-format="000,000,000,000" data-reverse="true" class="form-control" id="export_price" name="export_price" placeholder="Giá bán" value="{{old('export_price')}}" required="">
                    <div class="input-group-append">
                        <span class="input-group-text input-group-text--custom">VNĐ</span>
                    </div>
                    <div class="invalid-feedback">Vui lòng nhập giá bán</div>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3">Giá nhập</label>
                <div class="col-sm-9">
                  <div class="input-group">
                    <input type="text" data-toggle="input-mask" data-mask-format="000,000,000,000" data-reverse="true" class="form-control" id="import_price" name="import_price" placeholder="Giá nhập" value="{{old('import_price')}}" required="">
                    <div class="input-group-append">
                        <span class="input-group-text input-group-text--custom">VNĐ</span>
                    </div>
                    <div class="invalid-feedback">Vui lòng nhập giá nhập</div>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                  <label class="col-sm-3">Đơn vị</label>
                  <div class="col-sm-9">
                    <div class="input-group flex-wrap-initial">
                      <select class="form-control select2" name="unit_id" id="unit" required="">
                      <option value="" >Chọn đơn vị</option>
                      @foreach($units as $v)
                      <option value="{{$v->id}}">{{$v->name}}</option>
                      @endforeach
                      </select>
                      <div class="input-group-append">
                        <button type='button'
                        class="btn waves-effect waves-light btn-info ml-1 ajax-form"
                        data-title='Tạo đơn vị'
                        data-form-size = 'modal-md'
                        data-form-rel = 'true'
                        data-url="{{Route('admin.unit.add')}}">
                          <i class="mdi mdi-plus-circle-outline"></i>
                        </button>
                      </div>
                    <div class="invalid-feedback flex-custom-end"><i class="mdi mdi-block-helper"></i></div>
                    </div>
                  </div>
              </div>
            </div>
          </div>
          <div id="attribute-product">
            <h5 class="text-uppercase bg-light p-2 mb-0">
              <i class="mdi mdi-settings mr-1"></i>Thuộc tính
            </h5>
            <div class="card">
              <div class="card-body">
                <div class="list-attribute">
                  <div class="first-attribute"></div>
                </div>
                <a href="javascript: void(0);" 
                class="btn add-attr-pattern btn-info waves-effect waves-light">
                  <i class="mdi mdi-plus-circle mr-1"></i>Thêm thuộc tính
                </a>
              </div>
            </div>
          </div>
          <div id="product-same">
            <h5 class="text-uppercase bg-light p-2 mb-0">
              <i class="mdi mdi-settings mr-1"></i>Hàng hoá cùng loại
            </h5>
            <div class="card">
              <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-borderless mb-0">
                        <thead class="thead-light">
                        <tr>
                            <th width="35%"><b class="bold">Tên</b></th>
                            <th><b class="bold">Sku</b></th>
                            <th><b class="bold">Giá bán</b></th>
                            <th><b class="bold">Giá gốc</b></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody class="first-same-item">
                          
                        </tbody>
                    </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <button type="submit" class="btn btn-success waves-effect waves-light"><i class="far fa-plus-square mr-1"></i>Tạo</button>
      <button type="reset" class="btn btn-secondary waves-effect waves-light"><i class="fa fas fa-redo mr-1"></i>Làm mới</button>
   </div>
</div>
</form>
<div id="all-attribute" data-value="{{json_encode($group_attributes)}}"></div>
<script id="attr-pattern" type="text/template">
  <div class="item-attribute mb-2">
    <div class="row">
      <div class="col-lg-3 col-md-5">
        <div class="input-group flex-wrap-initial">
          <select class="select2 group_attribute"  id=''>
            <option value="" >Nhóm thuộc tính</option>
            @foreach($group_attributes as $v)
            <option value="{{$v->id}}">{{$v->name}}</option>
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
          <select class="select2 select2-multiple attribute" multiple="multiple" data-live-search="true"  required="">
          </select>
          <div class="input-group-append">
            <button type='button'
            class="btn btn-attribute waves-effect waves-light btn-info ml-1 ajax-form"
            data-title='Tạo thuộc tính'
            data-form-size = 'modal-md'
            data-form-rel = 'true'
            data-url="">
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
</script>
<script id="attr-same-item" type="text/template">
<tr>
  <td scope="row">
      <div class="input-group input-group--custom">
      <input type="text" class="form-control"  name="data_child[name][]" placeholder="Tên sản phẩm" value="">
      <input type="hidden" name="data_child[attribute_id][]">
      <input type="hidden" name="data_child[group_attribute_id][]">
    </div>
  </td>
  <td>
    <div class="input-group input-group--custom">
      <input type="text" class="form-control"  name="data_child[sku][]" placeholder="Mã hàng" value="">
    </div>
  </td>
  <td>
    <div class="input-group input-group--custom">
      <input type="text" data-toggle="input-mask" data-mask-format="000,000,000,000" data-reverse="true" class="form-control price--format"  name="data_child[import_price][]" placeholder="Giá bán" value="">
    </div>
  </td>
  <td>
    <div class="input-group input-group--custom">
      <input type="text" data-toggle="input-mask" data-mask-format="000,000,000,000" data-reverse="true" class="form-control price--format"  name="data_child[export_price][]" placeholder="Giá nhập" value="">
    </div>
  </td>
  <td>
      <button type='button'
        class="btn btn-icon btn_remove--row-child waves-effect waves-light btn-warning"
        data-title='Xoá thuộc tính'>
          <i class="mdi mdi-trash-can-outline"></i>
      </button>
  </td>
</tr>
</script>
@endsection