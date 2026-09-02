<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\{User,Role};

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Super Admin',
                'email' => 'admin@elevatexpert.in',
                'password' => bcrypt('elevatexpert@321'),
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('admin@321'),
            ],
        ];

        $roles = [
            [
                'name' => 'Super Admin',
                'slug' => 'super_admin'
            ],
            [
                'name' => 'Admin',
                'slug' => 'admin'
            ],
        ];

        foreach ($roles as $role) {
            $createdRole = Role::create($role);

            if ($role['slug'] === 'super_admin') {
                $superAdminUser = User::create($users[0]);

                $superAdminUser->roles()->attach($createdRole);
            }

            if ($role['slug'] === 'admin') {
                $adminUser = User::create($users[1]);

                $adminUser->roles()->attach($createdRole);
            }
        }

    }
}
