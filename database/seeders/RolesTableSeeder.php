<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use App\Enums\RolesEnum;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->truncate();

        $roles = [
            [
                'id' => 1,
                'name' => RolesEnum::Admin->value,
            ],
            [
                'id' => 2,
                'name' => RolesEnum::Agent->value,
            ],
        ];

        Role::insert($roles);
    }
}
