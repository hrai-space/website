<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AppApiController extends Controller
{
    public function getGame(Game $game){
        $screenshots = $game->screenshotsASC;
        $files = $game->files;

        foreach($screenshots as $screenshot){
            $screenshot->file = Storage::url('images/' . $screenshot->file);
        }
        foreach($files as $file){
            $file->file = Storage::url('files/' . $file->file);
        }

        $game->genre_id = $game->decodeGenre();

        return response()->json(['game' => $game], 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function getFollowed(User $user){
        $followedGames = [];
        
        foreach($user->followedGames as $game){
            array_push($followedGames, ['game_id' => $game->id, 'title' => $game->title, 'short_description' => $game->short_description, 'icon' => Storage::url('images/' . $game->getGameIcon())]);
        }
        return response()->json($followedGames);
    }

    public function loginUser($username, $password){
        if(Auth::attempt(['username' => $username, 'password' => $password]))
            $user = User::where('username', $username)->first();
            return response()->json(['user' => $user]);
        return response()->json(['error' => 'Щось пішло не так']);
    }
}
