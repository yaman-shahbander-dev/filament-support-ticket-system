<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\UsersTableSeeder;
use Database\Seeders\RolesTableSeeder;
use Database\Seeders\PermissionsTableSeeder;
use Database\Seeders\PermissionRoleTableSeeder;
use Database\Seeders\RoleUserTableSeeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        $this->call([
            UsersTableSeeder::class,
            RolesTableSeeder::class,
            PermissionsTableSeeder::class,
            PermissionRoleTableSeeder::class,
            RoleUserTableSeeder::class
        ]);

        Schema::enableForeignKeyConstraints();
    }
}
