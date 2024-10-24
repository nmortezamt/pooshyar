<?php

namespace Modules\Setting\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class SettingServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'Setting';

    /**
     * Boot the application events.
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));
    }

    /**
     * Register the service provider.
     */
    public function register(): void
    {
    }
}
