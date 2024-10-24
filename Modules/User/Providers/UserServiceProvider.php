<?php

namespace Modules\User\Providers;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Modules\User\Database\Seeders\UserDatabaseSeeder;

class UserServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'User';

    public function boot(): void
    {
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));
        $this->loadViewsFrom(module_path($this->moduleName, 'Resources/views'),'User');
        $this->loadRoutesFrom(module_path($this->moduleName,'Routes/user_routes.php'));
        DatabaseSeeder::$seeders[1] = UserDatabaseSeeder::class;
    }


    public function register(): void
    {
    }

}
