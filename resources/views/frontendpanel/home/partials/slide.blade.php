<section id="slide-section" class="slide-section clearfix">
    <div id="main-carousel1" class="main-carousel1 owl-carousel owl-theme">

        @foreach ($banners as $key => $banner)
            <div class="item" style="background-image: url({{ asset($banner->image->url) }})">
                <div class="overlay-black">
                    <div class="container">
                        <div class="slider-item-content">

                            <h1 class="big-text">{{ $banner->title ?? '' }}</h1>
                            <small class="small-text">{{ $banner->sub_title ?? '' }}</small>

                            <div class="link-groups">
                                <a href="#" class="about-btn custom-btn">about us</a>
                                <a href="#!" class="start-btn">get started!</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
</section>