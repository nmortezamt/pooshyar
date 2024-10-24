<?php

namespace Modules\Auth\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'Auth';

    /**
     * Boot the application events.
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));
        $this->loadViewsFrom(module_path($this->moduleName, 'Resources/views'),'Auth');
        $this->loadRoutesFrom(module_path($this->moduleName,'Routes/auth_routes.php'));
    }


    public function register(): void
    {
    }
}
