<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable(['street','city','house_number','property_id'])]
class Address extends Model
{
    public function property() {
        return $this->hasOne(Property::class);
    }
}
