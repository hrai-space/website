@extends('layouts.admin')

@section('main_content')

<main>
    <div class="container">
        <h2>Banners page</h2>
        <a href="{{route('banner.create')}}" class="btn btn-success">Create</a>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($banners as $banner)
                <tr>
                    <th scope="row">{{$banner->id}}</th>
                    <td>{{$banner->title}}</td>
                    <td>
                        <div class="form-inline">
                            <a href="{{route('banner.edit', $banner)}}" class="btn btn-primary">Edit</a>
                            <form action="{{route('banner.destroy', $banner)}}" method="POST">@method('DELETE')@csrf<button type="submit" class="btn btn-danger">Delete</button></form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</main>


@endsection