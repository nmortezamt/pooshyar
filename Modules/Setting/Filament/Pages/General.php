<?php

namespace Modules\Setting\Filament\Pages;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;
use Illuminate\Support\Str;
use Modules\Category\Models\Category;
use Modules\Setting\Models\GeneralSettings;

class General extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $settings = GeneralSettings::class;

    public static function getNavigationGroup(): ?string
    {
        return __('resources.settings');
    }

    public static function getNavigationLabel(): string
    {
        return __('resources.general');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    TextInput::make('site_name')
                        ->label(__('site name'))
                        ->required(),

                    TextInput::make('copy_right')
                        ->label(__('copy right'))
                        ->required(),

                    TextInput::make('support_email')
                        ->email()
                        ->label(__('support email'))
                        ->required(),

                    TextInput::make('support_phone_number')
                        ->numeric()
                        ->label(__('support phone number'))
                        ->required(),

                    TextInput::make('instagram_url')
                        ->numeric()
                        ->label(__('instagram url'))
                        ->required(),

                    TextInput::make('telegram_url')
                        ->numeric()
                        ->label(__('telegram url'))
                        ->required(),

                    Textarea::make('address')
                        ->label(__('address'))
                        ->required()
                        ->columnSpanFull(),

                    Textarea::make('site_description')
                        ->label(__('site description'))
                        ->required()
                        ->columnSpanFull(),

                    FileUpload::make('logo')
                        ->label(__('logo'))
                        ->required()
                        ->directory('logo')
                        ->preserveFilenames()
                        ->image()
                        ->imageEditor()
                        ->columnSpanFull(),

                ])->columns(),
            ]);
    }
}
