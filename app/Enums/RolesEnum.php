<?php

namespace App\Enums;

use App\Traits\EnumHelper;

enum RolesEnum: string
{
    use EnumHelper;

    case Admin = 'admin';
    case Agent = 'agent';
}
