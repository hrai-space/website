<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Article_Category;
use App\Models\Game;
use App\Models\Game_File;
use App\Models\Genre;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class MainController extends Controller
{

    public $rowperpage = 4;
    public $gameFilterParameters = ['platform-', 'genre-', 'new', 'last-week', 'last-month', 'popular', 'featured'];

    public function home()
    {
        $data['rowperpage'] = $this->rowperpage;

        $data['games'] = Game::select('*')->take($this->rowperpage)->get();

        $data['totalrecords'] = $data['games']->count();
        $data['search'] = null;
        $data['filters'] = null;

        return view('home')->with('data', $data)->with('genres', Genre::all())->with('usedFilters', array('platform' => '', 'genre' => '', 'time' => '', 'other' => ''));
    }

    public function articles()
    {
        $categories = Article_Category::all();
        $data['rowperpage'] = $this->rowperpage;

        $data['articles'] = Article::select('*')->take($this->rowperpage)->get();

        $data['totalrecords'] = $data['articles']->count();
        $data['search'] = null;
        $data['category'] = null;
        $data['filters'] = null;
        return view('articles')->with('data', $data)->with('categories', $categories);
    }

    public function search(Request $request, $filters = null)
    {
        if($filters == null){
            return redirect()->route('home');
        }
        
        $data['filters'] = $filters;

        $filters = explode('/', $filters);

        $data['rowperpage'] = $this->rowperpage;
        $data['games'] = $this->processFilters($filters);
        $data['games'] = $this->processSearch($request, $data['games'])->take($this->rowperpage)->get();

        $data['totalrecords'] = $data['games']->count();
        $data['search'] = $request->search;

        $usedFilters = $this->prepareUsedFilters($filters);

        return view('home')->with('data', $data)->with('usedFilters', $usedFilters)->with('genres', Genre::all());
    }

    public function prepareUsedFilters($filters){

        $usedFilters = array('platform' => '', 'genre' => '', 'time' => '', 'other' => '');
        foreach($filters as $filter){
            if (str_starts_with($filter, $this->gameFilterParameters[0])) {
                $usedFilters['platform'] = '/' . $filter;
            } else if (str_starts_with($filter, $this->gameFilterParameters[1])) {
                $usedFilters['genre'] = '/' .  $filter;
            } else if (str_starts_with($filter, $this->gameFilterParameters[2])) {
                $usedFilters['time'] = '/' .  $filter;
            } else if (str_starts_with($filter, $this->gameFilterParameters[3])) {
                $usedFilters['time'] = '/' .  $filter;
            } else if (str_starts_with($filter, $this->gameFilterParameters[4])) {
                $usedFilters['time'] = '/' .  $filter;
            } else if (str_starts_with($filter, $this->gameFilterParameters[5])) {
                $usedFilters['other'] = '/' .  $filter;
            } else if (str_starts_with($filter, $this->gameFilterParameters[6])) {
                $usedFilters['other'] = '/' .  $filter;
            }
        }
        return $usedFilters;
    }

    public function articlesSearch(Request $request, $filters = null)
    {
        $category = null;
        if (isset($filters)) {
            $filters = explode('/', $filters);
            $bool = true;
            for ($i = count($filters) - 1; $i >= 0; $i--) {
                if (str_starts_with($filters[$i], 'category-')) {
                    $category = implode('/', array_slice($filters, 0, $i + 1)) . '/';
                    if (count($filters) > $i + 1) {
                        $filters = implode('/', array_slice($filters, $i + 1));
                    } else {
                        $filters = null;
                    }
                    $bool = false;
                    break;
                }
            }
            if ($bool) {
                $filters = implode('/', $filters);
            }
        }
        //dd($category, $filters);
        $categories = Article_Category::all();
        $data['rowperpage'] = $this->rowperpage;

        $data['articles'] = $this->processArticlesFilters($category . $filters);
        $data['articles'] = $this->processArticlesSearch($request, $data['articles'])->take($this->rowperpage)->get();

        $data['totalrecords'] = $data['articles']->count();
        $data['search'] = $request->search;
        $data['category'] = $category;
        $data['filters'] = $filters;

        return view('articles')->with('data', $data)->with('categories', $categories);
    }

    public function getGames(Request $request)
    {

        $start = $request->get("start");

        $games = new Game();
        $filters = $request->get("filters");

        if ($filters != null) {
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

    public function getArticles(Request $request)
    {

        $start = $request->get("start");

        // Fetch records
        $articles = new Article();
        $filters = $request->get("filters");
        $category = $request->get("category");

        if ($category != null or $filters != null) {
            $articles = $this->processArticlesFilters($category, $filters);
        }
        $articles = $this->processArticlesSearch($request, $articles)->skip($start)->take($this->rowperpage)->get();

        $html = "";
        foreach ($articles as $article) {
            $html .= '<div class="col-lg-10">
                <div class="card" style="width: 50rem;">
                    <div class="card-body">
                        <h5 class="card-title">' . $article->title . '</h5>
                        <a href="' . route("article.show", $article->id) . '" class="btn btn-primary">Show</a>
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

        $games = $user->game;

        foreach($games as $game){
            $game->platforms = $game->getPlatforms();
        }

        if ($user != null)
            return view('profile.public-profile')->with('user', $user)->with('games', $games);
        else
            return abort(404);
    }

    //public function filters($filters){
    //    dd($this->processFilters($filters)->take($this->rowperpage)->get());
    //}

    function processFilters($filters)
    {
        $games = new Game();

        foreach ($filters as $filter) {
            if (str_starts_with($filter, $this->gameFilterParameters[0])) {
                $filter = str_replace($this->gameFilterParameters[0], "", $filter);
                $filter = str_replace('-', " ", $filter);
                $games = $games->whereHas('files', function ($query) use ($filter) {
                    $query->where('type', $filter);
                });
            } else if (str_starts_with($filter, $this->gameFilterParameters[1])) {
                $filter = str_replace($this->gameFilterParameters[1], "", $filter);
                $filter = str_replace('-', " ", $filter);
                $games = $games->where('genre', $filter);
            } else if (str_starts_with($filter, $this->gameFilterParameters[2])) {
                $games = $games->latest();
            } else if (str_starts_with($filter, $this->gameFilterParameters[3])) {
                $games = $games->where('created_at', '>=', \Carbon\Carbon::today()->subDays(7))->latest();
            } else if (str_starts_with($filter, $this->gameFilterParameters[4])) {
                $games = $games->where('created_at', '>=', \Carbon\Carbon::today()->subDays(31))->latest();
            } else if (str_starts_with($filter, $this->gameFilterParameters[5])) {
                $games = $games->orderBy('views', 'desc');
            } else if (str_starts_with($filter, $this->gameFilterParameters[6])) {
                $games = $games->where('is_featured', '1');
            }
        }
        return $games;
    }

    function processArticlesFilters($filters)
    {
        $filters = explode('/', $filters);
        $filterStartParameters = ['category-', 'new', 'last-week', 'last-month', 'popular'];
        $article = new Article();

        foreach ($filters as $filter) {
            if (str_starts_with($filter, $filterStartParameters[0])) {
                $filter = str_replace($filterStartParameters[0], "", $filter);
                $filter = str_replace('-', " ", $filter);
                $article = $article->where('category_id', $filter);
            } else if (str_starts_with($filter, $filterStartParameters[1])) {
                $article = $article->latest();
            } else if (str_starts_with($filter, $filterStartParameters[2])) {
                $article = $article->where('created_at', '>=', \Carbon\Carbon::today()->subDays(7));
            } else if (str_starts_with($filter, $filterStartParameters[3])) {
                $article = $article->where('created_at', '>=', \Carbon\Carbon::today()->subDays(31));
            } else if (str_starts_with($filter, $filterStartParameters[4])) {
                $article = $article->orderBy('views', 'desc');
            }
        }
        return $article;
    }

    function processSearch($request, $game)
    {
        $tags = explode(" ", $request->search);
        return $game->where(function ($query) use ($request) {
            $query->where('title', 'LIKE', "%{$request->search}%")
                ->orWhere('short_description', 'LIKE', "%{$request->search}%")
                ->orWhere('description', 'LIKE', "%{$request->search}%")->take($this->rowperpage)->get();
        })
            ->orWhereHas('tag', function ($query) use ($tags) {
                $query = $query->whereIn('name', $tags);
            }, count($tags));
    }

    function processArticlesSearch($request, $article)
    {
        return $article->where(function ($query) use ($request) {
            $query->where('title', 'LIKE', "%{$request->search}%")
                ->orWhere('content', 'LIKE', "%{$request->search}%")->take($this->rowperpage)->get();
        });
    }
}
