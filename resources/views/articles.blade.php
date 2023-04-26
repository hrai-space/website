@extends('layouts.app')

@section('main_content')

<div class="container">
    <div class="row">
        @foreach($data['articles'] as $article)
        <div class="col-lg-6">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">{{$article->title}}</h5>
                    <a href="{{route('article.show', $article->id)}}" class="btn btn-primary">Show</a>
                </div>
            </div>
        </div>
        @endforeach
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
        start = start + rowperpage;

        if (start <= allcount) {
            $('#start').val(start);

            $.ajax({
                url: "{{route('getArticles')}}",
                data: {
                    start: start,
                    search: search
                },
                dataType: 'json',
                success: function(response) {

                    // Add
                    $(".col-lg-6:last").after(response.html).show().fadeIn("slow");

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