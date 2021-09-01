<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            \App\Repositories\Status\StatusRepositoryInterface::class,
            \App\Repositories\Status\StatusRepository::class,
        );
        $this->app->singleton(
            \App\Repositories\GroupStatus\GroupStatusRepositoryInterface::class,
            \App\Repositories\GroupStatus\GroupStatusRepository::class,
        );

        $this->app->singleton(
            \App\Repositories\User\UserRepositoryInterface::class,
            \App\Repositories\User\UserRepository::class,
        );
        
        $this->app->singleton(
            \App\Repositories\Role\RoleRepositoryInterface::class,
            \App\Repositories\Role\RoleRepository::class,
        );
        $this->app->singleton(
            \App\Repositories\Permission\PermissionRepositoryInterface::class,
            \App\Repositories\Permission\PermissionRepository::class,
        );
        $this->app->singleton(
            \App\Repositories\Unit\UnitRepositoryInterface::class,
            \App\Repositories\Unit\UnitRepository::class,
        );
        $this->app->singleton(
            \App\Repositories\GroupAttribute\GroupAttributeRepositoryInterface::class,
            \App\Repositories\GroupAttribute\GroupAttributeRepository::class,
        );
        $this->app->singleton(
            \App\Repositories\Attribute\AttributeRepositoryInterface::class,
            \App\Repositories\Attribute\AttributeRepository::class,
        );
        $this->app->singleton(
            \App\Repositories\Category\CategoryRepositoryInterface::class,
            \App\Repositories\Category\CategoryRepository::class,
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
