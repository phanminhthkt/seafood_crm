<div class="d-inline-flex justify-content-end mt-sm-0 mt-1">
    <form role="form" class="search-form" class="d-flex " method="GET" action="{{url()->current()}}" enctype="multipart/form-data" >
        @if(request()->routeIs('admin.wms.import.index'))
        <div class="dropdown-custom float-left">
            <!-- <a 
                class="btn btn-purple bg-gradient-primary text-white dropdown-toggle-custom" 
                href="#" title="Filter"
                >
                    <i class="mdi mdi-filter-outline"></i>
            </a> -->
            
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