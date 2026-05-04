<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::updateOrCreate(
            ['email' => 'admin@university.edu'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('group1admin2026'),
            ]
        );

        $this->command->info('Admin account created/updated.');
        $this->command->info('  Email:    admin@university.edu');
        $this->command->info('  Password: group1admin2026');
    }
}
