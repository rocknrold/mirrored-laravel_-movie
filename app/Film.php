<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $fillable = [
        'name','story','released_at','duration','info','genre_id','certificate_id'
    ];

    public function filmGenre()
    {
    	return $this->belongsTo(Genre::class);
    }

    public function filmCertificate()
    {
    	return $this->belongsTo(Certificate::class);
    }
}
