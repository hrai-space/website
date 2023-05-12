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
            <div class="mb-3">
                <label for="categoryName" class="form-label">Category name_ua:</label>
                <input type="text" class="form-control" name="name_ua" id="categoryName" value="@isset($category){{$category->name_ua}}@endisset">
            </div>
            <div class="mb-3">
                <label for="categoryDescription" class="form-label">Category description:</label>
                <textarea class="form-control" name="description" id="categoryDescription" rows="3">@isset($category){{$category->description}}@endisset</textarea>
            </div>
            <div class="mb-3">
                <label for="categoryType" class="form-label">Category type:</label>
                <input type="text" class="form-control" name="type" id="categoryType" value="@isset($category){{$category->type}}@endisset">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</main>


@endsection