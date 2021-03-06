@extends('backend.layouts.index')
@section('content')
<!-- start page title -->
<div class="row">
   <div class="col-12">
      <div class="page-title-box">
         <div class="page-title-left">
            <ol class="breadcrumb m-0">
               <li class="breadcrumb-item"><a href=""><i class="remixicon-home-8-line"></i></a></li>
               <li class="breadcrumb-item active">{{$title}}</li>
            </ol>
         </div>
      </div>
   </div>
</div>
<div class="row">
    <div class="col-12">
         @include('blocks.messages')
    </div>
</div>
<!-- end page title --> 
<div class="row row-product">
   <div class="col-12">
      <div class="card">
        <div class="card-header flex-wrap d-inline-flex justify-content-between py-1">
            <h4 class="card-title d-inline-block mb-0 py-1">Danh sách {{$title}}</h4>
            @include('backend.modules.search')
        </div>
         <div class="card-body">
              <div class="table-responsive">
                 <table id="datatable-buttons" class="table dt-responsive no-border">
                    <thead>
                       <tr role="row">
                          <th>Id</th>
                          @if(config('siteconfig.product.attributes'))
                          <th></th>
                          @endif
                          <th width="1%">
                              <div class="custom-control custom-checkbox text-center">
                                <input type="checkbox" class="custom-control-input" id="selectall-checkbox">
                                <label class="custom-control-label" for="selectall-checkbox"></label>
                              </div>
                          </th>
                          <th width="5%" class="text-center">STT</th>
                          <th class="text-center"width="20%">{{$title}}</th>
                          <th width="15%" class="text-center">Giá bán</th>
                          <th width="15%" class="text-center">Giá nhập</th>
                          <th width="3%" class="text-center">Đ/v</th>
                          <th width="15%" class="text-center">Danh mục</th>
                          <th width="10%" class="text-center">Trạng thái</th>
                          <th width="12%">Hành động</th>
                       </tr>
                    </thead>
                </table>
              </div>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
  var Datatable = {
    ajax: {
        url: '<?=url()->current()?>/data',
        data: function (d) {
            d.name = $('input[name=term]').val();
        }
    },
    columns:[
        {data: 'id',name: 'id', visible: false},
        <?php if(config('siteconfig.product.attributes')){ ?>
        {
            "className":      'details-control',
            "orderable":      false,
            "searchable":      false,
            "data":           null,
            "defaultContent": ''
        },
        <?php } ?>
        {data: 'checkbox', orderable: false, searchable: false},
        {data: 'priority',name: 'priority', orderable: false, searchable: false},
        {data: 'name',name: 'name'},
        {data: 'export_price',name: 'export_price'},
        {data: 'import_price',name: 'import_price'},
        {data: 'unit.name',name: 'unit', orderable: false, searchable: false},
        {data: 'category.name',name: 'category', orderable: false, searchable: false},
        {data: 'status',name: 'status', orderable: false, searchable: false},
        {data: 'action', name: 'action', orderable: false, searchable: false}
    ]
  };
</script>
@if(config('siteconfig.product.attributes'))
<script id="details-template" type="text/x-handlebars-template">
  <div class="text-left"><button type="button" 
  class="btn btn-outline-primary waves-effect waves-light direct-form"
  data-url="product/child/add/@{{id}}"
  >
    <i class="mdi mdi-plus-circle mr-1"></i>Thêm hàng cùng loại</button>
  </div>
  <table class="tablesaw table  details-table" id="products-@{{id}}">
      <thead>
         <tr role="row">
            <th>Id</th>
            <th width="1%"></th>
            <th width="5%" class="text-center">STT</th>
            <th class="text-center" width="20%">{{$title}}</th>
            <th width="15%" class="text-center">Giá bán</th>
            <th width="15%" class="text-center">Giá nhập</th>
            <th width="10%" class="text-center">Trạng thái</th>
            <th width="10%">Hành động</th>
         </tr>
      </thead>
  </table>
</script>
@endif
@endsection

