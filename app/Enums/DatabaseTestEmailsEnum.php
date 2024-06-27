<?php

namespace App\Enums;

use App\Traits\EnumHelper;

enum DatabaseTestEmailsEnum: string
{
    use EnumHelper;

    case Admin = 'admin@admin.com';
    case Agent = 'agent@agent.com';
}
