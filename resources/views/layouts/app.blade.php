<!DOCTYPE html>
<html lang="ru-RU" prefix="og: http://ogp.me/ns#">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title', 'Фабрика дверей и мебели')</title>
    <meta name="description" content="@yield('description', '')">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#fff">
    @stack('og')
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('img/favicons/favicon.ico" type="image/x-icon') }}">
    <link rel="icon" sizes="16x16" href="{{ asset('img/favicons/favicon-16x16.png" type="image/png') }}">
    <link rel="icon" sizes="32x32" href="{{ asset('img/favicons/favicon-32x32.png" type="image/png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('img/favicons/apple-touch-icon-precomposed.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('img/favicons/apple-touch-icon.png') }}">
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('img/favicons/apple-touch-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('img/favicons/apple-touch-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('img/favicons/apple-touch-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/favicons/apple-touch-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('img/favicons/apple-touch-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('img/favicons/apple-touch-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('img/favicons/apple-touch-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('img/favicons/apple-touch-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="167x167" href="{{ asset('img/favicons/apple-touch-icon-167x167.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/favicons/apple-touch-icon-180x180.png') }}">
    <link rel="apple-touch-icon" sizes="1024x1024" href="{{ asset('img/favicons/apple-touch-icon-1024x1024.png') }}">
    <link rel="stylesheet" href="{{ asset('styles/main.css') }}">
    <link rel="canonical" href="@yield('canonical', request()->url())"/>
</head>
<body>
<section class="{{ $className ?? '' }}" @isset($bgImg) style="background-image: url({{ $bgImg }})"@endisset>
    <header class="flex" id="sticky">
        <div class="col-logo flex">
            <span>Фабрика дверей и мебели</span>
            <a href="{{ route('page.show') }}">
                <picture>
                    <source media="(max-width: 670px)" srcset="{{ asset('img/logo-mob.svg') }}">
                    <img src="{{ asset('img/logo.svg') }}"/>
                </picture>
            </a>
        </div>
        <div class="col-socials-menu">
            <div class="socials-line flex">
                <div>
                    <a href="#" rel="noopener noreferrer">
                        {{ svg('insta') }}
                    </a>
                    <a href="#" rel="noopener noreferrer">
                        {{ svg('fb') }}
                    </a>
                    <a href="#" rel="noopener noreferrer">
                        {{ svg('pinterest') }}
                    </a>
                </div>
                <div class="flex">
                    <div class="favorite-box">
                        <a href="#" rel="noopener noreferrer">
                            {{ svg('favorite') }}
                        </a>
                        <span>Избранное</span>
                    </div>
                    <a href="#" rel="noopener noreferrer">
                        {{ svg('viber') }}
                    </a>
                    <a href="#" rel="noopener noreferrer">
                        {{ svg('whatsapp') }}
                    </a>
                    <a href="#" rel="noopener noreferrer">
                        {{ svg('telegram') }}
                    </a>
                </div>
                <div class="flex">
                    <a href="tel:+79663205077" class="phone">+7 (966) 320-50-77</a>
                    <div class="recall-me call-popup" data-target="popup-recall-me">Перезвоните мне</div>
                    <div class="favorite-box favorite-box-mobile">
                        <a href="#" rel="noopener noreferrer">
                            {{ svg('favorite') }}
                        </a>
                        <a href="#" rel="noopener noreferrer" class="icon-map-link">
                            {{ svg('map') }}
                        </a>
                    </div>
                </div>
            </div>
            <div class="menu-line flex">
                @if($menu->get('menu_header'))
                <ul class="flex">
                    @foreach($menu->get('menu_header') as $item)
                        <li>
                            <a href="{{ $item->link }}">{{ $item->name }}</a>
                            @if($item->has_submenu)
                                <div class="submenu">
                                    <div class="submenu-box flex">
                                        <ul>
                                            @foreach($furnitureTypes as $furnitureType)
                                                <li><a href="#">{{ $furnitureType->name }}</a></li>
                                            @endforeach
                                        </ul>
                                        <ul>
                                            @foreach($collections as $collection)
                                            <li><a href="{{ $collection->url }}">{{ $collection->name }}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif
                        </li>
                    @endforeach
                </ul>
                @endif
                <div class="btn btn-cost-calculation call-popup" data-target="popup-cost-calculation">
                    РАСЧЕТ ПРОЕКТА
                </div>
                <div class="burger-mob"><span></span></div>
                <a href="{{ route('search') }}" rel="noopener noreferrer" class="search-box">
                    {{ svg('search') }}
                </a>
            </div>
        </div>
    </header>
    @yield('first-screen')
</section>

@yield('content')

<footer>
    <div class="container">
        <div class="row">
            <div class="col-3">
                <div class="footer-first-col">
                    <div>
                        <a href="/">
                            <img src="{{ asset('img/logo.png') }}" alt="Фабрика дверей и мебели" />
                        </a>
                    </div>
                    <div class="our-salons">
                        <div class="our-salons-title">НАШИ САЛОНЫ:</div>
                        <ul>
                            <li>
                                ВК «Росстройэкспо»<br/>
                                Фрунзенская наб., 30, пав.2,<br/>
                                место 22,<br/>
                                8 (967) 053 75 28
                            </li>
                            <li>
                                ТВК «Экспострой»<br/>
                                г. Москва, Decor Expo,<br/>
                                Нахимовский проспект, д. 24,<br/>
                                Сектор З, Место Г - 9<br/>
                                8 (966) 320 50 77
                            </li>
                        </ul>
                    </div>
                    <div class="copyright">
                        © «Либерти» 2006 - {{ date('Y') }} г.
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="center footer-middle-col">
                    <div class="recall-me call-popup" data-target="popup-recall-me">Перезвоните мне</div>
                    <div>
                        <div class="btn call-popup" data-target="popup-cost-calculation">расчет проекта</div>
                    </div>
                    <div>
                        <a href="#">Оставить отзыв</a>
                    </div>
                    <div class="info">
                        Отправляя сообщение с данного сайта<br/>
                        Вы соглашаетесь с<br/>
                        <a href="#">Политикой конфиденциальности</a>
                    </div>
                    <div class="socials">
                        <a href="#" rel="noopener noreferrer">
                            {{ svg('insta') }}
                        </a>
                        <a href="#" rel="noopener noreferrer">
                            {{ svg('fb') }}
                        </a>
                        <a href="#" rel="noopener noreferrer">
                            {{ svg('pinterest') }}
                        </a>
                        <a href="#" rel="noopener noreferrer">
                            {{ svg('viber') }}
                        </a>
                        <a href="#" rel="noopener noreferrer">
                            {{ svg('whatsapp') }}
                        </a>
                        <a href="#" rel="noopener noreferrer">
                            {{ svg('telegram') }}
                        </a>
                    </div>
                    <div class="developer">
                        <div class="copyright-mob">
                            © «Либерти» - с 2006 г.
                        </div>
                        <a href="#">Разработка сайта Имтексео</a>
                    </div>
                </div>
            </div>
            <div class="col-3">
                @if($menu->get('menu_header'))
                    <ul class="footer-menu">
                        @foreach($menu->get('menu_header') as $item)
                            <li><a href="{{ $item->link }}">{{ $item->name }}</a></li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</footer>

@include('layouts.forms.recall-me')
@include('layouts.forms.cost-calculation')

<script src="{{ asset('js/main.min.js') }}"></script>
<script src="{{ asset('js/vendor.min.js') }}"></script>
</body>
</html>

