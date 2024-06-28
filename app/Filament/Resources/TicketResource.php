<?php

namespace App\Filament\Resources;

use App\Enums\PermissionsEnum;
use App\Enums\PriorityEnum;
use App\Enums\RolesEnum;
use App\Enums\ColorsEnum;
use App\Enums\StatusEnum;
use App\Filament\Resources\TicketResource\Pages;
use App\Filament\Resources\TicketResource\RelationManagers;
use App\Models\Ticket;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use App\Filament\Resources\TicketResource\RelationManagers\CategoriesRelationManager;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Columns\SelectColumn;

class TicketResource extends Resource
{
    protected static ?string $model = Ticket::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                TextInput::make('title')
                    ->autofocus()
                    ->required(),
                Textarea::make('description')
                    ->rows(3),
                Select::make('status')
                    ->options(StatusEnum::getKeyValue())
                    ->required()
                    ->in(StatusEnum::getValues()),
                Select::make('priority')
                    ->options(PriorityEnum::getKeyValue())
                    ->required()
                    ->in(PriorityEnum::getValues()),
                Select::make('assigned_to')
                    ->options(
                        User::query()
                            ->whereHas('roles', function (Builder $query) {
                                return $query->where('name', RolesEnum::Agent->value);
                            })
                            ->pluck('name', 'id')
                            ->toArray()
                    )
                    ->required(),
                Textarea::make('comment')
                    ->rows(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->description(fn (Ticket $record): ?string => $record?->description ?? null)
                    ->searchable()
                    ->sortable(),
                SelectColumn::make('status')
                    ->options(StatusEnum::getKeyValue()),
//                TextColumn::make('status')
//                    ->badge()
//                    ->colors([
//                        ColorsEnum::Warning->value => StatusEnum::Archived->value,
//                        ColorsEnum::Danger->value => StatusEnum::Open->value,
//                        ColorsEnum::Success->value => StatusEnum::Closed->value,
//                    ]),
                TextColumn::make('priority')
                    ->badge()
                    ->colors([
                        ColorsEnum::Warning->value => PriorityEnum::Low->value,
                        ColorsEnum::Success->value => PriorityEnum::Medium->value,
                        ColorsEnum::Danger->value => PriorityEnum::High->value,
                    ]),
                TextColumn::make('assignedTo.name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('assignedBy.name')
                    ->searchable()
                    ->sortable(),
                TextInputColumn::make('comment'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->options(StatusEnum::getKeyValue())
                    ->placeholder('Filter By Status'),
                SelectFilter::make('priority')
                    ->options(PriorityEnum::getKeyValue())
                    ->placeholder('Filter By Priority')
            ])
            ->actions([
                Tables\Actions\EditAction::make()->hidden(!Auth::user()->hasPermission(PermissionsEnum::CategoryEdit->value)),
                Tables\Actions\DeleteAction::make()->hidden(!Auth::user()->hasPermission(PermissionsEnum::CategoryDelete->value)),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->hidden(!Auth::user()->hasPermission(PermissionsEnum::CategoryDelete->value)),
                ]),
            ])
            ->modifyQueryUsing(function (Builder $query) {
                $user = Auth::user();
                return $user->hasRole(RolesEnum::Admin->value) ? $query : $query->where('assigned_to', $user->id);
            });
    }

    public static function getRelations(): array
    {
        return [
            CategoriesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTickets::route('/'),
            'create' => Pages\CreateTicket::route('/create'),
            'edit' => Pages\EditTicket::route('/{record}/edit'),
        ];
    }
}
