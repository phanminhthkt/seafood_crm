<?php

namespace App\Providers;

use App\Models\Permission;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Member;
use Auth;
use Illuminate\Support\Facades\Schema;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Member' => 'App\Policies\MemberPolicy',
        // 'App\Models\Project' => 'App\Policies\ProjectPolicy',
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function ($user, $ability) {//Check Full permission
            if($user->isSuperAdmin()){
                return true;
            }
        });
        if (Schema::hasTable('Permissions')) {

            foreach(Permission::all() as $permission){//Check per permission
                Gate::define($permission->slug,function($user) use ($permission){
                    return $user->hasPermission($permission);
                });
                
            }
            // }
            foreach(optional(Permission::all()) as $permission){
                Gate::define('member-'.$permission->slug,function($user) use ($permission){
                    return $user->group->hasPermission($permission);
                });
            }
        }
        
    }
}
