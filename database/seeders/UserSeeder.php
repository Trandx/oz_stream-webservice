<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::query()->first();

        $first = [
            'first_name' => '',
            'last_name' => 'Trandx',

            'phones' => ["+237-122", "+237-123"],

            'email' => "test@gmail.com",

            "roles_id" => $role['id'],

            // 'username' => "Trandx",
            // 'birthday' => "1999-01-05",
            'password' => Hash::make('test'), // bcrypt('test'),

        ];

        User::create($first);

        User::factory()->count(10)->create();

    }
}
