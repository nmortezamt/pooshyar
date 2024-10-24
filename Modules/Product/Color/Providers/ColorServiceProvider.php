<?php

namespace Modules\Product\Color\Providers;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Modules\Product\Color\Database\Seeders\ColorDatabaseSeeder;

class ColorServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'Product';

    public function boot(): void
    {
        $this->loadMigrationsFrom(module_path($this->moduleName,'Color/Database/Migrations'));
        DatabaseSeeder::$seeders[4] = ColorDatabaseSeeder::class;
    }

}
