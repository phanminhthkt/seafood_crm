@extends('backend.layouts.index')
@section('content')
<!-- start page title -->
<div class="row">
   <div class="col-12">
      <div class="page-title-box">
         <div class="page-title-left">
            <ol class="breadcrumb m-0">
               <li class="breadcrumb-item"><a href="javascript: void(0);"><i class="remixicon-home-8-line"></i> Danh mục</a></li>
               <li class="breadcrumb-item active">Danh sách</li>
            </ol>
         </div>
      </div>
   </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card-footer text-sm sticky-top py-2 mb-2">
            <a class="btn btn-purple bg-gradient-primary text-white" href="" title="Thêm mới"><i class="mdi mdi-plus-circle mr-2"></i>Thêm mới</a>
            <a class="btn btn-danger bg-gradient-danger text-white" id="delete-all" data-url="" title="Xóa tất cả"><i class="far fa-trash-alt mr-2"></i>Xóa tất cả</a>

            <div class="form-inline form-search d-inline-block align-middle ml-3">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar text-sm" type="search" id="keyword" placeholder="Tìm kiếm" aria-label="Tìm kiếm" value="" >
                    <div class="input-group-append bg-primary rounded-right">
                        <button class="btn btn-purple text-white" type="button">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>
<!-- end page title --> 
<div class="row">
   <div class="col-12">
      <div class="card">
        <div class="card-header bg-purple py-2 text-white">
            <h5 class="card-title mb-0 text-white">Danh sách</h5>
        </div>

         <div class="card-body">
            <div id="basic-datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                
               <!-- <div class="row">
                  <div class="col-sm-12 col-md-6">
                     <div class="dataTables_length" id="basic-datatable_length">
                        <label>
                           Show 
                           <select name="basic-datatable_length" aria-controls="basic-datatable" class="custom-select custom-select-sm form-control form-control-sm">
                              <option value="10">10</option>
                              <option value="25">25</option>
                              <option value="50">50</option>
                              <option value="100">100</option>
                           </select>
                           entries
                        </label>
                     </div>
                  </div>
                  <div class="col-sm-12 col-md-6">
                     <div id="basic-datatable_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="basic-datatable"></label></div>
                  </div>
               </div> -->
               <div class="row">
                  <div class="col-sm-12">
                     <table id="basic-datatable" class="table table-striped dt-responsive nowrap dataTable no-footer dtr-inline" role="grid" aria-describedby="basic-datatable_info" >
                        <thead>
                           <tr role="row">
                              <th width="1%">
                                  <div class="custom-control custom-checkbox text-center">
                                    <input type="checkbox" class="custom-control-input" id="autoSizingCheck">
                                    <label class="custom-control-label" for="autoSizingCheck"></label>
                                  </div>
                              </th>
                              <th width="5%" class="text-center sorting_asc" tabindex="0" aria-controls="basic-datatable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Thứ tự</th>
                             
                              <th class="text-center sorting" tabindex="0" aria-controls="basic-datatable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" width="30%">Tiêu đề
                              </th>
                              <th width="15%" class="text-center sorting" tabindex="0" aria-controls="basic-datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending">Ngày tạo
                              </th>
                              <th width="7%" class="text-center sorting" tabindex="0" aria-controls="basic-datatable" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending">Trạng thái</th>
                              <th width="10%" class="text-center sorting" tabindex="0" aria-controls="basic-datatable" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending">Hành động</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr role="row" class="even">
                              <td class="sorting_1" tabindex="0">
                                <div class="custom-control custom-checkbox text-center">
                                  <input type="checkbox" class="custom-control-input" id="autoSizingCheck">
                                  <label class="custom-control-label" for="autoSizingCheck"></label>
                                </div>
                              </td>
                              <td align="center">
                                <input type="text" name="priority" class="form-control input-mini input-priority" value="1" data-ajax="act=update_priority|table=categories|id=11|col=priority">
                              </td>
                              <td align="left"><a href="">Sallie Gulgowski</a></td>
                              <td align="center">2018-10-22 04:58:39</td>
                              <td align="center">
                                <a href="" class="btn btn-lg waves-effect waves-light text-primary">
                                  <i class="mdi mdi-check-bold"></i>
                                </a>
                              </td>
                              <td align="center">
                                <a href="" class="btn btn-icon waves-effect waves-light btn-purple">
                                  <i class="fas fa-edit"></i>
                                </a>
                                <a href="" class="btn btn-icon waves-effect waves-light btn-danger">
                                  <i class="fas fa-times"></i>
                                </a>
                              </td>
                           </tr>
                           <tr role="row" class="even">
                              <td class="sorting_1" tabindex="0">
                                <div class="custom-control custom-checkbox text-center">
                                  <input type="checkbox" class="custom-control-input" id="autoSizingCheck">
                                  <label class="custom-control-label" for="autoSizingCheck"></label>
                                </div>
                              </td>
                              <td align="center">
                                <input type="text" name="priority" class="form-control input-mini input-priority" value="1" data-ajax="act=update_priority|table=categories|id=11|col=priority">
                              </td>
                              <td align="left"><a href="">-- Sallie Gulgowski</a></td>
                              <td align="center">2018-10-22 04:58:39</td>
                              <td align="center">
                                <a href="" class="btn   btn-lg waves-effect waves-light text-primary">
                                  <i class="mdi mdi-check-bold"></i>
                                </a>
                              </td>
                              <td align="center">
                                <a href="" class="btn btn-icon waves-effect waves-light btn-purple">
                                  <i class="fas fa-edit"></i>
                                </a>
                                <a href="" class="btn btn-icon waves-effect waves-light btn-danger">
                                  <i class="fas fa-times"></i>
                                </a>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-12 col-md-7">
                     <div class="dataTables_paginate paging_simple_numbers text-center" id="basic-datatable_paginate">
                        <ul class="pagination pagination-rounded">
                           <li class="paginate_button page-item previous disabled" id="basic-datatable_previous"><a href="#" aria-controls="basic-datatable" data-dt-idx="0" tabindex="0" class="page-link"><i class="mdi mdi-chevron-left"></i></a></li>
                           <li class="paginate_button page-item active"><a href="#" aria-controls="basic-datatable" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                           <li class="paginate_button page-item "><a href="#" aria-controls="basic-datatable" data-dt-idx="2" tabindex="0" class="page-link">2</a></li>
                           <li class="paginate_button page-item "><a href="#" aria-controls="basic-datatable" data-dt-idx="3" tabindex="0" class="page-link">3</a></li>
                           <li class="paginate_button page-item "><a href="#" aria-controls="basic-datatable" data-dt-idx="4" tabindex="0" class="page-link">4</a></li>
                           <li class="paginate_button page-item "><a href="#" aria-controls="basic-datatable" data-dt-idx="5" tabindex="0" class="page-link">5</a></li>
                           <li class="paginate_button page-item "><a href="#" aria-controls="basic-datatable" data-dt-idx="6" tabindex="0" class="page-link">6</a></li>
                           <li class="paginate_button page-item next" id="basic-datatable_next"><a href="#" aria-controls="basic-datatable" data-dt-idx="7" tabindex="0" class="page-link"><i class="mdi mdi-chevron-right"></i></a></li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection