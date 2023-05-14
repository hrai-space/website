@extends('layouts.default-layout')
@section('title')@if(Route::is('game.create')){{'Створити гру'}}@else{{'Редагувати ' . $game->title}}@endif @endsection

@section('css1')chat.css @endsection
@section('css2')dashboard.css @endsection

@section('main_content')

<!-- Content -->

<div class="chat">
    <div class="main-block">
        <form method="POST" id="GameForm" action="@isset($game){{route('game.update', $game)}}@else{{route('game.store')}}@endisset" >
        @isset($game)@method('PUT')@endisset
        @csrf
        <h3>Заголовок:</h3>
        <input type="text" id="title" class="post-input" name="title" value="{{old('title', isset($game) ? $game->title : null)}}" placeholder="Придумайте заголовок" onfocus="this.placeholder=''" onblur="this.placeholder='Придумайте заголовок'">
        @include('layouts.error', ['fieldname' => 'title'])
        <h3>Короткий опис:</h3>
        <input type="text" id="title" class="post-input" name="short_description" value="{{old('short_description', isset($game) ? $game->short_description : null)}}" placeholder="Придумайте короткий опис" onfocus="this.placeholder=''" onblur="this.placeholder='Придумайте короткий опис'">
        @include('layouts.error', ['fieldname' => 'short_description'])
        <h3>Опис:</h3>
        <div id="editor">
                    @if(old('description') != null)
                        {!! old('description') !!}
                    @elseif(isset($game)) 
                        {!! $game->description !!} 
                    @endif
                </div>
            <input type="hidden" name="description">
        @include('layouts.error', ['fieldname' => 'description'])
        <h3 style="margin-top: 30px;">Завантажте файли гри</h3>
        <p>У форматі архіву .zip</p>
        <label class="button edit" for="files-upload"><span class="iconify" data-icon="material-symbols:drive-folder-upload-outline"></span> Завантажити</label>
        <input type="file" multiple="multiple" class="form-control" id="files-upload" hidden />
        @include('layouts.error', ['fieldname' => 'GameFile'])
        @include('layouts.error', ['fieldname' => 'GameFile[]'])
        <div class="files">
            @if(old('GameFile') != null)
                @for($i = 0; $i < count(old('GameFile')); $i++)
                    <div id="{{old('GameFile.' . $i)}}" class="file-input">
                        <a href="{{Storage::disk('do')->url('files/' . old('GameFile.' . $i))}}">{{old('FileName.' . $i)}}</a>
                        <input hidden="" name="GameFile[]{{$i}}" value="{{old('GameFile.' . $i)}}">
                        <input hidden="" name="FileName[]{{$i}}" value="{{old('FileName.' . $i)}}">
                        <select name="FileType[]{{$i}}">
                            <option value="0" @if(old('FileType.' . $i) == 0) selected @endif>Windows</option>
                            <option value="1" @if(old('FileType.' . $i) == 1) selected @endif>Linux</option>
                            <option value="2" @if(old('FileType.' . $i) == 2) selected @endif>MacOS</option>
                            <option value="3" @if(old('FileType.' . $i) == 3) selected @endif>Android</option>
                        </select>
                        <button type="button" id="delete" value="{{$i}}" class="button delete">Видалити</button>
                    </div>
                @endfor
            
            @elseif(isset($game))
                @for($i = 0; $i < count($files); $i++)
                    <div id="{{$files[$i]->file}}" class="file-input">
                        <a href="{{Storage::disk('do')->url('files/' . $files[$i]->file)}}">{{$files[$i]->name}}</a>
                        <input hidden="" name="GameFile[]{{$i}}" value="{{$files[$i]->file}}">
                        <input hidden="" name="FileName[]{{$i}}" value="{{$files[$i]->name}}">
                        <select name="FileType[]{{$i}}">
                            <option value="0" @if($files[$i]->type == 0) selected @endif>Windows</option>
                            <option value="1" @if($files[$i]->type == 1) selected @endif>Linux</option>
                            <option value="2" @if($files[$i]->type == 2) selected @endif>MacOS</option>
                            <option value="3" @if($files[$i]->type == 3) selected @endif>Android</option>
                        </select>
                        <button type="button" id="delete" value="{{$i}}" class="button delete">Delete</button>
                    </div>
                @endfor
            @endif

        </div>
        <h3 style="margin-top: 30px;">Жанр</h3>
        <select name="genre">
            @foreach($genres as $genre)
            <option value="{{$genre->id}}" @if(old('genre') == $genre->id)selected @else @isset($game)@if($game->genre->id == $genre->id)selected @endif @endisset @endif>{{$genre->name}}</option>
            @endforeach
        </select>
        @include('layouts.error', ['fieldname' => 'genre'])
        <h3 style="margin-top: 30px;">Теги</h3>
        <select id="tags-select" name="tags[]" multiple="multiple">
            @isset($game)
                @foreach($tags as $tag)
                    <option value="{{$tag->id}}" selected>{{$tag->name}}</option>
                @endforeach
            @endisset
        </select>
        @include('layouts.error', ['fieldname' => 'tags'])
        @include('layouts.error', ['fieldname' => 'tags[]'])
        <h3 style="margin-top: 30px;">Зображення</h3>
        <p>*Перше зображення буде заставкою гри</p>
        <label class="button edit" for="upload"><span class="iconify" data-icon="uil:image-upload"></span> Завантажити</label>
        <input name="ImageFile[]" type="file" multiple id="upload" accept="image/*" hidden />
        @include('layouts.error', ['fieldname' => 'screenshots'])
        @include('layouts.error', ['fieldname' => 'screenshots[]'])
        <div class="screenshots" style="margin-top: 30px;">
            @if(old('screenshots') != null)
                @for($i = 0; $i < count(old('screenshots')); $i++)
                    <div id="{{old('screenshots.' . $i)}}" class="screenshot-box">
                        <img src="{{Storage::disk('do')->url('images/' . old('screenshots.' . $i))}}">
                        <input hidden="" name="screenshots[]{{$i}}" id="screenshot-data" value="{{old('screenshots.' . $i)}}">
                        <button type="button" id="up" class="button" value="{{$screenshots[$i]->type}}">Вище</button>
                        <button type="button" id="down" class="button edit" value="{{$screenshots[$i]->type}}">Нижче</button>
                        <button type="button" id="delete" class="button delete" value="{{$screenshots[$i]->type}}">Видалити</button>
                    </div>
                @endfor
            @elseif(isset($game))
                @for($i = 0; $i < count($screenshots); $i++)
                    <div id="{{$screenshots[$i]->file}}" class="screenshot-box">
                        <img src="{{Storage::disk('do')->url('images/' . $screenshots[$i]->file)}}">
                        <input hidden="" name="screenshots[]{{$screenshots[$i]->type}}" id="screenshot-data" value="{{$screenshots[$i]->file}}">
                        <button type="button" id="up" class="button" value="{{$screenshots[$i]->type}}">Вище</button>
                        <button type="button" id="down" class="button edit" value="{{$screenshots[$i]->type}}">Нижче</button>
                        <button type="button" id="delete" class="button delete" value="{{$screenshots[$i]->type}}">Видалити</button>
                    </div>
                @endfor
            @endif
        </div>
        <br>
        <button type="submit" class="button" style="margin-top: 30px;">Опублікувати</button>
        </form>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    <!-- Include the Quill library -->
    <!-- Initialize Quill editor -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <script>
        var toolbarOptions = [
            [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
            [{ 'align': [] }],
            ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
            [{ 'list': 'ordered'}, { 'list': 'bullet' }],      // superscript/subscript
            [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
            ['clean']                                         // remove formatting button
        ];
        var quill = new Quill('#editor', {
            modules: {
                toolbar: toolbarOptions,
            },
            theme: 'snow'
        });
        var form = document.getElementById("GameForm");;
        form.onsubmit = function() {
        // Populate hidden form on submit
        var content = document.querySelector('input[name=description]');
            //content.value = JSON.stringify(quill.getContents());
            content.value = quill.root.innerHTML;
            return true;
        };
        //content.value = quill.root.innerHTML;
            //content.value = quill.getText();
    </script>

<script>
    $(document).ready(function() {
        $('#tags-select').select2({
            minimumInputLength: 2,
            ajax: {
                url: '{{ route("api.get.tags") }}',
                dataType: 'json',
            },
        });
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let i = parseInt("@if(old('screenshots') != null) {{count(old('screenshots'))}}@elseif (isset($game)) {{$game->getMaxImageType()}} @else 0 @endif") + 1;
    let fileNumber = parseInt("@if(old('GameFile') != null) {{count(old('GameFile'))}}@elseif (isset($game)) {{count($files)}}@else 0 @endif") + 1;
    let lastElement = 0;

    $(function() {

        function filePreview(input, placeToInsertFilePreview) {

            let url = "{{route('game.temp.file.store')}}";

            let files = $('#files-upload')[0].files;
            let form_data = new FormData();

            for (let x = 0; x < files.length; x++) {
                form_data.append('GameFile[]', files[x])
            }

            var bar = $('.bar');
            var percent = $('.percent');
            var status = $('#status');

            $.ajax({
                url: url,
                method: 'POST',
                data: form_data,
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    let j = 0;
                    response.success.forEach(element => {
                        $('<div id="' + element + '"></div>').attr('class', 'file-input').appendTo(placeToInsertFilePreview);
                        $('<a href="{{Storage::disk("do")->url("files/")}}' + element + '">' + files[j].name + '</a>').appendTo('div#' + element);
                        $($.parseHTML('<input hidden>')).attr('name', "GameFile[]" + fileNumber).attr('value', element).appendTo('div#' + element);
                        $($.parseHTML('<input hidden>')).attr('name', "FileName[]" + fileNumber).attr('value', files[j].name).appendTo('div#' + element);
                        $('<select name="FileType[]"><option value="0">Windows</option><option value="1">Linux</option><option value="2">MacOS</option><option value="3">Android</option></select>').appendTo('div#' + element);
                        $('<button type="button" id="delete" value="' + fileNumber + '" class="button delete">Видалити</button>').appendTo('div#' + element);
                        fileNumber++;
                        j++;
                    });
                },
                error: function(response) {
                    $.each(response.responseJSON.errors,function(field_name,error){
                        $('<div class="alert alert-warning alert-dismissible fade show" id="ImageFile-error" role="alert" style="margin-top: 75px;">' + error + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>').appendTo('div.files');
                    })
                }
            });
        }

        function imagesPreview(input, placeToInsertImagePreview) {

            let url = "{{route('game.temp.file.store')}}";

            let files = $('#upload')[0].files;
            let form_data = new FormData();

            for (let x = 0; x < files.length; x++) {
                form_data.append('ImageFile[]', files[x])
            }


            $.ajax({
                url: url,
                method: 'POST',
                data: form_data,
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    let j = 0;
                    let length = response.success.length;
                    response.success.forEach(element => {
                        $('<div id="' + element + '" class="screenshot-box"></div>').appendTo(placeToInsertImagePreview);
                        $($.parseHTML('<img>')).attr('src', "{{Storage::disk('do')->url('images/')}}" + element).css('width', '300px').appendTo('div#' + element);
                        $($.parseHTML('<input hidden>')).attr('name', "screenshots[]" + i).attr('id', 'screenshot-data').attr('value', element).appendTo('div#' + element);
                        //if (i != 1)
                        //    $('<button type="button" id="up" value="' + i + '">Up</button>').appendTo('div#' + element);
                        //if (j == length - 1) {
                        //    changeLastElement(0);
                        //    lastElement = i;
                        //} else {
                        //    $('<button type="button" id="down" value="' + i + '">Down</button>').appendTo('div#' + element);
                        //}
                        $('<button type="button" id="up" class="button" value="' + i + '">Вище</button>').appendTo('div#' + element);
                        $('<button type="button" id="down" class="button edit" value="' + i + '">Нижче</button>').appendTo('div#' + element);
                        $('<button type="button" id="delete" class="button delete" value="' + i + '">Видалити</button>').appendTo('div#' + element);
                        i++;
                        j++;
                    });
                },
                error: function(response) {
                    $.each(response.responseJSON.errors,function(field_name,error){
                        $('<div class="alert alert-warning alert-dismissible fade show" id="ImageFile-error" role="alert" style="margin-top: 75px;">' + error + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>').appendTo('div.screenshots');
                    })
                    
                }
            });
        }

        function deleteImage(input) {

            let parent = $("input[name='screenshots[]" + input.value + "']").parent();
            let parentId = parent.attr('id');



            //if(lastElement == input.value){
            //    changeLastElement(1);
            //}
            //if($('div.screenshots').children(':first-child').attr('id') == parentId){
            //    console.log(1);
            //    parent.remove();
            //    changeFirstElement(0);
            //}
            //else{
            //    console.log(2);
            //    parent.remove();
            //}

            parent.remove();
            $("div.screenshots button[value = '" + input.value + "']").remove();


            $.ajax({
                url: "{{ route('game.temp.image.delete') }}",
                method: 'POST',
                data: {
                    FileName: parentId
                },
                contentType: 'application/x-www-form-urlencoded; charset=utf-8',
                cache: false,
                success: function(response) {
                    console.log("200");
                },
                error: function(response) {}
            });
        };

        function deleteFile(input) {

            let parent = $("input[name='GameFile[]" + input.value + "']").parent();
            let parentId = parent.attr('id');

            parent.remove();

            $.ajax({
                url: "{{ route('game.temp.file.delete') }}",
                method: 'POST',
                data: {
                    FileName: parentId
                },
                contentType: 'application/x-www-form-urlencoded; charset=utf-8',
                cache: false,
                success: function(response) {
                    console.log("200");
                },
                error: function(response) {}
            });
        };


        $('#upload').on('change', function() {
            imagesPreview(this, 'div.screenshots');
        });

        $('#files-upload').on('change', function() {
            filePreview(this, 'div.files');
        });

        $('div.screenshots').on("click", 'button#delete', function() {
            deleteImage(this);
        });

        $('div.screenshots').on("click", 'button#up', function() {
            current = $("input[name='screenshots[]" + this.value + "']");
            currentParent = current.parent();
            upper = currentParent.prev().find("input#screenshot-data");
            upperParent = upper.parent();

            currentImgPath = currentParent.find('img').attr('src');
            upperImgPath = upperParent.find('img').attr('src');

            upperParent.find('img').attr('src', currentImgPath);
            currentParent.find('img').attr('src', upperImgPath);

            upper.attr('value', currentParent.attr('id'));
            current.attr('value', upperParent.attr('id'));

            temp = currentParent.attr('id');
            currentParent.attr('id', upperParent.attr('id'));
            upperParent.attr('id', temp);
        });

        $('div.screenshots').on("click", 'button#down', function() {
            current = $("input[name='screenshots[]" + this.value + "']");
            currentParent = current.parent();
            lower = currentParent.next().find("input#screenshot-data");
            lowerParent = lower.parent();

            currentImgPath = currentParent.find('img').attr('src');
            lowerImgPath = lowerParent.find('img').attr('src');

            lowerParent.find('img').attr('src', currentImgPath);
            currentParent.find('img').attr('src', lowerImgPath);

            lower.attr('value', currentParent.attr('id'));
            current.attr('value', lowerParent.attr('id'));

            temp = currentParent.attr('id');
            currentParent.attr('id', lowerParent.attr('id'));
            lowerParent.attr('id', temp);
        });

        $('div.files').on("click", 'button#delete', function() {
            deleteFile(this);
        });

        //function changeLastElement(type) {
        //    if(type == 0){
        //        if (lastElement != 0) {
        //            $('<button type="button" id="down" value="' + lastElement + '">Down</button>').insertAfter($("button#up[value='" + lastElement + "']"));
        //        }
        //    }
        //    else if(type == 1){
        //        lastElement--;
        //        $("div.screenshots button#down[value = '" + lastElement + "']").remove();
        //    }
        //}

        //function changeFirstElement(type) {
        //    if(type == 0){
        //        $('div.screenshots').children(':first-child').find("button#up").remove();
        //    }
        //    else if(type == 1){
        //        $('div.screenshots').children(':first-child').find("button#down").remove();
        //    }
        //}
    });
</script>
    

<!-- Content -->

@endsection