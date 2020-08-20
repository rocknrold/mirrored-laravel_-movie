<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FilmUser extends Model
{
    public function film(){
        return $this->belongsTo(Film::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
