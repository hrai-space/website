<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Game_File;
use App\Models\Game_Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MainController extends Controller
{

    public $rowperpage = 4;

    public function home()
    {
        $data['rowperpage'] = $this->rowperpage;

        $data['totalrecords'] = Game::select('*')->count();

        $data['games'] = Game::select('*')->take($this->rowperpage)->get();

        return view('home')->with('data', $data);
    }

    public function game($game_id)
    {
        $game = Game::where('id', $game_id)->first();
        $screenshots = Game_Image::where('game_id', $game_id)->get();
        $game_files = Game_File::where('game_id', $game_id)->get();

        return view('game')->with('game', $game)->with('screenshots', $screenshots)->with('game_files', $game_files);
    }

    public function getGames(Request $request)
    {

        $start = $request->get("start");

        // Fetch records
        $games = Game::select('*')->skip($start)->take($this->rowperpage)->get();

        $html = "";
        foreach ($games as $game) {
            $html .= '<div class="col-lg-6">
                <div class="card" style="width: 18rem;">
                    <img src="' . Storage::url("images/" . $game->getGameIcon()) . '" class="card-img-top" alt="image">
                    <div class="card-body">
                        <h5 class="card-title">' . $game->title . '</h5>
                        <p class="card-text">' . $game->short_description . '</p>
                        <a href="' . route("game", $game->id) . '" class="btn btn-primary">Game</a>
                    </div>
                </div>
            </div>';
        }

        $data['html'] = $html;

        return response()->json($data);
    }
}
