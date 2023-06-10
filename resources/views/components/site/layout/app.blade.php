<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ session('dir') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    
    <title>{{ getTransSetting('websit_title', app()->getLocale()) . ' - ' . $title ?? '' }}</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Stylesheets -->
    <link href="{{ asset('site_assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('site_assets/css/material-design-iconic-font.css') }}" rel="stylesheet">
    <link href="{{ asset('site_assets/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('site_assets/css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('site_assets/css/owl.theme.default.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.6/dist/jquery.fancybox.min.css">
    <link href="{{ asset('site_assets/css/animate.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('site_assets/css/style.css') }}" rel="stylesheet">
    <!-- Responsive -->
    <link href="{{ asset('site_assets/css/responsive.css') }}" rel="stylesheet">

    <script src="{{ asset('site_assets/js/jquery-3.2.1.min.js') }}"></script>

    {{ $style ?? '' }}

</head>
<body>

    <x-site.layout.includes.mobile-menu/>
    <!--mobile-menu-->

    <div class="main-wrapper">

        <x-site.layout.includes.header/>
        <!--header-->

        {{ $slot }}

        <x-site.layout.includes.footer/>
        <!--footer-->
    </div>

    <x-site.layout.includes.model-auth/>
    <!--model-auth-->

    <!--main-wrapper--> 
    <script src="{{ asset('site_assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('site_assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('site_assets/js/owl.carousel.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.6/dist/jquery.fancybox.min.js"></script>
    <script src="{{ asset('site_assets/js/wow.js') }}"></script>
    <script src="{{ asset('site_assets/js/script.js') }}"></script>
    
    <script>
        new WOW().init();
    </script>

    {{ $scripts ?? '' }}
</body>
</html> 