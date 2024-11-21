@extends('frontendpanel.layout.master')

@section('title', 'Blog')

@section('route', route('blogs'))

@section('sub-title', $blog->title)

@section('content')
    <section id="event-details-section" class="event-details-section sec-ptb-100 clearfix">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12">
                    <div class="event-details mb-80">
                        <div class="event-title mb-30">
                            <span class="tag-item">
                                <i class="fas fa-bookmark"></i>
                                {{ $blog->category ?? '' }}
                            </span>
                            <h2 class="event-title">{{ $blog->title ?? '' }}</h2>
                        </div>

                        @if ($blog->image)
                            <div id="event-details-carousel" class="event-details-carousel owl-carousel owl-theme">
                                <div class="item">
                                    <img src="{{ asset($blog->image->url) }}" alt="{{ $blog->title ?? '' }}">
                                </div>
                            </div>
                        @endif

                        <div class="event-info-list ul-li clearfix mb-50">
                            <ul>
                                <li>
                                    <span class="icon"><i class="far fa-calendar"></i></span>
                                    <div class="event-content">
                                        <small class="event-title">Blog Date</small>
                                        <h3 class="event-date">{{ date('d F Y', strtotime($blog->start)) }}
                                        </h3>
                                    </div>
                                </li>
                                <li>
                                    <span class="icon"><i class="fas fa-tags"></i></span>
                                    <div class="event-content">
                                        <small class="event-title">Category</small>
                                        <h3 class="event-date">{{ $blog->category ?? '' }}</h3>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <p class="black-color mb-30">
                            {!! $blog->description ?? '' !!}
                        </p>
                    </div>
                </div>
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
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
