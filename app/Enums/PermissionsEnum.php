<?php

namespace App\Enums;

use App\Traits\EnumHelper;

enum PermissionsEnum: string
{
    use EnumHelper;

    case PermissionCreate = 'permission_create';
    case PermissionEdit = 'permission_edit';
    case PermissionDelete = 'permission_delete';
    case PermissionShow = 'permission_show';
    case PermissionAccess = 'permission_access';
    case RoleCreate = 'role_create';
    case RoleEdit = 'role_edit';
    case RoleShow = 'role_show';
    case RoleDelete = 'role_delete';
    case RoleAccess = 'role_access';
    case CategoryCreate = 'category_create';
    case CategoryEdit = 'category_edit';
    case CategoryShow = 'category_show';
    case CategoryDelete = 'category_delete';
    case CategoryAccess = 'category_access';
    case TicketCreate = 'ticket_create';
    case TicketEdit = 'ticket_edit';
    case TicketShow = 'ticket_show';
    case TicketDelete = 'ticket_delete';
    case TicketAccess = 'ticket_access';
    case UserCreate = 'user_create';
    case UserEdit = 'user_edit';
    case UserShow = 'user_show';
    case UserDelete = 'user_delete';
    case UserAccess = 'user_access';
}
