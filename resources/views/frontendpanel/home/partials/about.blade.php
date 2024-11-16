<section id="about-section" class="about-section sec-ptb-100 clearfix">
    <div class="container">
        <div class="row">

            <!-- section-title - start -->
            <div class="col-lg-{{ isset($aboutUs->advantages) && count($aboutUs->advantages) > 0 ? '4' : '12' }} col-md-12 col-sm-12">
                <div class="section-title text-left mb-30">
                    <span class="line-style"></span>
                    {{-- <small class="sub-title">we are harmoni</small> --}}
                    <h2 class="big-title">{{ $aboutUs->title ?? '' }}</h2>
                    <p class="black-color mb-50">
                        {!! Str::limit($aboutUs->description ?? '', 300) !!}
                    </p>
                    <a href="#!" class="custom-btn">
                        about harmonei
                    </a>
                </div>
            </div>
            <!-- section-title - end -->

            <!-- about-item-wrapper - start -->
            @if (isset($aboutUs->advantages) && count($aboutUs->advantages) > 0)
                <div class="col-lg-8 col-md-12 col-sm-12">
                    <div class="about-item-wrapper ul-li">
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
            @endif
            <!-- about-item-wrapper - end -->

        </div>
    </div>
</section>
