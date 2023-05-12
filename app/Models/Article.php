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

    protected $fillable = ['user_id', 'title', 'content', 'category_id'];
}
