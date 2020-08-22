<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class FilmUser extends Model
{
    public function film(){
        return $this->belongsTo(Film::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function remove($film){
        return $this->where([['film_id','=',$film],['user_id','=',Auth::user()->id]])->delete();
    }

}
