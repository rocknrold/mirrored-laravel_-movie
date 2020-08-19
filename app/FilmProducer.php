<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FilmProducer extends Model
{
    public function film(){
        return $this->belongsTo(Film::class);
    }

    public function producer(){
        return $this->belongsTo(Producer::class);
    }
}
