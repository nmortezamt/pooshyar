<?php

namespace Modules\Product\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Modules\Product\Brand\Providers\BrandServiceProvider;
use Modules\Product\Color\Providers\ColorServiceProvider;
use Modules\Product\Gallery\Providers\GalleryServiceProvider;
use Modules\Product\Product\Providers\ProductServiceProvider;
use Modules\Product\Size\Providers\SizeServiceProvider;

class BaseProductServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'Product';

    /**
     * Boot the application events.
     */
    public function boot(): void
    {
    }

    /**
     * Register the service provider.
     */
    public function register(): void
    {
        $this->app->register(ProductServiceProvider::class);
        $this->app->register(BrandServiceProvider::class);
        $this->app->register(ColorServiceProvider::class);
        $this->app->register(SizeServiceProvider::class);
        $this->app->register(GalleryServiceProvider::class);
    }

}
