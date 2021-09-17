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
               <li class="breadcrumb-item active">Tạo {{$title}}</li>
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
<div class="row d-flex row-wms">
  
  <div class="col-lg-8">
    <div class="card">
      <div class="card-header py-2">
          <h5 class="card-title mb-0">THÔNG TIN ĐƠN</h5>
      </div>
      <div class="card-body">
        <a href="javascript: void(0);" data-toggle="modal" data-target="#productModal" class="btn btn-modal--product btn-info waves-effect waves-light">
          <i class="mdi mdi-plus-circle mr-1"></i>Thêm sản phẩm
        </a>
        <div class="table-responsive mt-2">
            <table class="table mb-0">
                <thead>
                <tr>
                    <th width="25%">Tên</th>
                    <th style="width: 120px;">Số lượng</th>
                    <th>Giá bán</th>
                    <th style="width: 120px;">Thành tiền</th>
                    <th></th>
                </tr>
                </thead>
                <tbody class="first-same-item">
                    
                </tbody>
            </table>
        </div>
        <div class="row mt-3">
          <div class="col-sm-6">
            <div class="form-group">
              <label>Ghi chú</label>
              <div class="input-group input-group--custom">
                <textarea name="note" class="form-control"  id="note"  rows="4"></textarea>
              </div>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group row">
              <label class="col-5 mt-2">Phí vận chuyển:</label>
              <div class="col-7 text-danger text-right">
                  <div class="input-group input-group--custom">
                  <input type="text" data-toggle="input-mask" data-mask-format="000,000,000,000" data-reverse="true" class="form-control text-right" id="ship_price" name="ship_price" placeholder="0" value="{{old('ship_price')}}"> <span class='mt-1 text-muted'>đ</span>
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-5 mt-2">Giảm giá:</label>
              <div class="col-7 text-danger text-right">
                <div class="input-group input-group--custom">
                  <input type="text" data-toggle="input-mask" data-mask-format="000,000,000,000" data-reverse="true" class="form-control text-right" id="reduce_price" name="reduce_price" placeholder="0" value="{{old('reduce_price')}}"> <span class='mt-1 text-muted'>đ</span>
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-4">Tổng tiền:</label>
              <div class="col-8 text-danger text-right"><span class="total-price ">0</span>đ</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <button type="submit" name="save_draft" value="2" class="hidden-xs btn btn-warning waves-effect waves-light">Lưu nháp</button>
    <button type="submit" name="save_success" value="3" class="hidden-xs btn btn-success waves-effect waves-light">Xuất kho</button>
  </div>
  <div class="col-lg-4">
    <div class="card">
      <div class="card-header py-2">
          <h5 class="card-title mb-0">THÔNG TIN XUẤT HÀNG</h5>
      </div>
      <div class="card-body">
          <div class="form-group">
              <label>Chi nhánh</label>
              <select class="selectpicker" data-live-search="true" name="store_id" id="store" required="">
                @foreach($wms as $v)
                <option value="{{$v->id}}">
                {{$v->name}}
                </option>
                @endforeach
              </select>
              <div class="invalid-feedback">Vui lòng chọn kho</div>
          </div>
          <div class="form-group">
            <label id="export_created_at">Ngày tạo đơn</label>
            <div class="input-group">
              <input 
                type="text" 
                name="export_created_at" 
                class="form-control input-dev-default flatpickr-input" 
                id="export_created_at" 
                value="{{formatDate(Carbon\Carbon::now(),'d-m-Y H:i')}}" 
                readonly="readonly"
                placeholder="Ngày tạo đơn"
                >
              <div class="input-group-append">
                  <span class="input-group-text"><i class="ti-calendar"></i></span>
              </div>
            </div>
          </div>
          <div class="row">
            <label class="col-sm-4">Trạng thái:</label>
            <div class="col-sm-8 text-warning text-right">Phiếu tạm</div>
          </div>
      </div>
      <div class="card-body border-top">
        <div class="form-group">
            <label>Chọn khách hàng trong hệ thống</label>
            <select name="customer[id]" id="customer">
             
            </select>
            <small class="text-primary mt-1 d-block">Bỏ qua ô chọn nếu là khách hàng mới</small>
        </div>
        <div class="form-group">
          <label>Họ tên: </label>
          <div>
            <div class="input-group">
              <input type="text" class="input-dev-default form-control" id="name" name="customer[name]" placeholder="Họ tên" value="{{old('name')}}" required="">
              <div class="invalid-feedback">Vui lòng nhập họ tên</div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label>Số điện thoại: </label>
          <div>
            <div class="input-group">
              <input type="text" class="input-dev-default form-control" id="phone" name="customer[phone]" placeholder="Số điện thoại" value="{{old('phone')}}" required="">
              <div class="invalid-feedback">Vui lòng nhập số điện thoại</div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label>Địa chỉ: </label>
          <div>
            <div class="input-group">
              <input type="text" class="input-dev-default form-control" id="address" name="customer[address]" placeholder="Địa chỉ" value="{{old('address')}}" required="">
              <div class="invalid-feedback">Vui lòng nhập địa chỉ</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <button type="submit" name="save_draft" value="2" class="hidden-sm btn btn-warning waves-effect waves-light">Lưu nháp</button>
    <button type="submit" name="save_success" value="3" class="hidden-sm btn btn-success waves-effect waves-light">Xuất kho</button>
  </div>
