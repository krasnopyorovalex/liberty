<!DOCTYPE html>
<html lang="ru-RU" prefix="og: http://ogp.me/ns#">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui">
    <title>@yield('title', 'Мебель для гостиниц')</title>
    <meta name="description" content="@yield('description', '')">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#f1f5f8">
    @stack('og')
    <link rel="shortcut icon" href="{{ asset('img/favicons/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" sizes="16x16" href="{{ asset('img/favicons/favicon-16x16.png') }}" type="image/png">
    <link rel="icon" sizes="32x32" href="{{ asset('img/favicons/favicon-32x32.png') }}" type="image/png">
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
    <link href="{{ asset('css/app.min.css') }}" rel="stylesheet">
    <link rel="canonical" href="@yield('canonical', request()->url())"/>
</head>
<body>
    <header itemscope="" itemtype="http://schema.org/WPHeader">
        <meta itemprop="headline" content="Веб-студия Красбер в Симферополе и Крыму">
        <meta itemprop="description" content="Создание и seo-продвижение веб-сайтов, настройка рекламы в интернете по всей России">
        <meta itemprop="keywords" content="создание, продвижение, интернет-реклама, крым, симферополь">
        <div class="sticky__menu{{ is_main_page() ? '' : ' sticky__menu-always' }}">
            <div class="container">
                <div class="top__line">
                    <a href="tel:+79787547499" class="phone__svg">
                        <svg class="phone">
                            <use xlink:href="{{ asset('img/symbols.svg#phone') }}"></use>
                        </svg>
                    </a>
                    <div class="logo">
                        <a href="{{ route('page.show') }}">
                            <img class="desktop__logo" src="{{ asset('img/logo_white.svg') }}" alt="Создание сайта в веб-студии Красбер" title="Веб-студия Красбер" />
                        </a>
                    </div>
                    <!-- /.logo -->
                    @includeWhen($menu->get('menu_header'), 'layouts.menus.header', ['menu' => $menu, 'services' => $services])
                    <svg class="icon menu">
                        <use xlink:href="{{ asset('img/symbols.svg#menu') }}"></use>
                    </svg>
                    <div class="phone__email">
                        <a href="tel:+79787547499" title="Позвонить" class="phone__link">
                            <span>+7 (978) 754-74-99</span>
                        </a>
                        <a href="mailto:info@krasber.ru" title="Написать на почту">info@krasber.ru</a>
                    </div>
                    <!-- /.phone__email -->
                </div>
                <!-- /.top__line -->
            </div>
        </div>
        @section('slogan')
        @show
    </header>

    @yield('content')

    <section class="footer__contacts">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-6 footer__contacts-text">
                            Звоните, пишите, договоримся!
                        </div>
                        <div class="col-6 footer__contacts-messengers">
                            <div class="phone"><a href="tel:+79787547499" title="Позвонить">+7 (978) 754-74-99</a></div>
                            <div class="email"><a href="mailto:info@krasber.ru" title="Написать на почту">info@krasber.ru</a></div>
                            <div class="f__icons">
{{--                                <a href="https://t.me/nata_105" target="_blank" rel="noopener noreferrer">--}}
{{--                                    <svg class="icon telegram">--}}
{{--                                        <use xlink:href="{{ asset('img/symbols.svg#telegram') }}"></use>--}}
{{--                                    </svg>--}}
{{--                                </a>--}}
                                <a href="https://wa.me/79787547499" target="_blank">
                                    <svg class="icon whatsapp">
                                        <use xlink:href="{{ asset('img/symbols.svg#whatsapp') }}"></use>
                                    </svg>
                                </a>
                                <a href="viber://add?number=79787547499" target="_blank">
                                    <svg class="icon viber">
                                        <use xlink:href="{{ asset('img/symbols.svg#viber') }}"></use>
                                    </svg>
                                </a>
{{--                                <a href="https://www.instagram.com/krasber_studio/" target="_blank" rel="noopener noreferrer">--}}
{{--                                    <svg class="icon insta">--}}
{{--                                        <use xlink:href="{{ asset('img/symbols.svg#insta') }}"></use>--}}
{{--                                    </svg>--}}
{{--                                </a>--}}
{{--                                <a href="https://www.facebook.com/krasber/" target="_blank" rel="noopener noreferrer">--}}
{{--                                    <svg class="icon facebook">--}}
{{--                                        <use xlink:href="{{ asset('img/symbols.svg#facebook') }}"></use>--}}
{{--                                    </svg>--}}
{{--                                </a>--}}
{{--                                <a href="https://vk.com/krasber" target="_blank" rel="noopener noreferrer">--}}
{{--                                    <svg class="icon vk">--}}
{{--                                        <use xlink:href="{{ asset('img/symbols.svg#vk') }}"></use>--}}
{{--                                    </svg>--}}
{{--                                </a>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer itemtype="http://schema.org/WPFooter" itemscope="">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="line"></div>
                    <div class="row list__columns">
                        <div class="col__logo">
                            <div class="copyright">
                                <span itemprop="copyrightYear">2017</span> - {{ date('Y') }} © Создание и продвижение сайтов. ИНН 910601621324
                                <p>Вся информация, представленная на сайте, носит информационный характер и ни при каких условиях не является публичной офертой.</p>
                            </div>
                        </div>
                        @foreach ($services as $service)
                            <div class="col__service">
                                <div class="title">{{ $service->getMenuName() }}</div>
                                @if ($service->services->count())
                                    <ul>
                                        @foreach ($service->services as $subService)
                                            <li><a href="{{ route('service.show', $subService->alias) }}">{{ $subService->getMenuName() }}</a></li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        @endforeach
                        <div class="col__nav">
                            @includeWhen($menu->get('menu_footer'), 'layouts.menus.footer', ['menu' => $menu])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <div class="notify"></div>

    <script type="text/javascript" >
        (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
            m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");
        ym(45495162, "init", {id:45495162,clickmap:true,trackLinks:true,accurateTrackBounce:true,webvisor:true,trackHash:true});
    </script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-107358703-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments)};
        gtag('js', new Date());
        gtag('config', 'UA-107358703-1');
    </script>
    <script type="text/javascript">(window.Image ? (new Image()) : document.createElement('img')).src = 'https://vk.com/rtrg?p=VK-RTRG-224888-EpCh';</script>
    <script src="{{ asset('js/jquery.3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/app.min.js') }}"></script>
</body>
</html>
