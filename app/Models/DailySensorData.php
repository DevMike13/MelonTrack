<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailySensorData extends Model
{
    use HasFactory;

    protected $fillable = [
        'cycle_id',
        'board',
        'soil_moisture', 
        'soil_ph',
        'water_ph',
        'temperature',
        'humidity',
        'reading_date'
    ];
}
