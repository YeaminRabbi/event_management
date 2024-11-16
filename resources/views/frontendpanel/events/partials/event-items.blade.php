@forelse($events as $event)
    <div class="col-lg-6 col-md-12 col-sm-12">
        <div class="event-item clearfix">
            <div class="event-image">
                <div class="post-date">
                    <span class="date">{{ date('d', strtotime($event->start)) }}</span>
                    <small class="month">{{ date('M', strtotime($event->start)) }}</small>
                </div>
                <img src="{{ asset($event->image->url ?? '') }}" alt="{{ $event->summary }}">
            </div>
            
            <div class="event-content">
                <div class="event-title mb-15">
                    <h3 class="title">{{ $event->summary }}</h3>
                    <span class="ticket-price yellow-color">Tickets from ${{ number_format($event->ticket_price, 2) }}</span>
                </div>
                <div class="event-post-meta ul-li-block mb-30">
                    <ul>
                        <li>
                            <span class="icon"><i class="far fa-clock"></i></span>
                            Start {{ date('h:i A', strtotime($event->start)) }} - {{ date('h:i A', strtotime($event->end)) }}
                        </li>
                        <li>
                            <span class="icon"><i class="fas fa-map-marker-alt"></i></span>
                            {{ $event->location }}
                        </li>
                    </ul>
                </div>
                <a href="#" class="tickets-details-btn">tickets & details</a>
            </div>
        </div>
    </div>
@empty
    <div class="col-12">
        <p class="text-center">No events found for this category.</p>
    </div>
@endforelse

@if ($events->hasPages())
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="pagination ul-li clearfix">
            <ul>
                <!-- Previous Page Link -->
                @if ($events->onFirstPage())
                    <li class="page-item prev-item disabled">
                        <span class="page-link">Prev</span>
                    </li>
                @else
                    <li class="page-item prev-item">
                        <button class="page-link paginate-btn" 
                                data-type="{{ $type }}" 
                                data-page="{{ $events->currentPage() - 1 }}">
                            Prev
                        </button>
                    </li>
                @endif

                <!-- Pagination Links -->
                @foreach ($events->getUrlRange(1, $events->lastPage()) as $page => $url)
                    <li class="page-item {{ $events->currentPage() == $page ? 'active' : '' }}">
                        <button class="page-link paginate-btn" 
                                data-type="{{ $type }}" 
                                data-page="{{ $page }}">
                            {{ $page }}
                        </button>
                    </li>
                @endforeach

                <!-- Next Page Link -->
                @if ($events->hasMorePages())
                    <li class="page-item next-item">
                        <button class="page-link paginate-btn" 
                                data-type="{{ $type }}" 
                                data-page="{{ $events->currentPage() + 1 }}">
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
