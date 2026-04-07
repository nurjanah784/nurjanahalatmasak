<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PetugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Petugas',
            'email' => 'petugas@dummygmail.com',
            'password' => Hash::make('petugas123'),
            'email_verified_at' => now(),
            'role' => 'petugas',
        ]);
    }
}