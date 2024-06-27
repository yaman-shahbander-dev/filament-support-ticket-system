<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Enums\DatabaseTestEmailsEnum;
use App\Enums\RolesEnum;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->truncate();

        $users = [
            [
                'name' => ucfirst(RolesEnum::Admin->value),
                'email' => DatabaseTestEmailsEnum::Admin->value,
                'password' => bcrypt('password'),
                'remember_token' => null,
            ],
            [
                'name' => ucfirst(RolesEnum::Admin->value),
                'email' => DatabaseTestEmailsEnum::Agent->value,
                'password' => bcrypt('password'),
                'remember_token' => null,
            ],
        ];

        User::insert($users);
    }
}
