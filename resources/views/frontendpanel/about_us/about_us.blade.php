@extends('frontendpanel.layout.master')

@section('title', 'About Us')

@section('content')
    <!-- our-management-section - start
                                      ================================================== -->
    <section id="our-management-section" class="our-management-section bg-gray-light sec-ptb-100 clearfix">
        <div class="container">
            <div class="row">

                <!-- section-title - start -->
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="section-title text-left mb-50 sr-fade1">
                        {{-- <small class="sub-title">we are harmoni</small> --}}
                        <h2 class="big-title">{{ config('app.name') }}</h2>
                        <a href="#!" class="custom-btn">
                            get started!
                        </a>
                    </div>
                </div>
                <!-- section-title - end -->

                <div class="col-lg-8 col-md-12 col-sm-12">
                    <div class="row">

                        <!-- management-item - start -->
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="management-item sr-fade2">
                                <div class="item-title">
                                    <h3 class="title-text">
                                        our mission
                                    </h3>
                                </div>
                                <p class="black-color mb-30">
                                    {{ $aboutUs->mission ?? '' }}
                                </p>
                            </div>
                        </div>
                        <!-- management-item - end -->

                        <!-- management-item - start -->
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="management-item sr-fade3">
                                <div class="item-title">
                                    <h3 class="title-text">
                                        our vission
                                    </h3>
                                </div>
                                <p class="black-color mb-30">
                                    {{ $aboutUs->vision ?? '' }}
                                </p>
                            </div>
                        </div>
                        <!-- management-item - end -->

                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- our-management-section - end
                                      ================================================== -->





    <!-- award-section - start
                                      ================================================== -->
    <section id="award-section" class="award-section sec-ptb-100 clearfix">
        <div class="container">
            <div class="row">

                <div class="col-lg-12">
                    <p>
                        {!! $aboutUs->description ?? '' !!}
                    </p>
                </div>

            </div>
        </div>
    </section>
    <!-- award-section - end
                                      ================================================== -->





    <!-- service-section - start
                                      ================================================== -->
    @if (isset($aboutUs->advantages) && count($aboutUs->advantages) > 0)
        <section id="service-section" class="service-section sec-ptb-100 bg-gray-light clearfix">
            <div class="container">

                <div class="row">
                    <div class="col-lg-6">
                        <div class="section-title mb-50 sr-fade1">
                            <span class="line-style"></span>
                            <small class="sub-title">why choose us</small>
                            <h2 class="big-title">{{ $aboutUs->title ?? '' }}</h2>
                        </div>
                    </div>

                    {{-- <div class="col-lg-6">
                    <div class="team-btn text-right sr-fade2">
                        <a href="#!" class="custom-btn">meet the team</a>
                    </div>
                </div> --}}
                </div>

                <div class="service-wrapper sr-fade1">
                    <ul>

                        @foreach ($aboutUs->advantages as $advantage)
                            <li>
                                <a href="#!" class="about-item">
                                    <span class="icon">
                                        <i class="{{ $advantage->icon ?? '' }}"></i>
                                    </span>
                                    <strong class="title">
                                        {{ $advantage->title ?? '' }}
                                    </strong>
                                    {{-- <small class="sub-title">
                                            More than 200 teams
                                        </small> --}}
                                </a>
                            </li>
                        @endforeach

                    </ul>
                </div>

            </div>
        </section>
    @endif
    <!-- service-section - end
                                      ================================================== -->


    @if (isset($faqs) && count($faqs) > 0)
        <section id="faq-section" class="faq-section sec-ptb-100 clearfix">
            <div class="container">
                <div class="faq-content-wrapper mb-80">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <!-- section-title - start -->
                            <div class="section-title mb-30">
                                <span class="line-style"></span>
                                <small class="sub-title">find your answer</small>
                                <h2 class="big-title">ask & <strong>questions</strong></h2>
                            </div>
                            <!-- section-title - end -->
                            <div id="faq-accordion" class="faq-accordion">

                                @foreach ($faqs as $faq)
                                    <div class="card">
                                        <div class="card-header" id="heading{{ $faq->id }}">
                                            <button class="btn collapsed" data-toggle="collapse"
                                                data-target="#collapse{{ $faq->id }}" aria-expanded="true"
                                                aria-controls="collapse{{ $faq->id }}">
                                                <span>0{{ $loop->iteration }}.</span> {{ $faq->question }}
                                            </button>
                                        </div>

                                        <div id="collapse{{ $faq->id }}" class="collapse"
                                            aria-labelledby="heading{{ $faq->id }}" data-parent="#faq-accordion">
                                            <div class="card-body">
                                                <h3>answer</h3>
                                                {{ $faq->answer }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection
