<?php

namespace App\Filament\Widgets;

use App\Models\Ticket;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use App\Enums\DurationEnum;

class TicketsOverviewChart extends ChartWidget
{
    protected static ?int $sort = 2;

    protected static ?string $heading = 'Tickets Overview';

    public ?string $filter = 'week';

    protected function getData(): array
    {
        $start = null;
        $end = null;
        $perDuration = null;

        match ($this->filter) {
            DurationEnum::Week->value => [
                $start = now()->startOfWeek(),
                $end = now()->endOfWeek(),
                $perDuration = 'perDay',
            ],
            DurationEnum::Month->value => [
                $start = now()->startOfMonth(),
                $end = now()->endOfMonth(),
                $perDuration = 'perDay',
            ],
            DurationEnum::Year->value => [
                $start = now()->startOfYear(),
                $end = now()->endOfYear(),
                $perDuration = 'perMonth',
            ]
        };

        $data = Trend::model(Ticket::class)
            ->between(
                start: $start,
                end: $end,
            )
            ->$perDuration()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Tickets data',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getFilters(): ?array
    {
        return [
            'week' => 'Last week',
            'month' => 'Last month',
            'year' => 'This year',
        ];
    }
}
