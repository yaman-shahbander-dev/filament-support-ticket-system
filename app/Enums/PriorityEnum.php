<?php

namespace App\Enums;

use App\Traits\EnumHelper;

enum PriorityEnum: string
{
    use EnumHelper;
    case Low = 'low';
    case Medium = 'medium';
    case High = 'high';
}
