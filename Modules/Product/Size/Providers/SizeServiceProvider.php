<?php

namespace Modules\Product\Size\Providers;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Modules\Product\Size\Database\Seeders\SizeDatabaseSeeder;

class SizeServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'Product';

    public function boot(): void
    {
        $this->loadMigrationsFrom(module_path($this->moduleName,'Size/Database/Migrations'));
        DatabaseSeeder::$seeders[5] = SizeDatabaseSeeder::class;
    }

}
