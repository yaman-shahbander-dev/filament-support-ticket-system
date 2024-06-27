<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Enums\PermissionsEnum;
use App\Enums\RolesEnum;
use Illuminate\Support\Facades\DB;

class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permission_role')->truncate();

        $adminPermissions = Permission::all();

        $agentPermissions = Permission::whereIn('name', [
            PermissionsEnum::CategoryAccess->value,
            PermissionsEnum::CategoryShow->value,
            PermissionsEnum::TicketAccess->value,
            PermissionsEnum::TicketShow->value,
        ])->get();

        Role::query()
            ->whereRaw('LOWER(name) = ?', [strtolower(RolesEnum::Admin->value)])
            ->first()
            ->permissions()
            ->sync($adminPermissions);

        Role::query()
            ->whereRaw('LOWER(name) = ?', [strtolower(RolesEnum::Agent->value)])
            ->first()
            ->permissions()
            ->sync($agentPermissions);
    }
}
