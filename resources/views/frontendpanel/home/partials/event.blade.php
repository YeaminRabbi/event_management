@section('custom_css')
    <style>
        .loading-state {
            opacity: 0.6;
            pointer-events: none;
        }
    </style>
@endsection
<section id="event-section" class="event-section sec-ptb-100 bg-gray-light clearfix">
    <div class="container">

        <div class="mb-50">
            <div class="row">
                <!-- section-title - start -->
                <div class="col-lg-3 col-md-12 col-sm-12">
                    <div class="section-title text-left">
                        <span class="line-style"></span>
                        <small class="sub-title">harmoni events</small>
                        <h2 class="big-title"><strong>event</strong> listing</h2>
                    </div>
                </div>
                <!-- section-title - end -->

                <!-- event-tab-menu - start -->
                <div class="col-lg-8 col-md-12 col-sm-12">
                    <div class="event-tab-menu clearfix">
                        <ul class="nav">
                            @foreach ($eventTypes as $type)
                                <li>
                                    <a class="event-tab-link {{ $type === 'conference' ? 'active' : '' }}"
                                        data-toggle="tab" href="#{{ $type }}-event">
                                        <strong>
                                            <i
                                                class="fas fa-{{ \App\Helpers\Frontend::getEventTypeIcon($type) ?? '' }}"></i>
                                            {{ $type }}
                                        </strong> event
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <!-- event-tab-menu - end -->
            </div>
        </div>

        <!-- tab-content - start -->
        <div class="tab-content">
            @foreach ($eventTypes as $type)
                <div id="{{ $type }}-event"
                    class="tab-pane fade {{ $type === 'conference' ? 'show active' : '' }}">
                    <div class="row">
                        @forelse($events[$type] as $event)
                            <!-- event-item - start -->
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div class="event-item clearfix">
                                    <!-- event-image - start -->
                                    <div class="event-image">
                                        <div class="post-date">
                                            <span class="date">{{ date('d', strtotime($event->start)) }}</span>
                                            <small class="month">{{ date('M', strtotime($event->start)) }}</small>
                                        </div>
                                        <img src="{{ asset($event->image->url ?? '') }}" alt="{{ $event->summary }}">
                                    </div>
                                    <!-- event-image - end -->

                                    <!-- event-content - start -->
                                    <div class="event-content">
                                        <div class="event-title mb-15">
                                            <h3 class="title">
                                                {{ $event->summary }}
                                            </h3>
                                            <span class="ticket-price yellow-color">Tickets from
                                                ${{ number_format($event->ticket_price, 2) }}</span>
                                        </div>
                                        <div class="event-post-meta ul-li-block mb-30">
                                            <ul>
                                                <li>
                                                    <span class="icon">
                                                        <i class="far fa-clock"></i>
                                                    </span>
                                                    Start {{ date('h:i A', strtotime($event->start)) }} -
                                                    {{ date('h:i A', strtotime($event->end)) }}
                                                </li>
                                                <li>
                                                    <span class="icon">
                                                        <i class="fas fa-map-marker-alt"></i>
                                                    </span>
                                                    {{ $event->location }}
                                                </li>
                                            </ul>
                                        </div>
                                        <a href="#" class="tickets-details-btn">
                                            tickets & details
                                        </a>
                                    </div>
                                    <!-- event-content - end -->
                                </div>
                            </div>
                            <!-- event-item - end -->
                        @empty
                            <div class="col-12">
                                <p class="text-center">No events found for this category.</p>
                            </div>
                        @endforelse

                        <!-- Custom Pagination -->
                        @if ($events[$type]->hasPages())
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="pagination ul-li clearfix">
                                    <ul>
                                        <!-- Previous Page Link -->
                                        @if ($events[$type]->onFirstPage())
                                            <li class="page-item prev-item disabled">
                                                <span class="page-link">Prev</span>
                                            </li>
                                        @else
                                            <li class="page-item prev-item">
                                                <button class="page-link paginate-btn" data-type="{{ $type }}"
                                                    data-page="{{ $events[$type]->currentPage() - 1 }}">
                                                    Prev
                                                </button>
                                            </li>
                                        @endif

                                        <!-- Pagination Elements -->
                                        @foreach (range(1, $events[$type]->lastPage()) as $i)
                                            <li
                                                class="page-item {{ $events[$type]->currentPage() == $i ? 'active' : '' }}">
                                                <button class="page-link paginate-btn" data-type="{{ $type }}"
                                                    data-page="{{ $i }}">
                                                    {{ $i }}
                                                </button>
                                            </li>
                                        @endforeach

                                        <!-- Next Page Link -->
                                        @if ($events[$type]->hasMorePages())
                                            <li class="page-item next-item">
                                                <button class="page-link paginate-btn" data-type="{{ $type }}"
                                                    data-page="{{ $events[$type]->currentPage() + 1 }}">
                                                    Next
                                                </button>
                                            </li>
                                        @else
                                            <li class="page-item next-item disabled">
                                                <span class="page-link">Next</span>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            @endforeach
        </div>
        <!-- tab-content - end -->

    </div>
</section>

@section('custom_js')
    <script>
        $(document).ready(function () {
    // Use event delegation for dynamically added buttons
    $(document).on('click', '.paginate-btn', function (e) {
        e.preventDefault();

        const button = $(this);
        const type = button.data('type');
        const page = button.data('page');
        const tabContent = $(`#${type}-event .row`);

        // Show loading state
        tabContent.addClass('loading-state');
        button.prop('disabled', true);

        // AJAX request for pagination
        $.ajax({
            url: '{{ route('events.paginate') }}', // Adjust this route if needed
            method: 'GET',
            data: {
                type: type,
                page: page
            },
            success: function (response) {
                // Replace the content with new events
                tabContent.html(response);

                // Scroll to the updated content
                $('html, body').animate({
                    scrollTop: tabContent.offset().top - 100
                }, 500);
            },
            error: function (xhr) {
                console.error('Error loading events:', xhr);
                alert('Unable to load events. Please try again.');
            },
            complete: function () {
                // Remove loading state
                tabContent.removeClass('loading-state');
                button.prop('disabled', false);
            }
        });
    });
});

    </script>
@endsection
