<?php

namespace Modules\Banner\Providers;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Modules\Banner\Database\Seeders\BannerDatabaseSeeder;

class BannerServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'Banner';


    /**
     * Boot the application events.
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));
        $this->loadViewsFrom(module_path($this->moduleName, 'Resources/views'),'Banner');
        DatabaseSeeder::$seeders[8] = BannerDatabaseSeeder::class;
    }

    /**
     * Register the service provider.
     */
    public function register(): void
    {
    }
}
