@extends('layouts.default-layout')
@section('title'){{$user->username}}@endsection

@section('css1')account.css @endsection
@section('css2')dashboard.css @endsection

@section('main_content')

<div class="profile">
    <div class="content-profile">
        <a href="#" class="company"><img src="{{Storage::disk('do')->url('images/' . $user->avatar)}}" alt="">{{$user->username}}</a>
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
        <p class="description">{{$user->description}}</p>
        <p class="topic-profile">Ігри</p>
    </div>
    <div class="bg-color-grey-200">
        <div class="wrapper py-2xl">
            <div class="media-scroller with-overscroll snaps-inline snaps--individual">
            @foreach($games as $game)
                <div class="media-element">
                    <a href="{{route('game.show', $game->id)}}"><img src="{{Storage::disk('do')->url('images/' . $game->getGameIcon())}}" alt=""></a>
                    <p class="game-name">{{$game->title}} @if($game->is_featured)<span class="iconify" data-icon="material-symbols:verified-outline-rounded"></span>@endif</p>
                    <ul class="platform-list">
                        @if($game->platforms[0] == 1)
                        <li class="platform-element">
                            <span class="iconify" data-icon="mingcute:windows-fill"></span>
                        </li>
                        @endif
                        @if($game->platforms[1] == 1)
                        <li class="platform-element">
                            <span class="iconify" data-icon="teenyicons:linux-alt-solid"></span>
                        </li>
                        @endif
                        @if($game->platforms[2] == 1)
                        <li class="platform-element">
                            <span class="iconify" data-icon="ic:baseline-apple"></span>
                        </li>
                        @endif
                        @if($game->platforms[3] == 1)
                        <li class="platform-element">
                            <span class="iconify" data-icon="uil:android"></span>
                        </li>
                        @endif
                    </ul>
                </div>
            
            @endforeach
            </div>
        </div>
    </div>
</div>

@endsection