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
            <div id="basic-datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
               <div class="row">
                  <div class="col-sm-12">
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
                              <th width="8%" class="text-center">Thứ tự</th>
                              <th class="text-center" width="70%" >{{$title}}</th>
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
        {data: 'priority',name: 'priority', orderable: false, searchable: false},
        {data: 'name',name: 'name'},
        {data: 'status',name: 'status', orderable: false, searchable: false},
        {data: 'action', name: 'action', orderable: false, searchable: false}
    ]
  };
</script>
@endsection