@extends('frontendpanel.layout.master')

@section('title', 'Contact')

@section('content')
<section id="contact-section" class="contact-section sec-ptb-100 clearfix">
    <div class="container">

        <!-- section-title - start -->
        <div class="section-title mb-50">
            <small class="sub-title">contact us</small>
            <h2 class="big-title">Keep in touch <strong>with {{ config('app.name') }}</strong></h2>
        </div>
        <!-- section-title - end -->

        <!-- contact-form - start -->
        <div class="contact-form form-wrapper text-center">
            <form action="#" method="post">
                <div class="row">

                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-item">
                            <input type="text" placeholder="Your Name" required>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-item">
                            <input type="email" placeholder="Email Address" required>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-item">
                            <input type="text" placeholder="Your Country" required>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-item">
                            <input type="tel" placeholder="Phone Number" required>
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <textarea placeholder="Your Message" required></textarea>
                        <button type="submit" class="custom-btn">send mail</button>
                    </div>
                    
                </div>
            </form>
        </div>
        <!-- contact-form - end -->

    </div>
</section>
@endsection