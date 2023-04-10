@extends('layouts.app')

@section('main_content')
<style>
    #myProgress {
        width: 100%;
        background-color: grey;
    }

    #myBar {
        width: 1%;
        height: 30px;
        background-color: green;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-lg-4">
            <form>
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail" class="form-label">Title</label>
                    <input type="text" class="form-control" id="exampleInputEmail">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail" class="form-label">Short desciption</label>
                    <input type="text" class="form-control" id="exampleInputEmail">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail" class="form-label">Description</label>
                    <input type="text" class="form-control" id="exampleInputEmail">
                </div>
                <label for="exampleInputEmail" class="form-label">Game file</label>
                <div class="input-group">
                    <label class="btn btn-info" for="files-upload">Upload Game</label>
                    <input type="file" multiple="multiple" class="form-control" id="files-upload" hidden />
                </div>
                <div class="files">
                </div>
                <label for="exampleInputEmail" class="form-label">Genre</label>
                <select class="form-select" aria-label="Default select example">
                    <option value="1" selected>Action</option>
                    <option value="2">Acronim</option>
                </select>
                <label for="exampleInputEmail" class="form-label">Screenshots</label>
                <div class="input-group">
                    <label class="btn btn-info" for="upload">+</label>
                    <input name="ImageFile[]" type="file" multiple id="upload" accept="image/*" hidden />
                </div>
                <div class="screenshots">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let i = 1;
    let fileNumber = 0;
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
                        $('<p>' + files[j].name + '</p>').appendTo('div#' + element);
                        $($.parseHTML('<input hidden>')).attr('name', "GameFile[]" + fileNumber).attr('value', element).appendTo('div#' + element);
                        $($.parseHTML('<input hidden>')).attr('name', "FileName[]" + fileNumber).attr('value', files[j].name).appendTo('div#' + element);
                        $('<select name="file-type[]"><option value="0">Windows</option><option value="1">Linux</option><option value="2">MacOS</option><option value="3">Android</option></select>').appendTo('div#' + element);
                        $('<button type="button" id="delete" value="' + fileNumber + '">Delete</button>').appendTo('div#' + element);
                        fileNumber++;
                        j++;
                    });
                },
                error: function(response) {}
            });
        }

        function imagesPreview(input, placeToInsertImagePreview) {

            let url = "{{route('game.temp.image.store')}}";

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
                error: function(response) {}
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