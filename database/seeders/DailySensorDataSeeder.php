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
        DailySensorData::where('cycle_id', 1)->delete();

        $start = Carbon::create(2026, 7, 6, 0, 0, 0);
        $end   = Carbon::create(2026, 12, 31, 23, 0, 0);

        while ($start <= $end) {

            DailySensorData::create([
                'cycle_id' => 1,

                // Environmental Readings
                'temperature'   => rand(260, 340) / 10, // 26.0 - 34.0 °C
                'humidity'      => rand(650, 900) / 10, // 65.0 - 90.0 %

                'soil_moisture' => rand(550, 850) / 10, // 55.0 - 85.0 %
                'soil_moisture2' => rand(550, 850) / 10,

                'water_level' => rand(300, 900) / 10,

                'ec_level'      => rand(10, 30) / 10,   // 1.0 - 3.0
                'ph_level'      => rand(55, 75) / 10,   // 5.5 - 7.5

                // NPK
                'nitrogen'      => rand(80, 180),
                'phosphorus'    => rand(30, 120),
                'potassium'     => rand(100, 250),

                'nitrogen2' => rand(80, 180),
                'phosphorus2' => rand(30, 120),
                'potassium2' => rand(100, 250),

                'reading_date'  => $start->copy(),
            ]);

            // Next hour
            $start->addHour();
        }
    }
}
