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
                    <a href="{{route('search')}}/new">
                        <span class="footer-text">Ігри</span>
                    </a>
                </li>
                <li class="footer-list-element">
                    <a href="{{route('forum.show', 2)}}">
                        <span class="footer-text">Про нас</span>
                    </a>
                </li>
                <li class="footer-list-element">
                    <a href="{{route('forum.search', 5)}}">
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