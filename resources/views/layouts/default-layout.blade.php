<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - @yield('title')</title>


    <!-- Style CSS -->
    <link rel="stylesheet" href="{{asset('/assets/css')}}/@yield('css1')">
    <link rel="stylesheet" href="{{asset('/assets/css')}}/@yield('css2')">
    <link rel="stylesheet" href="{{asset('/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/css/null.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.5/css/swiper.min.css">
    
    <!-- Style CSS -->


</head>

<body>


    @include('layouts.menu')





    <!-- Content -->

    @yield('main_content')

    <!-- Content -->







    <!--Contact Us-->


    <div class="up" role="alert">
        <form id="contact-form" class="up-container">
            <img src="{{URL::asset('assets/img/logo.svg')}}" alt="logo">
            <p class="head-text">Зворотній зв'язок</p>
            <div id="contact-forms" class="contact-forms">
                <input type="text" type="" class="username contact-input" id="username-input enter-input" placeholder="Нік або пошта" onfocus="this.placeholder=''" onblur="this.placeholder='Нік або пошта'" />
                <textarea name="contact-us" id="contact-input" class="contact-form" cols="30" rows="10" placeholder="Опишіть свою проблему" onfocus="this.placeholder=''" onblur="this.placeholder='Опишіть свою проблему'" /></textarea>
                <button class="send-btn" id="send-btn">Відправити</button>
            </div>
        </form>
    </div>


    <!--Contact Us-->




    @include('layouts.sign-in', ['class' => ''])
    @include('layouts.sign-up', ['class' => ''])



    <!-- Footer -->


    <div class="footer">
        <span class="logo-footer"><img src="{{URL::asset('assets/img/logo.svg')}}" alt="logo"></span>
        <div class="row">
            <div class="col socials">
                <span class="iconify" data-icon="mdi:instagram"></span>
                <span class="iconify" data-icon="ph:twitter-logo-bold"></span>
                <span class="iconify" data-icon="ph:telegram-logo-bold"></span>
                <span class="iconify last" data-icon="tabler:brand-tiktok"></span>
            </div>
            <div class="col footer-menu">
                <li class="footer-list-element">
                    <a href="#">
                        <span class="footer-text">Про нас</span>
                    </a>
                </li>
                <li class="footer-list-element">
                    <a href="#">
                        <span class="footer-text">FAQ</span>
                    </a>
                </li>
                <li class="footer-list-element">
                    <a href="#">
                        <span class="footer-text">Блог</span>
                    </a>
                </li>
                <li class="footer-list-element last">
                    <a href="#">
                        <span class="footer-text right up-trigger">Зворотній зв'язок</span>
                    </a>
                </li>
            </div>
            <div class="col reserved" id="rights">
                <script>
                    document.write("&copy; " + new Date().getFullYear() + " DarkMoon Studio. Усі права захищено.");
                </script>
            </div>

        </div>
    </div>

    <!-- Footer -->







    <!-- Script -->

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.5/js/swiper.min.js"></script>
    <script src="{{asset('/assets/js/script.js')}}"></script>

    <!-- Script -->




</body>


</html>