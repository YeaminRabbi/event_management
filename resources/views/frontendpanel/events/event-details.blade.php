@extends('frontendpanel.layout.master')

@section('title', 'Event')

@section('route', route('events'))

@section('sub-title', $event->summary)

@section('content')
    <section id="event-details-section" class="event-details-section sec-ptb-100 clearfix">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="event-details mb-80">
                        <div class="event-title mb-30">
                            <span class="tag-item">
                                <i class="fas fa-bookmark"></i>
                                {{ $event->event_type ?? '' }}
                            </span>
                            <h2 class="event-title">{{ $event->summary ?? '' }}</h2>
                        </div>

                        @if ($event->image)
                            <div id="event-details-carousel" class="event-details-carousel owl-carousel owl-theme">
                                <div class="item">
                                    <img src="{{ asset($event->image->url) }}" alt="{{ $event->summary ?? '' }}">
                                </div>
                            </div>
                        @endif

                        <div class="event-info-list ul-li clearfix mb-50">
                            <ul>
                                <li>
                                    <span class="icon"><i class="far fa-calendar"></i></span>
                                    <div class="event-content">
                                        <small class="event-title">Event Date</small>
                                        <h3 class="event-date">{{ date('d F Y', strtotime($event->start)) }}
                                        </h3>
                                    </div>
                                </li>
                                <li>
                                    <span class="icon"><i class="far fa-clock"></i></span>
                                    <div class="event-content">
                                        <small class="event-title">Event Time</small>
                                        <h3 class="event-date">
                                            {{ date('g:i A', strtotime($event->start)) }} ~
                                            {{ date('g:i A', strtotime($event->end)) }}
                                        </h3>
                                    </div>
                                </li>
                                <li>
                                    <span class="icon"><i class="fas fa-map-marker-alt"></i></span>
                                    <div class="event-content">
                                        <small class="event-title">Event Location</small>
                                        <h3 class="event-date">{{ $event->location ?? '' }}</h3>
                                    </div>
                                </li>
                                @if ($event->information['max_event_capacity'])
                                    <li class="mt-1">
                                        <span class="icon"><i class="fas fa-ticket-alt"></i></span>
                                        <div class="event-content">
                                            <small class="event-title">Max Sit</small>
                                            <h3 class="event-date">{{ $event->information['max_event_capacity'] }}</h3>
                                        </div>
                                    </li>
                                @endif
                                @if ($event->information['min_age_requirement'])
                                    <li class="mt-1">
                                        <span class="icon"><i class="fas fa-address-card"></i></span>
                                        <div class="event-content">
                                            <small class="event-title">Age Req.</small>
                                            <h3 class="event-date">{{ $event->information['min_age_requirement'] }}</h3>
                                        </div>
                                    </li>
                                @endif
                                <li class="mt-1">
                                    <span class="icon"><i class="fas fa-dollar-sign"></i></span>
                                    <div class="event-content">
                                        <small class="event-title">Ticket Price</small>
                                        <h3 class="event-date">{{ $event->ticket_price ?? '' }}</h3>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <p class="black-color mb-30">
                            {{ $event->description ?? '' }}
                        </p>

                        <div class="d-flex justify-content-between">
                            <div title="Add to Calendar" class="addeventatc">
                                Add to Calendar
                                <span class="start">{{ date('m/d/Y g:i A', strtotime($event->start)) }}</span> 
                                <span class="end">{{ date('m/d/Y g:i A', strtotime($event->end)) }}</span> 
                                <span class="timezone">{{ env('APP_TIMEZONE') }}</span>
                                <span class="title">{{ $event->summary ?? '' }}</span>
                                <span class="description">{{ $event->description ?? '' }}</span>
                                <span class="location">{{ $event->location ?? '' }}</span>
                                <span class="all_day_event">false</span>
                                <span class="date_format">MM/DD/YYYY</span>
                            </div>
                            <div>
                                <a href="#" class="custom-btn">booking ticket</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
