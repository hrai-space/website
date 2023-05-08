@extends('layouts.app')

@section('main_content')

<div class="container">
    <div class="row">
        <div class="col-lg-4">
            <h1>{{$article->title}}</h1>
            {!! $article->content !!}
        </div>
    </div>
</div>

@endsection