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
            <span><a href="{{route('home')}}" class="navbar-brand"><img src="{{URL::asset('assets/img/logo.svg')}}" alt="logo"></a></span>
        </div>
        <ul>
            <li><label><a href="{{route('search')}}/new">Ігри</a></label></li>
            <hr>
            <li><label><a href="{{route('forum')}}">Форум</a></label></li>
            <hr>
            <li><label><a href="{{Storage::disk('do')->url('files/Hrai-Space-setup.exe')}}">Лаунчер</a></label></li>
            <hr>
            <li><label><a href="{{route('forum.show', 2)}}">Про нас</a></label></li>
            <hr>
            <li><label><a href="{{route('forum.search', 5)}}">Блог</a></label></li>
            <hr>
        </ul>
    </div>
</nav>



<!-- Burger -->


<!-- Menu -->

<div class="navbar">

    <ul class="navbar-nav">
        <a href="{{route('home')}}" class="navbar-brand"><img src="{{URL::asset('assets/img/logo.svg')}}" alt="logo"></a>
        <!--
        <li class="nav-item dropdown">
            <a href="#" onclick="dropdown()" id="dropdown">
                <span class="unchosed">Огляд</span>
                <span id="dropdown-triangle" class="iconify" data-icon="tabler:triangle-filled"></span>
            </a>
            <ul class="ddown-menu">
                <li class="dropdown-item">
                    <a href="#">
                        <span class="unchosed">Ігри</span>
                    </a>
                </li>
                <li class="dropdown-item">
                    <a href="#">
                        <span class="unchosed">Статті</span>
                    </a>
                </li>
            </ul>
        </li>
        -->
        <li class="nav-item">
            <a href="{{route('search')}}/new">
                <span class="unchosed">Ігри</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('forum')}}">
                <span class="unchosed">Форум</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{Storage::disk('do')->url('files/Hrai-Space-setup.exe')}}">
                <span class="unchosed">Лаунчер</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('forum.show', 2)}}">
                <span class="unchosed">Про нас</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('forum.search', 5)}}">
                <span class="unchosed">Блог</span>
            </a>
        </li>
    </ul>
</div>

<!-- Menu -->















@include('layouts.search')


@include('layouts.notification')

    <!-- Notification -->




    <!-- Account -->
@include('layouts.account-menu')


<!-- Account -->




</div>