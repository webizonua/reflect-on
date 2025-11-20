<header class="header">
    <div class="header__container container">
        @if (request()->routeIs('home'))
        <div class="header__logo"><img src="/images/logo.svg" alt="Reflect ON"></div>
        @else
        <a href="/" class="header__logo"><img src="/images/logo.svg" alt="Reflect ON"></a>
        @endif
        <nav class="header__nav nav">
            <ul class="nav__list">
                <li><a href="/online-kurs" class="nav__link {{ request()->is('online-kurs') ? 'nav__link--current' : '' }}">Online-Kurs</a></li>
                <li><a href="/mein-angebot" class="nav__link {{ request()->is('mein-angebot') ? 'nav__link--current' : '' }}">Mein Angebot</a></li>
                <li><a href="/ueber-mich" class="nav__link {{ request()->is('ueber-mich') ? 'nav__link--current' : '' }}">Über mich</a></li>
                {{--<li><a href="/blog" class="nav__link {{ request()->is('blog*') ? 'nav__link--current' : '' }}">Blog</a></li>--}}
                <li><a href="/kontakt" class="nav__link {{ request()->is('kontakt') ? 'nav__link--current' : '' }}">Kontakt</a></li>
            </ul>
        </nav>
        <div class="header__actions">
            <button class="header__login" aria-label="Account"><img src="/images/icon-user.svg" alt="Login"></button>
        </div>
        <button class="header__toggle" aria-label="Toggle menu">
            <span class="header__toggle-line"></span>
            <span class="header__toggle-line"></span>
            <span class="header__toggle-line"></span>
        </button>
    </div>
</header>