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
  <div class="card mb-0">
      <ul class="nav nav-tabs-custom nav-tabs nav-bordered">
        <li class="nav-item d-block">
            <a href="#ttinfo" data-toggle="tab" aria-expanded="false" class="nav-link active">
                <span class="d-inline-block d-sm-none"><i class="fas fa-file-contract"></i></span>
                <span class="d-none d-sm-inline-block">Thông tin chung</span> 
            </a>
        </li>
        <li class="nav-item d-block">
            <a href="#ttimage" data-toggle="tab" aria-expanded="true" class="nav-link">
                <span class="d-inline-block d-sm-none"><i class="fab fa-connectdevelop"></i></span>
                <span class="d-none d-sm-inline-block">Hình ảnh</span> 
            </a>
        </li>
      </ul>
  </div>
  <form 
    class='needs-validation {{$form->devform}}'
    role="form" 
    method="POST" 
    action="{{$pageIndex.'/child/update/'.$item->id.$path_type}}" 
    enctype="multipart/form-data" 
    novalidate>
   @csrf
   {{ method_field('PUT') }}
   <div class="tab-content">
      <div class="tab-pane fade active show" id="ttinfo">
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
                            <option value="{{$v->id}}"
                              {{ $item->category_id == $v->id ? 'selected' : ''}}
                            >{{$v->name}}</option>
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
                            <input type="text" class="form-control" id="name" name="name" placeholder="{{$title}}" value="{{$item->name}}" required="">
                            <div class="invalid-feedback">Vui lòng nhập {{$title}}</div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3">SKU</label>
                        <div class="col-sm-9">
                          <div class="input-group">
                            <input type="text" class="form-control" id="sku" name="sku" placeholder="Mã hàng" value="{{$item->sku}}" required="">
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
                            <input type="text" data-toggle="input-mask" data-mask-format="000,000,000,000" data-reverse="true" class="form-control" id="export_price" name="export_price" placeholder="Giá bán" value="{{$item->export_price}}" required="">
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
                            <input type="text" data-toggle="input-mask" data-mask-format="000,000,000,000" data-reverse="true" class="form-control" id="import_price" name="import_price" placeholder="Giá nhập" value="{{$item->import_price}}" required="">
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
                              <option value="{{$v->id}}"
                                {{ $item->unit_id == $v->id ? 'selected' : ''}}
                              >{{$v->name}}</option>
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
                  @if(config('siteconfig.product.attributes'))
                    @include('backend.product.blocks.product_child_attribute')
                  @endif
                </div>
              </div>
              
           </div>
        </div>
      </div>
    
    <div class="tab-pane fade" id="ttimage">
        <div class="row">
          <div class="col-md-4">
            <div class="card">
              <div class="card-header py-2">
                  <h5 class="card-title mb-0">Ảnh đại diện</h5>
              </div>
              <div class="card-body">
                @include('backend.product.blocks.image')
              </div>
            </div>
          </div>
          <div class="col-md-8">
            <div class="card">
              <div class="card-header py-2">
                  <h5 class="card-title mb-0">Bộ sưu tập</h5>
              </div>
              <div class="card-body">
                @include('backend.product.blocks.album')
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>  
    <button type="submit" class="btn btn-success waves-effect waves-light"><i class="far fa-plus-square mr-1"></i>Cập nhật</button>
    <button type="reset" class="btn btn-secondary waves-effect waves-light"><i class="fa fas fa-redo mr-1"></i>Làm mới</button>
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
          <select class="select2 select2-multiple attribute attribute__child--edit" multiple="multiple" data-live-search="true" name='attribute_id[]'  required="">
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
<script id="multi-images-pattern" type="text/template">
  <div class="col-md-3">
    <div class="card mt-2 mb-1 shadow-none border dz-processing dz-success dz-complete dz-image-preview">
      <div class="p-2 text-center">
        <a class="btn btn-link btn-lg text-muted remove-image"><i class="mdi mdi-close-circle" onClick="removeImage(this)"></i></a>
        <img style="height:100px;" class="rounded bg-light img-child" alt="" src="">
        <input type="text" class="name-img" name="data_album[name][]" value="" placeholder="Tiêu đề">
        <input type="text"  name="data_album[stt][]" value="0" placeholder="Số thứ tự">
        <input type="hidden"  name="data_album[hidden][]" value="">
      </div>
    </div>
  </div>
</script>
@endsection
