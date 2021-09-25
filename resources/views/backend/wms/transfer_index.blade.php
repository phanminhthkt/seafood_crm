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
<div class="card">
<div class="card-body pmb-0 dev-p-1">
   <form role="form" class="search-form" method="GET" action="{{url()->current()}}" enctype="multipart/form-data" >
    <div class="row">
      <div class="col-sm-3 col-12">
        <div class="form-group">
          <div class="input-group">
            <input 
              type="text" 
              name="created_at" 
              class="form-control input-dev-default flatpickr-input flatpickr-input-range" 
              id="created_at" 
              value="" 
              placeholder="Ngày tạo đơn"
              >
            <div class="input-group-append">
                <span class="input-group-text"><i class="ti-calendar"></i></span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-3 col-6">
          <div class="form-group">
              <select class="select2"  name="store" >
              <option value="" >Chọn chi nhánh</option>
                @foreach($wms as $v)
                <option value="{{$v->id}}">{{$v->name}}</option>
                @endforeach
              </select>
          </div>
      </div>
      <div class="col-sm-2 col-6">
          <div class="form-group">
              <select class="select2" name="status" >
              <option value="" >Chọn trạng thái</option>
                @foreach($status as $v)
                <option value="{{$v->id}}">{{$v->name}}</option>
                @endforeach
              </select>
          </div>
      </div>
      <div class="col-sm-2 col-6">
        <div class="form-group">
          <button class="btn btn-purple text-white w-100" type="submit">
              <i class="fas fa-filter mr-1"></i>Lọc
          </button>
        </div>
      </div>
      <div class="col-sm-2 col-6">
        <div class="form-group">
          <button class="btn btn-danger btn-destroy__filter text-white w-100" type="button">
              <i class="mdi mdi-close-circle mr-1"></i>Huỷ</button>
        </div>
      </div>
  </div>
</form>
</div>
</div>
<!-- end page title --> 
<div class="row">
   <div class="col-12">
      <div class="card">
        <div class="card-header flex-wrap d-inline-flex justify-content-between py-1">
            <h4 class="card-title d-inline-block mb-0 py-1">Danh sách {{$title}}</h4>
            @include('backend.modules.search')
        </div>
         <div class="card-body">
              <div class="table-responsive">
                 <table id="datatable-buttons" class="table table-striped dt-responsive no-border">
                    <thead>
                       <tr role="row">
                          <th>Id</th>
                          <th width="1%">
                              <div class="custom-control custom-checkbox text-center">
                                <input type="checkbox" class="custom-control-input" id="selectall-checkbox">
                                <label class="custom-control-label" for="selectall-checkbox"></label>
                              </div>
                          </th>
                          <th class="text-center"width="13%">Mã chuyển</th>
                          <th class="text-center"width="20%" style="min-width: 100px;">Từ chi nhánh</th>
                          <th class="text-center"width="20%" style="min-width: 100px;">Đến chi nhánh</th>
                          <th class="text-center"width="10%">Ngày tạo</th>
                          <th width="10%" class="text-center">Trạng thái</th>
                          <th class="text-center"width="10%">Tổng tiền</th>
                          <th width="10%">Hành động</th>
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
            d.status = $('select[name=status] option:selected').val();
            d.store = $('select[name=store] option:selected').val();
            d.created_at = $('input[name=created_at]').val();
        }
    },
    columns:[
        {data: 'id',name: 'id', visible: false},
        {data: 'checkbox', orderable: false, searchable: false},
        {data: 'code',name: 'code'},
        {data: 'fromStore.name',name: 'fromStore', orderable: false, searchable: false},
        {data: 'toStore.name',name: 'toStore', orderable: false, searchable: false},
        {data: 'created_at',name: 'created_at'},
        {data: 'status',name: 'status', orderable: false, searchable: false},
        {data: 'total_price',name: 'total_price', orderable: false, searchable: false},
        {data: 'action', name: 'action', orderable: false, searchable: false}
    ]
  };
</script>
@endsection

