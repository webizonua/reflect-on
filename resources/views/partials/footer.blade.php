<footer class="footer">
    <div class="footer__container container">
        <div class="footer__top">
            <nav class="footer__nav nav">
                <ul class="nav__list">
                    <li class="nav__item"><a href="/online-kurs" class="nav__link">Online-Kurs</a></li>
                    <li class="nav__item"><a href="/mein-angebot" class="nav__link">Mein Angebot</a></li>
                    <li class="nav__item"><a href="/uber-mich" class="nav__link">Über mich</a></li>
                    {{--<li class="nav__item"><a href="/blog" class="nav__link">Blog</a></li>--}}
                    <li class="nav__item"><a href="/kontakt" class="nav__link">Kontakt</a></li>
                </ul>
            </nav>
            <div class="footer__socials">
                <a href="https://www.instagram.com/reflect.on.coaching/" target="_blank" class="footer__social" aria-label="Instagram">
                    <img src="/images/icon-instagram.svg" alt="Instagram">
                </a>
                <a href="https://www.linkedin.com/in/janine-bischoff/" target="_blank" class="footer__social" aria-label="LinkedIn">
                    <img src="/images/icon-linkedin.svg" alt="LinkedIn">
                </a>
            </div>
        </div>
        <div class="footer__bottom">
            <div class="footer__copy">© {{ date('Y') }} Reflect-ON</div>
            <ul class="footer__links">
                <li><a href="/agb" class="footer__link">AGB</a></li>
                <li><a href="/datenschutz" class="footer__link">Datenschutz</a></li>
                <li><a href="/widerrufsbelehrung" class="footer__link">Widerrufsbelehrung</a></li>
                <li><a href="/impressum" class="footer__link">Impressum</a></li>
            </ul>
        </div>
    </div>
</footer>
