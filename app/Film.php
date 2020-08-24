<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\File;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Film extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'name','story','released_at','duration','info','genre_id','certificate_id','media_id'
    ];

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function certificate()
    {
        return $this->belongsTo(Certificate::class);
    }

    public function filmProducers(){
        return $this->hasMany(FilmProducer::class);
    }

    public function actorRoles(){
        return $this->hasMany(ActorRole::class);
    }

    public function filmUsers(){
        return $this->hasMany(FilmUser::class);
    }

    public function registerMediaCollections(Media $media=null): void{
        $this
        ->addMediaCollection('movies')
        ->singleFile()
        ->acceptsFile(function (File $file) {
            return ($file->mimeType === 'image/jpeg') || ($file->mimeType === 'image/png');
        });
        $this->addMediaConversion('card')
            ->width(500)
            ->height(262);
        $this
            ->addMediaConversion('thumb')
            ->width(200)
            ->height(200);
        $this
            ->addMediaConversion('icon')
            ->width(100)
            ->height(100);

    }

    public function photo(){
        return $this->hasOne(Media::class,'id', 'media_id');
    }

    public function getFilmUrlAttribute(){
        return $this->photo->getUrl('thumb');
    }

    public function getFilmUrlCardAttribute(){
        return $this->photo->getUrl('card');
    }

    public function getFilmUrlIconAttribute(){
        return $this->photo->getUrl('icon');
    }
}
