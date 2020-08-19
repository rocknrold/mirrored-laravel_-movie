<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActorRole extends Model
{
    public function actor(){
        return $this->belongsTo(Actor::class);
    }

    public function role(){
        return $this->belongsTo(Role::class);
    }
}
