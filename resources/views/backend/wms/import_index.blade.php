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
                          <th class="text-center"width="13%">Mã {{$title}}</th>
                          <th class="text-center"width="20%">Chi nhánh</th>
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
        }
    },
    columns:[
        {data: 'id',name: 'id', visible: false},
        {data: 'checkbox', orderable: false, searchable: false},
        {data: 'code',name: 'code'},
        {data: 'store.name',name: 'store', orderable: false, searchable: false},
        {data: 'created_at',name: 'created_at'},
        {data: 'status.name',name: 'status', orderable: false, searchable: false},
        {data: 'total_price',name: 'total_price', orderable: false, searchable: false},
        {data: 'action', name: 'action', orderable: false, searchable: false}
    ]
  };
</script>
@endsection

