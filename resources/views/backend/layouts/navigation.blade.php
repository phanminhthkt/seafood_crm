<div class="slimscroll-menu">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <ul class="metismenu" id="side-menu">
                <li>
                    <a href="{{Route('admin.index')}}" class="waves-effect">
                        <i class="remixicon-dashboard-line"></i>
                        <span> Tổng quan </span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="remixicon-pie-chart-line"></i>
                        <span>Báo cáo</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level mm-collapse" aria-expanded="false">
                        <li>
                            <a href="extras-profile.html">- Báo cáo doanh thu</a>
                        </li>
                    </ul>
                </li>
                <li class="{{ $activeMenu->wms == true ? 'mm-active' : '' }}">
                    <a href="javascript: void(0);" class="waves-effect {{ $activeMenu->wms == true ? 'active' : '' }}">
                        <i class="remixicon-building-4-line"></i>
                        <span>Kho</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level mm-collapse {{ $activeMenu->wms == true ? 'mm-show' : '' }}" aria-expanded="false">
                        <li>
                            <a href="{{Route('admin.wms.index')}}">- Chi nhánh</a>
                        </li>
                        <li>
                            <a href="{{Route('admin.wms.export.index')}}">- Xuất kho</a>
                        </li>
                        <li>
                            <a href="{{Route('admin.wms.import.index')}}"> - Nhập kho</a>
                        </li>
                    </ul>
                </li>
                
                <li class="{{ $activeMenu->product == true ? 'mm-active' : '' }}">
                    <a href="javascript: void(0);" class="waves-effect {{ $activeMenu->product == true ? 'active' : '' }}">
                        <i class="remixicon-stack-line"></i>
                        <span>Hàng hoá</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level mm-collapse 
                    {{ $activeMenu->product == true ? 'mm-show' : '' }}" 

                    aria-expanded="false">
                        <li>
                            <a href="{{Route('admin.category.index')}}">- Danh mục</a>
                        </li>
                        <li>
                            <a href="{{Route('admin.product.index')}}">- Sản phẩm</a>
                        </li>
                        <li>
                            <a href="{{Route('admin.group_attribute.index')}}">- Nhóm thuộc tính</a>
                        </li>
                        <li>
                            <a href="{{Route('admin.attribute.index')}}">- Thuộc tính</a>
                        </li>
                        <li>
                            <a href="{{Route('admin.unit.index')}}">- Đơn vị</a>
                        </li>
                    </ul>
                </li>

                @if(Auth::user()->can('view-status') || Auth::user()->can('view-group_status'))

                <li class="{{ $activeMenu->status == true ? 'mm-active' : '' }}">
                    <a href="javascript: void(0)" class="waves-effect {{ $activeMenu->status == true ? 'active' : '' }}">
                        <i class="remixicon-contrast-drop-2-line"></i>
                        <span>Trạng thái</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul 
                    class="nav-second-level mm-collapse {{ $activeMenu->status == true ? 'mm-show' : '' }}
                    " aria-expanded="false">
                        @can('view-group_status')
                        <li>
                            <a 

                            href="{{Route('admin.group_status.index')}}">
                            - Nhóm trạng thái</a>
                        </li>
                        @endcan
                        @can('view-status')
                        <li>
                            <a href="{{Route('admin.status.index')}}"> - Trạng thái</a>
                        </li>
                        @endcan
                    </ul>
                </li>               
                @endif
                
                @if(Auth::user()->can('view-permission') || Auth::user()->can('view-role'))

                <li 
                class="{{ $activeMenu->role_permission == true ? 'mm-active' : '' }}">
                    <a href="#" class="waves-effect">
                        <i class="remixicon-vip-crown-2-line"></i>
                        <span>Phân quyền</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul  class="nav-second-level mm-collapse {{ 
                $activeMenu->role_permission == true ? 'mm-show' : '' }}"  aria-expanded="false">
                        @can('view-role')
                        <li >
                            <a href="{{Route('admin.role.index')}}"> - Vai trò</a>
                        </li>
                        @endcan
                        @can('view-permission')
                        <li> 
                            <a href="{{Route('admin.permission.index')}}"> - Phân quyền</a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endif
                <li 
                class="{{ $activeMenu->customer == true ? 'mm-active' : '' }}">
                    <a href="{{Route('admin.customer.index')}}" class="waves-effect">
                        <i class="remixicon-user-smile-line"></i>
                        <span>Khách hàng</span>
                    </a>
                </li>
                @can('view-user')
                <li 
                class="{{  $activeMenu->user == true ? 'mm-active' : '' }}">
                    <a href="{{Route('admin.user.index')}}" class="waves-effect">
                        <i class="remixicon-admin-line"></i>
                        <span>Quản trị viên</span>
                    </a>
                </li>
                @endcan
                
                <li class="menu-title">cấu hình</li>
                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="fe-settings"></i>
                        <span> Cấu hình website</span>
                    </a>
                </li>
            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<script type="text/javascript">
    var URL = {
        'type': '<?=isset($_GET['type']) ? $_GET['type'] :''?>',
        'current': '<?=url()->current()?>',
        'base_url': '<?=URL::to('/');?>',
    };
</script>