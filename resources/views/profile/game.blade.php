@extends('layouts.app')

@section('main_content')

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
                <label for="exampleInputEmail" class="form-label">Kind of content</label>
                <select class="form-select" aria-label="Default select example">
                    <option value="1" selected>Downloadable</option>
                    <option value="2">WebGL</option>
                </select>
                <label for="exampleInputEmail" class="form-label">Game file</label>
                <div class="input-group">
                    <input type="file" multiple="multiple" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                </div>
                <label for="exampleInputEmail" class="form-label">Genre</label>
                <select class="form-select" aria-label="Default select example">
                    <option value="1" selected>Downloadable</option>
                    <option value="2">WebGL</option>
                </select>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <form data-action="{{route('game.temp.image.store')}}" method="post" enctype="multipart/form-data" id="screenshots-temp">
                @csrf
                <label for="exampleInputEmail" class="form-label">Screenshots</label>
                <div class="input-group">
                    <label class="btn btn-info" for="upload">+</label>
                    <input name="ImageFile[]" type="file" multiple id="upload" accept="image/*" />
                </div>
                <div class="screenshots">

                </div>
            </form>
        </div>
    </div>
</div>

<script>
    var i = 0;
    var lastElement = 0;
    $(function() {
        var imagesPreview = function(input, placeToInsertImagePreview) {

            var form = $("#screenshots-temp")[0];
            var url = $(form).attr('data-action');

            $.ajax({
                url: url,
                method: 'POST',
                data: new FormData(form),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    var j = 0;
                    var length = response.success.length;
                    response.success.forEach(element => {
                        $('<div id="' + element + '"></div>').appendTo(placeToInsertImagePreview);
                        $($.parseHTML('<img>')).attr('src', "{{Storage::disk('do')->url('images/')}}" + element).css('width', '300px').appendTo('div#' + element);
                        $($.parseHTML('<input hidden>')).attr('name', "screenshots[]" + i).attr('id', 'screenshot-data').attr('value', element).appendTo('div#' + element);
                        if(i != 0)
                            $('<button type="button" id="up" value="' + i + '">Up</button>').appendTo(placeToInsertImagePreview);
                        if(j == length - 1){
                            changeLastElement();
                            lastElement = i;
                        }
                        else{
                            $('<button type="button" id="down" value="' + i + '">Down</button>').appendTo(placeToInsertImagePreview);
                        }
                        $('<button type="button" id="delete" value="' + i + '">Delete</button>').appendTo(placeToInsertImagePreview);
                        i++;
                        j++;
                    });
                },
                error: function(response) {}
            });
        };

        $('#upload').on('change', function() {
            imagesPreview(this, 'div.screenshots');
        });
        
        $('div.screenshots').on("click", 'button#up', function(){
            
            current = $("input[name='screenshots[]" + this.value + "']");
            upper = $("div.screenshots input[name='screenshots[]" + (this.value - 1) +"']");
            currentParent = current.parent();
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

        $('div.screenshots').on("click", 'button#down', function(){
            current = $("input[name='screenshots[]" + this.value + "']");
            lower = $("div.screenshots input[name='screenshots[]" + (parseInt(this.value) + 1) +"']");
            currentParent = current.parent();
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

        function changeLastElement() {
            if(lastElement != 0){
                $('<button type="button" id="down" value="' + i + '">Down</button>').appendTo($("input[name='screenshots[]" + lastElement +"']").parent());
            }
        }
    });
</script>

@endsection