<?php

namespace App\Filament\Resources\TicketResource\Widgets;

use App\Filament\CustomWidgets\MetricWidget;
use App\Models\Ticket;
use Illuminate\Contracts\Support\Htmlable;
use App\Enums\DurationEnum;

class MetricsSampleWidget extends MetricWidget
{
    protected string | Htmlable $label = 'Tickets Overview';

    public ?string $filter = DurationEnum::Week->value;

    public function getValue()
    {
        return match($this->filter) {
            DurationEnum::Week->value => Ticket::query()->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
            DurationEnum::Month->value => Ticket::query()->whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])->count(),
            DurationEnum::Year->value => Ticket::query()->whereBetween('created_at', [now()->startOfYear(), now()->endOfYear()])->count(),
        };
    }

    protected function getFilters(): ?array
    {
        return [
            DurationEnum::Week->value => 'This Week',
            DurationEnum::Month->value => 'This Month',
            DurationEnum::Year->value => 'This Year',
        ];
    }
}
