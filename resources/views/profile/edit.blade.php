
@extends('layouts.sidebar-layout')
@section('title')Головна@endsection

@section('css1')settings.css @endsection

@section('main_content')

<!--Content -->

<div class="settings">


<div class="account-container-settings">
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>
    <h1 class="topic">Профіль</h1>

    
    <p class="description">Нікнейм — Використовується для входу в акаунт і для вашого публічного посилання</p>
    <p class="account-settings">{{Auth::user()->username}} <button class="change-button ip-trigger">Змінити нікнейм</button></p>
   
    <p class="description">Публічне посилання на профіль</p>
    <a href="http://hrai.space/profile/{{Auth::user()->username}}" class="url"><p>http://hrai.space/profile/{{Auth::user()->username}}</p></a>

    <form method="post" action="{{ route('profile.image.store') }}" enctype="multipart/form-data">
        @csrf
        <p class="description">Фото профілю — Показується одразу збоку вашого нікнейму</p>
        <input type="file" id="account-image" name="AvatarFile" accept="image/png, image/jpeg">
        <br>
        @include('layouts.error', ['fieldname' => 'AvatarFile'])
        <button type="submit" class="confirm" style="margin-top: 20px;">Зберегти</button>
    </form>
    
    <p class="description">Мова — Мова інтерфейсу сайту (в розробці)</p>
    <select name="language" id="language" class="language">
        <option value="value1">English</option>
        <option value="value2">Українська</option>
    </select>

    <p class="description">Тема — Кольорова схема сайту</p>
    <ul class="checkbox-list">
        <li class="checkbox-element">
            <p class="checkbox-text"><input type="checkbox" class="theme" checked> <span class="iconify" data-icon="ph:moon-fill"></span> Використовувати темну тему де можливо (в розробці)</p>
        </li>
    </ul>
    <form method="post" action="{{route('profile.update')}}">
        @csrf
        @method('patch')
        <p class="description">Профіль — Текст, який буде видно у вашому профілі</p>
        <textarea name="description" id="describe-input" class="describe-input" cols="30" rows="10" placeholder="Придумайте опис" onfocus="this.placeholder=''" onblur="this.placeholder='Придумайте опис'" />{{old('description', $user->description)}}</textarea>
        @include('layouts.error', ['fieldname' => 'description'])
        <br>
        <button type="submit" class="confirm">Зберегти</button>
    </form>
</div>




<div class="password-container">
    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')
        <h1 class="topic">Змінити пароль</h1>
        <p class="description">Оновлення пароля призведе до виходу з усіх інших сесій. Будь-які підключення OAuth і ключі API залишаться активними.</p>
        <input type="password" name="current_password" class="password" id= "current-password" placeholder="Старий пароль" onfocus="this.placeholder=''" onblur="this.placeholder='Старий пароль'" />
        @foreach($errors->updatePassword->get('current_password') as $error)
            <div class="alert" role="alert" style="margin: 0; margin-top:-30px">
                {{$error}}
            </div>
        @endforeach
        <input type="password" name="password" class="password" id= "new-password" placeholder="Новий пароль" onfocus="this.placeholder=''" onblur="this.placeholder='Новий пароль'" />
        @foreach($errors->updatePassword->get('password') as $error)
            <div class="alert" role="alert" style="margin: 0; margin-top:-30px">
                {{$error}}
            </div>
        @endforeach
        <input type="password" name="password_confirmation" class="password" id= "repeat-new-password" placeholder="Повторно новий пароль" onfocus="this.placeholder=''" onblur="this.placeholder='Повторно новий пароль'" />
        @foreach($errors->updatePassword->get('password_confirmation') as $error)
            <div class="alert" role="alert" style="margin: 0; margin-top:-30px">
                {{$error}}
            </div>
        @endforeach
        <button type="submit" class="confirm">Зберегти</button>
    </form>
</div>




<div class="email-container">
    <form method="post" action="{{route('profile.update')}}">
        @csrf
        @method('patch')
        <h1 class="topic">Електронна адреса</h1>
        <p class="description">Коли ви змінюєте адресу електронної пошти, її потрібно підтвердити, щоб отримати доступ до своїх ігор. Інструкції щодо підтвердження буде надіслано вам електронною поштою.</p>
        <p class="description">Ваша пошта:  <span> {{Auth::user()->email}}</span></p>
        <input type="text" class="email" name="email" id= "email" placeholder="Нова адреса" onfocus="this.placeholder=''" onblur="this.placeholder='Нова адреса'" />
        <button type="submit" class="confirm">Зберегти</button>
        @include('layouts.error', ['fieldname' => 'email'])
        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <p class="description">Ваша електронна адреса не підтверджена</p>

                <button form="send-verification" class="confirm">
                    Перевідправити посилання для верифікації
                </button>
            </div>

            @if (session('status') === 'verification-link-sent')
                <p class="description">Нове посилання для верифікації було відправлено</p>
            @endif
        @endif
    </form>
</div>

</div>


<!--Content -->



<!--Change Name-->


<div class="ip" role="alert">

    <form id="change-form" class="change-container" method="post" action="{{route('profile.update')}}">
        @csrf
        @method('patch')
        <img src="assets/img/logo.svg" alt="logo">
        <p class="head-text">Змінити Нікнейм</p>
        <div id="change-forms" class="change-forms">
            <input type="text" name="username" class="change change-input" value="{{old('username')}}" id= "change-input change-input" placeholder="Новий нікнейм" onfocus="this.placeholder=''" onblur="this.placeholder='Новий нікнейм'" />
            @include('layouts.error', ['fieldname' => 'username'])
            <button class="change-btn" type="submit" id="change-btn">Змінити Нікнейм</button>
        </div>
    </form>    
</div>


<!--Change Name-->

@endsection