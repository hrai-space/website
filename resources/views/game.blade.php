@extends('layouts.app')

@section('main_content')

<div class="container">
    <div class="row">
        <div class="col-lg-4">
            @admin
            <form action="{{route('game.destroy', $game->id)}}" method="POST">
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Destroy</button>
                @csrf
            </form>
            @endadmin
            <h1>{{$game->title}}</h1>
            <h2>{{$game->short_description}}</h2>
            <h3>{{$game->description}}</h3>

            @foreach($screenshots as $screenshot)
            <img src="{{Storage::disk('do')->url('images/' . $screenshot->file)}}" alt="" style="width: 400px">
            @endforeach
        </div>
    </div>
</div>

@endsection