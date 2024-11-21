{{-- @extends('frontendpanel.layout.master')

@section('title', 'Blogs')

@section('content')
<section id="blog-section" class="blog-section sec-ptb-100 clearfix">
    <div class="container">
        <div class="row">

            <div class="col-lg-8 col-md-12 col-sm-12">
                <!-- blog-wrapper - start -->
                <div class="blog-wrapper">
                    <div class="layout-btn-group">
                        <!-- <h3 class="float-left">change layout</h3> -->
                        <ul class="nav blog-layout-menubar float-right">
                            <li>
                                <a class="active" data-toggle="tab" href="#grid-layout"><i class="fas fa-th"></i></a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#list-layout"><i class="fas fa-th-list"></i></a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#big-layout"><i class="fas fa-square"></i></a>
                            </li>
                        </ul>
                    </div>

                    <div class="tab-content">
                        <!-- grid-layout - start -->
                        <div id="grid-layout" class="tab-pane fade in active show">
                            <div class="row">

                                <!-- blog-grid-item - start -->
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="blog-grid-item">

                                        <div class="event-date">
                                            26 may 2018 - 4.00 PM
                                        </div>

                                        <div class="blog-image">
                                            <img src="assets/images/blog/musical-event1.jpg" alt="Image_not_found">
                                            <a href="#!" class="plus-effect"></a>
                                        </div>

                                        <div class="blog-content">
                                            <a href="#!" class="tag">
                                                <i class="fas fa-bookmark"></i>
                                                musical event
                                            </a>
                                            <h4 class="blog-title">biggest musical event</h4>
                                            <p class="mb-15">
                                                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                            </p>
                                            <a href="#!" class="tickets-details-btn">
                                                Read More
                                            </a>
                                        </div>

                                    </div>
                                </div>
                                <!-- blog-grid-item - end -->

                            </div>
                        </div>
                        <!-- grid-layout - end -->

                        <!-- list-layout - start -->
                        <div id="list-layout" class="tab-pane fade">

                            <!-- blog-list-item - start -->
                            <div class="blog-list-item clearfix">

                                <div class="blog-image float-left">
                                    <img src="assets/images/blog/musical-event1.jpg" alt="Image_not_found">
                                    <a href="#!" class="plus-effect"></a>
                                    <div class="event-date">
                                        26 may 2018 - 4.00 PM
                                    </div>
                                </div>

                                <div class="blog-content float-right">
                                    <a href="#!" class="tag">
                                        <i class="fas fa-bookmark"></i>
                                        musical event
                                    </a>
                                    <h4 class="blog-title">biggest musical event</h4>
                                    <p class="mb-15">
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                    </p>
                                    <a href="#!" class="tickets-details-btn">
                                        Read More
                                    </a>
                                </div>

                            </div>
                            <!-- blog-list-item - end -->

                        </div>
                        <!-- list-layout - end -->

                        <!-- big-layout - start -->
                        <div id="big-layout" class="tab-pane fade">

                            <!-- blog-big-item - start -->
                            <div class="blog-big-item clearfix">

                                <div class="blog-image">
                                    <img src="assets/images/blog/musical-event1.jpg" alt="Image_not_found">
                                    <a href="#!" class="plus-effect"></a>
                                    <div class="event-date">
                                        26 may 2018 - 4.00 PM
                                    </div>
                                </div>

                                <div class="blog-content">
                                    <a href="#!" class="tag">
                                        <i class="fas fa-bookmark"></i>
                                        musical event
                                    </a>
                                    <h4 class="blog-title">biggest musical event</h4>
                                    <p class="mb-15">
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                    </p>
                                    <a href="#!" class="tickets-details-btn">
                                        Read More
                                    </a>
                                </div>

                            </div>
                            <!-- blog-big-item - end -->
                        </div>
                        <!-- big-layout - end -->

                    </div>

                    <!-- pagination - start -->
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="pagination ul-li clearfix">
                            <ul>
                                <li class="page-item prev-item">
                                    <a class="page-link" href="#!">Prev</a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#!">01</a></li>
                                <li class="page-item active"><a class="page-link" href="#!">02</a></li>
                                <li class="page-item"><a class="page-link" href="#!">03</a></li>
                                <li class="page-item"><a class="page-link" href="#!">04</a></li>
                                <li class="page-item"><a class="page-link" href="#!">05</a></li>
                                <li class="page-item next-item">
                                    <a class="page-link" href="#!">Next</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- pagination - end -->
                </div>
                <!-- blog-wrapper - end -->
            </div>

            <!-- sidebar-section - start -->
            <div class="col-lg-4 col-md-12 col-sm-12">
                <div class="sidebar-section">

                    
                    

                    <!-- faq-wrapper - start -->
                    <div class="faq-wrapper mb-30">

                        <!-- section-title - start -->
                        <div class="section-title mb-30">
                            <h2 class="big-title">Recent <strong>Post</strong></h2>
                        </div>
                        <!-- section-title - end -->

                        <div id="faq-accordion" class="faq-accordion">
                            <div class="card">
                                <div class="card-header" id="headingone">
                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseone" aria-expanded="true" aria-controls="collapseone">
                                        How to join this event?
                                    </button>
                                </div>

                                <div id="collapseone" class="collapse show" aria-labelledby="headingone" data-parent="#faq-accordion">
                                    <div class="card-body">
                                        Lorem ipsum dollor site amet the best  consectuer diam nerd adipiscing elites sed diam nonummy nibh the ebest uismod tincidunt ut laoreet dolore.
                                    </div>
                                    <a href="#!" class="tickets-details-btn float-right">
                                        Read More
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- faq-wrapper - end -->

                </div>
            </div>
            <!-- sidebar-section - end -->

        </div>
    </div>
</section>
@endsection --}}


