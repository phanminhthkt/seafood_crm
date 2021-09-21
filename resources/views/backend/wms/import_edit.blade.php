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
    action="{{$pageIndex.'/update/'.$item->id.$path_type}}" 
    enctype="multipart/form-data" 
    novalidate>
   @csrf
   {{ method_field('PUT') }}
<div class="row d-flex row-wms">
  
  <div class="col-lg-8">
    <div class="card">
      <div class="card-header py-2">
          <h5 class="card-title mb-0">THÔNG TIN HOÁ ĐƠN</h5>
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
                    <th>Giá nhập</th>
                    <th style="width: 120px;">Thành tiền</th>
                    <th></th>
                </tr>
                </thead>
                <tbody class="first-same-item">
                  @foreach($item->details as $v)
                    <tr>
                      <td scope="row">
                          <div class="input-group input-group--custom">
                          <span class="name-product">{{$v->product_name}}</span>
                          <input type="hidden" name="data_child[product_id][]" value="{{$v->product_id}}">
                          <div class="w-100 mt-1 text-primary ">
                            Đ/v:<span class='unit-val'>{{$v->product_unit}}</span>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="input-group w-150">
                          <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected-dev bootstrap-touchspin-injected">
                            <button class="btn btn-icon btn-light bootstrap-touchspin-down dev-touchspin-btn" data-type="minus" type="button">-</button>
                            <input type="text" min="1" max='99999' name="data_child[quantity][]" value="{{$v->product_quantity}}" class="form-control">
                            <button class="btn btn-icon btn-light bootstrap-touchspin-up dev-touchspin-btn" data-type="plus" type="button">+</button>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="input-group input-group--custom">
                          <input type="text" data-toggle="input-mask" data-mask-format="000,000,000,000" data-reverse="true" class="form-control price--format" value='{{$v->product_price}}' name="data_child[import_price][]" placeholder="Giá nhập" >
                        </div>
                      </td>
                      <td>
                        <div class="input-group input-group--custom into-money">
                          
                            {{number_format($v->product_price * $v->product_quantity, 0,'',',')}}
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
                    @endForeach
                </tbody>
            </table>
        </div>
        
      </div>
    </div>
    @if($item->status_id == 2)
    <button type="submit" name="save_draft" value="2" class="hidden-xs btn btn-warning waves-effect waves-light">Lưu nháp</button>
    @endif
    <button type="submit" name="save_success" value="3" class="hidden-xs btn btn-success waves-effect waves-light">Hoàn thành</button>
    <button type="submit" name="save_cancel" value="1" class="hidden-xs btn btn-danger waves-effect waves-light">Huỷ phiếu</button>
    @if($item->status_id !== 2 && $item->status_id !== 1)
    <button type="button"
    onclick="loadOtherPage('{{route('admin.wms.import.print', ['id' => $item->id])}}')" class="hidden-xs btn btn-purple waves-effect waves-light"><i class="mdi mdi-cloud-print-outline mr-1"></i>Xuất phiếu</button>

    @endif
  </div>
  <div class="col-lg-4">
    <div class="card">
      <div class="card-header py-2">
          <h5 class="card-title mb-0">THÔNG TIN NHẬP HÀNG</h5>
      </div>
      <div class="card-body">
          <div class="form-group">
              <label>Chi nhánh</label>
              <select class="selectpicker" data-live-search="true" name="store_id" id="store" required="">
                @foreach($wms as $v)
                <option value="{{$v->id}}"
                {{ $item->store_id == $v->id ? 'selected' : ''}}  
                >
                {{$v->name}}
                </option>
                @endforeach
              </select>
              <div class="invalid-feedback">Vui lòng chọn kho</div>
          </div>
          @if($item->status_id == 2)
          <div class="form-group">
            <label id="import_created_at">Ngày tạo đơn</label>
            <div class="input-group">
              <input 
                type="text" 
                name="import_created_at" 
                class="form-control input-dev-default flatpickr-input" 
                id="import_created_at" 
                value="{{formatDate($item->import_created_at,'d-m-Y H:i')}}" 
                readonly="readonly"
                placeholder="Ngày tạo đơn"
                >
              <div class="input-group-append">
                  <span class="input-group-text"><i class="ti-calendar"></i></span>
              </div>
            </div>
            <div class="invalid-feedback">Vui lòng chọn ngày tạo đơn</div>
          </div>
          @else
          <div class="form-group row">
              <label class="col-sm-5">Ngày tạo đơn:</label>
              <div class="col-sm-7 text-purple text-right">{{formatDate($item->created_at,'d/m/Y H:i')}}</div>
          </div>
          @endif
          <div class="form-group row">
            <label class="col-sm-4">Trạng thái:</label>
            <div class="col-sm-8 text-right"><span class="{{classStyleStatus($item->status_id,'text')}}">{{$item->status->name}}</span></div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4">Tổng tiền:</label>
            <div class="col-sm-8 text-danger text-right"><span class="total-price ">{{number_format($item->total_price, 0,'',',')}}</span>đ</div>
          </div>
          <div class="form-group">
          <label>Ghi chú</label>
            <div class="input-group input-group--custom">
              <textarea name="note" class="form-control"  id="note"  rows="3">{{$item->note}}</textarea>
            </div>
          </div>
          @if($item->status_id !== 2)
          <label>Ghi chú huỷ</label>
            <div class="input-group input-group--custom">
              <textarea name="note_cancel" class="form-control"  id="note_cancel"  rows="3">{{$item->note_cancel}}</textarea>
            </div>
          </div>
          @endif
      </div>
    </div>
    @if($item->status_id == 2)
    <button type="submit" name="save_draft" value="2" class="hidden-sm btn btn-warning waves-effect waves-light">Lưu nháp</button>
    @endif
    <button type="submit" name="save_success" value="3" class="hidden-sm btn btn-success waves-effect waves-light">Hoàn thành</button>
    <button type="submit" name="save_cancel" value="1" class="hidden-sm btn btn-danger waves-effect waves-light">Huỷ phiếu</button>
    @if($item->status_id !== 2 && $item->status_id !== 1)
    <button type="button"
    onclick="loadOtherPage('{{route('admin.wms.import.print', ['id' => $item->id])}}')" class="hidden-sm btn btn-purple waves-effect waves-light"><i class="mdi mdi-cloud-print-outline mr-1"></i>Xuất phiếu</button>
    @endif
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
              <form role="form" id="search-form" class="d-flex search-form" method="GET" action="<?=URL::to('/admin/product/data?type=noparent');?>" enctype="multipart/form-data" >
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
<div class="method" data-method='import'></div>
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
        <input type="text" data-toggle="input-mask" data-mask-format="000,000,000,000" data-reverse="true" class="form-control price--format"  name="data_child[import_price][]" placeholder="Giá nhập" value="">
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