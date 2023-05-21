<div class="{{$class}}" role="alert">

    <form method="POST" action="{{ route('register') }}" id="register-form" class="popup-container">
        @csrf
        <img src="{{URL::asset('assets/img/logo.svg')}}" alt="logo">
        <div class="row">
            <div class="col right"><a href="#">Зареєструватись</a></div>
        </div>
        <div id="register-forms" class="register-forms">
            <input type="hidden" name="sign-up-visible" value="">
            <input type="text" class="username register-input" name="name" value="{{old('name')}}" id="username-input register-input" placeholder="Ім'я" onfocus="this.placeholder=''" onblur="this.placeholder='Ім\'я'" required autocomplete="name"/>
            @include('layouts.error', ['fieldname' => 'name'])
            <input type="text" class="register-input" name="username" value="{{old('username')}}" id= "register-input" placeholder="Нікнейм" onfocus="this.placeholder=''" onblur="this.placeholder='Нікнейм'" required autocomplete="username"/>
            @include('layouts.error', ['fieldname' => 'username'])
            <input type="password" class="pasword register-input" name="password" id= "password-input register-input" placeholder="Пароль" onfocus="this.placeholder=''" onblur="this.placeholder='Пароль'" required autocomplete="new-password"/>
            @include('layouts.error', ['fieldname' => 'password'])
            <input type="password" class="repeat-pasword register-input" name="password_confirmation" id= "repeat-password-input register-input" placeholder="Повторіть пароль" onfocus="this.placeholder=''" onblur="this.placeholder='Повторіть пароль'" required autocomplete="new-password"/>
            @include('layouts.error', ['fieldname' => 'password_confirmation'])
            <input type="email" class="email register-input" id="email-input register-input" name="email" value="{{old('email')}}" placeholder="Електронна пошта" onfocus="this.placeholder=''" onblur="this.placeholder='Електронна пошта'" required autocomplete="email"/>
            @include('layouts.error', ['fieldname' => 'email'])
            <span>
                <p>Реєструючись, я приймаю <span class="terms-of-service"><a href="#">Правила платформи</a></span> </p>
            </span>
            <button class="sign-up-btn" id="sign-in-btn" type="submit">Зареєструватись</button>
        </div>

    </form>

</div>