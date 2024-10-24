<?php

namespace Modules\User\Filament\Resources;

use BezhanSalleh\FilamentShield\Support\Utils;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Str;
use Modules\Category\Models\Category;
use Modules\User\Filament\Resources\UserResource\Pages;
use Modules\User\Filament\Resources\UserResource\RelationManagers;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\User\Models\User;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function getModelLabel(): string
    {
        return __('resources.user');
    }

    public static function getPluralModelLabel(): string
    {
        return __('resources.users');
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
                    TextInput::make('name')
                        ->label(__('name'))
                        ->required(),

                    TextInput::make('email')
                        ->label(__('email'))
                        ->email()
                        ->required()
                        ->unique(User::class,'email',ignoreRecord: true),

                    TextInput::make('phone_number')
                        ->label(__('phone number'))
                        ->numeric()
                        ->required(),

                    Select::make('status')
                        ->label(__('status'))
                        ->options([
                            User::ACTIVE_STATUS => __(User::ACTIVE_STATUS),
                            User::INACTIVE_STATUS => __(User::INACTIVE_STATUS)
                        ])
                        ->in(User::$statuses)
                        ->required(),

                    Forms\Components\Select::make('roles')
                        ->label(__('roles'))
                        ->relationship('roles', 'name')
                        ->multiple()
                        ->preload()
                        ->searchable(),

                    Forms\Components\FileUpload::make('img')
                        ->label(__('image'))
                        ->directory('users')
                        ->preserveFilenames()
                        ->image()
                        ->avatar()
                        ->imageEditor()
                        ->columnSpanFull(),

                ])->columns(),
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
                Tables\Columns\TextColumn::make('email')
                    ->label(__('email'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone_number')
                    ->label(__('phone number'))
                    ->searchable(),
                Tables\Columns\ImageColumn::make('img')->label(__('image')),

                Tables\Columns\TextColumn::make('status')
                    ->formatStateUsing(function ($state) {
                        return __($state);
                    })->label(__('status')),
                Tables\Columns\TextColumn::make('roles.name')
                    ->label(__('roles'))->badge()
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')->label(__('status'))
                    ->options([
                        User::ACTIVE_STATUS => __(User::ACTIVE_STATUS),
                        User::INACTIVE_STATUS => __(User::INACTIVE_STATUS)
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
