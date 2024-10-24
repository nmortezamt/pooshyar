<?php

namespace Modules\Category\Providers;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Modules\Category\Database\Seeders\CategoryDatabaseSeeder;

class CategoryServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'Category';

    /**
     * Boot the application events.
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));
        $this->loadViewsFrom(module_path($this->moduleName, 'Resources/views'),'Category');
        $this->loadRoutesFrom(module_path($this->moduleName,'Routes/category_routes.php'));
        DatabaseSeeder::$seeders[2] = CategoryDatabaseSeeder::class;
    }

    /**
     * Register the service provider.
     */
    public function register(): void
    {
    }

}
