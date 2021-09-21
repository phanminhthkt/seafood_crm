<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Auth;
use Illuminate\Http\Request;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Request $request)
    {   
        $activeMenu['report'] = $request->is('admin/report-revenue*') || $request->is('admin/report-product*') ? true : false;
        $activeMenu['wms'] = $request->is('admin/wms*') || $request->is('admin/wms-export*') || $request->is('admin/wms-import*') ? true : false;
        $activeMenu['product'] = $request->is('admin/category*') || $request->is('admin/product*') || $request->is('admin/group_attribute*') ||
                $request->is('admin/unit*') || $request->is('admin/attribute*') ? true : false;
        $activeMenu['status'] = $request->is('admin/status*') || $request->is('admin/group_status*') ? true : false;        
        $activeMenu['role_permission'] = $request->is('admin/role*') || $request->is('admin/permission*') ? true : false;        
        $activeMenu['customer'] = $request->is('admin/customer*') ? true : false;        
        $activeMenu['user'] = $request->is('admin/user*') ? true : false;        
        View::share('activeMenu', (object)$activeMenu);
    }
}
