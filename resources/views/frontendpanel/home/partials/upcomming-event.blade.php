<section id="upcomming-event-section" class="upcomming-event-section sec-ptb-100 clearfix">
    <div class="container">

        <!-- section-title - start -->
        <div class="section-title text-center mb-50">
            <small class="sub-title">upcomming events</small>
            <h2 class="big-title">Latest <strong>Awesome Events</strong></h2>
        </div>
        <!-- section-title - end -->

        <!-- upcomming-event-carousel - start -->
        <div id="upcomming-event-carousel" class="upcomming-event-carousel owl-carousel owl-theme">

            <!-- item - start -->
            @foreach($upcommingEvents as $key => $data)
                <div class="item">
                    <div class="event-item">

                        <div class="countdown-timer">
                            <ul class="countdown-list" data-countdown="{{ $data->start }}"></ul>
                        </div>

                        <div class="event-image">
                            <img src="{{ asset($data->image->url ?? '') }}" alt="Image_not_found">
                            <div class="post-date">
                                <span class="date">{{ date('d', strtotime($data->start)) }}</span>
                                <small class="month">{{ date('M', strtotime($data->start)) }}</small>
                            </div>
                        </div>

                        <div class="event-content">
                            <div class="event-title mb-30">
                                <h3 class="title">
                                    {{ $data->summary ?? '' }}
                                </h3>
                                <span class="ticket-price yellow-color">Tickets from ${{ number_format($data->ticket_price, 2) }}</span>
                            </div>
                            <div class="event-post-meta ul-li-block mb-30">
                                <ul>
                                    <li>
                                        <span class="icon">
                                            <i class="far fa-clock"></i>
                                        </span>
                                        Start {{ date('g:i A', strtotime($data->start)) }} - {{ date('g:i A', strtotime($data->end)) }}
                                    </li>
                                    <li>
                                        <span class="icon">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </span>
                                        {{ $data->location ?? '' }}
                                    </li>
                                </ul>
                            </div>
                            <a href="{{ route('event.details', $data->id) }}" class="custom-btn">
                                tickets & details
                            </a>
                            {{-- <a href="{{ route('frontend.event.show', $data->slug) }}" class="custom-btn">
                                tickets & details
                            </a> --}}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- upcomming-event-carousel - end -->

    </div>
</section>