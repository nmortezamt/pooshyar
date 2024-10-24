<?php

namespace Modules\Product\Brand\Filament\Resources;

use BezhanSalleh\FilamentShield\Support\Utils;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Str;
use Modules\Product\Brand\Filament\Resources\BrandResource\Pages;
use Modules\Product\Brand\Filament\Resources\BrandResource\RelationManagers;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Modules\Product\Brand\Models\Brand;

class BrandResource extends Resource
{
    protected static ?string $model = Brand::class;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getModelLabel(): string
    {
        return __('resources.brand');
    }
    public static function getNavigationGroup(): ?string
    {
        return __('resources.products');
    }

    public static function getPluralModelLabel(): string
    {
        return __('resources.brands');
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
                    TextInput::make('name')
                        ->label(__('name'))
                        ->unique(Brand::class,'name',ignoreRecord: true)
                        ->required(),

                    TextInput::make('slug')
                        ->label(__('slug'))
                        ->rules('regex:/^[a-z0-9\p{Arabic}-]+$/u')
                        ->required()
                        ->unique(Brand::class,'slug',ignoreRecord: true)
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn ($state, callable $set) =>
                        $set('slug', preg_replace('/\s+/u', '-', trim($state)))
                        ),

                    Select::make('status')
                        ->label(__('status'))
                        ->options([
                            Brand::ACTIVE_STATUS => __(Brand::ACTIVE_STATUS),
                            Brand::INACTIVE_STATUS => __(Brand::INACTIVE_STATUS),
                        ])
                        ->required(),

                    Textarea::make('description')
                        ->label(__('description'))
                        ->columnSpanFull(),

                    Forms\Components\FileUpload::make('img')
                        ->label(__('image'))
                        ->required()
                        ->directory('brands')
                        ->preserveFilenames()
                        ->image()
                        ->imageEditor()
                        ->columnSpanFull(),

                ])->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('name'))
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
            'index' => Pages\ListBrands::route('/'),
            'create' => Pages\CreateBrand::route('/create'),
            'edit' => Pages\EditBrand::route('/{record}/edit'),
        ];
    }
}
