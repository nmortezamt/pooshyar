<?php

namespace Modules\Category\Filament\Resources;

use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use BezhanSalleh\FilamentShield\Support\Utils;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Str;
use Modules\Category\Filament\Resources\CategoryResource\Pages;
use Modules\Category\Filament\Resources\CategoryResource\RelationManagers;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Modules\Category\Models\Category;

class CategoryResource extends Resource implements HasShieldPermissions
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    public static function getPermissionPrefixes(): array
    {
        return [
            'view',
            'view_any',
            'create',
            'update',
            'delete',
            'delete_any',
        ];
    }
    public static function getModelLabel(): string
    {
        return __('resources.category');
    }

    public static function canAccess(): bool
    {
        return auth()->user()->hasRole(Utils::getSuperAdminName());
    }

    public static function getPluralModelLabel(): string
    {
        return __('resources.categories');
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
                    Forms\Components\Grid::make(3)
                        ->schema([
                            Select::make('type')
                                ->label(__('type'))
                                ->options([
                                    Category::PRODUCT_TYPE => __(Category::PRODUCT_TYPE),
                                    Category::BLOG_TYPE => __(Category::BLOG_TYPE)
                                ])
                                ->in(Category::$types)
                                ->required(),
                            Select::make('status')
                                ->label(__('status'))
                                ->options([
                                    Category::ACTIVE_STATUS => __(Category::ACTIVE_STATUS),
                                    Category::INACTIVE_STATUS => __(Category::INACTIVE_STATUS)
                                ])
                                ->in(Category::$statuses)
                                ->required(),

                            Select::make('parent_id')
                                ->label(__('parent category'))
                                ->options(function($get) {
                                    return Category::getParentCategoriesExcludingCurrent($get('id'),$get('type'))->pluck('title', 'id');
                                })
                                ->searchable(),
                    ]),


                    TextInput::make('title')
                        ->label(__('title'))
                        ->unique(Category::class,'title',ignoreRecord: true)
                        ->required(),

                    TextInput::make('slug')
                        ->label(__('slug'))
                        ->rules('regex:/^[a-z0-9\p{Arabic}-]+$/u')
                        ->required()
                        ->unique(Category::class,'slug',ignoreRecord: true)
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn ($state, callable $set) =>
                        $set('slug', preg_replace('/\s+/u', '-', trim($state)))
                        ),

                    Textarea::make('description')
                        ->label(__('description'))
                        ->columnSpanFull(),

                    Forms\Components\FileUpload::make('img')
                        ->label(__('image'))
                        ->required()
                        ->directory('categories')
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
                Tables\Columns\TextColumn::make('type')
                    ->formatStateUsing(function ($state) {
                        return __($state);
                    })->label(__('type')),
                Tables\Columns\TextColumn::make('status')
                    ->formatStateUsing(function ($state) {
                        return __($state);
                    })->label(__('status')),
                Tables\Columns\TextColumn::make('parentCategory.title')
                    ->label(__('parent category'))
                    ->placeholder(__('root')),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('published at'))
                    ->sortable()
                    ->date(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')->label(__('type'))
                    ->options([
                        Category::PRODUCT_TYPE => __(Category::PRODUCT_TYPE),
                        Category::BLOG_TYPE => __(Category::BLOG_TYPE)
                    ]),
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
