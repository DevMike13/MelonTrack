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
        'ec_level',
        'ph_level',
        'reading_date'
    ];
}
