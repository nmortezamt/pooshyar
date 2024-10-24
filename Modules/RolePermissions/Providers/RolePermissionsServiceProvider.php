<?php

namespace Modules\RolePermissions\Providers;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Modules\RolePermissions\Database\Seeders\RolePermissionsDatabaseSeeder;

class RolePermissionsServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'RolePermissions';


    /**
     * Boot the application events.
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));
        DatabaseSeeder::$seeders[0] = RolePermissionsDatabaseSeeder::class;
    }

    /**
     * Register the service provider.
     */
    public function register(): void
    {
    }

}
