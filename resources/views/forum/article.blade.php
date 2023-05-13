@extends('layouts.app')

@section('main_content')

<div class="container">
    <div class="row">
        <div class="col-lg-4">
            <h1>{{$article->title}}</h1>
            {!! $article->content !!}
        </div>
    </div>
</div>
        <!--@foreach($comments as $comment)
            <div class="@if($comment->parent_id == null)first-level-comment @else second-level-comment @endif level-comment">
                <div class="row">
                    <div class="col-2">
                        <a href="#"><img src="assets/img/1.png" alt="logo"></a>
                    </div>
                    <div class="col">
                        <div class="box-top-info">
                            <p class="level-nickname">{{$comment->user->username}}</p>
                            <p class="level-date">1 year ago</p>
                        </div>
                        <p class="level-text">{{$comment->text}}</p>
                        <div class="box-info">
                            <a href="#" class="level-like"><span class="iconify" data-icon="ant-design:like-outlined"></span> Like</a>
                            <a href="#" class="level-reply">Reply</a>
                            <a href="#" class="level-report yp-trigger">Report</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach-->
@endsection