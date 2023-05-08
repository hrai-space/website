<?php

namespace App\Models;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    public function game()
    {
        return $this->hasMany(Game::class);
    }

    public function following(){
        return $this->hasMany(Game_Follow::class);
    }

    public function isFollowed($game_id){
        if($this->following()->where('game_id', $game_id)->first() != null){
            return 1;
        }
        return 0;
    }

    public function followedGames(){
        return $this->belongsToMany(Game::class, 'game__follows');
    }

    public function article()
    {
        return $this->hasMany(Article::class);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'avatar',
        'is_admin',
        'description'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin(){
        return $this->is_admin === 1;
    }
}
