@extends('layouts.app')

@section('main_content')

<div class="container">
    <form class=" mt-3 mb-3" role="search" method="GET" action="@if(Route::is('articles.search')){{URL::current()}}@else{{route('articles.search')}}@endif">
        <div class="d-flex mt-3 mb-3">
            <input class="form-control me-2" type="search" name="search" placeholder="@isset($data['search']){{$data['search']}}@else Search @endisset" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </div>
    </form>
    <div class="d-flex mt-3 mb-3">
        <label for="category" class="form-label me-3">Category</label>
        <a class="me-3" href="{{route('articles.search', $data['filters']) }}">All</a>
        @foreach($categories as $category)
        <a class="me-3" href="{{route('articles.search', 'category-'.$category->id.'/'.$data['filters']) }}">{{$category->name}}</a>
        @endforeach
    </div>
    <div class="d-flex mt-3 mb-3">
        <label for="filters" class="form-label me-3">Filters</label>
        <a class="me-3" href="{{route('articles.search', $data['category']) }}">Without filters</a>
        <a class="me-3" href="{{route('articles.search', $data['category'].'new') }}">New</a>
        <a class="me-3" href="{{route('articles.search', $data['category'].'last-week') }}">Last Week</a>
        <a class="me-3" href="{{route('articles.search', $data['category'].'last-month') }}">Last Month</a>
    </div>  
    <div class="row">
        @foreach($data['articles'] as $article)
        <div class="col-lg-10">
            <div class="card" style="width: 50rem;">
                <div class="card-body">
                    <h5 class="card-title">{{$article->title}}</h5>
                    <a href="{{route('article.show', $article->id)}}" class="btn btn-primary">Show</a>
                </div>
            </div>
        </div>
        @endforeach
        <input type="hidden" id="start" value="0">
        <input type="hidden" id="rowperpage" value="{{ $data['rowperpage'] }}">
        <input type="hidden" id="totalrecords" value="{{ $data['totalrecords'] }}">
        <input type="hidden" id="search" value="{{ $data['search'] }}">
        <input type="hidden" id="category" value="{{ $data['category'] }}">
        <input type="hidden" id="filters" value="{{ $data['filters'] }}">
    </div>  
</div>

<script>
    checkWindowSize();

    // Check if the page has enough content or not. If not then fetch records
    function checkWindowSize() {
        if ($(window).height() >= $(document).height()) {
            // Fetch records
            fetchData();
        }
    }

    // Fetch records
    function fetchData() {
        var start = Number($('#start').val());
        var allcount = Number($('#totalrecords').val());
        var rowperpage = Number($('#rowperpage').val());
        var search = $('#search').val();
        var category = $('#category').val();
        var filters = $('#filters').val();
        start = start + rowperpage;

        if (start <= allcount) {
            $('#start').val(start);

            $.ajax({
                url: "{{route('getArticles')}}",
                data: {
                    start: start,
                    search: search,
                    category: category,
                    filters: filters
                },
                dataType: 'json',
                success: function(response) {

                    // Add
                    $(".col-lg-10:last").after(response.html).show().fadeIn("slow");

                    // Check if the page has enough content or not. If not then fetch records
                    checkWindowSize();
                }
            });
        }
    }

    $(document).on('touchmove', onScroll); // for mobile

    function onScroll() {
        if ($(window).scrollTop() > $(document).height() - $(window).height() - 100) {
            fetchData();
        }
    }

    $(window).scroll(function() {
        onScroll();
    });
</script>

@endsection