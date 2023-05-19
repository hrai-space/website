@extends('layouts.default-layout')
@section('title')Мої ігри@endsection

@section('css1')dashboard.css @endsection
@section('css2')dashboard.css @endsection

@section('main_content')

<!-- Content -->

<div class="topic">
    <span>Creator Dashboard</span>
</div>
<div class="dashboard">
    <a href="#" class="dashboard-menu active"><span>Projects</span></a>
    <div class="row dashboard-row">
        @if(Auth::user()->game->count() != 0)
        <div class="col info-col">
            @foreach(Auth::user()->game as $game)
                <div class="info-box">
                    <div class="row">
                        <div class="col img">
                            <a href="{{route('game.show', $game)}}" class="info-img"><img src="{{Storage::disk('do')->url('images/' . $game->getGameIcon())}}" alt="info"></a>
                        </div>
                        <div class="col info d-flex align-items-center">
                            <div>
                                <a href="{{route('game.show', $game)}}"><span class="info-name">{{$game->title}}</span></a>
                                <ul class="info-list">
                                    <li class="info-list-element">
                                        <p><span>{{$game->views}}</span> переглядів</p>
                                    </li>
                                    <li class="info-list-element">
                                        <p><span>{{$game->gameDownloads->count()}}</span> завантажень</p>
                                    </li>
                                    <li class="info-list-element">
                                        <p><span>{{$game->gameFollows->count()}}</span> підписників</p>
                                    </li>
                                </ul>
                                <ul class="info-list-bottom">
                                    <li class="info-list-element-bottom">
                                        <a href="{{route('game.edit', $game->id)}}">
                                            <p>Редагувати</p>
                                        </a>
                                    </li>
                                    <li class="info-list-element-bottom">
                                    <form action="{{route('game.destroy', $game->id)}}" method="POST">
                                        @method('DELETE')
                                        <button type="submit">Видалити</button>
                                        @csrf
                                    </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>


        <div class="col analytics">
            <h1 class="analytics-header">Analytics</h1>
            <ul class="analytics-list">
                <li class="analytics-list-item">
                    <a onclick="drop()">
                        <span id="text">Game</span>
                        <span class="iconify" id="triangle" data-icon="tabler:triangle-filled"></span>
                    </a>

                    <ul class="analytics-list-hidden">
                        <li class="analytics-list-item-hidden chosed">
                            <a href="#">
                                <span>All</span>
                            </a>
                        </li>
                        <li class="analytics-list-item-hidden">
                            <a href="#">
                                <span>Call Of Duty</span>
                            </a>
                        </li>
                        <li class="analytics-list-item-hidden">
                            <a href="#">
                                <span>Battlefield</span>
                            </a>
                        </li>
                        <li class="analytics-list-item-hidden">
                            <a href="#">
                                <span>Don't Starve Together</span>
                            </a>
                        </li>
                        <li class="analytics-list-item-hidden">
                            <a href="#">
                                <span>Unturned</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="analytics-list-item">
                    <a onclick="dropSecond()">
                        <span class="side-nav-text" id="text-second">Interval</span>
                        <span class="iconify side-nav-filter-icon" id="triangle-second" data-icon="tabler:triangle-filled"></span>
                    </a>

                    <ul class="analytics-list-hidden">
                        <li class="analytics-list-item-hidden-second chosed">
                            <a href="#">
                                <span>Daily</span>
                            </a>
                        </li>
                        <li class="analytics-list-item-hidden-second">
                            <a href="#">
                                <span>Weekly</span>
                            </a>
                        </li>
                        <li class="analytics-list-item-hidden-second">
                            <a href="#">
                                <span>Monthly</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul class="analytics-list-bottom">
                <li class="analytics-list-bottom-item">
                    <p><span>332</span> переглядів</p>
                </li>
                <li class="analytics-list-bottom-item">
                    <p><span>12</span> завантажень</p>
                </li>
                <li class="analytics-list-bottom-item last">
                    <p><span>2</span> підписників</p>
                </li>
            </ul>


            <div class="chart-container" style="position: relative;height: 40vh; width:90%">
                <canvas id="views"></canvas>
            </div>


            <div class="chart-container" style="position: relative;height: 40vh; width:90%; margin-top: 50px;">
                <canvas id="downloads"></canvas>
            </div>




        </div>
    @else
    <div class="col info-col" style="padding: 50px 0 !important;">
        <h3>Ви ще не завантажили жодної гри(</h3>
    </div>
    @endif
    </div>

</div>


<!-- Content -->

@endsection