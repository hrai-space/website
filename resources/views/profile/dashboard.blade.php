@extends('layouts.app')

@section('main_content')

<div>
    <div class="container">
        <h1>You are logged in</h1>
        <div class="row">
            @foreach(Auth::user()->game as $game)
            <div class="col-lg-3">
                <div class="card" style="width: 18rem;">
                    <img src="{{Storage::disk('do')->url('images/' . $game->getGameIcon())}}" class="card-img-top" alt="image">
                    <div class="card-body">
                        <h5 class="card-title">{{$game->title}}</h5>
                        <p class="card-text">{{$game->short_description}}</p>
                        <a href="{{route('game.show', $game->id)}}" class="btn btn-primary">Game</a>
                        <a href="{{route('game.edit', $game->id)}}" class="btn btn-primary">Edit</a>
                        <form action="{{route('game.destroy', $game->id)}}" method="POST">
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Destroy</button>
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    @endsection