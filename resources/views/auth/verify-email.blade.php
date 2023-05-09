@extends('layouts.auth')
@section('title')Вхід@endsection

@section('css1')account.css @endsection
@section('css2')dashboard.css @endsection

@section('main_content')
<div class="profile">
    <div class="content-profile">
    <h4>Дякуємо за реєстрацію на нашому проєкті! Підтвердіть вашу електронну адресу, щоб отримати доступ до всього функціоналу сайту</h4>
        
        <form method="POST" action="{{ route('verification.send') }}" style="margin-top: 50px;">
            @csrf
            <button type="submit" class="btn btn-light">Перевідправити лист для верифікації</button>
        </form>

        @if (session('status') == 'verification-link-sent')
            <div style="margin-top: 20px;">
                Новий лист для підтвердження акаунту був відправлений
            </div>
        @endif
    </div>
</div>


@endsection

