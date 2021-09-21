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
        $this->app->singleton(
            \App\Repositories\Product\ProductRepositoryInterface::class,
            \App\Repositories\Product\ProductRepository::class,
        );
        $this->app->singleton(
            \App\Repositories\Wms\WmsRepositoryInterface::class,
            \App\Repositories\Wms\WmsRepository::class,
        );
        $this->app->singleton(
            \App\Repositories\Wms\WmsImportRepositoryInterface::class,
            \App\Repositories\Wms\WmsImportRepository::class,
        );
        $this->app->singleton(
            \App\Repositories\Wms\WmsExportRepositoryInterface::class,
            \App\Repositories\Wms\WmsExportRepository::class,
        );
        $this->app->singleton(
            \App\Repositories\Customer\CustomerRepositoryInterface::class,
            \App\Repositories\Customer\CustomerRepository::class,
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
