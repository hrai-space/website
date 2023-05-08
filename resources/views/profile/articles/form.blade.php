@extends('layouts.app')

@section('main_content')

<div class="container">
    <div class="row">
        <form method="POST" id ="ContentForm" action="@isset($article){{route('article.update', $article)}}@else{{route('article.store')}}@endisset" >
            @isset($article)@method('PUT')@endisset
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title:</label>
                <input type="text" class="form-control" name="title" value="{{old('title', isset($article) ? $article->title : null)}}">
                @include('layouts.error', ['fieldname' => 'title'])
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content:</label>
                <div id="editor">
                    @if(old('content') != null)
                        {!! old('content') !!}
                    @elseif(isset($article)) 
                        {!! $article->content !!} 
                    @endif
                </div>
                <input type="hidden" name="content">
                @include('layouts.error', ['fieldname' => 'content'])
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-select" name="category">
                    @foreach($categories as $category)
                    <option value="{{$category->id}}" @if(old('category') == $category->id)selected @else @isset($article)@if($article->category_id == $category->id)selected @endif @endisset @endif>{{$category->name}}</option>
                    @endforeach
                </select>
                @include('layouts.error', ['fieldname' => 'category'])
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>  
</div>

<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

<!-- Include the Quill library -->
<!-- Initialize Quill editor -->
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/quill-image-resize-module@3.0.0/image-resize.min.js"></script>
<script>
    var toolbarOptions = [
        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
        [{ 'font': [] }],
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

@endsection