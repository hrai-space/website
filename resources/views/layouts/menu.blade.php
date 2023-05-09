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
            <li><label><a href="#">Ігри</a></label></li>
            <hr>
            <li><label><a href="#">Статті</a></label></li>
            <hr>
            <li><label><a href="#">Лаунчер</a></label></li>
            <hr>
            <li><label><a href="#">Про нас</a></label></li>
            <hr>
            <li><label><a href="#">Блог</a></label></li>
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
            <a href="#">
                <span class="unchosed">Ігри</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="#">
                <span class="unchosed">Статті</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="#">
                <span class="unchosed">Лаунчер</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="#">
                <span class="unchosed">Про нас</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="#">
                <span class="unchosed">Блог</span>
            </a>
        </li>
    </ul>
</div>

<!-- Menu -->













<!-- Search Bar -->

<div class="search-bar">
    <span class="iconify" data-icon="ant-design:search-outlined"></span>
    <input type="text" placeholder="Знайти ігри" onfocus="this.placeholder=''" onblur="this.placeholder='Знайти ігри'" />
</div>


<!-- Search Bar -->



<!-- Notification -->






<button class="notification" id="notification-button"><span class="iconify" data-icon="basil:notification-outline"></span></button>
<div class='notification-dot'></div>

<div class="notification-container" id="notification-container">
    <div class="notification-text">
        <h1>В прогресі</h1>
        <p>В прогресі</p>
        <p>В прогресі</p>
    </div>
    <button class="notification-button">В прогресі</button>
</div>

<!-- Notification -->




<!-- Account -->


<button class="account" id="account-button"><img src="@auth{{Storage::disk('do')->url('images/' . Auth::user()->avatar)}}@else{{Storage::disk('do')->url('images/Pigeon3.png')}}@endauth" alt="account"></button>

@auth
<div class="account-container" id="account-container">
    <div class="profile-box">
        <div class="row">
            <div class="col">
                <a href="#"><img src="{{Storage::disk('do')->url('images/' . Auth::user()->avatar)}}" alt="account"></a>
            </div>
            <div class="col">
                <h1>{{Auth::user()->username}}</h1>
                <a id="profile" href="{{route('public.profile', Auth::user()->username)}}">Переглянути профіль</a>
            </div>
        </div>
        <hr>
    </div>
    <div class="statisticks">
        <div class="row">
            <div class="col">
                <h1>120</h1>
                <p>Ігор</p>
            </div>
            <div class="col">
                <h1>125</h1>
                <p>Статтей</p>
            </div>
        </div>
        <hr>
    </div>
    <div class="account-settings">
        <li>
            <a href="#">
                <span class="iconify" data-icon="material-symbols:library-books-outline"></span>
                <span>Бібліотека</span>
            </a>
        </li>
        <li>
            <a href="#">
                <span class="iconify" data-icon="ic:outline-games"></span>
                <span>Мої ігри</span>
            </a>
        </li>
        <li>
            <a href="#">
                <span class="iconify" data-icon="ooui:articles-ltr"></span>
                <span>Мої статті</span>
            </a>
        </li>
        <li id="bottom">
            <a href="#">
                <span class="iconify" data-icon="material-symbols:settings-outline-rounded"></span>
                <span>Налаштування</span>
            </a>
        </li>

    </div>
    <div class="button-container">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="account-button" onclick="event.preventDefault();this.closest('form').submit();"><span class="iconify" data-icon="ion:log-out-outline"></span> Вийти</button>
        </form>
    </div>
</div>
@else
<div class="not-registered-container" id="not-registered-container">
    <button class="pop-trigger sign-in"><span class="iconify" data-icon="ion:log-out-outline"></span> Sign In</button>
    <button class="popup-trigger sign-up"><span class="iconify" data-icon="mdi:register-outline"></span> Sign Up</button>
</div>
@endauth

</div>