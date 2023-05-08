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

    protected $fillable = ['user_id', 'title', 'content', 'category_id'];
}
