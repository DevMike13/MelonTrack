<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'cycle_id',
        'sale_date',
        'customer_name',
        'quantity_kg',
        'price_per_kg',
        'total_amount',
        'status',
        'remarks',
    ];

    protected $casts = [
        'sale_date' => 'date',
        'quantity_kg' => 'decimal:2',
        'price_per_kg' => 'decimal:2',
        'total_amount' => 'decimal:2',
    ];

    public function cycle(): BelongsTo
    {
        return $this->belongsTo(Cycles::class, 'cycle_id');
    }
}
