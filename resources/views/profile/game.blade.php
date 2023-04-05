@extends('layouts.app')

@section('main_content')

<div>
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <form>
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
            </div>
        </div>
    </div>

    @endsection