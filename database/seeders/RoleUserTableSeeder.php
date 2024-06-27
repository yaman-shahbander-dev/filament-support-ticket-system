<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Enums\DatabaseTestEmailsEnum;
use Illuminate\Support\Facades\DB;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('role_user')->truncate();

        User::query()
            ->whereRaw('LOWER(email) = ?', [strtolower(DatabaseTestEmailsEnum::Admin->value)])
            ->first()
            ->roles()
            ->sync(1);

        User::query()
            ->whereRaw('LOWER(email) = ?', [strtolower(DatabaseTestEmailsEnum::Agent->value)])
            ->first()
            ->roles()
            ->sync(2);
    }
}
