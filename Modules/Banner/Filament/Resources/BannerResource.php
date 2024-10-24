<?php

namespace Modules\Banner\Filament\Resources;

use BezhanSalleh\FilamentShield\Support\Utils;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Modules\Banner\Filament\Resources\BannerResource\Pages;
use Modules\Banner\Filament\Resources\BannerResource\RelationManagers;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Modules\Banner\Models\Banner;

class BannerResource extends Resource
{
    protected static ?string $model = Banner::class;

    protected static ?string $navigationIcon = 'heroicon-o-square-3-stack-3d';

    public static function getModelLabel(): string
    {
        return __('resources.banner');
    }

    public static function canAccess(): bool
    {
        return auth()->user()->hasRole(Utils::getSuperAdminName());
    }

    public static function getPluralModelLabel(): string
    {
        return __('resources.banners');
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    TextInput::make('title')
                        ->label(__('title'))
                        ->required(),

                    TextInput::make('slug')
                        ->label(__('slug'))
                        ->rules('regex:/^[a-z0-9\p{Arabic}-]+$/u')
                        ->required()
                        ->unique(Banner::class,'slug',ignoreRecord: true)
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn ($state, callable $set) =>
                        $set('slug', preg_replace('/\s+/u', '-', trim($state)))
                        ),

                    Select::make('status')
                        ->label(__('status'))
                        ->options([
                            Banner::ACTIVE_STATUS => __(Banner::ACTIVE_STATUS),
                            Banner::INACTIVE_STATUS => __(Banner::INACTIVE_STATUS)
                        ])
                        ->in(Banner::$statuses)
                        ->required(),

                    Textarea::make('description')
                        ->label(__('description')),

                    Forms\Components\FileUpload::make('img')
                        ->label(__('image'))
                        ->required()
                        ->directory('banners')
                        ->preserveFilenames()
                        ->image()
                        ->imageEditor()
                        ->columnSpanFull(),

                ])->columns(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label(__('title'))
                    ->sortable()
                    ->searchable(),
                Tables\Columns\ImageColumn::make('img')->label(__('image')),
                Tables\Columns\TextColumn::make('status')
                    ->formatStateUsing(function ($state) {
                        return __($state);
                    })->label(__('status')),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('published at'))
                    ->sortable()
                    ->date(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBanners::route('/'),
            'create' => Pages\CreateBanner::route('/create'),
            'edit' => Pages\EditBanner::route('/{record}/edit'),
        ];
    }
}
