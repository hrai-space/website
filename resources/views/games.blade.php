
@extends('layouts.sidebar-layout')
@section('title')Фільтри@endsection

@section('css1')list.css @endsection

@section('main_content')

<!--Content -->

<div class="content">



<div class="section-container">
    <div class="section-name">
        <h1>Фільтри</h1>
    </div>


    <div class="section-game-list">
        <div class="row">
            @foreach($data['games'] as $game)
                <div class="col game-element">
                    <div class="game-container">
                        <a href="{{route('game.show', $game->id)}}" class="game"><img src="{{Storage::disk('do')->url('images/' . $game->getGameIcon())}}" alt="game"></a>
                        <div class="row">
                            <div class="col img">
                                <a href="{{route('public.profile', $game->getDeveloper())}}"><img src="{{Storage::disk('do')->url('images/' . $game->getDeveloperIcon())}}" alt="game" class="container-img"></a>
                            </div>
                            <div class="col text">
                                <p class="name">{{Str::limit($game->title, 16)}} @if($game->is_featured)<span class="iconify" data-icon="material-symbols:verified-outline-rounded"></span>@endif</p>
                                <ul class="platform-list">
                                    @if($game->platforms[0] == 1)
                                    <li class="platform-element">
                                        <span class="iconify" data-icon="mingcute:windows-fill"></span>
                                    </li>
                                    @endif
                                    @if($game->platforms[1] == 1)
                                    <li class="platform-element">
                                        <span class="iconify" data-icon="teenyicons:linux-alt-solid"></span>
                                    </li>
                                    @endif
                                    @if($game->platforms[2] == 1)
                                    <li class="platform-element">
                                        <span class="iconify" data-icon="ic:baseline-apple"></span>
                                    </li>
                                    @endif
                                    @if($game->platforms[3] == 1)
                                    <li class="platform-element">
                                        <span class="iconify" data-icon="uil:android"></span>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                            <p class="description">@if($game->short_description != ""){{$game->short_description}}@else{{"Нема опису"}}@endif</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
</div>

<input type="hidden" id="start" value="0">
<input type="hidden" id="rowperpage" value="{{ $data['rowperpage'] }}">
<input type="hidden" id="totalrecords" value="{{ $data['totalrecords'] }}">
<input type="hidden" id="search" value="{{ $data['search'] }}">
<input type="hidden" id="filters" value="{{ $data['filters'] }}">

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
                    $(".game-element:last").after(response.html).show().fadeIn("slow");

                    // Check if the page has enough content or not. If not then fetch records
                    checkWindowSize();
                }
            });
        }
    }

    $(document).on('touchmove', onScroll); // for mobile

    function onScroll() {
        if ($(window).scrollTop() > $(document).height() - $(window).height() - 500) {
            fetchData();
        }
    }

    $(window).scroll(function() {
        onScroll();
    });
</script>
<!--Content -->

@endsection