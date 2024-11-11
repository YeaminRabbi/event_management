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
    <link rel="stylesheet" type="text/css"
        href="{{ asset('frontendpanel/assets/css/jquery.mCustomScrollbar.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontendpanel/assets/css/calendar.css') }}">

    <!-- color switcher css include -->
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('frontendpanel/assets/css/colors/style-switcher.css') }}"> --}}
    <link id="color_theme" rel="stylesheet" type="text/css"
        href="{{ asset('frontendpanel/assets/css/colors/default.css') }}">

    <!-- custom css include -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontendpanel/assets/css/style.css') }}">

    <style>

        #preloader {
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1005;
            position: fixed;
            overflow: visible;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 5px;
            background: #212121;
        }

        .loading-text {
            color: white;
            font-size: 14pt;
            font-weight: 600;
            margin-left: 10px;
        }

        .dot {
            margin-left: 3px;
            animation: blink 1.5s infinite;
        }

        .dot:nth-child(2) {
            animation-delay: 0.3s;
        }

        .dot:nth-child(3) {
            animation-delay: 0.6s;
        }

        .loading-bar-background {
            --height: 30px;
            display: flex;
            align-items: center;
            box-sizing: border-box;
            padding: 5px;
            width: 200px;
            height: var(--height);
            background-color: #212121
                /*change this*/
            ;
            box-shadow: #0c0c0c -2px 2px 4px 0px inset;
            border-radius: calc(var(--height) / 2);
        }

        .loading-bar {
            position: relative;
            display: flex;
            justify-content: center;
            flex-direction: column;
            --height: 20px;
            width: 0%;
            height: var(--height);
            overflow: hidden;
            background: rgb(222, 74, 15);
            background: linear-gradient(0deg,
                    rgba(222, 74, 15, 1) 0%,
                    rgba(249, 199, 79, 1) 100%);
            border-radius: calc(var(--height) / 2);
            animation: loading 4s ease-out infinite;
        }

        .white-bars-container {
            position: absolute;
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .white-bar {
            background: rgb(255, 255, 255);
            background: linear-gradient(-45deg,
                    rgba(255, 255, 255, 1) 0%,
                    rgba(255, 255, 255, 0) 70%);
            width: 10px;
            height: 45px;
            opacity: 0.3;
            rotate: 45deg;
        }

        @keyframes loading {
            0% {
                width: 0;
            }

            80% {
                width: 100%;
            }

            100% {
                width: 100%;
            }
        }

        @keyframes blink {

            0%,
            100% {
                opacity: 0;
            }

            50% {
                opacity: 1;
            }
        }
    </style>

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
    {{-- <div id="preloader"></div> --}}
    <div class="preloader" id="preloader">
        <div class="loading-text">
            Loading<span class="dot">.</span><span class="dot">.</span><span class="dot">.</span>
        </div>
        <div class="loading-bar-background">
            <div class="loading-bar">
                <div class="white-bars-container">
                    <div class="white-bar"></div>
                    <div class="white-bar"></div>
                    <div class="white-bar"></div>
                    <div class="white-bar"></div>
                    <div class="white-bar"></div>
                    <div class="white-bar"></div>
                    <div class="white-bar"></div>
                    <div class="white-bar"></div>
                    <div class="white-bar"></div>
                    <div class="white-bar"></div>
                </div>
            </div>
        </div>
    </div>

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
    {{-- <script src="{{ asset('frontendpanel/assets/js/style-switcher.js') }}"></script> --}}

    <!-- custom jquery include -->
    <script src="{{ asset('frontendpanel/assets/js/custom.js') }}"></script>

    @yield('custom_js')
</body>

</html>
