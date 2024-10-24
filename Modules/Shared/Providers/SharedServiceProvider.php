<?php

namespace Modules\Shared\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class SharedServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'Shared';


    /**
     * Boot the application events.
     */
    public function boot(): void
    {
//        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/migrations'));
    }


    public function register(): void
    {
    }
}
