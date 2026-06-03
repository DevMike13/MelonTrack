<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CycleMilestone extends Model
{
    use HasFactory;

    protected $fillable = [
        'cycle_id',
        'title',
        'type',
        'scheduled_date',
        'completed',
        'completed_date'
    ];

    public function cycle()
    {
        return $this->belongsTo(Cycles::class);
    }

    public function getColorAttribute()
    {
        return match ($this->type) {
            'greenhouse_transfer' => 'bg-blue-500',
            'pruning' => 'bg-yellow-500',
            'pollination' => 'bg-pink-500',
            'fruit_set' => 'bg-green-500',
            'harvest' => 'bg-red-500',
            default => 'bg-gray-400',
        };
    }
}
