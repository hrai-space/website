<div class="{{$class}}" role="alert">

    <form method="POST" action="{{ route('login') }}" id="enter-form" class="pop-container">
        @csrf
        <img src="{{URL::asset('assets/img/logo.svg')}}" alt="logo">
        <div class="row">
            <div class="col left"><a href="#">Увійти</a></div>
        </div>
        <div id="enter-forms" class="enter-forms">
            <input type="text" value="{{old('input_type')}}" name="input_type" class="username enter-input" id= "username-input enter-input" placeholder="Нікнейм або пошта" onfocus="this.placeholder=''" onblur="this.placeholder='Username or email'" autocomplete="username"/>
            @include('layouts.error', ['fieldname' => 'email'])
            @include('layouts.error', ['fieldname' => 'username'])
            <input type="password" name="password" class="pasword enter-input" id= "password-input enter-input" placeholder="Пароль" onfocus="this.placeholder=''" onblur="this.placeholder='Password'" autocomplete="current-password"/>
            @include('layouts.error', ['fieldname' => 'password'])
            <span>
                <p><input type="checkbox" name="remember" class="remember" id= "remember-input register-input" name="remember"> Запам'ятати мене</p>
            </span>
            <button class="sign-in-btn" id="sign-in-btn" type="submit">Увійти</button>
            <p class="enter-text">Увійти з</p>
            <ul class="enter-icon">
                <li>
                    <button class="icon-google-btn"><span class="iconify" data-icon="ri:google-fill"></span></button>
                </li>
                <li>
                    <button class="icon-git-btn"><span class="iconify" data-icon="fluent-mdl2:git-hub-logo"></span></button>
                </li>
            </ul>
        </div>
    
    </form>
    
</div>