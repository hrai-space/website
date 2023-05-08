<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\User;
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

        return response()->json(['game' => $game]);
    }

    public function getFollowed(User $user){
        return response()->json(['followed' => $user->followedGames->pluck('id')]);
    }
}
