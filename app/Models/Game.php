<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    public function tag()
    {
        return $this->belongsToMany(Tag::class, 'game_tags');
    }

    public function gameImages(){
        return $this->hasMany(Game_Images::class);
    }

    public function getGameIcon()
    {
        return $this->gameImages()->orderBy('type', 'asc')->first()->file;
    }

    protected $fillable = ['user_id', 'title', 'short_desctiption', 'description', 'genre', 'kind_of_content', 'classification', 'visibility'];
}
