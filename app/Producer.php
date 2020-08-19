<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producer extends Model
{
    public function filmProducers(){
        return $this->hasMany(FilmProducer::class);
    }
}