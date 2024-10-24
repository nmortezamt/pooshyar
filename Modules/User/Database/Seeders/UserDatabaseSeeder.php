<?php

namespace Modules\User\Database\Seeders;

use BezhanSalleh\FilamentShield\Support\Utils;
use Illuminate\Database\Seeder;
use Modules\User\Models\User;

class UserDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defaultUsers = ([
            [
                'name' => 'Morteza',
                'email' => 'mortezanmt30@gmail.com',
                'phone_number' => '09228647422',
                'role' => Utils::getSuperAdminName()
            ],
            [
                'name' => 'Ramin',
                'email' => 'ramin@gmail.com',
                'phone_number' => '09185250334',
                'role' => Utils::getSuperAdminName()
            ]
        ]);
        foreach ($defaultUsers as $user){
            User::firstOrCreate([
                'name' => $user['name'],
                'email' => $user['email'],
                'phone_number' => $user['phone_number'],
                'status' => User::ACTIVE_STATUS,
            ])->assignRole($user['role']);
        }
    }
}
