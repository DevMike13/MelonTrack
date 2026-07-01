<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Cycles extends Model
{
    use HasFactory;

    protected $fillable = [
        'cycle_code',
        'crop_variety',
        'planting_date',
        'expected_harvest_date',
        'actual_harvest_date',
        'status',
        'growth_stage',
        'overall_progress',
        'fruit_progress',
        'current_brix',
        'final_brix',
        'yield_kg',
        'yield_rate',
        'notes'
    ];

    protected $casts = [
        'planting_date' => 'date',
        'expected_harvest_date' => 'date',
        'actual_harvest_date' => 'date',
    ];

    public function harvests()
    {
        return $this->hasMany(Harvests::class, 'cycle_id');
    }

    public function brixReadings()
    {
        return $this->hasMany(BrixReading::class, 'cycle_id');
    }

    public function milestones()
    {
        return $this->hasMany(CycleMilestone::class, 'cycle_id')->orderBy('scheduled_date');
    }

    public function dailySensorData()
    {
        return $this->hasMany(DailySensorData::class, 'cycle_id')
            ->latest('reading_date');
    }
}
