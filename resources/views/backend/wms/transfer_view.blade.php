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
        <div class="table-responsive mt-2">
            <table class="table mb-0">
                <thead>
                <tr>
                    <th width="25%">Tên</th>
                    <th style="width: 120px;">Số lượng</th>
                    <th>Giá nhập</th>
                    <th style="width: 120px;">Thành tiền</th>
                </tr>
                </thead>
                <tbody class="first-same-item">
                  @foreach($item->details as $v)
                    <tr>
                      <td scope="row">
                        <span class="name-product">{{$v->product_name}}</span>
                        <div class="w-100 mt-1 text-primary ">
                          Đ/v:<span class='unit-val'>{{$v->product_unit}}</span>
                        </div>
                      </td>
                      <td>
                        <div class="input-group w-150">
                          {{$v->product_quantity}}
                        </div>
                      </td>
                      <td>
                        <div class="input-group input-group--custom">
                           {{number_format($v->product_price, 0,'',',')}}
                        </div>
                      </td>
                      <td>
                        <div class="input-group input-group--custom into-money">
                          {{number_format($v->product_price * $v->product_quantity, 0,'',',')}}
                        </div>
                      </td>
                    </tr>
                    @endForeach
                </tbody>
            </table>
        </div>
        
      </div>
    </div>
    @can('re-update-wms-transfer')
    <button type="button" onclick="window.location='{{route('admin.wms.transfer.edit', ['id' => $item->id])}}'" value="1" class="hidden-xs btn btn-info waves-effect waves-light">Sửa phiếu</button>
    @endcan
    <button type="submit" name="save_cancel" value="1" class="hidden-xs btn btn-danger waves-effect waves-light">Huỷ phiếu</button>
    @if($item->status_id !== 2 && $item->status_id !== 1)
    <button type="button"
    onclick="loadOtherPage('{{route('admin.wms.transfer.print', ['id' => $item->id])}}')" class="hidden-xs btn btn-purple waves-effect waves-light"><i class="mdi mdi-cloud-print-outline mr-1"></i>Xuất phiếu</button>
    @endif
  </div>
  <div class="col-lg-4">
    <div class="card">
      <div class="card-header py-2">
          <h5 class="card-title mb-0">THÔNG TIN NHẬP HÀNG</h5>
      </div>
      <div class="card-body">
          <div class="form-group mb-1">
            <h5><b class="medium text-secondary">Kho chuyển: {{ $item->toStore->name}}</b></h5>
          </div>
          <div class="form-group">
            <h5><b class="medium text-secondary">Kho nhận: {{ $item->fromStore->name}}</b></h5>
          </div>
          <div class="form-group mb-1 row">
              <label class="col-5">Ngày tạo đơn:</label>
              <div class="col-7 text-purple text-right"><b class="medium">{{formatDate($item->transfer_created_at,'d/m/Y H:i')}}</b></div>
          </div>
          <div class="form-group mb-1 row">
            <label class="col-4">Trạng thái:</label>
            <div class="col-8 text-right"><b class="medium"><span class="{{classStyleStatus($item->status_id,'text')}}">{{$item->status->name}}</span></b></div>
          </div>
          <div class="form-group mb-1 row">
            <label class="col-4">Tổng tiền:</label>
            <div class="col-8 text-danger text-right"><span class="total-price ">{{number_format($item->total_price, 0,'',',')}}</span>đ</div>
          </div>
          <div class="form-group mb-1">
            <label>Ghi chú</label>
            <div class="input-group input-group--custom">
              {{$item->note ?? 'Không'}}
            </div>
          </div>
          @if($item->status_id !== 2)
          <div class="form-group mb-1">
          <label>Ghi chú huỷ</label>
            <div class="input-group input-group--custom">
              {{$item->note_cancel ?? 'Không'}}
            </div>
          </div>
          @endif
      </div>
    </div>
    @can('re-update-wms-transfer')
    <button type="button" onclick="window.location='{{route('admin.wms.transfer.edit', ['id' => $item->id])}}'" value="1" class="hidden-sm btn btn-info waves-effect waves-light">Sửa phiếu</button>
    @endcan
    <button type="submit" name="save_cancel" value="1" class="hidden-sm btn btn-danger waves-effect waves-light">Huỷ phiếu</button>
    @if($item->status_id !== 2 && $item->status_id !== 1)
    <button type="button"
    onclick="loadOtherPage('{{route('admin.wms.transfer.print', ['id' => $item->id])}}')" class="hidden-sm btn btn-purple waves-effect waves-light"><i class="mdi mdi-cloud-print-outline mr-1"></i>Xuất phiếu</button>
    @endif
  </div>
</div>
</form>
@endsection