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
                <h1>{{Auth::user()->game()->count()}}</h1>
                <p>Ігор</p>
            </div>
            <div class="col">
                <h1>{{Auth::user()->article()->count()}}</h1>
                <p>Постів</p>
            </div>
        </div>
        <hr>
    </div>
    <div class="account-settings">
        <li>
            <a href="{{route('game.followed')}}">
                <span class="iconify" data-icon="material-symbols:library-books-outline"></span>
                <span>Бібліотека</span>
            </a>
        </li>
        <li>
            <a href="{{route('game.create')}}">
                <span class="iconify" data-icon="ri:game-line"></span>
                <span>Нова гра</span>
            </a>
        </li>
        <li>
            <a href="{{route('dashboard.games')}}">
                <span class="iconify" data-icon="ic:outline-games"></span>
                <span>Мої ігри</span>
            </a>
        </li>
        @admin
        <li>
            <a href="{{route('admin.dashboard')}}">
                <span class="iconify" data-icon="ooui:articles-ltr"></span>
                <span>Admin</span>
            </a>
        </li>
        @endadmin
        <li id="bottom">
            <a href="{{route('profile.edit')}}">
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