</div>
</form>

<div id="productModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title">Chọn sản phẩm</h4>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          </div>
          <div class="modal-body p-2">
            <div class="table-responsive ">
              <form role="form" id="search-form" class="d-flex " method="GET" action="<?=URL::to('/admin/product/data?type=noparent');?>" enctype="multipart/form-data" >
                <div  class="form-inline form-search d-inline-block align-middle">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar text-sm" type="search" id="keyword" placeholder="Tìm kiếm" aria-label="Tìm kiếm" name='term' value="{{Request('term')}}" >
                        <div class="input-group-append bg-primary rounded-right">
                            <button class="btn btn-secondary text-white" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
              </form>
               <table id="datatable-buttons" class="table table-striped dt-responsive no-border w-100">
                  <thead>
                     <tr role="row">
                        <th>Id</th>
                        <th width="2%">
                            <div class="custom-control custom-checkbox text-center">
                              <input type="checkbox" class="custom-control-input" id="selectall-checkbox">
                              <label class="custom-control-label" for="selectall-checkbox"></label>
                            </div>
                        </th>
                        <th class="text-center" width="45%">Tên sản phẩm</th>
                        <th width="15%" class="text-center">Giá bán</th>
                        <th width="15%" class="text-center">Giá nhập</th>
                        <th width="3%" class="text-center">Đ/v</th>
                        <th width="15%" class="text-center">Danh mục</th>
                     </tr>
                  </thead>
              </table>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn--add__product btn-success waves-effect waves-light">Chọn</button>
            <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Đóng</button>
        </div>
      </div>
  </div>
</div>
<div class="method" data-method='export'></div>
<script id="product-pattern" type="text/template">
  <tr>
    <td scope="row">
        <div class="input-group input-group--custom">
        <span class="name-product">Tên sản phẩm</span>
        <input type="hidden" name="data_child[product_id][]">
        <div class="w-100 mt-1 text-primary ">
          Đ/v:<span class='unit-val'>kg</span>
        </div>
      </div>
    </td>
    <td>
      <div class="input-group w-150">
        <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected-dev bootstrap-touchspin-injected">
          <button class="btn btn-icon btn-light bootstrap-touchspin-down dev-touchspin-btn" data-type="minus" type="button">-</button>
          <input type="text" min="1" max='99999' value="1" name="data_child[quantity][]" class="btn-operator form-control">
          <button class="btn btn-icon btn-light bootstrap-touchspin-up dev-touchspin-btn" data-type="plus" type="button">+</button>
        </div>
      </div>
    </td>
    <td>
      <div class="input-group input-group--custom">
        <input type="text" data-toggle="input-mask" data-mask-format="000,000,000,000" data-reverse="true" class="form-control price--format"  name="data_child[export_price][]" placeholder="Giá bán" value="">
      </div>
    </td>
    <td>
      <div class="input-group input-group--custom into-money">
        
      </div>
    </td>
    <td>
        <button type='button'
          class="btn btn-icon btn_remove--row-child waves-effect waves-light btn-warning"
          data-title='Xoá sản phẩm'>
            <i class="mdi mdi-trash-can-outline"></i>
        </button>
    </td>
  </tr>
</script>
<script type="text/javascript">
  var Datatable = {
    ajax: {
        url: '<?=URL::to('/admin/product/data?type=noparent');?>',
        data: function (d) {
            d.name = $('input[name=term]').val();
        }
    },
    pageLength:5,
    columns:[
        {data: 'id',name: 'id', visible: false},
        {data: 'checkbox', orderable: false, searchable: false},
        {data: 'name',name: 'name'},
        {data: 'export_price',name: 'export_price'},
        {data: 'import_price',name: 'import_price'},
        {data: 'unit.name',name: 'unit', orderable: false, searchable: false},
        {data: 'category.name',name: 'category', orderable: false, searchable: false},
    ]
  };
</script>
@endsection