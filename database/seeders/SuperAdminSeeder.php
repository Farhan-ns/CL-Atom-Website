<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = User::updateOrCreate(
            ['email' => 'sa@atom.cyberlabs.co.id'],
            [
                'name' => 'Super-Admin',
                'password' => 'Fn29G79P1n5q',
                'email_verified_at' => now(),
            ]
        );

        $superAdmin->assignRole('super_admin');
    }
}
