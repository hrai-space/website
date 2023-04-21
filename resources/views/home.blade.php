@extends('layouts.app')

@section('main_content')

<div>
    <div class="container">
        <div class="row">
            @foreach($data['games'] as $game)
            <div class="col-lg-6">
                <div class="card" style="width: 18rem;">
                    <img src="{{Storage::disk('do')->url('images/' . $game->getGameIcon())}}" class="card-img-top" alt="image">
                    <div class="card-body">
                        <h5 class="card-title">{{$game->title}}</h5>
                        <p class="card-text">{{$game->short_description}}</p>
                        <a href="{{route('game', $game->id)}}" class="btn btn-primary">Game</a>
                    </div>
                </div>
            </div>
            @endforeach
            <input type="hidden" id="start" value="0">
            <input type="hidden" id="rowperpage" value="{{ $data['rowperpage'] }}">
            <input type="hidden" id="totalrecords" value="{{ $data['totalrecords'] }}">
        </div>
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
        start = start + rowperpage;

        if (start <= allcount) {
            $('#start').val(start);

            $.ajax({
                url: "{{route('getGames')}}",
                data: {
                    start: start
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