<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    public function filmGenre()
    {
    	return $this->belongsTo(Genre::class);
    }

    public function filmCertificate()
    {
    	return $this->belongsTo(Certificate::class);
    }
}
