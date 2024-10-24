<?php

namespace Modules\Product\Gallery\Filament\Resources;

use BezhanSalleh\FilamentShield\Support\Utils;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Modules\Product\Gallery\Filament\Resources\GalleryResource\Pages;
use Modules\Product\Gallery\Filament\Resources\GalleryResource\RelationManagers;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Modules\Product\Gallery\Models\Gallery;
use Modules\Product\Product\Models\Product;

class GalleryResource extends Resource
{
    protected static ?string $model = Gallery::class;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
    protected static ?string $navigationIcon = 'heroicon-o-photo';

    public static function getModelLabel(): string
    {
        return __('resources.gallery');
    }
    public static function getNavigationGroup(): ?string
    {
        return __('resources.products');
    }

    public static function getPluralModelLabel(): string
    {
        return __('resources.galleries');
    }

    public static function canAccess(): bool
    {
        return auth()->user()->hasRole(Utils::getSuperAdminName());
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    Select::make('product_id')
                        ->label(__('product'))
                        ->options(Product::get()->pluck('title', 'id'))
                        ->required(),
                    TextInput::make('position')
                        ->numeric()
                        ->label(__('position')),
                    Forms\Components\FileUpload::make('img')
                        ->label(__('image'))
                        ->required()
                        ->directory('galleries')
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
                Tables\Columns\TextColumn::make('product.title')
                    ->label(__('product'))
                    ->searchable(),
                Tables\Columns\ImageColumn::make('img')->label(__('image')),
                Tables\Columns\TextColumn::make('position')
                    ->label(__('position'))
                    ->searchable(),
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
            'index' => Pages\ListGalleries::route('/'),
            'create' => Pages\CreateGallery::route('/create'),
            'edit' => Pages\EditGallery::route('/{record}/edit'),
        ];
    }
}
