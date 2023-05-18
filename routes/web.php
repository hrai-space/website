<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DoSpacesController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//ONLY FOR DEV
Route::get('clear-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('optimize');
    Artisan::call('route:cache');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('config:cache');
    Artisan::call('config:clear');
    return "All Cache Cleared !!!";
});

Route::get('/', [MainController::class, 'home'])->name('home');
Route::get('/forum/categories', [MainController::class, 'forum'])->name('forum');
Route::get('/getArticles', [MainController::class, 'getForumPosts'])->name('getForumPosts');
Route::get('/forum/category/{category}', [MainController::class, 'forumSearch'])->where('category', '[0-9]+')->name('forum.search');
Route::get('/filters/{filters?}', [MainController::class, 'search'])->name('search')->where('filters', '(.*)');
Route::get('/getGames', [MainController::class, 'getGames'])->name('getGames');
Route::get('/profile/{username}', [MainController::class, 'publicProfile'])->name('public.profile');
Route::get('/game/{game}', [GameController::class, 'show'])->where('game', '[0-9]+')->name('game.show');
Route::get('/forum/{post}', [ArticleController::class, 'show'])->where('post', '[0-9]+')->name('forum.show');
Route::get('/game/download/{file_id}', [GameController::class, 'download'])->name('game.download');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::middleware(['is_owner'])->group(function () {
        Route::get('/game', [GameController::class, 'index'])->name('game.index');
        Route::get('/game/create', [GameController::class, 'create'])->name('game.create');
        Route::post('/game', [GameController::class, 'store'])->name('game.store');
        Route::get('/game/{game}/edit', [GameController::class, 'edit'])->name('game.edit');
        Route::put('/game/{game}', [GameController::class, 'update'])->name('game.update');
        Route::delete('/game/{game}', [GameController::class, 'destroy'])->name('game.destroy');
        Route::get('/forum', [ArticleController::class, 'index'])->name('forum.index');
        Route::get('/forum/create/{category}', [ArticleController::class, 'create'])->where('category', '[0-9]+')->name('forum.create');
        Route::post('/forum', [ArticleController::class, 'store'])->name('forum.store');
        Route::get('/forum/{post}/edit', [ArticleController::class, 'edit'])->name('forum.edit');
        Route::put('/forum/{post}', [ArticleController::class, 'update'])->name('forum.update');
        Route::delete('/forum/{post}', [ArticleController::class, 'destroy'])->name('forum.destroy');
    });
    Route::post('/forum/comments/like', [ArticleController::class, 'like'])->name('comments.like');
    Route::post('comments', [ArticleController::class, 'storeComment'])->name('comments.store');
    Route::post('/game/follow', [GameController::class, 'follow'])->name('game.follow');
    Route::get('/followed', [ProfileController::class, 'followed'])->name('game.followed');
    Route::get('/dashboard/games', [ProfileController::class, 'dashboardGames'])->name('dashboard.games');
    Route::get('/dashboard/forums', [ProfileController::class, 'dashboardArticles'])->name('dashboard.forums');
    Route::post('/game/temp/image/store', [DoSpacesController::class, 'storeTempFile'])->name('game.temp.file.store');
    Route::post('/game/temp/image/delete', [DoSpacesController::class, 'deleteTempFile'])->name('game.temp.image.delete');
    Route::post('/game/temp/file/delete', [DoSpacesController::class, 'deleteTempGameFile'])->name('game.temp.file.delete');
    Route::middleware(['is_admin'])->group(function () {
        Route::put('/game/feature/{game}', [GameController::class, 'feature'])->name('game.feature');
        Route::put('/profile/admin/{user}', [ProfileController::class, 'admin'])->name('profile.admin');
        Route::prefix('admin')->group(function () {
            Route::resource('tag', TagController::class);
            Route::resource('genre', GenreController::class);
            Route::resource('category', CategoryController::class);
            Route::resource('banner', BannerController::class);
            Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        });
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile', [DoSpacesController::class, 'store'])->name('profile.image.store');
});

require __DIR__.'/auth.php';
