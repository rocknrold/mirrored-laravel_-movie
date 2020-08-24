<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\File;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\SoftDeletes;

class Actor extends Model implements HasMedia
{

    use InteractsWithMedia;
    use SoftDeletes;
    protected $fillable = ['name', 'note','media_id'];

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

    public function photo(){
        return $this->hasOne(Media::class,'id', 'media_id');
    }

    public function getActorUrlAttribute(){
        return $this->photo->getUrl('thumb');
    }

    public function getActorUrlCardAttribute(){
        return $this->photo->getUrl('card');
    }

    public function getActorUrlIconAttribute(){
        return $this->photo->getUrl('icon');
    }

}