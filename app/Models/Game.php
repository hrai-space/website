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
        return $this->hasMany(Game_Images::class);
    }

    public function screenshotsASC(){
        return $this->hasMany(Game_Images::class)->orderBy('type', 'asc');
    }

    public function files(){
        return $this->hasMany(Game_File::class);
    }

    public function getGameIcon()
    {
        return $this->screenshots()->orderBy('type', 'asc')->first()->file;
    }

    public function getMaxImageType()
    {
        return $this->screenshots()->orderBy('type', 'desc')->first()->type;
    }

    protected $fillable = ['user_id', 'title', 'short_desctiption', 'description', 'genre', 'kind_of_content', 'classification', 'visibility'];
}
