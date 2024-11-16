<section id="news-update-section" class="news-update-section sec-ptb-100 clearfix">
    <div class="container">
        <div class="row">

            <!-- faq-accordion - start -->
            @if ((isset($faqs) && count($faqs) > 0))
                <div class="col-lg-{{ isset($blogs) && count($blogs) > 0 ? '6' : '12' }} col-md-12 col-sm-12">
                    <!-- section-title - start -->
                    <div class="section-title mb-30">
                        <span class="line-style"></span>
                        <small class="sub-title">find your answer</small>
                        <h2 class="big-title">ask & <strong>questions</strong></h2>
                    </div>
                    <!-- section-title - end -->
                    <div id="faq-accordion" class="faq-accordion">

                        @foreach ($faqs as $faq)
                            <div class="card">
                                <div class="card-header" id="heading{{ $faq->id }}">
                                    <button class="btn collapsed" data-toggle="collapse"
                                        data-target="#collapse{{ $faq->id }}" aria-expanded="true"
                                        aria-controls="collapse{{ $faq->id }}">
                                        <span>0{{ $loop->iteration }}.</span> {{ $faq->question }}
                                    </button>
                                </div>

                                <div id="collapse{{ $faq->id }}" class="collapse" aria-labelledby="heading{{ $faq->id }}"
                                    data-parent="#faq-accordion">
                                    <div class="card-body">
                                        <h3>answer</h3>
                                        {{ $faq->answer }}
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            @endif
            <!-- faq-accordion - end -->

            <!-- latest-blog-wrapper - start -->
            @if ((isset($blogs) && count($blogs) > 0))
                <div class="col-lg-{{ isset($faqs) && count($faqs) > 0 ? '6' : '12' }} col-md-12 col-sm-12">
                    <div class="latest-blog-wrapper">

                        <!-- section-title - start -->
                        <div class="section-title mb-30">
                            <span class="line-style"></span>
                            <small class="sub-title">our blog</small>
                            <h2 class="big-title">latest <strong>blogs</strong></h2>
                        </div>
                        <!-- section-title - end -->

                        @foreach($blogs as $blog)
                            <div class="latest-blog clearfix">
                                <div class="blog-image">
                                    <img src="{{ asset($blog->image->url ?? '') }}" alt="{{ $blog->title }}">
                                    <a href="#!" class="plus-effect"></a>
                                </div>
                                <div class="blog-content">
                                    <div class="blog-title mb-30">
                                        <h3>{{ $blog->title }}</h3>
                                        <span>{{ date('F d, Y', strtotime($blog->created_at)) }}</span>
                                    </div>
                                    <p class="m-0">
                                        {!! Str::limit($blog->description ?? '', 100) !!}
                                    </p>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            @endif
            <!-- latest-blog-wrapper - end -->

        </div>
    </div>
</section>
