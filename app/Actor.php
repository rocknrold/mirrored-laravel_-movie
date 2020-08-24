<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\File;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Actor extends Model implements HasMedia
{

    use InteractsWithMedia;

    protected $fillable = ['name', 'note'];

    public function actorRoles(){
        return $this->hasMany(ActorRole::class);
    }

    public function registerMediaCollections(Media $media=null): void{
        $this
        ->addMediaCollection('actors')
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

}
