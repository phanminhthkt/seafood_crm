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
            <h4 class="card-title d-inline-block mb-0 py-1">Danh sách {{$title}}
              <span class="text-danger fs-15 ml-1">(Note - HĐ: Hợp đồng,LT: Lập trình)</span>
            </h4>
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
                              <th width="5%" class="text-center">STT</th>
                              <th class="text-center"width="20%">{{$title}}</th>
                              <th width="13%" class="text-center">Tình trạng</th>
                              <th width="15%" class="text-center">Phụ trách</th>
                              <th width="15%" class="text-center">Ngày tạo</th>
                              <th width="9%" class="text-center">Trạng thái</th>
                              <th width="6%" class="text-center">Hành động</th>
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
                              <td align=""><a href="{{url()->current().'/edit/'.$item->id}}">{{$item->name}}</a></td>
                              <td >
                                <div 
                                  class=" @if($item->status_project->first()->id == 4) badge badge-purple
                                  @elseif($item->status_project->first()->id == 5) badge badge-danger
                                  @elseif($item->status_project->first()->id == 6) badge badge-dark
                                  @endif
                                  " 
                                >

                                  LT: {{@$item->status_project->first()->name}}</div>
                                <div class=" @if($item->status_code->first()->id == 1) badge badge-warning
                                  @elseif($item->status_code->first()->id == 2) badge badge-info
                                  @elseif($item->status_code->first()->id == 3) badge badge-primary
                                  @endif
                                  " >HĐ: {{@$item->status_code->first()->name}}</div>
                              </td>
                              
                              <td align=""><a>
                                  <div>Dev:   &nbsp;{{@$item->dev->first()->name}}</div>
                                  <div>Saler: {{@$item->saler->first()->name}}</div>  
                              </a></td>
                              
                              <td align="center">{{$item->created_at}}</td>

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
                                    class="delete-item btn btn-icon waves-effect waves-light btn-danger ml-1" 
                                    >
                                    <i class="mdi mdi-close"></i>
                                  </a>
                                  <a href="#" 
                                    data-url="{{url()->current().'/send-mail/'.$item->id}}"
                                    data-id="{{$item->id}}"
                                    class="send-mail-item send-mail-item-{{$item->id}} btn btn-icon waves-effect waves-light btn-secondary ml-1" 
                                    >
                                    <i class="mdi mdi-send-circle"></i>
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