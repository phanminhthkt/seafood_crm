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
                            <a href="extras-profile.html">- Báo cáo năm</a>
                        </li>
                        <li>
                            <a href="extras-timeline.html">- Báo cáo tháng</a>
                        </li>
                        <li>
                            <a href="extras-timeline.html">- Báo cáo ngày</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="remixicon-building-4-line"></i>
                        <span>Kho</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level mm-collapse" aria-expanded="false">
                        <li>
                            <a href="extras-profile.html">- Chi nhánh</a>
                        </li>
                        <li>
                            <a href="extras-profile.html">- Xuất kho</a>
                        </li>
                        <li>
                            <a href="extras-timeline.html"> - Nhập kho</a>
                        </li>
                        <li>
                            <a href="extras-timeline.html"> - Kiểm kho</a>
                        </li>
                    </ul>
                </li>
                
                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="remixicon-stack-line"></i>
                        <span>Hàng hoá</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level mm-collapse" aria-expanded="false">
                        <li>
                            <a href="{{Route('admin.category.index')}}">- Danh mục</a>
                        </li>
                        <li>
                            <a href="extras-timeline.html">- Sản phẩm</a>
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
                <li class="{{ request()->routeIs('admin.status.*') || request()->routeIs('admin.group_status.*') ? 'mm-active' : '' }}">
                    <a href="javascript: void(0)" class="waves-effect">
                        <i class="remixicon-contrast-drop-2-line"></i>
                        <span>Trạng thái</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul 
                    class="nav-second-level mm-collapse {{ request()->routeIs('admin.status.*') || request()->routeIs('admin.group_status.*') ? 'mm-show' : '' }}
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
                class="{{ request()->routeIs('admin.role.*') || request()->routeIs('admin.permission.*') ? 'mm-active' : '' }}">
                    <a href="#" class="waves-effect">
                        <i class="remixicon-vip-crown-2-line"></i>
                        <span>Phân quyền</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul  class="nav-second-level mm-collapse {{ 
                request()->routeIs('admin.role.*') || request()->routeIs('admin.permission.*') ? 'mm-show' : '' }}"  aria-expanded="false">
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

                @can('view-user')
                <li 
                class="{{ request()->routeIs('admin.user.*') ? 'mm-active' : '' }}">
                    <a href="{{Route('admin.user.index')}}" class="waves-effect">
                        <i class="remixicon-group-line"></i>
                        <span>Người dùng</span>
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
    };
</script>