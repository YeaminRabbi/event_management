<!-- breadcrumb-section - start
  ================================================== -->
<section id="breadcrumb-section" class="breadcrumb-section clearfix">
    <div class="jarallax"
        style="background-image: url('{{ asset('frontendpanel/assets/images/breadcrumb/0.breadcrumb-bg.jpg') }}');">
        <div class="overlay-black">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-12 col-sm-12">

                        <!-- breadcrumb-title - start -->
                        <div class="breadcrumb-title text-center mb-50">
                            {{-- <span class="sub-title">all you need to know</span> --}}

                            @hasSection('sub-title')
                                <a href="@yield('route')">
                                    <span class="sub-title">
                                        @yield('title')
                                    </span>
                                </a>
                                <h2 class="big-title">
                                    <strong>
                                        @yield('sub-title')
                                    </strong>
                                </h2>
                            @else
                                <h2 class="big-title">
                                    <strong>
                                        @yield('title')
                                    </strong>
                                </h2>
                            @endif
                        </div>
                        <!-- breadcrumb-title - end -->

                        <!-- breadcrumb-list - start -->
                        <div class="breadcrumb-list">
                            <ul>
                                <li class="breadcrumb-item"><a href="{{ route('home') }}"
                                        class="breadcrumb-link">Home</a></li>
                                @hasSection('sub-title')
                                    <li class="breadcrumb-item" aria-current="page">
                                        <a href="@yield('route')">
                                            @yield('title')
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">@yield('sub-title')</li>
                                @else
                                    <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
                                @endif
                            </ul>
                        </div>
                        <!-- breadcrumb-list - end -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- breadcrumb-section - end
  ================================================== -->
