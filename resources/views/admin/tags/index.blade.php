@extends('layouts.admin')

@section('main_content')

<main>
    <div class="container">
        <h2>Tags page</h2>
        <a href="{{route('tag.create')}}" class="btn btn-success">Create</a>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tags as $tag)
                <tr>
                    <th scope="row">{{$tag->id}}</th>
                    <td>{{$tag->name}}</td>
                    <td>
                        <div class="form-inline">
                            <a href="{{route('tag.edit', $tag)}}" class="btn btn-primary">Edit</a>
                            <form action="{{route('tag.destroy', $tag)}}" method="POST">@method('DELETE')@csrf<button type="submit" class="btn btn-danger">Delete</button></form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {!! $tags->links() !!}
    </div>
</main>


@endsection