@extends('layouts.app')

@section('main_content')

<div>
    <div class="container">
        <h1>You are logged in</h1>
        <div class="row">
            <div class="col-lg-3">
                <div class="card" style="width: 18rem;">
                    <img src="..." class="card-img-top" alt="image">
                    <div class="card-body">
                        <h5 class="card-title">Your Game</h5>
                        <p class="card-text">Game short description</p>
                        <a href="#" class="btn btn-primary">Game</a>
                        <a href="#" class="btn btn-primary">Edit</a>
                        <a href="#" class="btn btn-primary">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
