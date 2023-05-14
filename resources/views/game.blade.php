@extends('layouts.default-layout')
@section('title'){{$game->title}}@endsection

@section('css1')gamePage.css @endsection
@section('css2')dashboard.css @endsection

@section('main_content')

<div class="game">

    <div class="img" style="position: relative;">
        <img src="{{Storage::disk('do')->url('images/' . $screenshots[0]->file)}}" alt="game" style="object-fit: cover;">
        <button class="start"><a href="#description">Грати</a></button>
    </div>

    <div class="bg-color-grey-200">
        <div class="wrapper py-2xl">
            <div class="media-scroller with-overscroll snaps-inline snaps--individual">
                @foreach($screenshots as $screenshot)
                <div class="media-element">
                    <img src="{{Storage::disk('do')->url('images/' . $screenshot->file)}}" alt="">
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="head">
        <h1 class="name">{{$game->title}}</h1>
        @auth
        @admin
        <form action="{{route('game.destroy', $game->id)}}" method="POST">
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Destroy</button>
            @csrf
        </form>
        <form action="{{route('game.feature', $game->id)}}" method="POST">
            @method('PUT')
            @if($game->is_featured)
            <button type="submit" name="is_featured" value="0" class="btn btn-warning">Unfeature</button>
            @else
            <button type="submit" name="is_featured" value="1" class="btn btn-warning">Feature</button>
            @endif
            @csrf
        </form>
        @endadmin
        @if(auth()->user()->id != $game->user_id)
        <form action="{{route('game.follow', $game->id)}}" method="POST">
            @method('PUT')
            @if($is_followed)
            <button class="follow" name="follow" value="1"><a style="color: white !important;">Unfollow <span class="iconify" data-icon="material-symbols:star-rate-rounded"></span></a></button>
            @else
            <button class="follow" name="follow" value="0"><a style="color: white !important;">Follow <span class="iconify" data-icon="material-symbols:star-outline-rounded"></span></a></button>
            @endif
            @csrf
        </form>
        @endif
        @endauth
    </div>
    <div class="description" id="description">
        <div class="ql-snow">
            <div class="ql-editor" style="overflow-wrap: break-word;">
                {!!$game->description!!}
            </div>
        </div>
    </div>

    <div class="dev-content">
        <p class="sect-name">Download</p>
        @foreach($game_files as $file)
            <p class="download">
                <a href="{{Storage::disk('do')->url('files/' . $file->file)}}">{{$file->name}}</a>
                @if($file->type == 0)
                    <span class="iconify" data-icon="mingcute:windows-fill"></span>
                @elseif($file->type == 1)
                    <span class="iconify" data-icon="teenyicons:linux-alt-solid"></span>
                @elseif($file->type == 2)
                    <span class="iconify" data-icon="ic:baseline-apple"></span>
                @elseif($file->type == 3)
                    <span class="iconify" data-icon="uil:android"></span>
                @endif
            </p>
        @endforeach
    </div>

</div>

@endsection