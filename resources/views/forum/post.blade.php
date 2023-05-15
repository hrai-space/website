@extends('layouts.default-layout')
@section('title')@if(Route::is('forum.show')){{$post->title}}@else{{'Пост'}}@endif @endsection

@section('css1')chat.css @endsection
@section('css2')dashboard.css @endsection

@section('main_content')

<!-- Content -->

<div class="chat">
    <div class="main-block">
    @if(Route::is('forum.create') || Route::is('forum.edit'))
        <form method="POST" id="ContentForm" action="@isset($post){{route('forum.update', $post)}}@else{{route('forum.store')}}@endisset" >
        @isset($post)@method('PUT')@endisset
        @csrf
    @endif
        @if(Route::is('forum.show'))
            <p class="main-topic">{{$post->title}}</p>
        @else
            <h3>Заголовок:</h3>
            <input type="text" id="title" class="post-input" name="title" value="{{old('title', isset($post) ? $post->title : null)}}" placeholder="Придумайте заголовок" onfocus="this.placeholder=''" onblur="this.placeholder='Придумайте заголовок'">
            @include('layouts.error', ['fieldname' => 'title'])
        @endif
        @if(Route::is('forum.show') || Route::is('forum.edit'))
        <ul class="main-list">
            <li class="main-list-item">
                <p class="main-info"> Автор: <a href="{{route('public.profile', $post->getAuthor())}}" class="white creator">{{$post->getAuthor()}},</a> <span>{{ \Carbon\Carbon::parse($post->created_at)->format('d/m/Y')}}</span> </p>
            </li>
            <li class="main-list-item">
                <p class="main-info"> Перeглядів: <span>{{$post->views}}</span> </p>
            </li>
            <li class="main-list-item">
                <p class="main-info"> Відповідей: <span>{{$post->commentCount()}}</span> </p>
            </li>
        </ul>
        @endif
        @if(Route::is('forum.show'))
            <div class="ql-snow">
                <div class="ql-editor">
                    {!! $post->content !!}
                </div>
            </div>
            <a href="#comments" class="button">Відповісти</a>
        @auth
            @if($post->user_id == Auth::user()->id || 1 == Auth::user()->is_admin)
            <a href="{{route('forum.edit', $post->id)}}" class="button edit">Редагувати</a>
            <button type="submit" form="form-delete" class="button delete">Видалити</button>
            <form action="{{route('forum.destroy', $post->id)}}" id="form-delete" method="POST">
                @method('DELETE')
                @csrf
            </form>
            @endif
        @endauth
        @else
            <h3>Контент:</h3>
                <div id="editor">
                    @if(old('content') != null)
                        {!! old('content') !!}
                    @elseif(isset($post)) 
                        {!! $post->content !!} 
                    @endif
                </div>
            <input type="hidden" name="content">

            @include('layouts.error', ['fieldname' => 'content'])
        @endif
    @if(Route::is('forum.create') || Route::is('forum.edit'))
        <input type="hidden" name="category" value="{{$category->id}}">
        <button type="submit" class="button" style="margin-top: 30px;">Опублікувати</button>
    </form>
    @endif
    
    </div>



@if(!Route::is('forum.show'))
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    <!-- Include the Quill library -->
    <!-- Initialize Quill editor -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/quill-image-resize-module@3.0.0/image-resize.min.js"></script>
    <script>
        var toolbarOptions = [
            [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
            [{ 'align': [] }],
            ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
            [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
            [{ 'script': 'sub'}, { 'script': 'super' }],
            [{ 'list': 'ordered'}, { 'list': 'bullet' }],      // superscript/subscript
            [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
            ['link', 'image'],
            ['clean']                                         // remove formatting button
        ];
        var quill = new Quill('#editor', {
            modules: {
                toolbar: toolbarOptions,
                imageResize: {
                    displaySize: true
                }
            },
            theme: 'snow'
        });
        var form = document.getElementById("ContentForm");;
        form.onsubmit = function() {
        // Populate hidden form on submit
        var content = document.querySelector('input[name=content]');
            //content.value = JSON.stringify(quill.getContents());
            content.value = quill.root.innerHTML;
            return true;
        };
        //content.value = quill.root.innerHTML;
            //content.value = quill.getText();
    </script>
@endif

    @if(Route::is('forum.show'))
    <p class="chat-topic" id="comments">Коментарі</p>
    
    <div class="chat-box">
        @auth
            <div class="first-level-comment level-comment">
                <form method="post" action="{{ route('comments.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-2">
                            <a href="{{route('public.profile', Auth::user()->username)}}"><img src="{{Storage::disk('do')->url('images/' . Auth::user()->avatar)}}" alt="logo"></a>
                        </div>
                        <div class="col">
                            <div class="box-top-info">
                                <a href="{{route('public.profile', Auth::user()->username)}}" style="text-decoration: none"><p class="first-level-nickname level-nickname">{{Auth::user()->username}}</p></a>
                                <p class="first-level-date level-date">{{\Carbon\Carbon::parse(Carbon\Carbon::now())->format('d/m/Y')}}</p>
                            </div>
                            <textarea name="text" id="describe-input" class="describe-input" rows="2" placeholder="Напишіть коментар" onfocus="this.placeholder=''" onblur="this.placeholder='Напишіть коментар'" />{{old('text')}}</textarea>
                            @include('layouts.error', ['fieldname' => 'text'])
                            <div class="box-info">
                                <input type="hidden" name="post_id" value="{{ $post->id }}" />
                                <button type="submit" class="button">Коментувати</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        @endauth
        @include('layouts.comments', ['comments' => $post->comments, 'post_id' => $post->id])
    </div>
    @endif

</div>

<script>
    $("[data-comment]").on( "click", function() {
        let comment =  $("[data-comment_id = " + $(this).data("comment") + "]");
        let parent_id = comment.find("[name = 'parent_id']").val();
        let username = comment.find(".level-nickname").text();
        $('div.temp-comment-input').remove();
        comment.after("<div class = 'second-level-comment level-comment temp-comment-input'>" + 
        "            <form method='post' action='{{ route('comments.store') }}'>" + '@csrf' +
                "<div class='row'> <div class='col-2'><a href='{{route('public.profile', Auth::user()->username)}}'><img src='{{Storage::disk('do')->url('images/' . Auth::user()->avatar)}}' alt='logo'></a>" +
                    "</div><div class='col'><div class='box-top-info'><a href='{{route('public.profile', Auth::user()->username)}}' style='text-decoration: none'><p class='first-level-nickname level-nickname'>{{Auth::user()->username}}</p>" +
                    "</a><p class='first-level-date level-date'>{{\Carbon\Carbon::parse(Carbon\Carbon::now())->format('d/m/Y')}}</p></div>" +
                    "<textarea name='text' id='describe-input' class='describe-input' rows='2' placeholder='Напишіть коментар' onfocus='this.placeholder=''' onblur='this.placeholder='Напишіть коментар'' />" + username + ", </textarea>"+
                    "@include('layouts.error', ['fieldname' => 'text'])"+
                        "<div class='box-info'>" +
                            "<input type='hidden' name='post_id' value='@isset($post->id){{ $post->id }}@endisset' /><input type='hidden' name='parent_id' value='" + parent_id + "' /><button type='submit' class='button'>Коментувати</button>" +
                        "</div></div></div></form>" 
        +"</div>").show().fadeIn("slow")
    });
</script>

<!-- Content -->

@endsection