@extends('layouts.admin')

@section('main_content')

<main>
    <div class="container">
        <h2>Category Form</h2>
        <form action="@isset($category){{route('category.update', $category)}}@else{{route('category.store')}}@endisset" method="post">
            @isset($category)@method('PUT')@endisset
            @csrf
            <div class="mb-3">
                <label for="categoryName" class="form-label">Category name:</label>
                <input type="text" class="form-control" name="name" id="categoryName" value="@isset($category){{$category->name}}@endisset">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</main>


@endsection