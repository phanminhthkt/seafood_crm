<div class="d-inline-flex justify-content-end mt-sm-0 mt-1">
    <form role="form" id="search-form" class="d-flex " method="GET" action="{{url()->current()}}" enctype="multipart/form-data" >
        @if(request()->routeIs('admin.project.index'))
        <div class="dropdown-custom float-left">
            <a 
                class="btn btn-purple bg-gradient-primary text-white dropdown-toggle-custom" 
                href="#" title="Filter"
                >
                    <i class="mdi mdi-filter-outline"></i>
            </a>
            <div class="dropdown-menu-custom p-1">
                <div class="row">
                    <div class="col-sm-6 col-6">
                        <div class="form-group">
                          <label>Sale phụ trách</label>
                          <select class="selectpicker" data-live-search="true"  name="saler" >
                              <option value="" >Chọn saler</option>
                                @foreach($sales as $v)
                                <option 
                                value="{{$v->id}}"
                                {{ @$_GET['saler'] == $v->id ? 'selected' : ''}}
                                >
                                {{$v->name}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                <div class="col-sm-6 col-6">
                    <div class="form-group">
                        <label>Dev phụ trách</label>
                        <select class="selectpicker" data-live-search="true" name="dev" >
                          <option value="" >Chọn dev</option>
                            @foreach($devs as $v)
                            <option 
                            value="{{$v->id}}"
                            {{ @$_GET['dev'] == $v->id ? 'selected' : ''}}
                            >
                            {{$v->name}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6 col-6">
                    <div class="form-group">
                        <label>Trạng thái lập trình</label>
                        <select class="selectpicker" data-live-search="true" name="status_code" >
                        <option value="" >Chọn trạng thái</option>
                          @foreach($status_codes as $v)
                          <option 
                          value="{{$v->id}}"
                          {{ @$_GET['status_code'] == $v->id ? 'selected' : ''}}
                          >
                          {{$v->name}}
                          </option>
                          @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6 col-6">
                    <div class="form-group">
                        <label>Trạng thái dự án</label>
                        <select class="selectpicker" data-live-search="true" name="status_project" >
                        <option value="" >Chọn trạng thái</option>
                          @foreach($status_projects as $v)
                          <option value="{{$v->id}}"
                            {{ @$_GET['status_project'] == $v->id ? 'selected' : ''}}
                        >
                          {{$v->name}}
                          </option>
                          @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6 col-6">
                    <button class="btn btn-purple text-white w-100" type="submit">
                        <i class="fas fa-filter mr-1"></i>Lọc
                    </button>
                </div>
                <div class="col-sm-6 col-6">
                    <button class="btn btn-danger text-white w-100" type="button" onclick="window.location='{{route('admin.project.index')}}'">
                        <i class="mdi mdi-close-circle mr-1"></i>Huỷ lọc
                    </button>
                </div>
              </div>
                
            </div>
        </div>    
        @endif
        @if(isset($_GET['type']))
        <input type="hidden"  name="type" value='{{$_GET["type"]}}'>
        @endif
        <div  class="form-inline form-search d-inline-block align-middle ml-1">
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
    <a 
    class="btn btn-secondary bg-gradient-primary text-white  ml-1 {{$form->ajaxform}}"
    data-title="Tạo {{$title}}" 
    data-url="{{url()->current().'/add'.$path_type}}" 
    title="Thêm mới"
    >
        <i class="mdi mdi-plus-circle"></i>
    </a>
    <a 
        class="btn  btn-danger bg-gradient-danger text-white ml-1" 
        href="#" id="delete-all" 
        data-url="{{url()->current().'/delete-multiple'.$path_type}}" 
        title="Xóa tất cả">
        <i class="far fa-trash-alt "></i>
    </a>
</div>