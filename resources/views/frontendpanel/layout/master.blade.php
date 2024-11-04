<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>{{ config('app.name') }} | @yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('images/logo/favicon.png') }}">

    <!-- fraimwork - css include -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontendpanel/assets/css/bootstrap.min.css') }}">

    <!-- icon css include -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontendpanel/assets/css/fontawesome-all.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontendpanel/assets/css/flaticon.css') }}">

    <!-- carousel css include -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontendpanel/assets/css/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontendpanel/assets/css/slick-theme.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontendpanel/assets/css/animate.cssv') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontendpanel/assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontendpanel/assets/css/owl.theme.default.min.css') }}">

    <!-- others css include -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontendpanel/assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontendpanel/assets/css/jquery.mCustomScrollbar.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontendpanel/assets/css/calendar.css') }}">

    <!-- color switcher css include -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontendpanel/assets/css/colors/style-switcher.css') }}">
    <link id="color_theme" rel="stylesheet" type="text/css" href="{{ asset('frontendpanel/assets/css/colors/default.css') }}">

    <!-- custom css include -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontendpanel/assets/css/style.css') }}">

    @yield('custom_css')

</head>


<body>
    <!-- backtotop - start -->
    <div id="thetop" class="thetop"></div>
    <div class='backtotop'>
        <a href="#thetop" class='scroll'>
            <i class="fas fa-angle-double-up"></i>
        </a>
    </div>
    <!-- backtotop - end -->

    <!-- preloader - start -->
    <div id="preloader"></div>
    <!-- preloader - end -->

    <!-- header-section - start
  ================================================== -->
    @include('frontendpanel.layout.header')
    <!-- header-section - end
  ================================================== -->

    @yield('content')

    <!-- footer-section2 - start
  ================================================== -->
    @include('frontendpanel.layout.footer')
    <!-- footer-section2 - end
  ================================================== -->


    <!-- fraimwork - jquery include -->
    <script src="{{ asset('frontendpanel/assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('frontendpanel/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('frontendpanel/assets/js/bootstrap.min.js') }}"></script>

    <!-- carousel jquery include -->
    <script src="{{ asset('frontendpanel/assets/js/slick.min.js') }}"></script>
    <script src="{{ asset('frontendpanel/assets/js/owl.carousel.min.js') }}"></script>

    <!-- map jquery include -->
    <script src="{{ asset('frontendpanel/assets/js/gmap3.min.js') }}"></script>
    <script src="http://maps.google.com/maps/api/js?key=AIzaSyC61_QVqt9LAhwFdlQmsNwi5aUJy9B2SyA"></script>

    <!-- calendar jquery include -->
    <script src="{{ asset('frontendpanel/assets/js/atc.min.js') }}"></script>

    <!-- others jquery include -->
    <script src="{{ asset('frontendpanel/assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('frontendpanel/assets/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('frontendpanel/assets/js/jarallax.min.js') }}"></script>
    <script src="{{ asset('frontendpanel/assets/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>

    <!-- gallery img loaded - jqury include -->
    <script src="{{ asset('frontendpanel/assets/js/imagesloaded.pkgd.min.js') }}"></script>

    <!-- multy count down - jqury include -->
    <script src="{{ asset('frontendpanel/assets/js/jquery.countdown.js') }}"></script>

    <!-- color panal - jqury include -->
    <script src="{{ asset('frontendpanel/assets/js/style-switcher.js') }}"></script>

    <!-- custom jquery include -->
    <script src="{{ asset('frontendpanel/assets/js/custom.js') }}"></script>

    @yield('custom_js')
</body>

</html>
