<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Game_View;
use App\Models\User;
use Carbon\Carbon;
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
        if(Auth::attempt(['username' => $username, 'password' => $password])){
            $user = User::where('username', $username)->first();
            $user->avatar = Storage::url('images/' . $user->avatar);
            return response()->json(['user' => $user]);
        }

        return response()->json(['error' => 'Щось пішло не так']);
    }

    public function gameStatistic($game, $interval){
        $views = array(array(),array());

        if($game != "all"){
            $game = Game::where('id', $game)->first();
            if($interval == "daily"){
                for($i = 6; $i >= 0; $i--){
                    array_push($views[0], Carbon::today()->subDays($i)->toDateString());
                    array_push($views[1], Game_View::where('game_id', $game->id)->whereDate('created_at',\Carbon\Carbon::today()->subDays($i))->count());
                }
            }
            else if($interval == "weekly"){
                for($i = 3; $i >= 0; $i--){
                    $startDate = Carbon::today()->startOfWeek()->subWeek($i);
                    $endDate = Carbon::today()->endOfWeek()->subWeek($i);
                    array_push($views[0], $startDate->toDateString() . " - " . $endDate->toDateString());
                    array_push($views[1], Game_View::where('game_id', $game->id)->whereBetween('created_at', [$startDate, $endDate])->count());
                }
            }
        }
        else{
            if($interval == "daily"){
                for($i = 6; $i >= 0; $i--){
                    array_push($views[0], Carbon::today()->subDays($i)->toDateString());
                    foreach(Auth::user()->game->get() as $game)
                    array_push($views[1], Game_View::where('game_id', $game->id)->whereDate('created_at',\Carbon\Carbon::today()->subDays($i))->count());
                }
            }
            else if($interval == "weekly"){
                for($i = 3; $i >= 0; $i--){
                    $startDate = Carbon::today()->startOfWeek()->subWeek($i);
                    $endDate = Carbon::today()->endOfWeek()->subWeek($i);
                    array_push($views[0], $startDate->toDateString() . " - " . $endDate->toDateString());
                    array_push($views[1], Game_View::where('game_id', $game->id)->whereBetween('created_at', [$startDate, $endDate])->count());
                }
            }
        }

        return response()->json($views);
    }
}
