@extends('frontendpanel.layout.master')

@section('title', 'Home')

@section('content')

    <!-- slide-section - start
      ================================================== -->
    @include('frontendpanel.home.partials.slide')
    <!-- slide-section - end
    ================================================== -->




    <!-- upcomming-event-section - start
    ================================================== -->
    @include('frontendpanel.home.partials.upcomming-event')
    <!-- upcomming-event-section - end
    ================================================== -->



    <!-- about-section - start
    ================================================== -->
    @include('frontendpanel.home.partials.about')
    <!-- about-section - end
    ================================================== -->





    <!-- conference-section - start
    ================================================== -->
    @include('frontendpanel.home.partials.conference')
    <!-- conference-section - end
    ================================================== -->





    <!-- special-offer-section - start
    ================================================== -->
    @include('frontendpanel.home.partials.special-offer')
    <!-- special-offer-section - end
    ================================================== -->





    <!-- event-section - start
    ================================================== -->
    @include('frontendpanel.home.partials.event')
    <!-- event-section - end
    ================================================== -->





    <!-- event-gallery-section - start
    ================================================== -->
    @include('frontendpanel.home.partials.event-gallery')
    <!-- event-gallery-section - end
    ================================================== -->





    <!-- event-expertise-section - start
    ================================================== -->
    @include('frontendpanel.home.partials.event-expertise')
    <!-- event-expertise-section - end
    ================================================== -->





    <!-- speaker-section - start
    ================================================== -->
    @include('frontendpanel.home.partials.speaker')
    <!-- speaker-section - end
    ================================================== -->





    <!-- advertisement-section - start
    ================================================== -->
    @include('frontendpanel.home.partials.advertisement')
    <!-- advertisement-section - end
    ================================================== -->





    <!-- partners-clients-section - start
    ================================================== -->
    @include('frontendpanel.home.partials.partners')
    <!-- partners-clients-section - end
    ================================================== -->





    <!-- news-update-section - start
    ================================================== -->
    @include('frontendpanel.home.partials.news')
    <!-- news-update-section - end
    ================================================== -->





    <!-- google map - start
    ================================================== -->
    @include('frontendpanel.home.partials.map')
    <!-- google map - end
    ================================================== -->
@endsection
