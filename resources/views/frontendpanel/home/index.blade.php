@extends('frontendpanel.layout.master')

@section('title', 'Home')

@section('content')

    <!-- slide-section - start
                          ================================================== -->
    @if (isset($banners) && count($banners) > 0)
        @include('frontendpanel.home.partials.slide')
    @endif
    <!-- slide-section - end
                        ================================================== -->




    <!-- upcomming-event-section - start
                        ================================================== -->
    @if (isset($upcommingEvents) && count($upcommingEvents) > 0)
        @include('frontendpanel.home.partials.upcomming-event')
    @endif
    <!-- upcomming-event-section - end
                        ================================================== -->



    <!-- about-section - start
                        ================================================== -->
    @if (isset($aboutUs))
        @include('frontendpanel.home.partials.about')
    @endif
    <!-- about-section - end
                        ================================================== -->





    <!-- conference-section - start
                        ================================================== -->
    {{-- @include('frontendpanel.home.partials.conference') --}}
    <!-- conference-section - end
                        ================================================== -->





    <!-- special-offer-section - start
                        ================================================== -->
    @include('frontendpanel.home.partials.special-offer')
    <!-- special-offer-section - end
                        ================================================== -->





    <!-- event-section - start
                        ================================================== -->
    @if (isset($events))
        @include('frontendpanel.home.partials.event')
    @endif
    <!-- event-section - end
                        ================================================== -->





    <!-- event-gallery-section - start
                        ================================================== -->
    @if (isset($galleries) && count($galleries) > 0)
        @include('frontendpanel.home.partials.event-gallery')
    @endif
    <!-- event-gallery-section - end
                        ================================================== -->





    <!-- event-expertise-section - start
                        ================================================== -->
    {{-- @include('frontendpanel.home.partials.event-expertise') --}}
    <!-- event-expertise-section - end
                        ================================================== -->





    <!-- speaker-section - start
                        ================================================== -->
    {{-- @include('frontendpanel.home.partials.speaker') --}}
    <!-- speaker-section - end
                        ================================================== -->





    <!-- advertisement-section - start
                        ================================================== -->
    {{-- @include('frontendpanel.home.partials.advertisement') --}}
    <!-- advertisement-section - end
                        ================================================== -->





    <!-- partners-clients-section - start
                        ================================================== -->
    {{-- @include('frontendpanel.home.partials.partners') --}}
    <!-- partners-clients-section - end
                        ================================================== -->





    <!-- news-update-section - start
                        ================================================== -->
    @if ((isset($blogs) && count($blogs) > 0) || (isset($faqs) && count($faqs) > 0))
        @include('frontendpanel.home.partials.blogs')
    @endif
    <!-- news-update-section - end
                        ================================================== -->





    <!-- google map - start
                        ================================================== -->
    {{-- @include('frontendpanel.home.partials.map') --}}
    <!-- google map - end
                        ================================================== -->
@endsection
