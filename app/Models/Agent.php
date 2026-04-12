<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name','license_no','phone_no'])]
class Agent extends Model
{
    public function properties(){
        return $this->hasMany(Property::class);
    }


}
