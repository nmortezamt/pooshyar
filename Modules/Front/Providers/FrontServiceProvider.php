<?php

namespace Modules\Front\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Modules\Category\Models\Category;
use Modules\Setting\Models\GeneralSettings;

class FrontServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'Front';

    /**
     * Boot the application events.
     */
    public function boot(): void
    {
        $this->loadViewsFrom(module_path($this->moduleName, 'Resources/views'),'Front');
        $this->loadRoutesFrom(module_path($this->moduleName,'Routes/front_routes.php'));

        View::composer(['Front::layouts.header', 'Front::layouts.footer'], function ($view) {
            $generalSetting = resolve(GeneralSettings::class);
            if (auth()->check()) {
//                $cards = Card::where('user_id', auth()->id())->get();
//                $view->with('userCards', $cards);
            }
            $view->with('generalSetting', $generalSetting);
        });
    }

    /**
     * Register the service provider.
     */
    public function register(): void
    {
    }
}
