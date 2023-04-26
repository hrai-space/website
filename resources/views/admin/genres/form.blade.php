@extends('layouts.admin')

@section('main_content')

<main>
    <div class="container">
        <h2>Genres Form</h2>
        <form action="@isset($genre){{route('genre.update', $genre)}}@else{{route('genre.store')}}@endisset" method="post">
            @isset($genre)@method('PUT')@endisset
            @csrf
            <div class="mb-3">
                <label for="genreName" class="form-label">Genre name:</label>
                <input type="text" class="form-control" name="name" id="genreName" value="@isset($genre){{$genre->name}}@endisset">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</main>


@endsection