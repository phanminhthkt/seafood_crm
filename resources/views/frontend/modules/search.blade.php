<div class="d-inline-flex justify-content-end">
    <form role="form" method="GET" action="{{url()->current()}}" enctype="multipart/form-data" >
        @if(isset($_GET['type']))
        <input type="hidden"  name="type" value='{{$_GET["type"]}}'>
        @endif
        <div class="form-inline form-search d-inline-block align-middle ml-3">
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
    class="btn  btn-secondary bg-gradient-primary text-white  ml-1" 
    href="{{url()->current().'/add'.$path_type}}" title="Thêm mới">
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