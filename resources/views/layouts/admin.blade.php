<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Административная панель управления сайтом - веб-студия «Красбер»</title>

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

    <!-- Styles -->
    <link href="{{ asset('dashboard/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard/assets/css/icons/icomoon/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard/assets/css/core.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard/assets/css/components.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard/assets/css/colors.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard/assets/css/override.css') }}" rel="stylesheet">
    @stack('css')
</head>
<body>

<!-- Main navbar -->
<div class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ route('admin.home') }}"><img src="{{ asset('dashboard/assets/images/logo.png') }}" alt=""></a>

        <ul class="nav navbar-nav visible-xs-block">
            <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
            <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
        </ul>
    </div>

    <div class="navbar-collapse collapse" id="navbar-mobile">

        <p class="navbar-text"><span class="label bg-success">Online</span></p>

        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown dropdown-user">
                <a class="dropdown-toggle" data-toggle="dropdown">
                    <img src="{{ asset('dashboard/assets/images/placeholder.png') }}" alt="">
                    <span>{{{ Auth::user()->name }}}</span>
                    <i class="caret"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="#"><i class="icon-user-plus"></i> My profile</a></li>
                    <li><a href="#"><i class="icon-coins"></i> My balance</a></li>
                    <li><a href="#"><span class="badge bg-teal-400 pull-right">58</span> <i class="icon-comment-discussion"></i> Messages</a></li>
                    <li class="divider"></li>
                    <li><a href="#"><i class="icon-cog5"></i> Account settings</a></li>
                    <li>
                        <a href="#" id="logout-btn"><i class="icon-switch2"></i> Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="post">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- /main navbar -->

<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main sidebar -->
        <div class="sidebar sidebar-main">
            <div class="sidebar-content">

                <!-- Main navigation -->
                <div class="sidebar-category sidebar-category-visible">
                    <div class="category-content no-padding">
                        <ul class="navigation navigation-main navigation-accordion">

                            <!-- Main -->
                            <li class="navigation-header"><span>Навигация</span> <i class="icon-menu" title="Main pages"></i></li>
                            <li><a href="{{ route('admin.pages.index') }}"><i class="icon-compose"></i> <span>Страницы</span></a></li>
                            <li><a href="{{ route('admin.collections.index') }}"><i class="icon-stack4"></i> <span>Коллекции мебели</span></a></li>
                            <li><a href="{{ route('admin.furniture_attributes.index') }}"><i class="icon-stack4"></i> <span>Атрибуты мебели</span></a></li>
                            <li><a href="{{ route('admin.furniture.index') }}"><i class="icon-furniture"></i> <span>Мебель</span></a></li>
                            <li><a href="{{ route('admin.why_choose_us.index') }}"><i class="icon-question3"></i> <span>Почему выбирают нас</span></a></li>
                            <li><a href="{{ route('admin.how_we_works.index') }}"><i class="icon-yin-yang"></i> <span>Как мы работаем</span></a></li>
                            <li><a href="{{ route('admin.sliders.index') }}"><i class="icon-images2"></i> <span>Слайдер</span></a></li>
                            <li><a href="{{ route('admin.interiors.index') }}"><i class="icon-design"></i> <span>Портфолио</span></a></li>
                            <li><a href="{{ route('admin.for_clients.index') }}"><i class="icon-users4"></i> <span>Клиентам</span></a></li>
                            <li><a href="{{ route('admin.authors.index') }}"><i class="icon-pencil-ruler"></i> <span>Авторы</span></a></li>
{{--                            <li><a href="{{ route('admin.services.index') }}"><i class="icon-list"></i> <span>Услуги</span></a></li>--}}
{{--                            <li><a href="{{ route('admin.articles.index') }}"><i class="icon-magazine"></i> <span>Статьи</span></a></li>--}}
{{--                            <li><a href="{{ route('admin.guestbooks.index') }}"><i class="icon-bubble2"></i> <span>Отзывы</span></a></li>--}}
{{--                            <li><a href="{{ route('admin.portfolios.index') }}"><i class="icon-images3"></i> <span>Портфолио</span></a></li>--}}
                            <li><a href="{{ route('admin.menus.index') }}"><i class="icon-lan2"></i> <span>Навигация</span></a></li>
{{--                            <li><a href="{{ route('admin.faqs.index') }}"><i class="icon-question3"></i> <span>Faq</span></a></li>--}}
{{--                            <li><a href="{{ route('admin.tabs.index') }}"><i class="icon-stack"></i> <span>Вкладки</span></a></li>--}}
                            <li><a href="{{ route('admin.redirects.index') }}"><i class="icon-transmission"></i> <span>Редиректы</span></a></li>
                            <!-- /main -->

                        </ul>
                    </div>
                </div>
                <!-- /main navigation -->

                <div class="info_btn">
                    <button type="button" data-toggle="modal" data-target="#modal_info" class="btn btn-primary btn-labeled btn-xlg"><b><i class="icon-info3"></i></b> Информация</button>
                </div>

            </div>
        </div>
        <!-- /main sidebar -->


        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Page header -->
            <div class="page-header page-header-default">

                <div class="breadcrumb-line">
                    <ul class="breadcrumb">
                        <li><a href="{{ route('admin.home') }}"><i class="icon-home2 position-left"></i> Главная</a></li>
                        @section('breadcrumb')
                            <li class="active">Пропишите хлебные крошки</li>
                        @show
                    </ul>
                </div>
            </div>
            <!-- /page header -->


            <!-- Content area -->
            <div class="content">

                @yield('content')

                <!-- Footer -->
                <div class="footer text-muted">
                    &copy; <a href="https://krasber.ru" target="_blank">ООО «Красбер»</a> 2017 - {{ date('Y') }}
                </div>
                <!-- /footer -->

            </div>
            <!-- /content area -->

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

</div>
<!-- /page container -->

<!-- Basic modal -->
<div id="modal_info" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Применение shortcode'ов</h5>
            </div>

            <div class="modal-body">
                <h6 class="text-semibold">Доступные shortcode'ы:</h6>
                <ul>
                    <li>Карта сайта - {sitemap}</li>
                    <li>Тарифы - {tariffs}</li>
                    <li>Форма заказа услуги - {form}</li>
                    <li>FAQ - {faq}</li>
                    <li>Прикреплённые портфолио к услуге - {service_portfolios}</li>
                    <li>Форма-quiz - {quiz}</li>
                    <li>Seo-позиции - {seo}</li>
                </ul>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn bg-primary" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>
<!-- /basic modal -->

<!-- Scripts -->
<script src="{{ asset('dashboard/assets/js/jquery.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/plugins/loaders/pace.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/core/libraries/bootstrap.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/plugins/loaders/blockui.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/plugins/notifications/pnotify.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/core/libraries/jquery_ui/interactions.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/plugins/forms/selects/select2.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/core/app.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/core/user_scripts.js') }}"></script>
@stack('scripts')
</body>
</html>
