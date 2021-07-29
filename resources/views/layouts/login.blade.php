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
</head>
<body class="login-container">

<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Content area -->
            <div class="content">

                @yield('content')

                <!-- Footer -->
                <div class="footer text-muted text-center">
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

<!-- Scripts -->
<script src="{{ asset('dashboard/assets/js/jquery.js') }}" defer></script>
<script src="{{ asset('dashboard/assets/js/plugins/loaders/pace.min.js') }}" defer></script>
<script src="{{ asset('dashboard/assets/js/core/libraries/bootstrap.min.js') }}" defer></script>
<script src="{{ asset('dashboard/assets/js/plugins/loaders/blockui.min.js') }}" defer></script>
<script src="{{ asset('dashboard/assets/js/plugins/forms/styling/uniform.min.js') }}" defer></script>
<script src="{{ asset('dashboard/assets/js/core/app.js') }}" defer></script>
<script src="{{ asset('dashboard/assets/js/core/user_scripts.js') }}" defer></script>
</body>
</html>
