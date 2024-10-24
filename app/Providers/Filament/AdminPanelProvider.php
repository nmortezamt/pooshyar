<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function moduleDirectory(string $moduleName): string
    {
        return base_path('Modules/'.$moduleName.'/Filament/Resources');
    }

    public function moduleNamespace(string $moduleName): string
    {
        return 'Modules\\'.$moduleName.'\\Filament\\Resources';
    }
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
//            ->login()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->plugins([
                \BezhanSalleh\FilamentShield\FilamentShieldPlugin::make()
            ])
            ->discoverResources(in: $this->moduleDirectory('Category'), for: $this->moduleNamespace('Category'))
            ->discoverResources(in: $this->moduleDirectory('Product/Product'), for: $this->moduleNamespace('Product\\Product'))
            ->discoverResources(in: $this->moduleDirectory('Product/Brand'), for: $this->moduleNamespace('Product\\Brand'))
            ->discoverResources(in: $this->moduleDirectory('Product/Color'), for: $this->moduleNamespace('Product\\Color'))
            ->discoverResources(in: $this->moduleDirectory('Product/Size'), for: $this->moduleNamespace('Product\\Size'))
            ->discoverResources(in: $this->moduleDirectory('Product/Gallery'), for: $this->moduleNamespace('Product\\Gallery'))
            ->discoverResources(in: $this->moduleDirectory('Blog'), for: $this->moduleNamespace('Blog'))
            ->discoverResources(in: $this->moduleDirectory('RolePermissions'), for: $this->moduleNamespace('RolePermissions'))
            ->discoverResources(in: $this->moduleDirectory('User'), for: $this->moduleNamespace('User'))
            ->discoverResources(in: $this->moduleDirectory('Banner'), for: $this->moduleNamespace('Banner'))
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->discoverPages(in: base_path('Modules/Setting/Filament/Pages'), for: 'Modules\\Setting\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
