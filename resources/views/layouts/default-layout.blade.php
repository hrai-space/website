<!DOCTYPE html>
<html lang="en" prefix="og: http://ogp.me/ns#">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - @yield('title')</title>

    <meta property="og:title" content="@if(isset($game)){{$game->title}}@elseif(isset($post)){{$post->title}}@else{{config('app.name')}} - @yield('title')@endif">
    <meta property="og:image" content="@isset($game){{Storage::disk('do')->url('images/' . $screenshots[0]->file)}}@else{{asset('/assets/img/hrai.jpg')}}@endisset">
    <meta property="og:description" content="@if(isset($game)){{Str::limit(strip_tags($game->description), 256)}}@elseif(isset($post)){{Str::limit(strip_tags($post->content), 256)}}@else{{'Сайт для інді розробників ігор та їх фанатів'}}@endif">
    <meta property="og:url" content="{{Request::url()}}">
    <meta name="twitter:card" content="summary_large_image">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{asset('/assets/img/icon.png')}}" type="image/icon type">
    <!-- Style CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('/assets/css')}}/@yield('css1')">
    <link rel="stylesheet" href="{{asset('/assets/css')}}/@yield('css2')">
    <link rel="stylesheet" href="{{asset('/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/css/null.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.5/css/swiper.min.css">
    
    
    <!-- Style CSS -->


</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

    @include('layouts.menu')
    
    <!-- Content -->

    @yield('main_content')

    <!-- Content -->

    @include('layouts.contact')

    @include('layouts.sign-in', ['class' => 'pop'])
    @include('layouts.sign-up', ['class' => 'popup'])

    @include('layouts.footer')
    <!-- Script -->

    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.5/js/swiper.min.js"></script>
    <script src="{{asset('/assets/js/script.js')}}"></script>

    <!-- Script -->




</body>


</html>