@extends('frontendpanel.layout.master')

@section('title', 'Events')

@section('content')
    <section id="event-search-section" class="event-search-section clearfix"
        style="background-image: url({{ asset('frontendpanel/assets/images/special-offer-bg.png') }});">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="section-title">
                        <small class="sub-title">Find best event on {{ config('app.name') }}</small>
                        <h2 class="big-title">event <strong>Search</strong></h2>
                    </div>
                </div>

                <div class="col-lg-8 col-md-12 col-sm-12">
                    <div class="search-form form-wrapper">
                        <form action="{{ route('events.search') }}" method="GET">
                            <ul>
                                <li>
                                    <span class="title">event keyword</span>
                                    <div class="form-item">
                                        <input type="search" name="keyword" placeholder="Event name, location, etc"
                                            value="{{ request('keyword') }}">
                                    </div>
                                </li>
                                <li>
                                    <span class="title">event category</span>
                                    <select id="event-category-select" name="event_type">
                                        <option value="" selected>All Categories</option>
                                        @foreach ($eventTypes as $type)
                                            <option value="{{ $type }}"
                                                {{ request('event_type') == $type ? 'selected' : '' }}>
                                                {{ ucfirst($type) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </li>
                                <li>
                                    <button type="submit" class="submit-btn">search event now</button>
                                </li>
                            </ul>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="event-section" class="event-section bg-gray-light sec-ptb-100 clearfix">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9 col-md-12 col-sm-12">
                    <div class="search-result-form">
                        <form action="{{ route('events.search') }}" method="GET">
                            <ul>
                                <li>
                                    <span class="result-text">{{ $events->total() }}
                                        {{ Str::plural('Event', $events->total()) }} Found</span>
                                </li>
                                <li>
                                    <label for="year-select">Year:</label>
                                    <select id="year-select" name="year" onchange="this.form.submit()">
                                        @php
                                            $currentYear = date('Y');
                                            $years = range($currentYear, $currentYear + 10);
                                        @endphp
                                        <option value="" selected>All Years</option>
                                        @foreach ($years as $year)
                                            <option value="{{ $year }}"
                                                {{ request('year') == $year ? 'selected' : '' }}>
                                                {{ $year }}
                                            </option>
                                        @endforeach
                                    </select>
                                </li>
                                <li>
                                    <label for="munth-select">Month:</label>
                                    <select id="munth-select" name="month" onchange="this.form.submit()">
                                        <option value="" selected>All Months</option>
                                        @foreach (range(1, 12) as $month)
                                            <option value="{{ $month }}"
                                                {{ request('month') == $month ? 'selected' : '' }}>
                                                {{ date('F', mktime(0, 0, 0, $month, 1)) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </li>
                            </ul>
                        </form>

                        <ul class="nav event-layout-btngroup">
                            <li><a class="active" data-toggle="tab" href="#list-style"><i class="fas fa-th-list"></i></a>
                            </li>
                            <li><a data-toggle="tab" href="#grid-style"><i class="fas fa-th"></i></a></li>
                        </ul>
                    </div>

                    <div class="tab-content">
                        <div id="list-style" class="tab-pane fade in active show">
                            @forelse($events as $event)
                                <div class="event-list-item clearfix">
                                    <div class="event-image">
                                        <div class="post-date">
                                            <span class="date">{{ date('d', strtotime($event->start)) }}</span>
                                            <small class="month">{{ date('M', strtotime($event->start)) }}</small>
                                        </div>
                                        <img src="{{ $event->image ? asset($event->image->url) : asset('default-event-image.jpg') }}"
                                            alt="{{ $event->summary }}">
                                    </div>

                                    <div class="event-content">
                                        <div class="event-title mb-15">
                                            <h3 class="title">
                                                {{ $event->summary }}
                                            </h3>
                                            <span class="ticket-price yellow-color">
                                                Tickets from ${{ number_format($event->ticket_price, 2) }}
                                            </span>
                                        </div>
                                        <p class="discription-text mb-30">
                                            {{ Str::limit($event->description, 150) }}
                                        </p>
                                        <div class="event-info-list ul-li clearfix">
                                            <ul>
                                                <li>
                                                    <span class="icon">
                                                        <i class="fas fa-map-marker-alt"></i>
                                                    </span>
                                                    <div class="info-content">
                                                        <small>Location</small>
                                                        <h3>{{ $event->location }}</h3>
                                                    </div>
                                                </li>
                                                <li>
                                                    <span class="icon">
                                                        <i class="fas fa-ticket-alt"></i>
                                                    </span>
                                                    <div class="info-content">
                                                        <small>Event Type</small>
                                                        <h3>{{ ucfirst($event->event_type) }}</h3>
                                                    </div>
                                                </li>
                                                <li>
                                                    <a href="{{ route('event.details', $event->id) }}"
                                                        class="tickets-details-btn">
                                                        tickets & details
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="alert alert-info">
                                    No events found matching your criteria.
                                </div>
                            @endforelse
                        </div>

                        <div id="grid-style" class="tab-pane fade">
                            <div class="row justify-content-center">
                                @forelse($events as $event)
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="event-grid-item">
                                            <div class="event-image">
                                                <div class="post-date">
                                                    <span class="date">{{ date('d', strtotime($event->start)) }}</span>
                                                    <small class="month">{{ date('M', strtotime($event->start)) }}</small>
                                                </div>
                                                <img src="{{ $event->image ? asset($event->image->url) : asset('default-event-image.jpg') }}"
                                                    alt="{{ $event->summary }}">
                                            </div>

                                            <div class="event-content">
                                                <div class="event-title mb-30">
                                                    <h3 class="title">
                                                        {{ $event->summary }}
                                                    </h3>
                                                    <span class="ticket-price yellow-color">
                                                        Tickets from ${{ number_format($event->ticket_price, 2) }}
                                                    </span>
                                                </div>
                                                <div class="event-post-meta ul-li-block mb-30">
                                                    <ul>
                                                        <li>
                                                            <span class="icon">
                                                                <i class="far fa-clock"></i>
                                                            </span>
                                                            Start {{ date('g:i A', strtotime($event->start)) }} -
                                                            {{ date('g:i A', strtotime($event->end)) }}
                                                        </li>
                                                        <li>
                                                            <span class="icon">
                                                                <i class="fas fa-map-marker-alt"></i>
                                                            </span>
                                                            {{ $event->location }}
                                                        </li>
                                                    </ul>
                                                </div>
                                                <a href="{{ route('event.details', $event->id) }}"
                                                    class="tickets-details-btn">
                                                    tickets & details
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="alert alert-info">
                                        No events found matching your criteria.
                                    </div>
                                @endforelse
                            </div>
                        </div>
                        <div class="pagination ul-li clearfix">
                            @if ($events->hasPages())
                                <ul>
                                    {{-- Previous Page Link --}}
                                    @if ($events->onFirstPage())
                                        <li class="page-item prev-item disabled">
                                            <span class="page-link">Prev</span>
                                        </li>
                                    @else
                                        <li class="page-item prev-item">
                                            <a class="page-link" href="{{ $events->previousPageUrl() }}">Prev</a>
                                        </li>
                                    @endif

                                    @for ($i = 1; $i <= $events->lastPage(); $i++)
                                        <li class="page-item {{ $events->currentPage() == $i ? 'active' : '' }}">
                                            <a class="page-link"
                                                href="{{ $events->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endfor

                                    {{-- Next Page Link --}}
                                    @if ($events->hasMorePages())
                                        <li class="page-item next-item">
                                            <a class="page-link" href="{{ $events->nextPageUrl() }}">Next</a>
                                        </li>
                                    @else
                                        <li class="page-item next-item disabled">
                                            <span class="page-link">Next</span>
                                        </li>
                                    @endif
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
