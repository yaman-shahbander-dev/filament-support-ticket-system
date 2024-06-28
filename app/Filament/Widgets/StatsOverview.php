<?php

namespace App\Filament\Widgets;

use App\Enums\RolesEnum;
use App\Models\Category;
use App\Models\Ticket;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Builder;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Tickets', Ticket::query()->count()),
            Stat::make('Total Categories', Category::query()->active()->count()),
            Stat::make('Total Agents', User::query()->whereHas('roles', function (Builder $query) {
                return $query->where('name', RolesEnum::Agent->value);
            })->count()),
        ];
    }
}
