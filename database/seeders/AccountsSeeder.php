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
            'firstname' => 'Melon',
            'lastname' => 'Track',
            'username' => 'MelonTrack',
            'name' => 'MelonTrack Admin',
            'email' => 'melontrack@gmail.com',
            'password' => Hash::make('melontrack@2026'),
            'role' => 'admin',
            'email_verified_at' => $now,
            'is_verified' => true,
            'is_approved' => true,
        ]);
    }
}
