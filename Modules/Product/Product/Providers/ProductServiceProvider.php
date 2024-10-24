<?php

namespace Modules\Product\Product\Providers;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Modules\Product\Product\Database\Seeders\ProductDatabaseSeeder;

class ProductServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'Product';

    public function boot(): void
    {
        $this->loadMigrationsFrom(module_path($this->moduleName,'Product/Database/Migrations'));
        $this->loadViewsFrom(module_path($this->moduleName, 'Product/Resources/views'),'Product');
        $this->loadRoutesFrom(module_path($this->moduleName,'Product/Routes/product_routes.php'));
        DatabaseSeeder::$seeders[6] = ProductDatabaseSeeder::class;
    }

}
