@extends('layouts.admin')

@section('main_content')

<main>
    <div class="container">
        <h2>Banner Form</h2>
        <form action="@isset($banner){{route('banner.update', $banner)}}@else{{route('banner.store')}}@endisset" method="post" enctype="multipart/form-data">
            @isset($banner)@method('PUT')@endisset
            @csrf
            <div class="mb-3">
                <label for="bannerName" class="form-label">Banner title:</label>
                <input type="text" class="form-control" name="title" id="bannerName" value="@isset($banner){{$banner->title}}@endisset">
            </div>
            <div class="mb-3">
                <label for="bannerLink" class="form-label">Banner link</label>
                <input type="text" class="form-control" name="link" id="bannerLink" value="@isset($banner){{$banner->link}}@endisset">
            </div>
            <div class="mb-3">
                <label for="bannerDescription" class="form-label">Banner description:</label>
                <textarea class="form-control" name="description" id="bannerDescription" rows="3">@isset($banner){{$banner->description}}@endisset</textarea>
            </div>
            <div class="mb-3">
                <label for="bannerImg" class="form-label">Img:</label>
                <input type="file" class="form-control" name="file" id="bannerImg">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</main>


@endsection