<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Game_File;
use App\Models\Game_Image;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOption\None;

use function JmesPath\search;

class MainController extends Controller
{

    public $rowperpage = 4;

    public function home()
    {
        $data['rowperpage'] = $this->rowperpage;

        $data['games'] = Game::select('*')->take($this->rowperpage)->get();

        $data['totalrecords'] = $data['games']->count();
        $data['search'] = null;

        return view('home')->with('data', $data);
    }

    public function search(Request $request)
    {
        $data['rowperpage'] = $this->rowperpage;

        $data['games'] = new Game();
        $data['games'] = $data['games']->search($request)->take($this->rowperpage)->get();

        $data['totalrecords'] = $data['games']->count();
        $data['search'] = $request->search;

        return view('home')->with('data', $data);
    }

    public function getGames(Request $request)
    {

        $start = $request->get("start");

        // Fetch records
        $games = new Game();
        $games = $games->search($request)->skip($start)->take($this->rowperpage)->get();

        $html = "";
        foreach ($games as $game) {
            $html .= '<div class="col-lg-6">
                <div class="card" style="width: 18rem;">
                    <img src="' . Storage::url("images/" . $game->getGameIcon()) . '" class="card-img-top" alt="image">
                    <div class="card-body">
                        <h5 class="card-title">' . $game->title . '</h5>
                        <p class="card-text">' . $game->short_description . '</p>
                        <a href="' . route("game.show", $game->id) . '" class="btn btn-primary">Game</a>
                        <a href="' . route('public.profile', $game->getDeveloper()) . '" class="btn btn-outline-info">Developer</a>
                    </div>
                </div>
            </div>';
        }

        $data['html'] = $html;

        return response()->json($data);
    }

    public function publicProfile($username)
    {
        $user = User::where('username', $username)->first();

        return view('profile.public-profile')->with('user', $user)->with('games', $user->game);
    }
}
