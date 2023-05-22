<!DOCTYPE html>
<html lang="en" prefix="og: http://ogp.me/ns#">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - @yield('title')</title>
    <link rel="icon" href="{{asset('/assets/img/icon.png')}}" type="image/icon type">
    <meta property="og:title" content="{{config('app.name')}} - @yield('title')">
    <meta property="og:image" content="{{asset('/assets/img/hrai.jpg')}}">
    <meta property="og:description" content="Сайт для інді розробників ігор та їх фанатів">
    <meta property="og:url" content="{{Request::url()}}">
    <meta name="twitter:card" content="summary_large_image">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{asset('/assets/css')}}/@yield('css1')">
    <link rel="stylesheet" href="{{asset('/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/css/null.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.5/css/swiper.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.5/css/swiper.min.css">

    <!-- Style CSS -->


</head>

<body>

    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

    <!-- Side Menu -->
    <div class="row">



        <div class="col-sm-1">




            <div class="side-menu">
                <div class="side-nav" id="side-nav">

                    <span class="nav-img">
                        <img src="{{URL::asset('assets/img/logo.svg')}}" alt="logo">
                    </span>
                    <ul class="side-list">
                        <li class="list-element">
                            <a href="{{route('home')}}">
                                <span class="iconify" data-icon="material-symbols:dashboard-outline-rounded"></span>
                                <span class="side-nav-text">Головна</span>
                            </a>
                        </li>
                        <li class="list-element">
                            <a href="{{route('search')}}/new">
                                <span class="iconify" data-icon="pepicons-pop:controller"></span>
                                <span class="side-nav-text">Ігри</span>
                            </a>
                        </li>
                        <li class="list-element">
                            <a href="{{route('forum')}}">
                                <span class="iconify" data-icon="ooui:articles-ltr"></span>
                                <span class="side-nav-text">Форум</span>
                            </a>
                        </li>
                        <li class="list-element">
                            <a href="#">
                                <span class="iconify" data-icon="grommet-icons:status-unknown"></span>
                                <span class="side-nav-text">Лаунчер</span>
                            </a>
                        </li>
                        <li class="list-element">
                            <a href="{{route('forum.show', 2)}}">
                                <span class="iconify" data-icon="material-symbols:menu-book-outline-rounded"></span>
                                <span class="side-nav-text">Про нас</span>
                            </a>
                        </li>
                        <li class="list-element">
                            <a href="{{route('forum.search', 5)}}">
                                <span class="iconify" data-icon="fluent:people-community-24-regular"></span>
                                <span class="side-nav-text">Блог</span>
                            </a>
                        </li>
                        <li class="list-element">
                            <a onclick="dropDown()">
                                <span class="iconify" id="icon" data-icon="solar:sort-from-top-to-bottom-bold"></span>
                                <span class="side-nav-text" id="text">Фільтри</span>
                                <span class="iconify side-nav-filter-icon" id="triangle" data-icon="tabler:triangle-filled"></span>
                            </a>
                            <ul class="dropdown">
                                <li class="dropdown-element">
                                    <a onclick="dropDownSecond()">
                                        <span class="dropdown-text" id="text-second">Платформа</span>
                                        <span id="triangle-second" class="iconify dropdown-icon" data-icon="tabler:triangle-filled"></span>
                                    </a>
                                    <ul class="dropdown-menu-second">
                                        <li class="dropdown-element-second">
                                            <a href="{{url('filters')}}@if($usedFilters['platform'] != '/platform-0'){{'/platform-0'}}@endif{{$usedFilters['genre'] . $usedFilters['time'] . $usedFilters['other']}}?search={{$data['search']}}" class="@if($usedFilters['platform'] == '/platform-0') active @endif">
                                                <span class="dropdown-text-second">Windows</span>
                                            </a>
                                        </li>
                                        <li class="dropdown-element-second">
                                            <a href="{{url('filters')}}@if($usedFilters['platform'] != '/platform-1'){{'/platform-1'}}@endif{{$usedFilters['genre'] . $usedFilters['time'] . $usedFilters['other']}}?search={{$data['search']}}" class="@if($usedFilters['platform'] == '/platform-1') active @endif">
                                                <span class="dropdown-text-second">Linux</span>
                                            </a>
                                        </li>
                                        <li class="dropdown-element-second">
                                            <a href="{{url('filters')}}@if($usedFilters['platform'] != '/platform-2'){{'/platform-2'}}@endif{{$usedFilters['genre'] . $usedFilters['time'] . $usedFilters['other']}}?search={{$data['search']}}" class="@if($usedFilters['platform'] == '/platform-2') active @endif">
                                                <span class="dropdown-text-second">MacOS</span>
                                            </a>
                                        </li>
                                        <li class="dropdown-element-second">
                                            <a href="{{url('filters')}}@if($usedFilters['platform'] != '/platform-3'){{'/platform-3'}}@endif{{$usedFilters['genre'] . $usedFilters['time'] . $usedFilters['other']}}?search={{$data['search']}}" class="@if($usedFilters['platform'] == '/platform-3') active @endif">
                                                <span class="dropdown-text-second">Android</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="dropdown-element">
                                    <a onclick="dropDownThird()">
                                        <span class="dropdown-text" id="text-third">Дата</span>
                                        <span id="triangle-third" class="iconify dropdown-icon" data-icon="tabler:triangle-filled"></span>
                                    </a>

                                    <ul class="dropdown-menu-third">
                                        <li class="dropdown-element-third">
                                            <a href="{{url('filters') . $usedFilters['platform'] . $usedFilters['genre']}}@if($usedFilters['time'] != '/new'){{'/new'}}@endif{{$usedFilters['other']}}?search={{$data['search']}}" class="@if($usedFilters['time'] == '/new') active @endif">
                                                <span class="dropdown-text-third">Нові</span>
                                            </a>
                                        </li>
                                        <li class="dropdown-element-third">
                                            <a href="{{url('filters') . $usedFilters['platform'] . $usedFilters['genre']}}@if($usedFilters['time'] != '/last-week'){{'/last-week'}}@endif{{$usedFilters['other']}}?search={{$data['search']}}" class="@if($usedFilters['time'] == '/last-week') active @endif">
                                                <span class="dropdown-text-third">Цього тижня</span>
                                            </a>
                                        </li>
                                        <li class="dropdown-element-third">
                                            <a href="{{url('filters') . $usedFilters['platform'] . $usedFilters['genre']}}@if($usedFilters['time'] != '/last-month'){{'/last-month'}}@endif{{$usedFilters['other']}}?search={{$data['search']}}" class="@if($usedFilters['time'] == '/last-month') active @endif">
                                                <span class="dropdown-text-third">Цього місяця</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="dropdown-element">
                                    <a onclick="dropDownFourth()">
                                        <span class="dropdown-text" id="text-fourth">Жанри</span>
                                        <span id="triangle-fourth" class="iconify dropdown-icon" data-icon="tabler:triangle-filled"></span>
                                    </a>

                                    <ul class="dropdown-menu-fourth">
                                    @foreach($genres as $genre)
                                        <li class="dropdown-element-fourth">
                                            <a href="{{url('filters') . $usedFilters['platform']}}@if($usedFilters['genre'] != '/genre-' . $genre->id){{'/genre-' . $genre->id}}@endif{{$usedFilters['time'] . $usedFilters['other']}}?search={{$data['search']}}" class="@if($usedFilters['genre'] == '/genre-' . $genre->id) active @endif">
                                                <span class="dropdown-text-fourth">{{$genre->name}}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                    </ul>

                                </li>
                                <li class="dropdown-element">
                                    <a onclick="dropDownSixth()">
                                        <span class="dropdown-text" id="text-sixth">Різні</span>
                                        <span id="triangle-sixth" class="iconify dropdown-icon" data-icon="tabler:triangle-filled"></span>
                                    </a>
                                    
        

                                    <ul class="dropdown-menu-sixth">
                                        <li class="dropdown-element-sixth">
                                        <a href="{{url('filters') . $usedFilters['platform'] . $usedFilters['genre'] . $usedFilters['time']}}@if($usedFilters['other'] != '/featured'){{'/featured'}}@endif?search={{$data['search']}}" class="@if($usedFilters['other'] == '/featured') active @endif">
                                                <span class="dropdown-text-sixth">Обрані</span>
                                            </a>
                                        </li>
                                        <li class="dropdown-element-sixth">
                                        <a href="{{url('filters') . $usedFilters['platform'] . $usedFilters['genre'] . $usedFilters['time']}}@if($usedFilters['other'] != '/popular'){{'/popular'}}@endif?search={{$data['search']}}" class="@if($usedFilters['other'] == '/popular') active @endif">
                                                <span class="dropdown-text-sixth">Популярні</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>

                        </li>
                        <hr>
                        <li class="list-element">
                            <a href="{{route('game.followed')}}">
                                <span class="iconify" data-icon="carbon:game-wireless"></span>
                                <span class="side-nav-text">Бібліотека</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Side Menu -->




        <div class="col">





            <div class="header">

                <!-- Burger -->


                <nav>
                    <input type="checkbox" id="menu" name="menu" class="m-menu__checkbox">
                    <label class="m-menu__toggle" for="menu">
                        <svg width="33" height="33" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="butt" stroke-linejoin="arcs">
                            <line x1="3" y1="12" x2="21" y2="12"></line>
                            <line x1="3" y1="6" x2="21" y2="6"></line>
                            <line x1="3" y1="18" x2="21" y2="18"></line>
                        </svg>
                    </label>
                    <label class="m-menu__overlay" for="menu"></label>

                    <div class="m-menu">



                        <div class="m-menu__header">
                            <label class="m-menu__toggle" for="menu">
                                <span class="iconify" data-icon="maki:cross" data-width="30" data-height="30" fill="none"></span>
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                                </svg>
                            </label>
                            <span><a href="#" class="navbar-brand"><img src="assets/img/logo.svg" alt="logo"></a></span>
                        </div>



                        <ul>
                            <li><a href="{{route('home')}}"><label>Головна</label></a></li>
                            <hr>
                            <li><a href="{{route('search')}}/new"><label>Ігри</label></a></li>
                            <hr>
                            <li><a href="{{route('forum')}}"><label>Форум</label></a></li>
                            <hr>
                            <li><a href=""><label>Лаунчер</label></a></li>
                            <hr>
                            <li><a href="{{route('forum.show', 2)}}"><label>Про нас</label></a></li>
                            <hr>
                            <li><a href="{{route('forum.search', 5)}}"><label>Блог</label></a></li>
                            <hr>


                            <li>
                                <label class="a-label__chevron" for="item-2">Фільтри</label>
                                <hr>
                                <input type="checkbox" id="item-2" name="item-2" class="m-menu__checkbox">
                                <div class="m-menu">
                                    <div class="m-menu__header">
                                        <label class="m-menu__toggle" for="item-2">
                                            <span class="iconify" data-icon="ph:arrow-left-bold" style="color: white;" data-width="30" data-height="30"></span>
                                            <path d="M19 12H6M12 5l-7 7 7 7" />
                                            </svg>
                                        </label>
                                        <span>Фільтри</span>

                                    </div>
                                    <ul>
                                        <li>
                                            <label class="a-label__chevron" for="item-2-3">Платформа</label>
                                            <input type="checkbox" id="item-2-3" name="item-2" class="m-menu__checkbox">
                                            <div class="m-menu">
                                                <div class="m-menu__header">
                                                    <label class="m-menu__toggle" for="item-2-3">
                                                        <span class="iconify" data-icon="ph:arrow-left-bold" style="color: white;" data-width="30" data-height="30"></span>
                                                        <path d="M19 12H6M12 5l-7 7 7 7" />
                                                        </svg>
                                                    </label>
                                                    <span>Платформа</span>
                                                </div>
                                                <ul>
                                                    <li><a href="{{url('filters')}}@if($usedFilters['platform'] != '/platform-0'){{'/platform-0'}}@endif{{$usedFilters['genre'] . $usedFilters['time'] . $usedFilters['other']}}?search={{$data['search']}}"><label class="@if($usedFilters['platform'] == '/platform-0') active @endif">Windows</label></a></li>
                                                    <hr>
                                                    <li><a href="{{url('filters')}}@if($usedFilters['platform'] != '/platform-1'){{'/platform-1'}}@endif{{$usedFilters['genre'] . $usedFilters['time'] . $usedFilters['other']}}?search={{$data['search']}}"><label class="@if($usedFilters['platform'] == '/platform-1') active @endif">Linux</label></a></li>
                                                    <hr>
                                                    <li><a href="{{url('filters')}}@if($usedFilters['platform'] != '/platform-2'){{'/platform-2'}}@endif{{$usedFilters['genre'] . $usedFilters['time'] . $usedFilters['other']}}?search={{$data['search']}}"><label class="@if($usedFilters['platform'] == '/platform-2') active @endif">MacOS</label></a></li>
                                                    <hr>
                                                    <li><a href="{{url('filters')}}@if($usedFilters['platform'] != '/platform-3'){{'/platform-3'}}@endif{{$usedFilters['genre'] . $usedFilters['time'] . $usedFilters['other']}}?search={{$data['search']}}"><label class="@if($usedFilters['platform'] == '/platform-3') active @endif">Android</label></a></li>
                                                    <hr>
                                                </ul>
                                        </li>
                                        <hr>
                                        <li>
                                            <label class="a-label__chevron" for="item-2-4">Дата</label>
                                            <input type="checkbox" id="item-2-4" name="item-2" class="m-menu__checkbox">
                                            <div class="m-menu">
                                                <div class="m-menu__header">
                                                    <label class="m-menu__toggle" for="item-2-4">
                                                        <span class="iconify" data-icon="ph:arrow-left-bold" style="color: white;" data-width="30" data-height="30"></span>
                                                        <path d="M19 12H6M12 5l-7 7 7 7" />
                                                        </svg>
                                                    </label>
                                                    <span>Дата</span>
                                                </div>
                                                <ul>
                                                    <li><a href="{{url('filters') . $usedFilters['platform'] . $usedFilters['genre']}}@if($usedFilters['time'] != '/new'){{'/new'}}@endif{{$usedFilters['other']}}?search={{$data['search']}}"><label class="@if($usedFilters['time'] == '/new') active @endif">Нові</label></a></li>
                                                    <hr>
                                                    <li><a href="{{url('filters') . $usedFilters['platform'] . $usedFilters['genre']}}@if($usedFilters['time'] != '/last-week'){{'/last-week'}}@endif{{$usedFilters['other']}}?search={{$data['search']}}"><label class="@if($usedFilters['time'] == '/last-week') active @endif">Цього тижня</label></a></li>
                                                    <hr>
                                                    <li><a href="{{url('filters') . $usedFilters['platform'] . $usedFilters['genre']}}@if($usedFilters['time'] != '/last-month'){{'/last-month'}}@endif{{$usedFilters['other']}}?search={{$data['search']}}"><label class="@if($usedFilters['time'] == '/last-month') active @endif">Цього місяця</label></a></li>
                                                    <hr>
                                                </ul>
                                        </li>
                                        <hr>
                                        <li>
                                            <label class="a-label__chevron" for="item-2-5">Жанри</label>
                                            <input type="checkbox" id="item-2-5" name="item-2" class="m-menu__checkbox">
                                            <div class="m-menu">
                                                <div class="m-menu__header">
                                                    <label class="m-menu__toggle" for="item-2-5">
                                                        <span class="iconify" data-icon="ph:arrow-left-bold" style="color: white;" data-width="30" data-height="30"></span>
                                                        <path d="M19 12H6M12 5l-7 7 7 7" />
                                                        </svg>
                                                    </label>
                                                    <span>Жанри</span>
                                                </div>
                                                <ul>
                                                @foreach($genres as $genre)
                                                    <li>
                                                        <a href="{{url('filters') . $usedFilters['platform']}}@if($usedFilters['genre'] != '/genre-' . $genre->id){{'/genre-' . $genre->id}}@endif{{$usedFilters['time'] . $usedFilters['other']}}?search={{$data['search']}}"><label class="@if($usedFilters['genre'] == '/genre-' . $genre->id) active @endif">{{$genre->name}}</label></a>
                                                    </li>
                                                    <hr>
                                                @endforeach
                                                <li><label></label></li>
                                                <li><label></label></li>
                                                <li><label></label></li>
                                                <li><label></label></li>                   
                                                </ul>
                                        </li>
                                        <hr>


                                        <li>
                                            <label class="a-label__chevron" for="item-2-6">Різні</label>
                                            <input type="checkbox" id="item-2-6" name="item-2" class="m-menu__checkbox">
                                            <div class="m-menu">
                                                <div class="m-menu__header">
                                                    <label class="m-menu__toggle" for="item-2-6">
                                                        <span class="iconify" data-icon="ph:arrow-left-bold" style="color: white;" data-width="30" data-height="30"></span>
                                                        <path d="M19 12H6M12 5l-7 7 7 7" />
                                                        </svg>
                                                    </label>
                                                    <span>Різні</span>
                                                </div>
                                                <ul>
                                                    <li><a href="{{url('filters') . $usedFilters['platform'] . $usedFilters['genre'] . $usedFilters['time']}}@if($usedFilters['other'] != '/featured'){{'/featured'}}@endif?search={{$data['search']}}" class="btn btn-link @if($usedFilters['other'] == '/featured') active @endif"><label class="@if($usedFilters['other'] == '/featured') active @endif">Обрані</label></a></li>
                                                    <hr>
                                                    <li><a href="{{url('filters') . $usedFilters['platform'] . $usedFilters['genre'] . $usedFilters['time']}}@if($usedFilters['other'] != '/popular'){{'/popular'}}@endif?search={{$data['search']}}"><label class="@if($usedFilters['other'] == '/popular') active @endif">Популярні</label></a></li>
                                                    <hr>
                                                </ul>
                                        </li>
                                        <hr>
                                </div>
                            </li>
                            <li><a href="{{route('game.followed')}}"><label>Бібліотека</label></a></li>
                            <hr>
                            <li><label></label></li>
                            <li><label></label></li>
                            <li><label></label></li>
                            <li><label></label></li>
                        </ul>
                    </div>
                </nav>



                <!-- Burger -->

                <div class="row">



                    <div class="col">

                        <!-- Search Bar -->

                        @include('layouts.search')

                    </div>
                    <!-- Search Bar -->



                    <!-- Notification -->



                    <div class="col-sm">

                        @include('layouts.notification')

                        <!-- Notification -->




                        <!-- Account -->
                        @include('layouts.account-menu')

                    </div>

                </div>

            </div>
        </div>
    </div>

    @yield('main_content')

    <!-- Account -->

    @include('layouts.sign-in', ['class' => 'pop'])
    @include('layouts.sign-up', ['class' => 'popup'])


    @include('layouts.contact')

    @include('layouts.footer')

    <!-- Script -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.5/js/swiper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.5/js/swiper.min.js"></script>
    <script src="{{asset('/assets/js/script.js')}}"></script>
    @if($usedFilters['platform'] != "" || $usedFilters['time'] != "" || $usedFilters['genre'] != "" || $usedFilters['other'] != "")
        <script>
            dropDown();
        </script>
    @endif
    @if($usedFilters['platform'] != "")
        <script>
            dropDownSecond();
        </script>
    @endif
    @if($usedFilters['time'] != "")
        <script>
            dropDownThird()
        </script>
    @endif
    @if($usedFilters['genre'] != "")
        <script>
            dropDownFourth()
        </script>
    @endif
    @if($usedFilters['other'] != "")
        <script>
            dropDownSixth()
        </script>
    @endif

    <!-- Script -->




</body>


</html>