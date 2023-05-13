<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Article_Category::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getAuthorIcon(){
        return $this->user()->first()->avatar;
    }

    public function getAuthor(){
        return $this->user()->first()->username;
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id')->whereNull('parent_id');
    }

    public function commentCount(){
        return $this->hasMany(Comment::class, 'post_id')->count();
    }

    protected $fillable = ['user_id', 'title', 'content', 'category_id'];
}
