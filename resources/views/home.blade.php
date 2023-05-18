
@extends('layouts.sidebar-layout')
@section('title')Головна@endsection

@section('css1')style.css @endsection

@section('main_content')

<!--Content -->

<div class="content">




    <!--Slider -->

    <div class="blog-slider">
        <div class="blog-slider__wrp swiper-wrapper">
            @foreach($banners as $banner)
            <div class="blog-slider__item swiper-slide">
                <div class="blog-slider__img">
                    <img src="{{Storage::disk('do')->url('images/' . $banner->file)}}" alt="">
                </div>
                <div class="blog-slider__content">
                    <div class="blog-slider__title">{{$banner->title}}</div>
                    <div class="blog-slider__text">{{$banner->description}}</div>
                    <a href="{{$banner->link}}" class="blog-slider__button">Перейти</a>
                </div>
            </div>
            @endforeach

        </div>
        <div class="blog-slider__pagination"></div>
    </div>


    <!--Slider -->


    <!--Filter -->

    <div class="little-filter">
        <a href="{{url('filters')}}/featured"><button class="filter-button">Обрані</button></a>
        <a href="{{url('filters')}}/popular"><button class="filter-button">Популярні</button></a>
        <a href="{{url('filters')}}/new"><button class="filter-button">Нові</button></a>
    </div>

    <!--Filter -->


    <!--Top Certified -->

    <!--
<div class="top-certified">
    <div class="section-name">
        <h1>Top Certified</h1>
    </div>

    <div class="row">
        <div class="col game-1">
    <div class="game ">
        <a href="#" class="game-img"><img src="assets/img/1.webp" alt="game"></a>
        <div class="hover-container">
            <a href="#" class="logo"><img src="assets/img/1.png" alt="logo"></a>
            <p class="name">Dark Story <span class="iconify" data-icon="material-symbols:verified-outline-rounded"></span></p>
            <ul class="platform-list">
                <li class="platform-element">
                    <span class="iconify" data-icon="mingcute:windows-fill"></span>
                </li>
                <li class="platform-element">
                    <span class="iconify" data-icon="teenyicons:linux-alt-solid"></span>
                </li>
                <li class="platform-element">
                    <span class="iconify" data-icon="icon-park-solid:html-five"></span>
                </li>
                <li class="platform-element">
                    <span class="iconify" data-icon="ic:baseline-apple"></span>
                </li>
                <li class="platform-element">
                    <span class="iconify" data-icon="uil:android"></span>
                </li>
            </ul>

            <button class="status-button free"><a href="#">FREE</a></button>
        </div>
    </div>
</div>


<div class="col game-2">
    <div class="game ">
        <a href="#" class="game-img"><img src="assets/img/1.webp" alt="game"></a>
        <div class="hover-container">
            <a href="#" class="logo"><img src="assets/img/1.png" alt="logo"></a>
            <p class="name">Dark Story <span class="iconify" data-icon="material-symbols:verified-outline-rounded"></span></p>
            <ul class="platform-list">
                <li class="platform-element">
                    <span class="iconify" data-icon="mingcute:windows-fill"></span>
                </li>
                <li class="platform-element">
                    <span class="iconify" data-icon="teenyicons:linux-alt-solid"></span>
                </li>
                <li class="platform-element">
                    <span class="iconify" data-icon="icon-park-solid:html-five"></span>
                </li>
                <li class="platform-element">
                    <span class="iconify" data-icon="ic:baseline-apple"></span>
                </li>
                <li class="platform-element">
                    <span class="iconify" data-icon="uil:android"></span>
                </li>
            </ul>

            <button class="status-button free"><a href="#">FREE</a></button>
        </div>
    </div>
</div>

<div class="col last game-3">
    <div class="game ">
        <a href="#" class="game-img"><img src="assets/img/1.webp" alt="game"></a>
        <div class="hover-container">
            <a href="#" class="logo"><img src="assets/img/1.png" alt="logo"></a>
            <p class="name">Dark Story <span class="iconify" data-icon="material-symbols:verified-outline-rounded"></span></p>
            <ul class="platform-list">
                <li class="platform-element">
                    <span class="iconify" data-icon="mingcute:windows-fill"></span>
                </li>
                <li class="platform-element">
                    <span class="iconify" data-icon="teenyicons:linux-alt-solid"></span>
                </li>
                <li class="platform-element">
                    <span class="iconify" data-icon="icon-park-solid:html-five"></span>
                </li>
                <li class="platform-element">
                    <span class="iconify" data-icon="ic:baseline-apple"></span>
                </li>
                <li class="platform-element">
                    <span class="iconify" data-icon="uil:android"></span>
                </li>
            </ul>

            <button class="status-button free"><a href="#">FREE</a></button>
        </div>
    </div>

