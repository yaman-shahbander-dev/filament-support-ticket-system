<?php

namespace App\Filament\Resources\TicketResource\Widgets;

use App\Filament\CustomWidgets\MetricsOverviewWidget;

class MetricsOverviewSample extends MetricsOverviewWidget
{
    protected function getMetrics(): array
    {
        return [
            MetricsSampleWidget::class
        ];
    }
}
