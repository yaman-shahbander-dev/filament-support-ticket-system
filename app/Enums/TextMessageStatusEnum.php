<?php

namespace App\Enums;

use App\Traits\EnumHelper;

enum TextMessageStatusEnum: string
{
    use EnumHelper;

    case Pending = 'pending';
    case Success = 'success';
    case Failed = 'failed';
}
