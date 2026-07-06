<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailySensorData extends Model
{
    use HasFactory;

    protected $fillable = [
        'cycle_id',
        'temperature', 
        'humidity',

        'soil_moisture',
        'soil_moisture2',

        'water_level',

        'ec_level',
        'ph_level',

        'nitrogen',
        'phosphorus',
        'potassium',

        'nitrogen2',
        'phosphorus2',
        'potassium2',

        'reading_date'
    ];
}
