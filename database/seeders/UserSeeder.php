<?php

namespace Database\Seeders;

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
        $data = [
            [
                'username' => 'cap',
                'password' => Hash::make('111'),
                'role' => User::ROLE_CAPGUY,
            ],
            [
                'username' => 'bandana',
                'password' => Hash::make('111'),
                'role' => User::ROLE_BANDANAGUY,
            ],
            [
                'username' => 'beard',
                'password' => Hash::make('111'),
                'role' => User::ROLE_BEARDGUY,
            ],
        ];

        foreach ($data as $user) {
            User::create($user);
        }
    }
}
