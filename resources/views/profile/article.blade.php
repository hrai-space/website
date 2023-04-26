@extends('layouts.app')

@section('main_content')

<div class="container">
    <div class="row">
        <form method="POST" id ="ContentForm" action="{{route('article.store')}}" >
            @csrf
            <label for="title" class="form-label">Title:</label>
            <input type="text" class="form-control" name="title" >
            <label for="content" class="form-label">Content:</label>
            <div id="editor"></div>
            <input type="hidden" name="content">
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>  
</div>

<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

<!-- Include the Quill library -->
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

<!-- Initialize Quill editor -->
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
        toolbar: toolbarOptions
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