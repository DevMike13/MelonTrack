<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrixReading extends Model
{
    use HasFactory;

    protected $fillable = [
        'cycle_id',
        'brix_level',
        'reading_at',
        'remarks'
    ];

    protected $casts = [
        'reading_at' => 'datetime'
    ];

    public function cycle()
    {
        return $this->belongsTo(Cycles::class);
    }
}
