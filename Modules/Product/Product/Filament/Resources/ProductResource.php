<?php

namespace Modules\Product\Product\Filament\Resources;

use BezhanSalleh\FilamentShield\Support\Utils;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Modules\Category\Models\Category;
use Modules\Product\Product\Filament\Resources\ProductResource\RelationManagers;
use Modules\Product\Product\Models\Product;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getModelLabel(): string
    {
        return __('resources.product');
    }
    public static function getNavigationGroup(): ?string
    {
        return __('resources.products');
    }

    public static function getPluralModelLabel(): string
    {
        return __('resources.products');
    }

    public static function canAccess(): bool
    {
        return auth()->user()->hasRole(Utils::getSuperAdminName());
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
                        ->unique(Product::class,'slug',ignoreRecord: true)
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn ($state, callable $set) =>
                        $set('slug', preg_replace('/\s+/u', '-', trim($state)))
                        ),

                    Select::make('status')
                        ->label(__('status'))
                        ->options([
                            Product::ACTIVE_STATUS => __(Product::ACTIVE_STATUS),
                            Product::INACTIVE_STATUS => __(Product::INACTIVE_STATUS),
                        ])
                        ->required(),

                    Select::make('category_id')
                        ->label(__('category'))
                        ->options(Category::getProductTypeCategories()->pluck('title','id'))
                        ->searchable()
                        ->required(),

                    Select::make('subcategory_id')
                        ->label(__('subcategory'))
                        ->options(fn($get) => Category::getProductTypeSubCategories($get('category_id'))->pluck('title','id'))
                        ->searchable()
                        ->required(),

                    Select::make('sizes')
                        ->label(__('sizes'))
                        ->multiple()
                        ->required()
                        ->relationship(titleAttribute: 'name'),

                    Select::make('colors')
                        ->label(__('colors'))
                        ->multiple()
                        ->required()
                        ->relationship(titleAttribute: 'name'),

                    Select::make('brand_id')
                        ->label(__('brand'))
                        ->relationship('brand', 'name'),

                    RichEditor::make('body')
                        ->label(__('body'))->columnSpanFull()
                        ->required(),

                    Grid::make(3)
                        ->schema([
                            TextInput::make('price')
                                ->label(__('price'))
                                ->numeric()
                                ->required(),

                            TextInput::make('price_major')
                                ->label(__('price major'))
                                ->numeric()
                                ->required(),

                            TextInput::make('discount_price')
                                ->label(__('discount price'))
                                ->numeric(),
                        ]),

                    TextInput::make('quantity')
                        ->label(__('quantity'))
                        ->required(),

                    TextInput::make('order_count')
                        ->label(__('order count'))
                        ->numeric()
                        ->required(),

                    Textarea::make('description')
                        ->label(__('description')),

                    Textarea::make('description_seo')
                        ->label(__('SEO description')),

                    Toggle::make('is_published')
                        ->label(__('is published'))
                        ->helperText(__('Enable or disable product visibility')),

                    FileUpload::make('img')
                        ->label(__('image'))
                        ->required()
                        ->directory('products')
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
                Tables\Columns\TextColumn::make('formatted_price')
                    ->label(__('price')),
                Tables\Columns\TextColumn::make('formatted_price_major')
                    ->label(__('price major')),
                Tables\Columns\TextColumn::make('formatted_discount_price')
                    ->label(__('discount price')),
                Tables\Columns\TextColumn::make('quantity')
                    ->label(__('quantity')),
                Tables\Columns\TextColumn::make('order_count')
                    ->label(__('order count')),
                Tables\Columns\IconColumn::make('is_published')->label(__('is published'))->boolean(),
                Tables\Columns\ImageColumn::make('img')->label(__('image')),

                Tables\Columns\TextColumn::make('status')
                    ->formatStateUsing(function ($state) {
                        return __($state);
                    })->label(__('status')),

                Tables\Columns\TextColumn::make('category.title')
                    ->label(__('parent category')),

                Tables\Columns\TextColumn::make('subcategory.title')
                    ->label(__('subcategory')),

                Tables\Columns\TextColumn::make('view')
                    ->label(__('view')),

                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('published at'))
                    ->sortable()
                    ->date(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')->label(__('status'))
                    ->options([
                        Product::ACTIVE_STATUS => __(Product::ACTIVE_STATUS),
                        Product::INACTIVE_STATUS => __(Product::INACTIVE_STATUS)
                    ]),
                Tables\Filters\TernaryFilter::make('is_published')
                    ->label('Visibility')
                    ->boolean()
                    ->trueLabel('Only Visible Products')
                    ->falseLabel('Only Hidden Products'),
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
            'index' => \Modules\Product\Product\Filament\Resources\ProductResource\Pages\ListProducts::route('/'),
            'create' => \Modules\Product\Product\Filament\Resources\ProductResource\Pages\CreateProduct::route('/create'),
            'edit' => \Modules\Product\Product\Filament\Resources\ProductResource\Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
