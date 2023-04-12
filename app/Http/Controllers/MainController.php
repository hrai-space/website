<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Game_File;
use App\Models\Game_Images;
use Illuminate\Http\Request;

class MainController extends Controller
{

    public function home()
    {
        return view('home');
    }

    public function game($game_id){
        $game = Game::where('id', $game_id)->first();
        $screenshots = Game_Images::where('game_id', $game_id)->get();
        $game_files = Game_File::where('game_id', $game_id)->get();

        return view('game')->with('game', $game)->with('screenshots', $screenshots)->with('game_files', $game_files);
    }
}
