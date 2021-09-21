<!-- start page title -->
<div class="row">
   <div class="col-12">
      @include('blocks.messages')
    </div>
 </div>
 <div class="card mb-0">
      <ul class="nav nav-tabs-custom nav-tabs nav-bordered">
        <li class="nav-item d-block">
            <a href="#info" data-toggle="tab" aria-expanded="false" class="nav-link active">
                <span class="d-inline-block d-sm-none"><i class="mdi mdi-information-outline"></i></span>
                <span class="d-none d-sm-inline-block">Thông tin</span> 
            </a>
        </li>
        <li class="nav-item d-block">
            <a href="#history" data-toggle="tab" aria-expanded="true" class="nav-link">
                <span class="d-inline-block d-sm-none"><i class="mdi mdi-history"></i></span>
                <span class="d-none d-sm-inline-block">Lịch sử mua</span> 
            </a>
        </li>
      </ul>
  </div>
  <div class="tab-content">
    <div class="tab-pane fade active show" id="info">
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
                <label class="col-sm-3">{{$title}}</label>
                <div class="col-sm-9">
                  <div class="input-group">
                    <input type="text" class="form-control" id="name" name="name" placeholder="{{$title}}" value="{{$item->name}}" required="">
                    <div class="invalid-feedback">Vui lòng nhập {{$title}}</div>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3">Điện thoại</label>
                <div class="col-sm-9">
                  <div class="input-group">
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Số điện thoại" value="{{$item->phone}}">
                    <div class="invalid-feedback">Vui lòng nhập số điện thoại</div>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3">Địa chỉ</label>
                <div class="col-sm-9">
                  <div class="input-group">
                    <input type="text" class="form-control" id="address" name="address" placeholder="Địa chỉ" value="{{$item->address}}">
                    <div class="invalid-feedback">Vui lòng nhập địa chỉ</div>
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
  </div>
  <div class="tab-pane fade" id="history">
    <div class="table-responsive"> 
      <table id="datatable-in" class="table tablesaw mb-0  text-center"> 
        <thead class="thead-light"> 
          <tr> 
            <th>Id</th>
            <th width="35%"><b class="bold">Mã đơn</b></th> 
            <th><b class="bold">Tình trạng</b></th> 
            <th><b class="bold">Tổng tiền</b></th> 
            <th><b class="bold">Ngày đặt</b></th> 
          </tr> 
        </thead> 
        
      </table> 
    </div>
  </div>
</div>
<script type="text/javascript">
  var Datatable = {
    ajax: {
        url: '<?=URL::to('/admin/customer/data-order/'.$item->id.'')?>',
    },
    columns:[
        {data: 'id',name: 'id', visible: false},
        {data: 'code',name: 'code', orderable: false, searchable: false},
        {data: 'status',name: 'status', orderable: false, searchable: false},
        {data: 'total', name: 'total', orderable: false, searchable: false},
        {data: 'created_at',name: 'created_at', orderable: false, searchable: false},
    ]
  };
</script>