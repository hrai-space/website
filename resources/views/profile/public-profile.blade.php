@extends('layouts.app')

@section('main_content')

<div>
    <div class="container">
        <h1>{{$user->username}}</h1>
        @auth
            @admin
                <form action="{{route('profile.admin', $user)}}" method="POST">
                    @method('PUT')
                    @if($user->is_admin)
                        <button type="submit" name="is_admin" value="0" class="btn btn-warning">Unmade admin</button>
                    @else
                        <button type="submit" name="is_admin" value="1" class="btn btn-warning">Make admin</button>
                    @endif
                    @csrf
                </form>
            @endadmin
        @endauth
        <h3>{{$user->description}}</h3>
        <div class="row">
            @foreach($games as $game)
            <div class="col-lg-3">
                <div class="card" style="width: 18rem;">
                    <img src="{{Storage::disk('do')->url('images/' . $game->getGameIcon())}}" class="card-img-top" alt="image">
                    <div class="card-body">
                        <h5 class="card-title">{{$game->title}}</h5>
                        <p class="card-text">{{$game->short_description}}</p>
                        <a href="{{route('game.show', $game->id)}}" class="btn btn-primary">Game</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    @endsection