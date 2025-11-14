<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Example users for each role
        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ],
            [
                'name' => 'Creator One',
                'email' => 'creator1@example.com',
                'password' => Hash::make('password'),
                'role' => 'creator',
            ],
            [
                'name' => 'Creator Two',
                'email' => 'creator2@example.com',
                'password' => Hash::make('password'),
                'role' => 'creator',
            ],
            [
                'name' => 'Taker One',
                'email' => 'taker1@example.com',
                'password' => Hash::make('password'),
                'role' => 'taker',
            ],
            [
                'name' => 'Taker Two',
                'email' => 'taker2@example.com',
                'password' => Hash::make('password'),
                'role' => 'taker',
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']],
                $user
            );
        }

        $this->command->info('✅ User roles seeded successfully!');
    }
}
