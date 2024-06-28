<?php

namespace App\Enums;

use App\Traits\EnumHelper;

enum DurationEnum: string
{
    use EnumHelper;

    case Day = 'day';
    case Week = 'week';
    case Month = 'month';
    case Year = 'year';
}
