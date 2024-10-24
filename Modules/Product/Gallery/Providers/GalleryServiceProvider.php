<?php

namespace Modules\Product\Gallery\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class GalleryServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'Product';

    public function boot(): void
    {
        $this->loadMigrationsFrom(module_path($this->moduleName,'Gallery/Database/Migrations'));
    }

}
