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
        'cycle_no',
        'microgreen_type',
        'start_date', 
        'end_date',
        'trays',
        'notes',
        'status',
        'phase'
    ];

    public function yieldTrackers()
    {
        return $this->hasMany(YieldTracker::class, 'cycle_id'); 
    }
}
