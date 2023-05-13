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
        <div class="col info-col">
            @foreach(Auth::user()->game as $game)
                <div class="info-box">
                    <div class="row">
                        <div class="col img">
                            <a href="#" class="info-img"><img src="{{Storage::disk('do')->url('images/' . $game->getGameIcon())}}" alt="info"></a>
                        </div>
                        <div class="col info">
                            <a href="#"><span class="info-name">{{$game->title}}</span></a>
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
                            </ul>
                            <button class="info-button published"><a>Published</a></button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>


        <div class="col analytics">
            <h1 class="analytics-header">Analytics</h1>
            <ul class="analytics-list">
                <li class="analytics-list-item">
                    <a href="#" onclick="drop()">
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
                    <a href="#" onclick="dropSecond()">
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
                    <p><span>332</span> views</p>
                </li>
                <li class="analytics-list-bottom-item">
                    <p><span>12</span> downloads</p>
                </li>
                <li class="analytics-list-bottom-item last">
                    <p><span>2</span> followers</p>
                </li>
            </ul>


            <div class="chart-container" style=" height:40vh; width:90%">
                <canvas id="views"></canvas>
            </div>


            <div class="chart-container" style=" height:40vh; width:90%; margin-top: 50px;">
                <canvas id="downloads"></canvas>
            </div>




        </div>
    </div>
</div>


<!-- Content -->

@endsection