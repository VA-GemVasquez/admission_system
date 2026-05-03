<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        if (Admin::where('email', 'admin@university.edu')->exists()) {
            $this->command->info('Admin account already exists, skipping.');
            return;
        }

        Admin::create([
            'name' => 'Administrator',
            'email' => 'admin@university.edu',
            'password' => Hash::make('password123'),
        ]);

        $this->command->info('Admin account created.');
        $this->command->info('  Email:    admin@university.edu');
        $this->command->info('  Password: password123');
    }
}
