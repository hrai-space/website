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

    public function getGameIcon()
    {
        return $this->screenshots()->orderBy('type', 'asc')->first()->file;
    }

    public function getMaxImageType()
    {
        return $this->screenshots()->orderBy('type', 'desc')->first()->type;
    }

    public function search($request){
        $tags = explode(" ", $request->search);
        return $this::where(function ($query) use ($request) {
            $query->where('title', 'LIKE', "%{$request->search}%")
            ->orWhere('short_description', 'LIKE', "%{$request->search}%")
            ->orWhere('description', 'LIKE', "%{$request->search}%")->take($this->rowperpage)->get();
        })
        ->orWhereHas('tag', function ($query) use($tags) {
            $query = $query->whereIn('name', $tags);
        }, count($tags));
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getDeveloper(){
        return $this->user()->first()->username;
    }

    protected $fillable = ['user_id', 'title', 'short_desctiption', 'description', 'genre', 'kind_of_content', 'classification', 'visibility'];
}
