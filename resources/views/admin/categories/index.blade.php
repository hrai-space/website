@extends('layouts.admin')

@section('main_content')

<main>
    <div class="container">
        <h2>Categories page</h2>
        <a href="{{route('category.create')}}" class="btn btn-success">Create</a>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Name_ua</th>
                    <th scope="col">Type</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <th scope="row">{{$category->id}}</th>
                    <td>{{$category->name}}</td>
                    <td>{{$category->name_ua}}</td>
                    <td>{{$category->type}}</td>
                    <td>
                        <div class="form-inline">
                            <a href="{{route('category.edit', $category)}}" class="btn btn-primary">Edit</a>
                            <form action="{{route('category.destroy', $category)}}" method="POST">@method('DELETE')@csrf<button type="submit" class="btn btn-danger">Delete</button></form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</main>


@endsection