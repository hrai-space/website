<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article_Category extends Model
{
    use HasFactory;

    public function article(){
        return $this->hasMany(Article::class, 'category_id');
    }

    public function articlesCount(){
        return $this->article()->count();
    }

    public $timestamps=false;
}
