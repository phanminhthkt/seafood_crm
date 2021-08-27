<template>
	<header class="header">
		<div class="navbar-custom">
		    <ul class="list-unstyled topnav-menu float-right mb-0">
		        <li class="d-none d-sm-block">
		            <form class="app-search">
		                <div class="app-search-box">
		                    <div class="input-group">
		                        <input type="text" class="form-control" placeholder="Search...">
		                        <div class="input-group-append">
		                            <button class="btn" type="submit">
		                                <i class="fe-search"></i>
		                            </button>
		                        </div>
		                    </div>
		                </div>
		            </form>
		        </li>
		        <li class="dropdown notification-list">
		            <a class="nav-link dropdown-toggle  waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
		                <i class="fe-bell noti-icon"></i>
		                <span class="badge badge-danger rounded-circle noti-icon-badge">4</span>
		            </a>
		            <div class="dropdown-menu dropdown-menu-right dropdown-lg">

		                <!-- item-->
		                <div class="dropdown-item noti-title">
		                    <h5 class="m-0">
		                        <span class="float-right">
		                            <a href="" class="text-dark">
		                                <small>Clear All</small>
		                            </a>
		                        </span>Notification
		                    </h5>
		                </div>

		                <div class="slimscroll noti-scroll">

		                    <!-- item-->
		                    <a href="javascript:void(0);" class="dropdown-item notify-item active">
		                        <div class="notify-icon bg-soft-primary text-primary">
		                            <i class="mdi mdi-comment-account-outline"></i>
		                        </div>
		                        <p class="notify-details">Doug Dukes commented on Admin Dashboard
		                            <small class="text-muted">1 min ago</small>
		                        </p>
		                    </a>
		                    <!-- item-->
		                    <a href="javascript:void(0);" class="dropdown-item notify-item">
		                        <div class="notify-icon bg-secondary">
		                            <i class="mdi mdi-heart"></i>
		                        </div>
		                        <p class="notify-details">Carlos Crouch liked
		                            <b>Admin</b>
		                            <small class="text-muted">13 days ago</small>
		                        </p>
		                    </a>
		                </div>

		                <!-- All-->
		                <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
		                    View all
		                    <i class="fi-arrow-right"></i>
		                </a>

		            </div>
		        </li>
		        <li class="dropdown notification-list">
		            <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
		                <img v-bind:src="$root.baseUrl+'/frontend/images/users/avatar-1.jpg'" alt="user-image" class="rounded-circle">
		                <span class="pro-user-name ml-1">
		                	{{$root.user.username}}
		                    <i class="mdi mdi-chevron-down"></i> 
		                </span>
		            </a>
		            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
		                <!-- item-->
		                <!-- <router-link to="/project" class="dropdown-item notify-item">
		                    <i class="remixicon-account-circle-line"></i>
		                    <span>Thông tin cá nhân</span>
		                </router-link>	 -->
		                <a href="/logout" class="dropdown-item notify-item">
		                    <i class="remixicon-logout-box-line"></i>
		                    <span>Đăng xuất</span>
		                </a>

		            </div>
		        </li>
		    </ul>
		    <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
		        <li >
		            <button class="button-menu-mobile waves-effect waves-light">
		                <i class="fe-menu"></i>
		            </button>
		        </li>

		        <li class="dropdown d-none d-lg-block">
		            <a class="nav-link dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false" >
		                Quản lí dự án
		                <i class="mdi mdi-chevron-down"></i> 
		            </a>
		            <div class="dropdown-menu"
		            	>
		                <!-- item-->
		                <router-link 
		                	v-if="$root.user.role === 'nhom-kinh-doanh'"
		                	:to="{ name: 'project.add'}"  class="dropdown-item">	
		                    <i class="fe-briefcase mr-1"></i>
		                    <span>Khởi tạo dự án</span>
		                </router-link>

		                <!-- item-->
		                <router-link 
		                	:to="{ name: 'project.index'}" class="dropdown-item">
		                    <i class="fe-list mr-1"></i>
		                    <span>Danh sách dự án</span>
		                </router-link>
		                <!-- item-->
		               <!--  <a href="javascript:void(0);" class="dropdown-item">
		                    <i class="fe-bar-chart-line- mr-1"></i>
		                    <span>Xem thống kê</span>
		                </a> -->
		            </div>
		        </li>
		    </ul>
		</div>
		<div class="left-side-menu">
            <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 115px;"><div class="slimscroll-menu" style="overflow: hidden; width: auto; height: 115px;">
        <!--- Sidemenu -->
        <div id="sidebar-menu" class="mm-active">
            <ul class="metismenu mm-show" id="side-menu">
                <li>
                    <a href="http://127.0.0.1:8000/" class="waves-effect active">
                        <i class="remixicon-home-8-line"></i>
                        <span> Trang điều khiển </span>
                    </a>
                </li>
                <li class="">
                    <a href="#" class="waves-effect">
                        <i class="remixicon-book-mark-line"></i>
                        <span>Quản lý dự án</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level mm-collapse" aria-expanded="false">
                        <li>
                        	<router-link 
		                	v-if="$root.user.role === 'nhom-kinh-doanh'"
		                	:to="{ name: 'project.add'}" >	
		                    <i class="remixicon-movie-line"></i>
		                    <span>Khởi tạo dự án</span>
		                	</router-link>
                        </li>
                        <li>
                        	<router-link 
		                	:to="{ name: 'project.index'}" >
			                    <i class="remixicon-movie-line"></i>
			                    <span>Danh sách dự án</span>
			                </router-link>
                        </li>
                    </ul>
                </li>
            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <div class="slimScrollBar" style="background: rgb(158, 165, 171); width: 8px; position: absolute; top: -466px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 30px;">
	</div>
	<div class="slimScrollRail" style="width: 8px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div>
	</div>
    <!-- Sidebar -left -->

</div>
	</header>
</template>

<script>
    export default {
    	// props:['user'],
        data() {
            return{
                // userObject:JSON.parse(this.$props.user)
            }
        },
    }
</script>

<style lang="scss" scoped>
	
</style>