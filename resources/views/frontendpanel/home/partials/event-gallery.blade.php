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
