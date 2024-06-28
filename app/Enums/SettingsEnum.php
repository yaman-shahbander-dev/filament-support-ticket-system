<?php

namespace App\Enums;

use App\Traits\EnumHelper;

enum SettingsEnum: int
{
    use EnumHelper;

    case ActiveCategory = 1;
}
