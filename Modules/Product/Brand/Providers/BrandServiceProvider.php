<?php

namespace Modules\Product\Brand\Providers;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Support\ServiceProvider;
use Modules\Product\Brand\Database\Seeders\BrandDatabaseSeeder;

class BrandServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'Product';

    public function boot(): void
    {
        $this->loadMigrationsFrom(module_path($this->moduleName,'Brand/Database/Migrations'));
        DatabaseSeeder::$seeders[3] = BrandDatabaseSeeder::class;
    }

}