@extends('frontendpanel.layout.master')

@section('title', 'Blogs')

@section('content')
    <section id="blog-section" class="blog-section sec-ptb-100 clearfix">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12">
                    <div class="blog-wrapper">
                        <div class="layout-btn-group">
                            <ul class="nav blog-layout-menubar float-right">
                                <li>
                                    <a class="active" data-toggle="tab" href="#grid-layout"><i class="fas fa-th"></i></a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#list-layout"><i class="fas fa-th-list"></i></a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#big-layout"><i class="fas fa-square"></i></a>
                                </li>
                            </ul>
                        </div>

                        <div class="tab-content">
                            <!-- Grid Layout -->
                            <div id="grid-layout" class="tab-pane fade in active show">
                                <div class="row">
                                    @foreach ($blogs as $blog)
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="blog-grid-item">
                                                <div class="event-date">
                                                    {{ $blog->created_at->format('d F Y - h.i A') }}
                                                </div>

                                                <div class="blog-image">
                                                    @if ($blog->image)
                                                        <img src="{{ asset($blog->image->url) }}" alt="{{ $blog->title }}"
                                                            style="height: 240px; width:100%;">
                                                    @endif
                                                    <a href="{{ route('blog.details', $blog->slug) }}"
                                                        class="plus-effect"></a>
                                                </div>

                                                <div class="blog-content">
                                                    <a href="#" class="tag">
                                                        <i class="fas fa-bookmark"></i>
                                                        {{ $blog->category }}
                                                    </a>
                                                    <h4 class="blog-title">{{ $blog->title }}</h4>
                                                    <p class="mb-15">
                                                        {!! Str::limit($blog->description, 100) !!}
                                                    </p>
                                                    <a href="{{ route('blog.details', $blog->slug) }}"
                                                        class="tickets-details-btn">
                                                        Read More
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- List Layout -->
                            <div id="list-layout" class="tab-pane fade">
                                @foreach ($blogs as $index => $blog)
                                    <div class="blog-list-item clearfix">
                                        <div class="blog-image {{ $index % 2 == 0 ? 'float-left' : 'float-right' }}">
                                            @if ($blog->image)
                                                <img src="{{ asset($blog->image->url) }}" alt="{{ $blog->title }}"
                                                    style="height: 250px; width:100%;">
                                            @endif
                                            <a href="{{ route('blog.details', $blog->slug) }}" class="plus-effect"></a>
                                            <div class="event-date">
                                                {{ $blog->created_at->format('d F Y - h.i A') }}
                                            </div>
                                        </div>

                                        <div
                                            class="blog-content {{ $index % 2 == 0 ? 'float-right' : 'text-right float-left' }}">
                                            <a href="#" class="tag">
                                                <i class="fas fa-bookmark"></i>
                                                {{ $blog->category }}
                                            </a>
                                            <h4 class="blog-title">{{ $blog->title }}</h4>
                                            <p class="mb-15">
                                                {!! Str::limit($blog->description, 150) !!}
                                            </p>
                                            <a href="{{ route('blog.details', $blog->slug) }}" class="tickets-details-btn">
                                                Read More
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Big Layout -->
                            <div id="big-layout" class="tab-pane fade">
                                @foreach ($blogs as $blog)
                                    <div class="blog-big-item clearfix">
                                        <div class="blog-image">
                                            @if ($blog->image)
                                                <img src="{{ asset($blog->image->url) }}" alt="{{ $blog->title }}" style="height: 380px; width:100%;">
                                            @endif
                                            <a href="{{ route('blog.details', $blog->slug) }}" class="plus-effect"></a>
                                            <div class="event-date">
                                                {{ $blog->created_at->format('d F Y - h.i A') }}
                                            </div>
                                        </div>

                                        <div class="blog-content">
                                            <a href="#" class="tag">
                                                <i class="fas fa-bookmark"></i>
                                                {{ $blog->category }}
                                            </a>
                                            <h4 class="blog-title">{{ $blog->title }}</h4>
                                            <p class="mb-15">
                                                {!! Str::limit($blog->description, 200) !!}
                                            </p>
                                            <a href="{{ route('blog.details', $blog->slug) }}" class="tickets-details-btn">
                                                Read More
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Pagination -->
                        @if ($blogs->hasPages())
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="pagination ul-li clearfix">
                                    <ul>
                                        {{-- Previous Page Link --}}
                                        @if ($blogs->onFirstPage())
                                            <li class="page-item prev-item disabled">
                                                <span class="page-link">Prev</span>
                                            </li>
                                        @else
                                            <li class="page-item prev-item">
                                                <a class="page-link" href="{{ $blogs->previousPageUrl() }}">Prev</a>
                                            </li>
                                        @endif

                                        {{-- Pagination Elements --}}
                                        @foreach ($blogs->links()->elements as $element)
                                            @if (is_string($element))
                                                <li class="page-item disabled"><span
                                                        class="page-link">{{ $element }}</span></li>
                                            @endif

                                            @if (is_array($element))
                                                @foreach ($element as $page => $url)
                                                    @if ($page == $blogs->currentPage())
                                                        <li class="page-item active"><span
                                                                class="page-link">{{ $page }}</span></li>
                                                    @else
                                                        <li class="page-item"><a class="page-link"
                                                                href="{{ $url }}">{{ $page }}</a></li>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach

                                        {{-- Next Page Link --}}
                                        @if ($blogs->hasMorePages())
                                            <li class="page-item next-item">
                                                <a class="page-link" href="{{ $blogs->nextPageUrl() }}">Next</a>
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

                <!-- Sidebar Section -->
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="sidebar-section">
                        <!-- Recent Post Section -->
                        <div class="faq-wrapper mb-30">
                            <div class="section-title mb-30">
                                <h2 class="big-title">Recent <strong>Post</strong></h2>
                            </div>

                            <div id="faq-accordion" class="faq-accordion">
                                @foreach ($recent_blogs as $index => $recent_blog)
                                    <div class="card">
                                        <div class="card-header" id="heading{{ $index }}">
                                            <button class="btn btn-link collapsed" data-toggle="collapse"
                                                data-target="#collapse{{ $index }}" aria-expanded="false"
                                                aria-controls="collapse{{ $index }}">
                                                {{ $recent_blog->title }}
                                            </button>
                                        </div>

                                        <div id="collapse{{ $index }}" class="collapse"
                                            aria-labelledby="heading{{ $index }}" data-parent="#faq-accordion">
                                            <div class="card-body">
                                                {!! Str::limit($recent_blog->description, 200) !!}
                                            </div>
                                            <a href="{{ route('blog.details', $recent_blog->slug) }}"
                                                class="tickets-details-btn float-right">
                                                Read More
                                            </a>
                                        </div>
                                    </div>
                                    {{-- <div class="card">
                                        <div class="card-header" id="headingfour">
                                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsefour" aria-expanded="false" aria-controls="collapsefour">
                                                Consectuerer set diam?
                                            </button>
                                        </div>
                                        <div id="collapsefour" class="collapse" aria-labelledby="headingfour" data-parent="#faq-accordion">
                                            <div class="card-body">
                                                Lorem ipsum dollor site amet the best  consectuer diam nerd adipiscing elites sed diam nonummy nibh the ebest uismod tincidunt ut laoreet dolore.
                                            </div>
                                            <a href="#!" class="tickets-details-btn float-right">
                                                Read More
                                            </a>
                                        </div>
                                    </div> --}}
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
