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

    public $rowperpage = 6;
    public $gameFilterParameters = ['platform-', 'genre-', 'new', 'last-week', 'last-month', 'popular', 'featured'];

    public function home()
    {
        $featured_games = Game::where('is_featured', 1)->take(3)->latest()->get();
        $popular_games = Game::orderBy('views', 'desc')->take(3)->latest()->get();
        $new_games = Game::latest()->get();

        $data['search'] = null;

        foreach($featured_games as $game){
            $game->platforms = $game->getPlatforms();
        }

        foreach($popular_games as $game){
            $game->platforms = $game->getPlatforms();
        }

        foreach($new_games as $game){
            $game->platforms = $game->getPlatforms();
        }

        return view('home')->with('featured_games', $featured_games)->with('genres', Genre::all())->with('popular_games', $popular_games)
        ->with('new_games', $new_games)->with('usedFilters', array('platform' => '', 'genre' => '', 'time' => '', 'other' => ''))
        ->with('data', $data);
    }

    public function forum()
    {
        $categoriesGeneral = $this->addClassToForumCategories(Article_Category::where('type', 0)->get());
        $categoriesHrai = $this->addClassToForumCategories(Article_Category::where('type', 1)->get());
        $categoriesGame = $this->addClassToForumCategories(Article_Category::where('type', 2)->get());
        $categoriesArt = $this->addClassToForumCategories(Article_Category::where('type', 3)->get());

        return view('forum.categories')->with('categoriesGeneral', $categoriesGeneral)->with('categoriesHrai', $categoriesHrai)
        ->with('categoriesGame', $categoriesGame)->with('categoriesArt', $categoriesArt);
    }

    function addClassToForumCategories($categories){
        $categoryElements = ['first-element', 'second-element', 'third-element'];

        $i = 0;
        foreach($categories as $category){
            $category->class = $categoryElements[$i];
            $i++;
            if($i == 3){
                $i = 0;
            }
        }

        return $categories;
    }

    public function search(Request $request, $filters = null)
    {
        if($filters == null && $request->search == null){
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

        foreach($data['games'] as $game){
            $game->platforms = $game->getPlatforms();
        }

        return view('games')->with('data', $data)->with('usedFilters', $usedFilters)->with('genres', Genre::all());
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

    public function forumSearch(Request $request, Article_Category $category)
    {
        $posts = Article::where('category_id', $category->id);

        $data['rowperpage'] = $this->rowperpage;

        $data['posts'] = $this->processPostsSearch($request, $posts)->take($this->rowperpage)->get();

        $data['totalrecords'] = $data['posts']->count();
        $data['search'] = $request->search;
        $data['category'] = $category->id;

        return view('forum.category')->with('data', $data)->with('category', $category);
    }

    public function getGames(Request $request)
    {

        $start = $request->get("start");

        $filters = $request->get("filters");
        $filters = explode('/', $filters);
        if ($filters != null) {
            $games = $this->processFilters($filters);
        }
        $games = $this->processSearch($request, $games)->skip($start)->take($this->rowperpage)->get();

        foreach($games as $game){
            $game->platforms = $game->getPlatforms();
        }
        $html = "";
        foreach ($games as $game) {
            if($game->short_description == ""){
                $game->short_description = 'No description';
            }

            $html .= '
            <div class="col game-element">
            <div class="game-container">
                <a href="' . route('game.show', $game->id) . '" class="game"><img src="' . Storage::url("images/" . $game->getGameIcon()) . '" alt="game"></a>
                <div class="row">
                    <div class="col img">
                        <a href="' . route('public.profile', $game->getDeveloper()) . '"><img src="' . Storage::url("images/" . $game->getDeveloperIcon()) . '" alt="game" class="container-img"></a>
                    </div>
                    <div class="col text">
                        <p class="name">' . Str::limit($game->title, 16);
            if($game->is_featured){
                $html .= '<span class="iconify" data-icon="material-symbols:verified-outline-rounded"></span>';
            }
            $html .= '</p><ul class="platform-list">';
            
            if($game->platforms[0] == 1){
                $html .= '<li class="platform-element">
                <span class="iconify" data-icon="mingcute:windows-fill"></span>
            </li>';
            }
            if($game->platforms[1] == 1){
                $html .= '<li class="platform-element">
                <span class="iconify" data-icon="teenyicons:linux-alt-solid"></span>
            </li>';
            }
            if($game->platforms[2] == 1){
                $html .= '<li class="platform-element">
                <span class="iconify" data-icon="ic:baseline-apple"></span>
            </li>';
            }
            if($game->platforms[3] == 1){
                $html .= '<li class="platform-element">
                <span class="iconify" data-icon="uil:android"></span>
            </li>';
            }
                    
            $html .= '</ul>
                    </div>
                    <p class="description">' . $game->short_description . '</p>
                </div>
            </div>
        </div>';
        }

        $data['html'] = $html;

        return response()->json($data);
    }

    public function getForumPosts(Request $request)
    {

        $start = $request->get("start");

        // Fetch records
        $category = $request->get("category");
        $posts = Article::where('category_id', $category);

        $posts = $this->processPostsSearch($request, $posts)->skip($start)->take($this->rowperpage)->get();

        $html = "";
        foreach ($posts as $post) {
            $html .= '<div class="topic-box">
                    <div class="row">
                        <div class="col-1">
                            <a href="' . route('public.profile', $post->getAuthor()) . '"><img src="' . Storage::url("images/" . $post->getAuthorIcon()) . '" alt="logo"></a>
                        </div>
                        <div class="col">
                            <p class="topic-name">' . $post->title . '</p>
                            <p class="topic-text">' . Str::limit(strip_tags($post->content), 256) . '</p>
                            <p class="topic-info"><a href="' . route('public.profile', $post->getAuthor()) . '" class="creator">' . $post->getAuthor() . ',</a> <span>' . \Carbon\Carbon::parse($post->created_at)->format('d/m/Y') . '</span> <a href="' . route('forum.show', $post->id) . '" class="last-page">Читати далі <span class="iconify" data-icon="material-symbols:arrow-right-alt-rounded"></span></a></p>
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

        if ($user != null){
            $games = $user->game;

            foreach($games as $game){
                $game->platforms = $game->getPlatforms();
            }
            return view('profile.public-profile')->with('user', $user)->with('games', $games);
        }
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
                $games = $games->where('genre_id', $filter);
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

    function processPostsSearch($request, $article)
    {
        return $article->where(function ($query) use ($request) {
            $query->where('title', 'LIKE', "%{$request->search}%")
                ->orWhere('content', 'LIKE', "%{$request->search}%")->take($this->rowperpage)->get();
        });
    }
}
