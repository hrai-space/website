<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function comment_like(){
        return $this->hasMany(Comment_Like::class);
    }

    public function isLiked($user_id){
        if($this->comment_like()->where('user_id', $user_id)->first() != null){
            return 1;
        }
        return 0;
    }

    use HasFactory;
}
