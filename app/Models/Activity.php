<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_type',
        'subject_id',
        'cycle_id',
        'user_id',
        'type',
        'title',
        'description',
        'properties',
    ];

    protected $casts = [
        'properties' => 'array',
    ];

    public function subject()
    {
        return $this->morphTo();
    }

    public function cycle()
    {
        return $this->belongsTo(Cycles::class, 'cycle_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
