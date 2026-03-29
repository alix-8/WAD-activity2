<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable(['title','price','type','agent_id'])]
class Property extends Model
{
    public function amenities() {
        return $this->belongsToMany(Amenity::class);
    }

    public function agent() {
        return $this->belongsTo(Agent::class);
    }
    public function address() {
        return $this->hasOne(Address::class);
    }
}
