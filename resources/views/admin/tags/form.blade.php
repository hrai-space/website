@extends('layouts.admin')

@section('main_content')

<main>
    <div class="container">
        <h2>Tags Form</h2>
        <form action="@isset($tag){{route('tag.update', $tag)}}@else{{route('tag.store')}}@endisset" method="post">
            @isset($tag)@method('PUT')@endisset
            @csrf
            <div class="mb-3">
                <label for="tagName" class="form-label">Tag name:</label>
                <input type="text" class="form-control" name="name" id="tagName" value="@isset($tag){{$tag->name}}@endisset">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</main>


@endsection