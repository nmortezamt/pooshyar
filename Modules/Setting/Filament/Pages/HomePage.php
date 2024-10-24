<?php

namespace Modules\Setting\Filament\Pages;

use Filament\Forms\Form;
use Filament\Pages\SettingsPage;
use Modules\Setting\Models\HomeSettings;

class HomePage extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $settings = HomeSettings::class;

    public static function getNavigationGroup(): ?string
    {
        return __('resources.settings');
    }

    public static function getNavigationLabel(): string
    {
        return __('resources.home page setting');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // ...
            ]);
    }
}
