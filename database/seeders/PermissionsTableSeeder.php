<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Enums\PermissionsEnum; // Import the PermissionsEnum
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permissions')->truncate();

        $permissions = [
            [
                'name' => PermissionsEnum::PermissionCreate->value,
            ],
            [
                'name' => PermissionsEnum::PermissionEdit->value,
            ],
            [
                'name' => PermissionsEnum::PermissionDelete->value,
            ],
            [
                'name' => PermissionsEnum::PermissionShow->value,
            ],
            [
                'name' => PermissionsEnum::PermissionAccess->value,
            ],
            [
                'name' => PermissionsEnum::RoleCreate->value,
            ],
            [
                'name' => PermissionsEnum::RoleEdit->value,
            ],
            [
                'name' => PermissionsEnum::RoleShow->value,
            ],
            [
                'name' => PermissionsEnum::RoleDelete->value,
            ],
            [
                'name' => PermissionsEnum::RoleAccess->value,
            ],
            [
                'name' => PermissionsEnum::CategoryCreate->value,
            ],
            [
                'name' => PermissionsEnum::CategoryEdit->value,
            ],
            [
                'name' => PermissionsEnum::CategoryShow->value,
            ],
            [
                'name' => PermissionsEnum::CategoryDelete->value,
            ],
            [
                'name' => PermissionsEnum::CategoryAccess->value,
            ],
            [
                'name' => PermissionsEnum::TicketCreate->value,
            ],
            [
                'name' => PermissionsEnum::TicketEdit->value,
            ],
            [
                'name' => PermissionsEnum::TicketShow->value,
            ],
            [
                'name' => PermissionsEnum::TicketDelete->value,
            ],
            [
                'name' => PermissionsEnum::TicketAccess->value,
            ],
            [
                'name' => PermissionsEnum::UserCreate->value,
            ],
            [
                'name' => PermissionsEnum::UserEdit->value,
            ],
            [
                'name' => PermissionsEnum::UserShow->value,
            ],
            [
                'name' => PermissionsEnum::UserDelete->value,
            ],
            [
                'name' => PermissionsEnum::UserAccess->value,
            ],
        ];

        Permission::insert($permissions);
    }
}

