<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YieldTracker extends Model
{
    use HasFactory;

    protected $fillable = [
        'cycle_id',
        'cycle_no',
        'tray',
        'yield_per_tray',
        'date',
    ];
    
    public function cycle()
    {
        return $this->belongsTo(Cycle::class);
    }
}
