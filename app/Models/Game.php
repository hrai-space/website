<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    public function tag()
    {
        return $this->belongsToMany(Tag::class, 'game__tags');
    }

    public function screenshots(){
        return $this->hasMany(Game_Image::class);
    }

    public function screenshotsASC(){
        return $this->hasMany(Game_Image::class)->orderBy('type', 'asc');
    }

    public function files(){
        return $this->hasMany(Game_File::class);
    }

    public function gameDownloads(){
        return $this->hasMany(Game_Download::class);
    }

    public function gameFollows(){
        return $this->hasMany(Game_Follow::class);
    }

    public function getGameIcon()
    {
        return $this->screenshots()->orderBy('type', 'asc')->first()->file;
    }

    public function getMaxImageType()
    {
        return $this->screenshots()->orderBy('type', 'desc')->first()->type;
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getDeveloper(){
        return $this->user()->first()->username;
    }

    public function getDeveloperIcon(){
        return $this->user()->first()->avatar;
    }

    public function genre(){
        return $this->belongsTo(Genre::class);
    }

    public function decodeGenre(){
        return $this->genre()->first()->name;
    }

    public function getPlatforms(){
        $files = $this->files()->get();
        $platforms = [0, 0, 0, 0];
        foreach($files as $file){
            $platforms[$file->type] = 1;
        }
        return $platforms;
    }

    protected $fillable = ['user_id', 'title', 'short_desctiption', 'description', 'genre', 'kind_of_content', 'classification', 'visibility'];
}