</div>
</div>
</div>
-->


    <div class="section-container">
        <div class="section-name">
            <h1>Обрані</h1>
            <a href="{{url('filters')}}/featured"><button class="view-button">Більше <span class="iconify" data-icon="material-symbols:arrow-right-alt-rounded"></span></button></a>
        </div>


        <div class="section-game-list">
            <div class="row">
                <div class="col">
                    <div class="game-container">
                        <a href="{{route('game.show', $featured_games[0]->id)}}" class="game"><img src="{{Storage::disk('do')->url('images/' . $featured_games[0]->getGameIcon())}}" alt="game"></a>
                        <div class="row">
                            <div class="col img">
                                <a href="{{route('public.profile', $featured_games[0]->getDeveloper())}}"><img src="{{Storage::disk('do')->url('images/' . $featured_games[0]->getDeveloperIcon())}}" alt="game" class="container-img"></a>
                            </div>
                            <div class="col text">
                                <p class="name">{{Str::limit($featured_games[0]->title, 16)}} @if($featured_games[0]->is_featured)<span class="iconify" data-icon="material-symbols:verified-outline-rounded"></span>@endif</p>
                                <ul class="platform-list">
                                    @if($featured_games[0]->platforms[0] == 1)
                                    <li class="platform-element">
                                        <span class="iconify" data-icon="mingcute:windows-fill"></span>
                                    </li>
                                    @endif
                                    @if($featured_games[0]->platforms[1] == 1)
                                    <li class="platform-element">
                                        <span class="iconify" data-icon="teenyicons:linux-alt-solid"></span>
                                    </li>
                                    @endif
                                    @if($featured_games[0]->platforms[2] == 1)
                                    <li class="platform-element">
                                        <span class="iconify" data-icon="ic:baseline-apple"></span>
                                    </li>
                                    @endif
                                    @if($featured_games[0]->platforms[3] == 1)
                                    <li class="platform-element">
                                        <span class="iconify" data-icon="uil:android"></span>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                            <p class="description">@if($featured_games[0]->short_description != ""){{$featured_games[0]->short_description}}@else{{"Нема опису"}}@endif</p>
                        </div>
                    </div>
                </div>


                <div class="col second">
                    <div class="game-container">
                        <a href="{{route('game.show', $featured_games[1]->id)}}" class="game"><img src="{{Storage::disk('do')->url('images/' . $featured_games[1]->getGameIcon())}}" alt="game"></a>
                        <div class="row">
                            <div class="col img">
                                <a href="{{route('public.profile', $featured_games[1]->getDeveloper())}}"><img src="{{Storage::disk('do')->url('images/' . $featured_games[1]->getDeveloperIcon())}}" alt="game" class="container-img"></a>
                            </div>
                            <div class="col text">
                                <p class="name">{{Str::limit($featured_games[1]->title, 16)}} @if($featured_games[1]->is_featured)<span class="iconify" data-icon="material-symbols:verified-outline-rounded"></span>@endif</p>
                                <ul class="platform-list">
                                    @if($featured_games[1]->platforms[0] == 1)
                                    <li class="platform-element">
                                        <span class="iconify" data-icon="mingcute:windows-fill"></span>
                                    </li>
                                    @endif
                                    @if($featured_games[1]->platforms[1] == 1)
                                    <li class="platform-element">
                                        <span class="iconify" data-icon="teenyicons:linux-alt-solid"></span>
                                    </li>
                                    @endif
                                    @if($featured_games[1]->platforms[2] == 1)
                                    <li class="platform-element">
                                        <span class="iconify" data-icon="ic:baseline-apple"></span>
                                    </li>
                                    @endif
                                    @if($featured_games[1]->platforms[3] == 1)
                                    <li class="platform-element">
                                        <span class="iconify" data-icon="uil:android"></span>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                            <p class="description">@if($featured_games[1]->short_description != ""){{$featured_games[1]->short_description}}@else{{"Нема опису"}}@endif</p>
                        </div>
                    </div>
                </div>



                <div class="col last">
                    <div class="game-container">
                        <a href="{{route('game.show', $featured_games[2]->id)}}" class="game"><img src="{{Storage::disk('do')->url('images/' . $featured_games[2]->getGameIcon())}}" alt="game"></a>
                        <div class="row">
                            <div class="col img">
                                <a href="{{route('public.profile', $featured_games[2]->getDeveloper())}}"><img src="{{Storage::disk('do')->url('images/' . $featured_games[2]->getDeveloperIcon())}}" alt="game" class="container-img"></a>
                            </div>
                            <div class="col text">
                                <p class="name">{{Str::limit($featured_games[2]->title, 16)}} @if($featured_games[2]->is_featured)<span class="iconify" data-icon="material-symbols:verified-outline-rounded"></span>@endif</p>
                                <ul class="platform-list">
                                    @if($featured_games[2]->platforms[0] == 1)
                                    <li class="platform-element">
                                        <span class="iconify" data-icon="mingcute:windows-fill"></span>
                                    </li>
                                    @endif
                                    @if($featured_games[2]->platforms[1] == 1)
                                    <li class="platform-element">
                                        <span class="iconify" data-icon="teenyicons:linux-alt-solid"></span>
                                    </li>
                                    @endif
                                    @if($featured_games[2]->platforms[2] == 1)
                                    <li class="platform-element">
                                        <span class="iconify" data-icon="ic:baseline-apple"></span>
                                    </li>
                                    @endif
                                    @if($featured_games[2]->platforms[3] == 1)
                                    <li class="platform-element">
                                        <span class="iconify" data-icon="uil:android"></span>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                            <p class="description">@if($featured_games[2]->short_description != ""){{$featured_games[2]->short_description}}@else{{"Нема опису"}}@endif</p>
                        </div>
                    </div>
                </div>







            </div>
        </div>
    </div>



    <!--Top Certified -->



    <!--Section -->



    <div class="section-container">
        <div class="section-name">
            <h1>Популярні</h1>
            <a href="{{url('filters')}}/popular"><button class="view-button">Більше <span class="iconify" data-icon="material-symbols:arrow-right-alt-rounded"></span></button></a>
        </div>


        <div class="section-game-list">
            <div class="row">
                <div class="col">
                    <div class="game-container">
                        <a href="{{route('game.show', $popular_games[0]->id)}}" class="game"><img src="{{Storage::disk('do')->url('images/' . $popular_games[0]->getGameIcon())}}" alt="game"></a>
                        <div class="row">
                            <div class="col img">
                                <a href="{{route('public.profile', $popular_games[0]->getDeveloper())}}"><img src="{{Storage::disk('do')->url('images/' . $popular_games[0]->getDeveloperIcon())}}" alt="game" class="container-img"></a>
                            </div>
                            <div class="col text">
                                <p class="name">{{Str::limit($popular_games[0]->title, 16)}} @if($popular_games[0]->is_featured)<span class="iconify" data-icon="material-symbols:verified-outline-rounded"></span>@endif</p>
                                <ul class="platform-list">
                                    @if($popular_games[0]->platforms[0] == 1)
                                    <li class="platform-element">
                                        <span class="iconify" data-icon="mingcute:windows-fill"></span>
                                    </li>
                                    @endif
                                    @if($popular_games[0]->platforms[1] == 1)
                                    <li class="platform-element">
                                        <span class="iconify" data-icon="teenyicons:linux-alt-solid"></span>
                                    </li>
                                    @endif
                                    @if($popular_games[0]->platforms[2] == 1)
                                    <li class="platform-element">
                                        <span class="iconify" data-icon="ic:baseline-apple"></span>
                                    </li>
                                    @endif
                                    @if($popular_games[0]->platforms[3] == 1)
                                    <li class="platform-element">
                                        <span class="iconify" data-icon="uil:android"></span>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                            <p class="description">@if($popular_games[0]->short_description != ""){{$popular_games[0]->short_description}}@else{{"Нема опису"}}@endif</p>
                        </div>
                    </div>
                </div>


                <div class="col second">
                    <div class="game-container">
                        <a href="{{route('game.show', $popular_games[1]->id)}}" class="game"><img src="{{Storage::disk('do')->url('images/' . $popular_games[1]->getGameIcon())}}" alt="game"></a>
                        <div class="row">
                            <div class="col img">
                                <a href="{{route('public.profile', $popular_games[1]->getDeveloper())}}"><img src="{{Storage::disk('do')->url('images/' . $popular_games[1]->getDeveloperIcon())}}" alt="game" class="container-img"></a>
                            </div>
                            <div class="col text">
                                <p class="name">{{Str::limit($popular_games[1]->title, 16)}} @if($popular_games[1]->is_featured)<span class="iconify" data-icon="material-symbols:verified-outline-rounded"></span>@endif</p>
                                <ul class="platform-list">
                                    @if($popular_games[1]->platforms[0] == 1)
                                    <li class="platform-element">
                                        <span class="iconify" data-icon="mingcute:windows-fill"></span>
                                    </li>
                                    @endif
                                    @if($popular_games[1]->platforms[1] == 1)
                                    <li class="platform-element">
                                        <span class="iconify" data-icon="teenyicons:linux-alt-solid"></span>
                                    </li>
                                    @endif
                                    @if($popular_games[1]->platforms[2] == 1)
                                    <li class="platform-element">
                                        <span class="iconify" data-icon="ic:baseline-apple"></span>
                                    </li>
                                    @endif
                                    @if($popular_games[1]->platforms[3] == 1)
                                    <li class="platform-element">
                                        <span class="iconify" data-icon="uil:android"></span>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                            <p class="description">@if($popular_games[1]->short_description != ""){{$popular_games[1]->short_description}}@else{{"Нема опису"}}@endif</p>
                        </div>
                    </div>
                </div>



                <div class="col last">
                    <div class="game-container">
                        <a href="{{route('game.show', $popular_games[2]->id)}}" class="game"><img src="{{Storage::disk('do')->url('images/' . $popular_games[2]->getGameIcon())}}" alt="game"></a>
                        <div class="row">
                            <div class="col img">
                                <a href="{{route('public.profile', $popular_games[2]->getDeveloper())}}"><img src="{{Storage::disk('do')->url('images/' . $popular_games[2]->getDeveloperIcon())}}" alt="game" class="container-img"></a>
                            </div>
                            <div class="col text">
                                <p class="name">{{Str::limit($popular_games[2]->title, 16)}} @if($popular_games[2]->is_featured)<span class="iconify" data-icon="material-symbols:verified-outline-rounded"></span>@endif</p>
                                <ul class="platform-list">
                                    @if($popular_games[2]->platforms[0] == 1)
                                    <li class="platform-element">
                                        <span class="iconify" data-icon="mingcute:windows-fill"></span>
                                    </li>
                                    @endif
                                    @if($popular_games[2]->platforms[1] == 1)
                                    <li class="platform-element">
                                        <span class="iconify" data-icon="teenyicons:linux-alt-solid"></span>
                                    </li>
                                    @endif
                                    @if($popular_games[2]->platforms[2] == 1)
                                    <li class="platform-element">
                                        <span class="iconify" data-icon="ic:baseline-apple"></span>
                                    </li>
                                    @endif
                                    @if($popular_games[2]->platforms[3] == 1)
                                    <li class="platform-element">
                                        <span class="iconify" data-icon="uil:android"></span>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                            <p class="description">@if($popular_games[2]->short_description != ""){{$popular_games[2]->short_description}}@else{{"Нема опису"}}@endif</p>
                        </div>
                    </div>
                </div>







            </div>
        </div>
    </div>

    <!--Section -->



    <!--Section -->



    <div class="section-container">
        <div class="section-name">
            <h1>Нові</h1>
            <a href="{{url('filters')}}/new"><button class="view-button">Більше <span class="iconify" data-icon="material-symbols:arrow-right-alt-rounded"></span></button></a>
        </div>


        <div class="section-game-list">
            <div class="row">
                <div class="col">
                    <div class="game-container">
                        <a href="{{route('game.show', $new_games[0]->id)}}" class="game"><img src="{{Storage::disk('do')->url('images/' . $new_games[0]->getGameIcon())}}" alt="game"></a>
                        <div class="row">
                            <div class="col img">
                                <a href="{{route('public.profile', $new_games[0]->getDeveloper())}}"><img src="{{Storage::disk('do')->url('images/' . $new_games[0]->getDeveloperIcon())}}" alt="game" class="container-img"></a>
                            </div>
                            <div class="col text">
                                <p class="name">{{Str::limit($new_games[0]->title, 16)}} @if($new_games[0]->is_featured)<span class="iconify" data-icon="material-symbols:verified-outline-rounded"></span>@endif</p>
                                <ul class="platform-list">
                                    @if($new_games[0]->platforms[0] == 1)
                                    <li class="platform-element">
                                        <span class="iconify" data-icon="mingcute:windows-fill"></span>
                                    </li>
                                    @endif
                                    @if($new_games[0]->platforms[1] == 1)
                                    <li class="platform-element">
                                        <span class="iconify" data-icon="teenyicons:linux-alt-solid"></span>
                                    </li>
                                    @endif
                                    @if($new_games[0]->platforms[2] == 1)
                                    <li class="platform-element">
                                        <span class="iconify" data-icon="ic:baseline-apple"></span>
                                    </li>
                                    @endif
                                    @if($new_games[0]->platforms[3] == 1)
                                    <li class="platform-element">
                                        <span class="iconify" data-icon="uil:android"></span>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                            <p class="description">@if($new_games[0]->short_description != ""){{$new_games[0]->short_description}}@else{{"Нема опису"}}@endif</p>
                        </div>
                    </div>
                </div>


                <div class="col second">
                    <div class="game-container">
                        <a href="{{route('game.show', $new_games[1]->id)}}" class="game"><img src="{{Storage::disk('do')->url('images/' . $new_games[1]->getGameIcon())}}" alt="game"></a>
                        <div class="row">
                            <div class="col img">
                                <a href="{{route('public.profile', $new_games[1]->getDeveloper())}}"><img src="{{Storage::disk('do')->url('images/' . $new_games[1]->getDeveloperIcon())}}" alt="game" class="container-img"></a>
                            </div>
                            <div class="col text">
                                <p class="name">{{Str::limit($new_games[1]->title, 16)}} @if($new_games[1]->is_featured)<span class="iconify" data-icon="material-symbols:verified-outline-rounded"></span>@endif</p>
                                <ul class="platform-list">
                                    @if($new_games[1]->platforms[0] == 1)
                                    <li class="platform-element">
                                        <span class="iconify" data-icon="mingcute:windows-fill"></span>
                                    </li>
                                    @endif
                                    @if($new_games[1]->platforms[1] == 1)
                                    <li class="platform-element">
                                        <span class="iconify" data-icon="teenyicons:linux-alt-solid"></span>
                                    </li>
                                    @endif
                                    @if($new_games[1]->platforms[2] == 1)
                                    <li class="platform-element">
                                        <span class="iconify" data-icon="ic:baseline-apple"></span>
                                    </li>
                                    @endif
                                    @if($new_games[1]->platforms[3] == 1)
                                    <li class="platform-element">
                                        <span class="iconify" data-icon="uil:android"></span>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                            <p class="description">@if($new_games[1]->short_description != ""){{$new_games[1]->short_description}}@else{{"Нема опису"}}@endif</p>
                        </div>
                    </div>
                </div>



                <div class="col last">
                    <div class="game-container">
                        <a href="{{route('game.show', $new_games[2]->id)}}" class="game"><img src="{{Storage::disk('do')->url('images/' . $new_games[2]->getGameIcon())}}" alt="game"></a>
                        <div class="row">
                            <div class="col img">
                                <a href="{{route('public.profile', $new_games[2]->getDeveloper())}}"><img src="{{Storage::disk('do')->url('images/' . $new_games[2]->getDeveloperIcon())}}" alt="game" class="container-img"></a>
                            </div>
                            <div class="col text">
                                <p class="name">{{Str::limit($new_games[2]->title, 16)}} @if($new_games[2]->is_featured)<span class="iconify" data-icon="material-symbols:verified-outline-rounded"></span>@endif</p>
                                <ul class="platform-list">
                                    @if($new_games[2]->platforms[0] == 1)
                                    <li class="platform-element">
                                        <span class="iconify" data-icon="mingcute:windows-fill"></span>
                                    </li>
                                    @endif
                                    @if($new_games[2]->platforms[1] == 1)
                                    <li class="platform-element">
                                        <span class="iconify" data-icon="teenyicons:linux-alt-solid"></span>
                                    </li>
                                    @endif
                                    @if($new_games[2]->platforms[2] == 1)
                                    <li class="platform-element">
                                        <span class="iconify" data-icon="ic:baseline-apple"></span>
                                    </li>
                                    @endif
                                    @if($new_games[2]->platforms[3] == 1)
                                    <li class="platform-element">
                                        <span class="iconify" data-icon="uil:android"></span>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                            <p class="description">@if($new_games[2]->short_description != ""){{$new_games[2]->short_description}}@else{{"Нема опису"}}@endif</p>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>



    <!--Section -->

</div>

<!--Content -->

@endsection