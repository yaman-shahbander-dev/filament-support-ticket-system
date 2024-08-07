<?php

namespace App\Filament\Resources;

use App\Enums\PermissionsEnum;
use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use App\Services\TextMessageService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Resources\UserResource\RelationManagers\RolesRelationManager;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Actions\BulkAction;
use Filament\Forms\Components\Textarea;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->autofocus()
                    ->required(),
                TextInput::make('email')
                    ->unique(ignoreRecord: true)
                    ->required(),
                TextInput::make('password')
                    ->password()
                    ->required()
                    ->hiddenOn(['edit']),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->searchable(),
                TextColumn::make('roles.name')
                    ->badge()
            ])
            ->filters([
                SelectFilter::make('role')
                    ->relationship('roles', 'name')
                    ->preload()
            ])
            ->actions([
                Tables\Actions\EditAction::make()->hidden(!Auth::user()->hasPermission(PermissionsEnum::UserEdit->value)),
                Tables\Actions\DeleteAction::make()->hidden(!Auth::user()->hasPermission(PermissionsEnum::UserDelete->value)),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    BulkAction::make('send bulk sms')
                        ->icon('heroicon-o-chat-bubble-left-ellipsis')
                        ->deselectRecordsAfterCompletion()
                        ->form([
                            Textarea::make('message')
                                ->placeholder('Type your message!')
                                ->required()
                                ->rows(4),
                            Textarea::make('remarks')
                        ])
                        ->action(function (array $data, Collection $records) {
                            TextMessageService::sendMessage($data, $records);
                            Notification::make()
                                ->title('Message Sent Successfully!')
                                ->success()
                                ->send();
                        }),
                    Tables\Actions\DeleteBulkAction::make()->hidden(!Auth::user()->hasPermission(PermissionsEnum::UserDelete->value)),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RolesRelationManager::class
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
