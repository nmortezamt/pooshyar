<?php

namespace Modules\Blog\Filament\Resources;

use BezhanSalleh\FilamentShield\Support\Utils;
use Modules\Blog\Filament\Resources\BlogResource\Pages;
use Modules\Blog\Filament\Resources\BlogResource\RelationManagers;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Blog\Models\Blog;
use Modules\Category\Models\Category;

class BlogResource extends Resource
{
    protected static ?string $model = Blog::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function getModelLabel(): string
    {
        return __('resources.blog');
    }

    public static function getPluralModelLabel(): string
    {
        return __('resources.blogs');
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
                Forms\Components\Section::make()->schema([
                    Forms\Components\TextInput::make('title')
                        ->label(__('title'))
                        ->required(),

                    Forms\Components\TextInput::make('slug')
                        ->label(__('slug'))
                        ->rules('regex:/^[a-z0-9\p{Arabic}-]+$/u')
                        ->required()
                        ->unique(Blog::class,'slug',ignoreRecord: true)
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn ($state, callable $set) =>
                        $set('slug', preg_replace('/\s+/u', '-', trim($state)))
                        ),

                    Forms\Components\Select::make('status')
                        ->label(__('status'))
                        ->options([
                            Blog::ACTIVE_STATUS => __(Blog::ACTIVE_STATUS),
                            Blog::INACTIVE_STATUS => __(Blog::INACTIVE_STATUS),
                        ])
                        ->required(),

                    Forms\Components\Select::make('category_id')
                        ->label(__('category'))
                        ->options(Category::getBlogTypeCategories()->pluck('title','id'))
                        ->searchable()
                        ->required(),

                    Forms\Components\Select::make('subcategory_id')
                        ->label(__('subcategory'))
                        ->options(fn($get) => Category::getBlogTypeSubCategories($get('category_id'))->pluck('title','id'))
                        ->searchable()
                        ->required(),

                    Forms\Components\RichEditor::make('body')
                        ->label(__('body'))->columnSpanFull()
                        ->required(),

                    Forms\Components\Textarea::make('description')
                        ->label(__('description')),

                    Forms\Components\Textarea::make('description_seo')
                        ->label(__('SEO description')),

                    Forms\Components\FileUpload::make('img')
                        ->label(__('image'))
                        ->required()
                        ->directory('blogs')
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
                        Blog::ACTIVE_STATUS => __(Blog::ACTIVE_STATUS),
                        Blog::INACTIVE_STATUS => __(Blog::INACTIVE_STATUS)
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
            'index' => Pages\ListBlogs::route('/'),
            'create' => Pages\CreateBlog::route('/create'),
            'edit' => Pages\EditBlog::route('/{record}/edit'),
        ];
    }
}
