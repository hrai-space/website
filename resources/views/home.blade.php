<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body >
        <div>
            @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="card" style="width: 18rem;">
                            <img src="..." class="card-img-top" alt="image">
                            <div class="card-body">
                                <h5 class="card-title">Game name</h5>
                                <p class="card-text">Game short description</p>
                                <a href="#" class="btn btn-primary">Game</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card" style="width: 18rem;">
                            <img src="..." class="card-img-top" alt="image">
                            <div class="card-body">
                                <h5 class="card-title">Game name</h5>
                                <p class="card-text">Game short description</p>
                                <a href="#" class="btn btn-primary">Game</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card" style="width: 18rem;">
                            <img src="..." class="card-img-top" alt="image">
                            <div class="card-body">
                                <h5 class="card-title">Game name</h5>
                                <p class="card-text">Game short description</p>
                                <a href="#" class="btn btn-primary">Game</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card" style="width: 18rem;">
                            <img src="..." class="card-img-top" alt="image">
                            <div class="card-body">
                                <h5 class="card-title">Game name</h5>
                                <p class="card-text">Game short description</p>
                                <a href="#" class="btn btn-primary">Game</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card" style="width: 18rem;">
                            <img src="..." class="card-img-top" alt="image">
                            <div class="card-body">
                                <h5 class="card-title">Game name</h5>
                                <p class="card-text">Game short description</p>
                                <a href="#" class="btn btn-primary">Game</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card" style="width: 18rem;">
                            <img src="..." class="card-img-top" alt="image">
                            <div class="card-body">
                                <h5 class="card-title">Game name</h5>
                                <p class="card-text">Game short description</p>
                                <a href="#" class="btn btn-primary">Game</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
