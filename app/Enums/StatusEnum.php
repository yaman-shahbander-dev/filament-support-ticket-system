<?php

namespace App\Enums;

use App\Traits\EnumHelper;

enum StatusEnum: string
{
    use EnumHelper;
    case Open = 'open';
    case Closed = 'closed';
    case Archived = 'archived';
}
