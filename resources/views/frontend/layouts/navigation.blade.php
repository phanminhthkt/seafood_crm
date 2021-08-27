    <div class="slimscroll-menu">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <ul class="metismenu" id="side-menu">
                <li>
                    <a href="{{Route('admin.index')}}" class="waves-effect">
                        <i class="remixicon-home-8-line"></i>
                        <span> Trang điều khiển </span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.group_member.*') ? 'mm-active' : '' }}">
                    <a href="#" class="waves-effect">
                        <i class="remixicon-vip-crown-2-line"></i>
                        <span>Quản lý thành viên</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li>
                            <a href="{{Route('admin.group_member.index')}}"><i class="remixicon-movie-line"></i>Nhóm thành viên</a>
                        </li>
                        <li>
                            <a href="{{Route('admin.member.index')}}"> <i class="remixicon-movie-line"></i>Thành viên</a>
                        </li>
                    </ul>
                </li>
                <li class="menu-title">Quản lý dự án</li>
                <li >
                    <a href="{{Route('admin.project.index')}}" class="waves-effect">
                        <i class="remixicon-book-mark-line"></i>
                        <span>Quản lý dự án</span>
                    </a>
                </li>
                
                <li class="{{ request()->routeIs('admin.status.*') ? 'mm-active' : '' }}">
                    <a href="javascript: void(0)" class="waves-effect">
                        <i class="fas fa-tasks"></i>
                        <span>Quản lý trạng thái</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li>
                            <a 

                            href="{{Route('admin.group_status.index')}}">
                            <i class="remixicon-movie-line"></i>Nhóm trạng thái</a>
                        </li>
                        <li>
                            <a href="{{Route('admin.status.index')}}"> <i class="remixicon-movie-line"></i>Trạng thái</a>
                        </li>
                    </ul>
                </li>

                <li class="menu-title">Quản lý người dùng</li>
                <li >
                    <a href="{{Route('admin.user.index')}}" class="waves-effect">
                        <i class="fe-users"></i>
                        <span>Quản lý người dùng</span>
                    </a>
                </li>
                
                <!-- <li class="menu-title">Quản lý trang</li>
                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="remixicon-stack-line"></i>
                        <span>Quản lý sản phẩm</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li>
                            <a href="extras-profile.html"><i class="remixicon-movie-line"></i> Danh mục</a>
                        </li>
                        <li>
                            <a href="extras-timeline.html"> <i class="remixicon-movie-line"></i>Sản phẩm</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="remixicon-newspaper-line"></i>
                        <span>Quản lý bài viết</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li>
                            <a href="extras-profile.html"><i class="remixicon-movie-line"></i> Tin tức</a>
                        </li>
                        <li>
                            <a href="extras-timeline.html"> <i class="remixicon-movie-line"></i>Dịch vụ</a>
                        </li>
                        <li>
                            <a href="extras-timeline.html"> <i class="remixicon-movie-line"></i>Khuyến mãi</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="remixicon-article-line"></i>
                        <span>Quản lý trang tĩnh </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                    	<li>
                            <a href="extras-timeline.html"> <i class="remixicon-movie-line"></i>Slogan</a>
                        </li>
                        <li>
                            <a href="extras-profile.html"><i class="remixicon-movie-line"></i> Giới thiệu</a>
                        </li>
                        
                    </ul>
                </li>
                <li class="menu-title mt-2">Quản lý thuộc tính</li>
                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="remixicon-price-tag-3-line"></i>
                        <span>Quản lý tags </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                    	<li>
                            <a href="extras-timeline.html"> <i class="remixicon-movie-line"></i>Tags sản phẩm</a>
                        </li>
                        <li>
                            <a href="extras-profile.html"><i class="remixicon-movie-line"></i> Tags tin tức</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="remixicon-book-mark-line"></i>
                        <span>Quản lý thương hiệu </span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="remixicon-drop-line"></i>
                        <span>Quản lý thuộc tính lọc </span>
                    </a>
                </li>
                <li class="menu-title mt-2">Quản lý Photo - Video</li>
                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="remixicon-radio-2-line"></i>
                        <span>Quản lý Photo - Video</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                    	<li>
                            <a href="extras-timeline.html"> <i class="remixicon-movie-line"></i>Logo</a>
                        </li>
                        <li>
                            <a href="extras-profile.html"><i class="remixicon-movie-line"></i> Banner</a>
                        </li>
                        <li>
                            <a href="extras-profile.html"><i class="remixicon-movie-line"></i> Favicon</a>
                        </li>
                        <li>
                            <a href="extras-profile.html"><i class="remixicon-movie-line"></i> Slider</a>
                        </li>
                        <li>
                            <a href="extras-profile.html"><i class="remixicon-movie-line"></i> Video</a>
                        </li>
                    </ul>
                </li> -->
                <li class="menu-title">Quản lý cấu hình</li>
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
    };
</script>