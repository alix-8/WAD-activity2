<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    // Mas safe gamitin ang protected property sa ngayon
    protected $fillable = [
        'street',
        'city',
        'house_number',
        'property_id'
    ];

    public function property(): BelongsTo
    {
        // Siguraduhin na ang Property model ay nasa parehong namespace (App\Models)
        return $this->belongsTo(Property::class, 'property_id');
    }
}