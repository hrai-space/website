<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body style="background-color: #121416">
    <style>
        .nav-link{
            color: white !important
        }
        .card{
            background: linear-gradient(280.3deg, #E94548 1.65%, #9C57D3 97.46%);
            border-radius: 25px;
            color: white;
            font-weight: 600;
        }
        .card-link{
            text-decoration: none;
            color: white;
        }
        main{
            margin-top: 100px;
        }
        table{
            color: white !important;
        }
        h2{
            color: white;
        }
        label{
            color: white;
        }
        .pagination{
            --bs-pagination-bg: #29893;
            --bs-pagination-color: white;
            --bs-pagination-hover-color: white;
            --bs-pagination-hover-bg: #2f2f2f;
            --bs-pagination-focus-color: white;
            --bs-pagination-focus-bg: #2f2f2f;
            --bs-pagination-active-bg: #2f2f2f;
            --bs-pagination-active-border-color: white;
            --bs-pagination-disabled-bg: black;
        }
        .form-inline{
            position: relative;
            display: inline-flex;
            vertical-align: middle;
        }
        td a{
            margin-right: 15px;
        }
    </style>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="background-color: #161A1E !important;">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">{{ config('app.name', 'Laravel') }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{route('admin.dashboard')}}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{route('tag.index')}}">Tags</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{route('genre.index')}}">Genres</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    @yield('main_content')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>