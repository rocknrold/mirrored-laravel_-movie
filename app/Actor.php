<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Actor extends Model
{

	use SoftDeletes;
	
    protected $fillable = ['name', 'note'];

    public function actorRoles(){
        return $this->hasMany(ActorRole::class);
    }

}