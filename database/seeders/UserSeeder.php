<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Ensure "Admin" role exists
        Role::firstOrCreate(['name' => 'Admin']);

        // — Admin User —
        $admin = User::updateOrCreate(
            ['email' => 'a@a'],
            [
                'name'     => 'Admin User',
                'password' => Hash::make('a'),
            ]
        );

        $admin->syncRoles('Admin');
    }
}
