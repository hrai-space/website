<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Game_File;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MainController extends Controller
{

    public $rowperpage = 4;

    public function home()
    {
        $data['rowperpage'] = $this->rowperpage;

        $data['games'] = Game::select('*')->take($this->rowperpage)->get();

        $data['totalrecords'] = $data['games']->count();
        $data['search'] = null;
        $data['filters'] = null;

        return view('home')->with('data', $data);
    }

    public function search(Request $request, $filters = null)
    {
        $data['rowperpage'] = $this->rowperpage;

        $data['games'] = $this->processFilters($filters);
        $data['games'] = $this->processSearch($request, $data['games'])->take($this->rowperpage)->get();

        $data['totalrecords'] = $data['games']->count();
        $data['search'] = $request->search;
        $data['filters'] = $filters;

        return view('home')->with('data', $data);
    }

    public function getGames(Request $request)
    {

        $start = $request->get("start");

        $games = new Game();
        $filters = $request->get("filters");

        if($filters != null){
            $games = $this->processFilters($filters);
        }
        $games = $this->processSearch($request, $games)->skip($start)->take($this->rowperpage)->get();

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

    //public function filters($filters){
    //    dd($this->processFilters($filters)->take($this->rowperpage)->get());
    //}

    function processFilters($filters){
        $filters = explode('/', $filters);
        $filterStartParameters = ['platform-', 'genre-', 'new', 'last-week', 'last-month'];
        $game = new Game();

        foreach($filters as $filter){
            if(str_starts_with($filter, $filterStartParameters[0])){
                $filter = str_replace($filterStartParameters[0], "", $filter);
                $filter = str_replace('-', " ", $filter);
                $game = $game->whereHas('files', function ($query) use($filter) {
                    $query->where('type', $filter);
                   });
            }
            else if(str_starts_with($filter, $filterStartParameters[1])){
                $filter = str_replace($filterStartParameters[1], "", $filter);
                $filter = str_replace('-', " ", $filter);
                $game = $game->where('genre', $filter);
            }
            else if(str_starts_with($filter, $filterStartParameters[2])){
                $game = $game->orderBy('id', 'desc');
            }
            else if(str_starts_with($filter, $filterStartParameters[3])){
                $game = $game->where('created_at', '>=', \Carbon\Carbon::today()->subDays(7));
            }
            else if(str_starts_with($filter, $filterStartParameters[4])){
                $game = $game->where('created_at', '>=', \Carbon\Carbon::today()->subDays(31));
            }
        }
        return $game;
    }

    function processSearch($request, $game){
        $tags = explode(" ", $request->search);
        return $game->where(function ($query) use ($request) {
            $query->where('title', 'LIKE', "%{$request->search}%")
            ->orWhere('short_description', 'LIKE', "%{$request->search}%")
            ->orWhere('description', 'LIKE', "%{$request->search}%")->take($this->rowperpage)->get();
        })
        ->orWhereHas('tag', function ($query) use($tags) {
            $query = $query->whereIn('name', $tags);
        }, count($tags));
    }
}
