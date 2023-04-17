<?php

namespace App\Http\Controllers;

use App\Http\Requests\GameUploadRequest;
use App\Models\Game;
use App\Models\Game_File;
use App\Models\Game_Images;
use App\Models\Game_Tag;
use App\Models\Genre;
use App\Models\Tag;
use App\Models\Temp_File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = Tag::all();
        $genres = Genre::all();
        return view('profile.game')->with('tags', $tags)->with('genres', $genres);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GameUploadRequest $request)
    {
        $game = new Game();

        $game->user_id = $request->user()->id;
        $game->title = $request->title;
        $game->short_description = $request->short_description;
        $game->description = $request->description;
        $game->kind_of_content = 0;
        $game->classification = 0;
        $game->genre = $request->genre;
        $game->visibility = 1;
        
        $game->save();

        for ($i=0; $i < count($request->GameFile); $i++) { 
            $gameFile = new Game_File();
            $gameFile->game_id = $game->id;
            $gameFile->file = $request->GameFile[$i];
            $gameFile->name = $request->FileName[$i];
            $gameFile->type = $request->FileType[$i];
            $gameFile->save();
            Temp_File::where('file', $request->GameFile[$i])->delete();
        }

        foreach ($request->tags as $tag) { 
            $gameTag = new Game_Tag();
            $gameTag->game_id = $game->id;
            $gameTag->tag_id = $tag;
            $gameTag->save();
        }

        for ($i=0; $i < count($request->screenshots); $i++) { 
            $screenshot = new Game_Images();
            $screenshot->game_id = $game->id;
            $screenshot->type = $i+1;
            $screenshot->file = $request->screenshots[$i];
            $screenshot->save();
            Temp_File::where('file', $request->screenshots[$i])->delete();
        }
        
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     */
    public function show(Game $game)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Game $game)
    {
        $tags = Tag::all();
        $genres = Genre::all();
        return view('profile.game')->with('tags', $tags)->with('genres', $genres)->with('game', $game)->with('gameTags', $game->tag)
        ->with('screenshots', $game->screenshotsASC)->with('files', $game->files);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GameUploadRequest $request, Game $game)
    {
        $game->title = $request->title;
        $game->short_description = $request->short_description;
        $game->description = $request->description;
        $game->genre = $request->genre;

        $game->save();
        for ($i=0; $i < count($request->GameFile); $i++) {
            if(!Game_File::where('file', $request->GameFile[$i])->where('game_id', $game->id)->exists()){
                $gameFile = new Game_File();
                $gameFile->game_id = $game->id;
                $gameFile->file = $request->GameFile[$i];
                $gameFile->name = $request->FileName[$i];
                $gameFile->type = $request->FileType[$i];
                $gameFile->save();
                Temp_File::where('file', $request->GameFile[$i])->delete();
            }
        }

        $tagArray = [];

        foreach ($request->tags as $tag) {
            if(!Game_Tag::where('tag_id', $tag)->where('game_id', $game->id)->exists()){
                $gameTag = new Game_Tag();
                $gameTag->game_id = $game->id;
                $gameTag->tag_id = $tag;
                $gameTag->save();
            }
            array_push($tagArray, $tag);
        }

        Game_Tag::where('game_id', $game->id)->whereNotIn('tag_id', $tagArray)->delete();

        for ($i=0; $i < count($request->screenshots); $i++) {
            if(!Game_Images::where('file', $request->screenshots[$i])->where('game_id', $game->id)->exists()){
                $screenshot = new Game_Images();
                $screenshot->game_id = $game->id;
                $screenshot->type = $i+1;
                $screenshot->file = $request->screenshots[$i];
                $screenshot->save();
                Temp_File::where('file', $request->screenshots[$i])->delete();
            }
        }

        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game $game)
    {
        //
    }
}
