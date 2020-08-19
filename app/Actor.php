<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    public function actorRoles(){
        return $this->hasMany(ActorRole::class);
    }
}
