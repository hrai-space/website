@extends('layouts.default-layout')
@section('title'){{$category->name_ua}}@endsection

@section('css1')discussion.css @endsection
@section('css2')dashboard.css @endsection

@section('main_content')

<!-- Content -->

<div class="discussion">
    <div class="main-block">
        <p class="main-topic">{{$category->name_ua}}</p>
        <p class="main-text">{{$category->description}}</p>
        <p class="main-numbers"><span>{{$category->articlesCount()}}</span> постів <button class="add-topic"><a href="{{route('forum.create', $category)}}">Новий пост</a></button></p>
        <ul class="main-list">
            <li class="main-list-item"><a id="texty" onclick="dropyDown()"> Переглянути правила спільноти <span class="iconify" id="triangly" data-icon="tabler:triangle-filled"></span></a>
                <ul class="main-second-list dropydown-element">
                    <li class="main-second-list-item ">
                        <p><span>Правила</span>
                            <br>
                            <br>
                            Talk about anything that doesn't have already have a specific category for. If you post here without looking at the other boards first we may close or move your topic. You can post in:
                        <ul class="description-list">
                            <li class="description-list-item">
                                <p>Release announcements for sharing game announcements</p>
                            </li>
                            <li class="description-list-item">
                                <p>Questions & Support ask the community for help related to your itch.io account or projects</p>
                            </li>
                            <li class="description-list-item">
                                <p>Get feedback for asking for feedback for your project or ideas</p>
                            </li>
                            <li class="description-list-item">
                                <p>General development for game development questions</p>
                            </li>
                            <li class="description-list-item">
                                <p>Help wanted if you're looking for game development help from other members of the community</p>
                            </li>
                            <li class="description-list-item">
                                <p>Ideas & feedback if you're having trouble with itch.io, or have an idea </p>
                            </li>
                        </ul>
                        If your post is just a link to your content with no text then it will be locked.
                        These boards are for all of itch.io, not a specific game. If you're trying to reach the developer of a game please head to their game page to find their contact information.
                        This board is not for support with your account or purchases. Please either contact support directly or post in the Questions & Support
                        </p>
                    </li>
                </ul>

            </li>
        </ul>
    </div>


    <p class="discussion-topic">Публікації</p>

    @foreach($data['posts'] as $post)
        <div class="topic-box">
            <div class="row">
                <div class="col-1">
                    <a href="{{route('public.profile', $post->getAuthor())}}"><img src="{{Storage::disk('do')->url('images/' . $post->getAuthorIcon())}}" alt="logo"></a>
                </div>
                <div class="col">
                    <p class="topic-name">{{$post->title}}</p>
                    <p class="topic-text">{{Str::limit(strip_tags($post->content), 256)}}</p>
                    <p class="topic-info">Автор: <a href="{{route('public.profile', $post->getAuthor())}}" class="creator">{{$post->getAuthor()}},</a> <span>{{ \Carbon\Carbon::parse($post->created_at)->format('d/m/Y')}}</span> <a href="{{route('forum.show', $post->id)}}" class="last-page">Читати далі <span class="iconify" data-icon="material-symbols:arrow-right-alt-rounded"></span></a></p>
                </div>
            </div>
        </div>
    @endforeach
</div>


<!-- Content -->

<input type="hidden" id="start" value="0">
<input type="hidden" id="rowperpage" value="{{ $data['rowperpage'] }}">
<input type="hidden" id="totalrecords" value="{{ $data['totalrecords'] }}">
<input type="hidden" id="search" value="{{ $data['search'] }}">
<input type="hidden" id="category" value="{{ $data['category'] }}">

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
        start = start + rowperpage;

        if (start <= allcount) {
            $('#start').val(start);

            $.ajax({
                url: "{{route('getForumPosts')}}",
                data: {
                    start: start,
                    search: search,
                    category: category,
                },
                dataType: 'json',
                success: function(response) {

                    // Add
                    $(".topic-box:last").after(response.html).show().fadeIn("slow");

                    // Check if the page has enough content or not. If not then fetch records
                    checkWindowSize();
                }
            });
        }
    }

    $(document).on('touchmove', onScroll); // for mobile

    function onScroll() {
        if ($(window).scrollTop() > $(document).height() - $(window).height() - 1000) {
            fetchData();
        }
    }

    $(window).scroll(function() {
        onScroll();
    });
</script>


@endsection