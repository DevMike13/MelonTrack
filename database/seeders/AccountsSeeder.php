<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AccountsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        
        User::create([
            'name' => 'iBroccoGreens Admin',
            'email' => 'broccolimicrogreens@gmail.com',
            'password' => Hash::make('ibroccogreens@2025'),
            'role' => 'admin',
            'email_verified_at' => $now,
            'is_approved' => true
        ]);

        User::create([
            'name' => 'Reynalyn Admin',
            'email' => 'rodiquereyn@gmail.com',
            'password' => Hash::make('rodiquereyn@2025'),
            'role' => 'admin',
            'email_verified_at' => $now,
            'is_approved' => true
        ]);

        User::create([
            'name' => 'Abigail Admin',
            'email' => 'abigailvacunawa3412@gmail.com',
            'password' => Hash::make('abigailvacunawa@2025'),
            'role' => 'admin',
            'email_verified_at' => $now,
            'is_approved' => true
        ]);
    }
}
