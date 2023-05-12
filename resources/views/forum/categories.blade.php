@extends('layouts.default-layout')
@section('title')Категорії форуму@endsection

@section('css1')community.css @endsection
@section('css2')dashboard.css @endsection

@section('main_content')

<div class="community">

    <!-- General -->

    <p class="community-name">Загальні</p>

    <div class="bg-color-grey-200">
        <div class="wrapper py-2xl">
            <div class="media-scroller with-overscroll snaps-inline snaps--individual">
                @foreach($categoriesGeneral as $category)
                <a href="{{route('forum.search', $category->id)}}">
                    <div class="media-element {{$category->class}}">
                        <p class="topic-name">{{$category->name_ua}}</p>
                        <p class="topic-text">{{Str::limit($category->description, 128)}}</p>
                        <p class="topic-number"><span>2466</span> topics</p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- General -->


    <!-- hrai.space -->

    <p class="community-name">hrai.space</p>

    <div class="bg-color-grey-200">
        <div class="wrapper py-2xl">
            <div class="media-scroller with-overscroll snaps-inline snaps--individual">
                @foreach($categoriesHrai as $category)
                    <a href="{{route('forum.search', $category->id)}}">
                        <div class="media-element {{$category->class}}">
                            <p class="topic-name">{{$category->name_ua}}</p>
                            <p class="topic-text">{{Str::limit($category->description, 128)}}</p>
                            <p class="topic-number"><span>2466</span> topics</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- hrai.space -->


    <!-- Game Development -->

    <p class="community-name">Розробка ігор</p>

    <div class="bg-color-grey-200">
        <div class="wrapper py-2xl">
            <div class="media-scroller with-overscroll snaps-inline snaps--individual">
                @foreach($categoriesGame as $category)
                    <a href="{{route('forum.search', $category->id)}}">
                        <div class="media-element {{$category->class}}">
                            <p class="topic-name">{{$category->name_ua}}</p>
                            <p class="topic-text">{{Str::limit($category->description, 128)}}</p>
                            <p class="topic-number"><span>2466</span> topics</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Game Development -->


    <!-- Creativity & Art -->

    <p class="community-name">Творчість і мистецтво</p>

    <div class="bg-color-grey-200">
        <div class="wrapper py-2xl">
            <div class="media-scroller with-overscroll snaps-inline snaps--individual">
                @foreach($categoriesArt as $category)
                    <a href="{{route('forum.search', $category->id)}}">
                        <div class="media-element {{$category->class}}">
                            <p class="topic-name">{{$category->name_ua}}</p>
                            <p class="topic-text">{{Str::limit($category->description, 128)}}</p>
                            <p class="topic-number"><span>2466</span> topics</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Creativity & Art -->


</div>

@endsection