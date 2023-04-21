<?php

use App\Http\Controllers\DoSpacesController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProfileController;
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



Route::get('/', [MainController::class, 'home'])->name('home');
Route::get('/getGames', [MainController::class, 'getGames'])->name('getGames');
Route::get('game/{game_id}', [MainController::class, 'game'])->where('game_id', '[0-9]+')->name('game');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::middleware(['is_owner'])->group(function () {
        Route::resource('game', GameController::class);
    });
    Route::get('/dashboard', [ProfileController::class, 'dashboard'])->name('dashboard');
    Route::post('/game/temp/image/store', [DoSpacesController::class, 'storeTempFile'])->name('game.temp.file.store');
    Route::post('/game/temp/image/delete', [DoSpacesController::class, 'deleteTempFile'])->name('game.temp.image.delete');
    Route::post('/game/temp/file/delete', [DoSpacesController::class, 'deleteTempGameFile'])->name('game.temp.file.delete');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile', [DoSpacesController::class, 'store'])->name('profile.image.store');
});

require __DIR__.'/auth.php';
