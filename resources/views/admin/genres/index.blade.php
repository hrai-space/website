@extends('layouts.admin')

@section('main_content')

<main>
    <div class="container">
        <h2>Genres page</h2>
        <a href="{{route('genre.create')}}" class="btn btn-success">Create</a>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($genres as $genre)
                <tr>
                    <th scope="row">{{$genre->id}}</th>
                    <td>{{$genre->name}}</td>
                    <td>
                        <div class="form-inline">
                            <a href="{{route('genre.edit', $genre)}}" class="btn btn-primary">Edit</a>
                            <form action="{{route('genre.destroy', $genre)}}" method="POST">@method('DELETE')@csrf<button type="submit" class="btn btn-danger">Delete</button></form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</main>


@endsection