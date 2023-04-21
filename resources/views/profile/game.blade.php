@extends('layouts.app')

@section('main_content')

<div class="container">
    <div class="row">
        <div class="col-lg-4">
            <form method="POST" action="@isset($game){{route('game.update', $game)}}@else{{route('game.store')}}@endisset">
                @isset($game)@method('PUT')@endisset
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail" class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" value="{{old('title', isset($game) ? $game->title : null)}}">
                    @include('layouts.error', ['fieldname' => 'title'])
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail" class="form-label">Short desrciption</label>
                    <input type="text" class="form-control" name="short_description" value="{{old('short_description', isset($game) ? $game->short_description : null)}}">
                    @include('layouts.error', ['fieldname' => 'short_description'])
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail" class="form-label">Description</label>
                    <input type="text" class="form-control" name="description" value="{{old('description', isset($game) ? $game->description : null)}}">
                    @include('layouts.error', ['fieldname' => 'description'])
                </div>
                <label for="exampleInputEmail" class="form-label">Game file</label>
                <div class="input-group">
                    <label class="btn btn-info" for="files-upload">Upload Game</label>
                    <input type="file" multiple="multiple" class="form-control" id="files-upload" hidden />
                    @include('layouts.error', ['fieldname' => 'GameFile'])
                    @include('layouts.error', ['fieldname' => 'GameFile[]'])
                </div>
                <div class="files">
                    @if(old('GameFile') != null)
                        @for($i = 0; $i < count(old('GameFile')); $i++)
                            <div id="{{old('GameFile.' . $i)}}" style="background-color: #f2f2f2;">
                                <a href="{{Storage::disk('do')->url('files/' . old('GameFile.' . $i))}}">{{old('FileName.' . $i)}}</a>
                                <input hidden="" name="GameFile[]{{$i}}" value="{{old('GameFile.' . $i)}}">
                                <input hidden="" name="FileName[]{{$i}}" value="{{old('FileName.' . $i)}}">
                                <select name="FileType[]">
                                    <option value="0" @if(old('FileType.' . $i) == 0) selected @endif>Windows</option>
                                    <option value="1" @if(old('FileType.' . $i) == 1) selected @endif>Linux</option>
                                    <option value="2" @if(old('FileType.' . $i) == 2) selected @endif>MacOS</option>
                                    <option value="3" @if(old('FileType.' . $i) == 3) selected @endif>Android</option>
                                </select>
                                <button type="button" id="delete" value="{{$i}}">Delete</button>
                            </div>
                        @endfor
                    
                    @elseif(isset($game))
                        @for($i = 0; $i < count($files); $i++)
                            <div id="{{$files[$i]->file}}" style="background-color: #f2f2f2;">
                                <a href="{{Storage::disk('do')->url('files/' . $files[$i]->file)}}">{{$files[$i]->name}}</a>
                                <input hidden="" name="GameFile[]{{$i}}" value="{{$files[$i]->file}}">
                                <input hidden="" name="FileName[]{{$i}}" value="{{$files[$i]->name}}">
                                <select name="FileType[]">
                                    <option value="0" @if($files[$i]->type == 0) selected @endif>Windows</option>
                                    <option value="1" @if($files[$i]->type == 1) selected @endif>Linux</option>
                                    <option value="2" @if($files[$i]->type == 2) selected @endif>MacOS</option>
                                    <option value="3" @if($files[$i]->type == 3) selected @endif>Android</option>
                                </select>
                                <button type="button" id="delete" value="{{$i}}">Delete</button>
                            </div>
                        @endfor
                    @endif

                </div>
                <label for="exampleInputEmail" class="form-label">Genre</label>
                <select class="form-select" name="genre">
                    @foreach($genres as $genre)
                    <option value="{{$genre->id}}" @if(old('genre') == $genre->id)selected @else @isset($game)@if($game->genre == $genre->id)selected @endif @endisset @endif>{{$genre->name}}</option>
                    @endforeach
                </select>
                @include('layouts.error', ['fieldname' => 'genre'])
                <label for="exampleInputEmail" class="form-label">Tags</label>
                <select class="form-select" id="tags-select" name="tags[]" multiple="multiple">
                    @foreach($tags as $tag)
                        <option value="{{$tag->id}}"
                            @for($i = 0; $i < count($tags); $i++)
                                @if(old('tags.' . $i) == $tag->id)
                                    selected
                                @endif
                            @endfor
                            @isset($game)
                                @for($i = 0; $i < count($gameTags); $i++)
                                    @if($gameTags[$i]['id'] == $tag->id)
                                        selected
                                    @endif
                                @endfor
                            @endisset
                        >{{$tag->name}}</option>
                    @endforeach
                </select>
                @include('layouts.error', ['fieldname' => 'tags'])
                @include('layouts.error', ['fieldname' => 'tags[]'])
                <label for="exampleInputEmail" class="form-label">Screenshots</label>
                <div class="input-group">
                    <label class="btn btn-info" for="upload">+</label>
                    <input name="ImageFile[]" type="file" multiple id="upload" accept="image/*" hidden />
                </div>
                @include('layouts.error', ['fieldname' => 'screenshots'])
                @include('layouts.error', ['fieldname' => 'screenshots[]'])
                <div class="screenshots">
                    @if(old('screenshots') != null)
                        @for($i = 0; $i < count(old('screenshots')); $i++)
                            <div id="{{old('screenshots.' . $i)}}">
                                <img src="{{Storage::disk('do')->url('images/' . old('screenshots.' . $i))}}" style="width: 300px;">
                                <input hidden="" name="screenshots[]{{$i}}" id="screenshot-data" value="{{old('screenshots.' . $i)}}">
                                <button type="button" id="up" value="{{$i}}">Up</button>
                                <button type="button" id="down" value="{{$i}}">Down</button>
                                <button type="button" id="delete" value="{{$i}}">Delete</button>
                            </div>
                        @endfor
                    @elseif(isset($game))
                        @for($i = 0; $i < count($screenshots); $i++)
                            <div id="{{$screenshots[$i]->file}}">
                                <img src="{{Storage::disk('do')->url('images/' . $screenshots[$i]->file)}}" style="width: 300px;">
                                <input hidden="" name="screenshots[]{{$screenshots[$i]->type}}" id="screenshot-data" value="{{$screenshots[$i]->file}}">
                                <button type="button" id="up" value="{{$screenshots[$i]->type}}">Up</button>
                                <button type="button" id="down" value="{{$screenshots[$i]->type}}">Down</button>
                                <button type="button" id="delete" value="{{$screenshots[$i]->type}}">Delete</button>
                            </div>
                        @endfor
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#tags-select').select2();
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
                        $('<div id="' + element + '"></div>').attr('style', 'background-color: #f2f2f2;').appendTo(placeToInsertFilePreview);
                        $('<a href="{{Storage::disk("do")->url("files/")}}' + element + '">' + files[j].name + '</a>').appendTo('div#' + element);
                        $($.parseHTML('<input hidden>')).attr('name', "GameFile[]" + fileNumber).attr('value', element).appendTo('div#' + element);
                        $($.parseHTML('<input hidden>')).attr('name', "FileName[]" + fileNumber).attr('value', files[j].name).appendTo('div#' + element);
                        $('<select name="FileType[]"><option value="0">Windows</option><option value="1">Linux</option><option value="2">MacOS</option><option value="3">Android</option></select>').appendTo('div#' + element);
                        $('<button type="button" id="delete" value="' + fileNumber + '">Delete</button>').appendTo('div#' + element);
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
                        $('<div id="' + element + '"></div>').appendTo(placeToInsertImagePreview);
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
                        $('<button type="button" id="up" value="' + i + '">Up</button>').appendTo('div#' + element);
                        $('<button type="button" id="down" value="' + i + '">Down</button>').appendTo('div#' + element);
                        $('<button type="button" id="delete" value="' + i + '">Delete</button>').appendTo('div#' + element);
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

@endsection