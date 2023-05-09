<?php

use App\Http\Controllers\AppApiController;
use App\Http\Controllers\TagController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('v1/get/tags', [TagController::class, 'getTags'])->name('api.get.tags');
Route::get('v1/get/game/{game}', [AppApiController::class, 'getGame'])->name('api.get.game');
Route::get('v1/get/followed/{user}', [AppApiController::class, 'getFollowed'])->name('api.get.followed');
Route::get('v1/auth/login/{username}/{password}', [AppApiController::class, 'loginUser']);