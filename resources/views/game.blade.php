@extends('layouts.default-layout')
@section('title'){{$game->title}}@endsection

@section('css1')gamePage.css @endsection
@section('css2')dashboard.css @endsection



@section('main_content')

<div class="game">

    <div class="img" style="position: relative;">
        <img src="{{Storage::disk('do')->url('images/' . $screenshots[0]->file)}}" alt="game" style="object-fit: cover;">
        <a href="#description"><button class="start">Грати</button></a>
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
        <div class="input-group" style="justify-content: center;">
        <form action="{{route('game.destroy', $game->id)}}" method="POST">
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Destroy</button>
            @csrf
        </form>
        <form action="{{route('game.feature', $game->id)}}" method="POST" style="margin-left: 20px;">
            @method('PUT')
            @if($game->is_featured)
            <button type="submit" name="is_featured" value="0" class="btn btn-warning">Unfeature</button>
            @else
            <button type="submit" name="is_featured" value="1" class="btn btn-warning">Feature</button>
            @endif
            @csrf
        </form>
        </div>
        @endadmin
        @if(auth()->user()->id != $game->user_id)
            <button class="follow" name="follow"><a style="color: white !important;">
            @if($is_followed) Не слідкувати <span class="iconify" data-icon="material-symbols:star-rate-rounded"></span>
            @else Слідкувати <span class="iconify" data-icon="material-symbols:star-outline-rounded"></span>@endif
            </a></button>
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

<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('button[name="follow"]').on( "click", function() {
        $.ajax({
                url: "{{route('game.follow')}}",
                type:'POST',
                data: {
                    game: '{{$game->id}}',
                },
                dataType: 'json',
                success: function(response) {
                    if(response == 0){
                        $("button[name='follow'] a").html('Слідкувати <span class="iconify" data-icon="material-symbols:star-outline-rounded"></span>');
                    }
                    else if(response == 1){
                        $("button[name='follow'] a").html('Не слідкувати <span class="iconify" data-icon="material-symbols:star-rate-rounded"></span>');
                    }
                    
                }
            });
    });
</script>

@endsection