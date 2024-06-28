<?php

namespace App\Enums;

use App\Traits\EnumHelper;

enum ColorsEnum: string
{
    use EnumHelper;
    case Danger = 'danger';
    case Success = 'success';
    case Warning = 'warning';
}
