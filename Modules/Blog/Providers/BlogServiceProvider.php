<?php

namespace Modules\Blog\Providers;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Modules\Blog\Database\Seeders\BlogDatabaseSeeder;

class BlogServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'Blog';


    /**
     * Boot the application events.
     */
    public function boot(): void
    {
        $this->loadViewsFrom(module_path($this->moduleName, 'Resources/views'),'Blog');
        $this->loadRoutesFrom(module_path($this->moduleName,'Routes/blog_routes.php'));
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));
        DatabaseSeeder::$seeders[7] = BlogDatabaseSeeder::class;
    }


    public function register(): void
    {
    }
}
