<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Harvests extends Model
{
    use HasFactory;

    protected $fillable = [
        'cycle_id',
        'harvest_count', 
        'date_harvested',
        'status'
    ];

    public function cycle(): BelongsTo
    {
        return $this->belongsTo(Cycles::class);
    }
}
