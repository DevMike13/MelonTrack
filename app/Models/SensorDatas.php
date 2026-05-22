<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SensorDatas extends Model
{
    use HasFactory;

    protected $fillable = [
        'cycle_id',
        'ph_level', 
        'dissolved_oxygen',
        'alkalinity_level',
        'water_temperature',
        'reading_date'
    ];

    // public function cycle(): BelongsTo
    // {
    //     return $this->belongsTo(Cycles::class, 'cycle_id');
    // }
}
