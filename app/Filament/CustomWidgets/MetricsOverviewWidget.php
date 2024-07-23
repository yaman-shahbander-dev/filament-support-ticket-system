<?php

namespace App\Filament\CustomWidgets;

use Filament\Widgets\Concerns\CanPoll;
use Filament\Widgets\Widget;

class MetricsOverviewWidget extends Widget
{
    protected static string $view = 'filament.custom-widgets.metrics-overview-widget';

    use CanPoll;

    /**
     * @var array<MetricWidget> | null
     */
    protected ?array $cachedMetrics = null;

    protected int | string | array $columnSpan = 'full';

    protected function getColumns(): int
    {
        $count = count($this->getCachedMetrics());

        if ($count < 3) {
            return 3;
        }

        if (($count % 3) !== 1) {
            return 3;
        }

        return 4;
    }

    /**
     * @return array<MetricWidget>
     */
    protected function getCachedMetrics(): array
    {
        return $this->cachedMetrics ??= $this->getMetrics();
    }

    /**
     * @return array<MetricWidget>
     */
    protected function getMetrics(): array
    {
        return [];
    }
}
