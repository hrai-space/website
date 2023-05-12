
@extends('layouts.sidebar-layout')
@section('title')Бібліотека@endsection

@section('css1')list.css @endsection

@section('main_content')

<!--Content -->

<div class="content">



    <div class="section-container">
        <div class="section-name">
            <h1>Бібліотека</h1>
        </div>


        <div class="section-game-list">
            <div class="row">
                @if($games->count() == 0)
                    <h3>Ваша бібліотека пуста(</h3>
                @endif
                @foreach($games as $game)
                    <div class="col game-element">
                        <div class="game-container">
                            <a href="{{route('game.show', $game->id)}}" class="game"><img src="{{Storage::disk('do')->url('images/' . $game->getGameIcon())}}" alt="game"></a>
                            <div class="row">
                                <div class="col img">
                                    <a href="{{route('public.profile', $game->getDeveloper())}}"><img src="{{Storage::disk('do')->url('images/' . $game->getDeveloperIcon())}}" alt="game" class="container-img"></a>
                                </div>
                                <div class="col text">
                                    <p class="name">{{Str::limit($game->title, 16)}} @if($game->is_featured)<span class="iconify" data-icon="material-symbols:verified-outline-rounded"></span>@endif</p>
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
                                <p class="description">@if($game->short_description != ""){{$game->short_description}}@else{{"No description"}}@endif</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection