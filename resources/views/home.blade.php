@extends('layouts.app')

@section('main_content')

<style>
    .active{
        color: red !important;
    }
</style>

<div>
    <div class="container">
        <p>Platform</p>
        <a href="{{url('filters')}}@if($usedFilters['platform'] != '/platform-0'){{'/platform-0'}}@endif{{$usedFilters['genre'] . $usedFilters['time'] . $usedFilters['other']}}?search={{$data['search']}}" class="btn btn-link @if($usedFilters['platform'] == '/platform-0') active @endif">Windows</a>
        <a href="{{url('filters')}}@if($usedFilters['platform'] != '/platform-1'){{'/platform-1'}}@endif{{$usedFilters['genre'] . $usedFilters['time'] . $usedFilters['other']}}?search={{$data['search']}}" class="btn btn-link @if($usedFilters['platform'] == '/platform-1') active @endif">Linux</a>
        <a href="{{url('filters')}}@if($usedFilters['platform'] != '/platform-2'){{'/platform-2'}}@endif{{$usedFilters['genre'] . $usedFilters['time'] . $usedFilters['other']}}?search={{$data['search']}}" class="btn btn-link @if($usedFilters['platform'] == '/platform-2') active @endif">MacOS</a>
        <a href="{{url('filters')}}@if($usedFilters['platform'] != '/platform-3'){{'/platform-3'}}@endif{{$usedFilters['genre'] . $usedFilters['time'] . $usedFilters['other']}}?search={{$data['search']}}" class="btn btn-link @if($usedFilters['platform'] == '/platform-3') active @endif">Android</a>
        <p>Genre</p>
        @foreach($genres as $genre)
            <a href="{{url('filters') . $usedFilters['platform']}}@if($usedFilters['genre'] != '/genre-' . $genre->id){{'/genre-' . $genre->id}}@endif{{$usedFilters['time'] . $usedFilters['other']}}?search={{$data['search']}}" class="btn btn-link @if($usedFilters['genre'] == '/genre-' . $genre->id) active @endif">{{$genre->name}}</a>
        @endforeach
        <p>Time</p>
        <a href="{{url('filters') . $usedFilters['platform'] . $usedFilters['genre']}}@if($usedFilters['time'] != '/new'){{'/new'}}@endif{{$usedFilters['other']}}?search={{$data['search']}}" class="btn btn-link @if($usedFilters['time'] == '/new') active @endif">Нові</a>
        <a href="{{url('filters') . $usedFilters['platform'] . $usedFilters['genre']}}@if($usedFilters['time'] != '/last-week'){{'/last-week'}}@endif{{$usedFilters['other']}}?search={{$data['search']}}" class="btn btn-link @if($usedFilters['time'] == '/last-week') active @endif">Тиждень</a>
        <a href="{{url('filters') . $usedFilters['platform'] . $usedFilters['genre']}}@if($usedFilters['time'] != '/last-month'){{'/last-month'}}@endif{{$usedFilters['other']}}?search={{$data['search']}}" class="btn btn-link @if($usedFilters['time'] == '/last-month') active @endif">Місяць</a>
        <p>Other</p>
        <a href="{{url('filters') . $usedFilters['platform'] . $usedFilters['genre'] . $usedFilters['time']}}@if($usedFilters['other'] != '/popular'){{'/popular'}}@endif?search={{$data['search']}}" class="btn btn-link @if($usedFilters['other'] == '/popular') active @endif">Популярні</a>
        <a href="{{url('filters') . $usedFilters['platform'] . $usedFilters['genre'] . $usedFilters['time']}}@if($usedFilters['other'] != '/featured'){{'/featured'}}@endif?search={{$data['search']}}" class="btn btn-link @if($usedFilters['other'] == '/featured') active @endif">Вибрані</a>
        <div class="row">
            @foreach($data['games'] as $game)
            <div class="col-lg-6">
                <div class="card" style="width: 18rem;">
                    <img src="{{Storage::disk('do')->url('images/' . $game->getGameIcon())}}" class="card-img-top" alt="image">
                    <div class="card-body">
                        <h5 class="card-title">{{$game->title}}</h5>
                        <p class="card-text">{{$game->short_description}}</p>
                        <a href="{{route('game.show', $game->id)}}" class="btn btn-primary">Game</a>
                        <a href="{{route('public.profile', $game->getDeveloper())}}" class="btn btn-outline-info">Developer</a>
                    </div>
                </div>
            </div>
            @endforeach
            <input type="hidden" id="start" value="0">
            <input type="hidden" id="rowperpage" value="{{ $data['rowperpage'] }}">
            <input type="hidden" id="totalrecords" value="{{ $data['totalrecords'] }}">
            <input type="hidden" id="search" value="{{ $data['search'] }}">
            <input type="hidden" id="filters" value="{{ $data['filters'] }}">
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
        var search = $('#search').val();
        var filters = $('#filters').val();
        start = start + rowperpage;

        if (start <= allcount) {
            $('#start').val(start);

            $.ajax({
                url: "{{route('getGames')}}",
                data: {
                    start: start,
                    search: search,
                    filters: filters,
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