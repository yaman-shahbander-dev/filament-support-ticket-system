<?php

namespace App\Filament\Widgets;

use App\Filament\CustomWidgets\MetricWidget;
use Illuminate\Contracts\Support\Htmlable;
use App\Enums\DurationEnum;

class MetricWidgetFromCommand extends MetricWidget
{
    protected string | Htmlable $label = '';

    public function getValue()
    {
        return "";
    }
}
