<?php

namespace App\Filament\Widgets;

use App\Enums\ColorsEnum;
use App\Enums\PriorityEnum;
use App\Enums\RolesEnum;
use App\Enums\StatusEnum;
use App\Models\Ticket;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class LatestTickets extends BaseWidget
{
    protected int | string | array $columnSpan = 2;

    protected static ?int $sort = 3;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Auth::user()->hasRole(RolesEnum::Admin->value) ? Ticket::query() : Ticket::query()->where('assigned_to', Auth::user()->id)
            )
            ->columns([
                TextColumn::make('title')
                    ->description(fn (Ticket $record): ?string => $record?->description ?? null)
                    ->searchable()
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->colors([
                        ColorsEnum::Warning->value => StatusEnum::Archived->value,
                        ColorsEnum::Danger->value => StatusEnum::Open->value,
                        ColorsEnum::Success->value => StatusEnum::Closed->value,
                    ]),
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
            ]);
    }
}
