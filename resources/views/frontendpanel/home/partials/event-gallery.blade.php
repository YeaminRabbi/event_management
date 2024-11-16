{{-- <section id="event-gallery-section" class="event-gallery-section sec-ptb-100 clearfix">

    <!-- section-title - start -->
    <div class="section-title text-center mb-50">
        <small class="sub-title">harmoni gallery</small>
        <h2 class="big-title">Beautiful & <strong>Unforgettable Times</strong></h2>
    </div>
    <!-- section-title - end -->

    <div class="button-group filters-button-group mb-30">
        <button class="button is-checked" data-filter="*">
            <i class="fas fa-star"></i>
            <strong>all</strong> gallery
        </button>
        <button class="button" data-filter=".video-gallery">
            <i class="fas fa-play-circle"></i>
            <strong>video</strong> gallery
        </button>
        <button class="button" data-filter=".photo-gallery">
            <i class="far fa-image"></i>
            <strong>photo</strong> gallery
        </button>
    </div>

    <div class="grid zoom-gallery clearfix mb-80"
        data-isotope="{ &quot;masonry&quot;: { &quot;columnWidth&quot;: 0 } }">
        <div class="grid-item grid-item--height2 photo-gallery " data-category="photo-gallery">
            <a class="popup-link" href="{{ asset('frontendpanel/assets/images/gallery/1.image.jpg') }}">
                <img src="{{ asset('frontendpanel/assets/images/gallery/1.image.jpg') }}" alt="Image_not_found">
            </a>
            <div class="item-content">
                <h3>John Doe Wedding day</h3>
                <span>Wedding Party, 24 June 2016</span>
            </div>
        </div>
        <div class="grid-item grid-item--width2 video-gallery " data-category="video-gallery">
            <a class="popup-youtube" href="https://youtu.be/-haiaZ011OM">
                <img src="{{ asset('frontendpanel/assets/images/gallery/2.image.jpg') }}" alt="Image_not_found">
            </a>
            <div class="item-content">
                <h3>Business Conference in Dubai</h3>
                <span>Food Festival, 24 June 2016</span>
            </div>
        </div>
        <div class="grid-item photo-gallery " data-category="photo-gallery">
            <a class="popup-link" href="{{ asset('frontendpanel/assets/images/gallery/3.image.jpg') }}">
                <img src="{{ asset('frontendpanel/assets/images/gallery/3.image.jpg') }}" alt="Image_not_found">
            </a>
            <div class="item-content">
                <h3>Envato Author Fun Hiking</h3>
                <span>Food Festival, 24 June 2016</span>
            </div>
        </div>

        <div class="grid-item photo-gallery " data-category="photo-gallery">
            <a class="popup-link" href="{{ asset('frontendpanel/assets/images/gallery/4.image.jpg') }}">
                <img src="{{ asset('frontendpanel/assets/images/gallery/4.image.jpg') }}" alt="Image_not_found">
            </a>
            <div class="item-content">
                <h3>John Doe Wedding day</h3>
                <span>Wedding Party, 24 June 2016</span>
            </div>
        </div>
        <div class="grid-item grid-item--width2 video-gallery " data-category="video-gallery">
            <a class="popup-youtube" href="https://youtu.be/-haiaZ011OM">
                <img src="{{ asset('frontendpanel/assets/images/gallery/5.image.jpg') }}" alt="Image_not_found">
            </a>
            <div class="item-content">
                <h3>New Year Celebration</h3>
                <span>Food Festival, 24 June 2016</span>
            </div>
        </div>

        <div class="grid-item grid-item--width2 photo-gallery " data-category="photo-gallery">
            <a class="popup-link" href="{{ asset('frontendpanel/assets/images/gallery/6.image.jpg') }}">
                <img src="{{ asset('frontendpanel/assets/images/gallery/6.image.jpg') }}" alt="Image_not_found">
            </a>
            <div class="item-content">
                <h3>John Doe Wedding day</h3>
                <span>Wedding Party, 24 June 2016</span>
            </div>
        </div>
        <div class="grid-item video-gallery " data-category="video-gallery">
            <a class="popup-youtube" href="https://youtu.be/-haiaZ011OM">
                <img src="{{ asset('frontendpanel/assets/images/gallery/7.image.jpg') }}" alt="Image_not_found">
            </a>
            <div class="item-content">
                <h3>New Year Celebration</h3>
                <span>Food Festival, 24 June 2016</span>
            </div>
        </div>
        <div class="grid-item photo-gallery " data-category="photo-gallery">
            <a class="popup-link" href="{{ asset('frontendpanel/assets/images/gallery/8.image.jpg') }}">
                <img src="{{ asset('frontendpanel/assets/images/gallery/8.image.jpg') }}" alt="Image_not_found">
            </a>
            <div class="item-content">
                <h3>Envato Author Fun Hiking</h3>
                <span>Food Festival, 24 June 2016</span>
            </div>
        </div>
    </div>

    <div class="text-center">
        <a href="#!" class="custom-btn">view all gallery</a>
    </div>


</section> --}}


<section id="event-gallery-section" class="event-gallery-section sec-ptb-100 clearfix">

    <!-- Section Title -->
    <div class="section-title text-center mb-50">
        <small class="sub-title">Event Gallery</small>
        <h2 class="big-title">Beautiful & <strong>Unforgettable Moments</strong></h2>
    </div>

    <div class="grid zoom-gallery clearfix mb-80">
        @foreach ($galleries as $event)
            {{-- @foreach ($event->images as $image) --}}
                <div class="grid-item photo-gallery" data-category="photo-gallery">
                    <a class="popup-link" href="{{ asset($event->image->url ?? '') }}">
                        <img src="{{ asset($event->image->url ?? '') }}" alt="{{ $event->summary }}">
                    </a>
                    <div class="item-content">
                        <h3>{{ $event->summary }}</h3>
                        <span>{{ date('F d, Y', strtotime($event->start)) }}</span>
                    </div>
                </div>
            {{-- @endforeach --}}
        @endforeach
    </div>

    <div class="text-center">
        <a href="#!" class="custom-btn">View All Events</a>
    </div>

</section>
