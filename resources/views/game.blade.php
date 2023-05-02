@extends('layouts.app')

@section('main_content')

<div class="container">
    <div class="row">
        <div class="col-lg-4">
            @auth
                @admin
                <form action="{{route('game.destroy', $game->id)}}" method="POST">
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Destroy</button>
                    @csrf
                </form>
                @endadmin
                @if(auth()->user()->id != $game->user_id)
                    <form action="{{route('game.follow', $game->id)}}" method="POST">
                    @method('PUT')
                    @if($is_followed)
                        <button type="submit" name="follow" value="1" class="btn btn-danger">Unfollow</button>
                    @else
                        <button type="submit" name="follow" value="0" class="btn btn-warning">Follow</button>
                    @endif
                    @csrf
                </form>
                @endif
            @endauth

            <h1>{{$game->title}}</h1>
            {!!$game->description!!}

            @foreach($screenshots as $screenshot)
            <img src="{{Storage::disk('do')->url('images/' . $screenshot->file)}}" alt="" style="width: 400px">
            @endforeach
        </div>
    </div>
</div>

@endsection