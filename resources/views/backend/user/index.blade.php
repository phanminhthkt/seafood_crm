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
                     <table id="basic-datatable" class="table table-striped dt-responsive nowrap dataTable no-footer dtr-inline" role="grid" aria-describedby="basic-datatable_info" >
                        <thead>
                           <tr role="row">
                              <th width="1%">
                                  <div class="custom-control custom-checkbox text-center">
                                    <input type="checkbox" class="custom-control-input" id="selectall-checkbox">
                                    <label class="custom-control-label" for="selectall-checkbox"></label>
                                  </div>
                              </th>
                              <th width="5%" class="text-center">Thứ tự</th>
                              <th class="text-center"width="20%">{{$title}}</th>
                              <th class="text-center"width="20%">Tên</th>
                              <!-- <th class="text-center"width="20%">Nhóm</th> -->
                              <th width="7%" class="text-center">Trạng thái</th>
                              <th width="10%">Hành động</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach($items as $item)
                           <tr role="row" class="even">
                              <td class="sorting_1" tabindex="0">
                                <div class="custom-control custom-checkbox text-center">
                                  <input type="checkbox" class="custom-control-input select-checkbox" value="{{$item->id}}" id="autoSizingCheck-{{$item->id}}">
                                  <label class="custom-control-label" for="autoSizingCheck-{{$item->id}}"></label>
                                </div>
                              </td>
                              <td align="center">
                                <input type="text" 
                                name="is_priority"
                                data-table="{{$table}}"
                                data-id="{{$item->id}}"
                                class="form-control input-mini input-priority p-0 text-center" 
                                value="{{$item->is_priority}}" >
                              </td>
                              <td align="center"><a href="{{url()->current().'/edit/'.$item->id.$path_type}}">{{$item->username}}</a></td>
                              <td align="center"><a href="{{url()->current().'/edit/'.$item->id.$path_type}}">{{$item->name}}</a></td>
                              <!-- <td align="center">{{$item->group ? $item->group->name :''}}</td> -->

                              <td align="center">
                                <div class="custom-control custom-checkbox text-center">
                                  <input 
                                  type="checkbox" 
                                  data-table="{{$table}}"
                                  data-id="{{$item->id}}"
                                  data-kind="is_status"
                                  class="custom-control-input dev-checkbox"
                                  id="autoSizingCheckKink-{{$item->id}}"
                                  {{$item->is_status==1 ? 'checked' :''}}
                                  >
                                  <label class="custom-control-label" for="autoSizingCheckKink-{{$item->id}}"></label>
                                </div>
                              </td>

                              <td align="center">
                                <div class="d-flex">
                                  <a href="{{url()->current().'/edit/'.$item->id}}" 
                                    class="btn btn-icon waves-effect waves-light btn-info">
                                    <i class="mdi mdi-pencil"></i>
                                  </a>
                                  <a href="#" 
                                    data-url="{{url()->current().'/delete/'.$item->id}}"
                                    data-id="{{$item->id}}"
                                    class="delete-item btn btn-icon waves-effect waves-light btn-danger ml-1">
                                    <i class="mdi mdi-close"></i>
                                  </a>
                                </div>
                              </td>
                           </tr>
                           @endforeach
                        </tbody>
                     </table>
                   </div>
                  </div>
               </div>
               {{$items->links('vendor.pagination.dev-pagination') }}
               
            </div>
         </div>
      </div>
   </div>
</div>
@endsection