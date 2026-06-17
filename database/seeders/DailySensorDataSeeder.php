<?php

namespace Database\Seeders;

use App\Models\DailySensorData;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class DailySensorDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DailySensorData::truncate();

        $start = Carbon::now()->subHours(24);

        for ($i = 0; $i <= 24; $i++) {

            $timestamp = $start->copy()->addHours($i);

            DailySensorData::create([
                'cycle_id' => 1,

                'temperature' => rand(260, 340) / 10,      // 26.0 - 34.0 °C
                'humidity' => rand(650, 900) / 10,         // 65 - 90 %
                'soil_moisture' => rand(550, 850) / 10,    // 55 - 85 %
                'ec_level' => rand(10, 30) / 10,           // 1.0 - 3.0
                'ph_level' => rand(55, 75) / 10,           // 5.5 - 7.5

                'nitrogen' => rand(80, 180),
                'phosphorus' => rand(30, 120),
                'potassium' => rand(100, 250),

                'reading_date' => $timestamp,
            ]);
        }
    }
}
