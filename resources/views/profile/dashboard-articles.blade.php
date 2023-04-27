@extends('layouts.app')

@section('main_content')

<div>
    <div class="container">
        <h1>You are logged in</h1>
        <div class="row">
            @foreach(Auth::user()->article as $article)
            <div class="col-lg-3">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{$article->title}}</h5>
                        <a href="{{route('article.show', $article->id)}}" class="btn btn-primary">Show</a>
                        <a href="{{route('article.edit', $article->id)}}" class="btn btn-primary">Edit</a>
                        <form action="{{route('article.destroy', $article->id)}}" method="POST">
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