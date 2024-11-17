<footer id="footer-section" class="footer-section footer-section2 clearfix">

    <!-- footer-top - start -->
    <div class="footer-top sec-ptb-100 clearfix">
        <div class="container">
            <div class="row">

                <!-- about-wrapper - start -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="about-wrapper">

                        <!-- site-logo-wrapper - start -->
                        <div class="site-logo-wrapper mb-30">
                            <a href="index-1.html" class="logo">
                                <img src="{{ asset(\App\Helpers\Frontend::Settings('website', 'logo')) }}"
                                    alt="logo_not_found">
                            </a>
                        </div>
                        <!-- site-logo-wrapper - end -->

                        <!-- basic-info - start -->
                        <div class="basic-info ul-li-block mb-50">
                            <ul>
                                @if (\App\Helpers\Frontend::Settings('website', 'location'))
                                    <li>
                                        <i class="fas fa-map-marker-alt"></i>
                                        {{ \App\Helpers\Frontend::Settings('website', 'location') }}
                                    </li>
                                @endif
                                @if (\App\Helpers\Frontend::Settings('website', 'email'))
                                    <li>
                                        <i class="fas fa-envelope"></i>
                                        <a
                                            href="mailto:{{ \App\Helpers\Frontend::Settings('website', 'email') }}">{{ \App\Helpers\Frontend::Settings('website', 'email') }}</a>
                                    </li>
                                @endif
                                @if (\App\Helpers\Frontend::Settings('website', 'phone'))
                                    <li>
                                        <i class="fas fa-phone"></i>
                                        <a
                                            href="tel:{{ \App\Helpers\Frontend::Settings('website', 'phone') }}">{{ \App\Helpers\Frontend::Settings('website', 'phone') }}</a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                        <!-- basic-info - end -->

                        <!-- social-links - start -->
                        <div class="social-links ul-li">
                            <h3 class="social-title">Social Media</h3>
                            <ul>
                                @if (\App\Helpers\Frontend::Settings('social', 'facebook'))
                                    <li><a href="{{ \App\Helpers\Frontend::Settings('social', 'facebook') }}"
                                            target="_blank" title="Facebook">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    </li>
                                @endif
                                @if (\App\Helpers\Frontend::Settings('social', 'instagram'))
                                    <li><a href="{{ \App\Helpers\Frontend::Settings('social', 'instagram') }}"
                                            target="_blank" title="Instagram"><i class="fa fa-instagram"></i></a></li>
                                @endif
                                @if (\App\Helpers\Frontend::Settings('social', 'whatsapp'))
                                    <li><a href="{{ \App\Helpers\Frontend::Settings('social', 'whatsapp') }}"
                                            target="_blank" title="WhatsApp"><i class="fab fa-whatsapp"></i></a></li>
                                @endif
                                @if (\App\Helpers\Frontend::Settings('social', 'youtube'))
                                    <li><a href="{{ \App\Helpers\Frontend::Settings('social', 'youtube') }}"
                                            target="_blank" title="YouTube"><i class="fab fa-youtube"></i></a></li>
                                @endif
                                @if (\App\Helpers\Frontend::Settings('social', 'linkedin'))
                                    <li><a href="{{ \App\Helpers\Frontend::Settings('social', 'linkedin') }}"
                                            target="_blank" title="LinkedIn"><i class="fab fa-linkedin"></i></a>
                                    </li>
                                @endif
                                @if (\App\Helpers\Frontend::Settings('social', 'x'))
                                    <li><a href="{{ \App\Helpers\Frontend::Settings('social', 'x') }}"
                                            target="_blank" title="X"><i class="fab fa-twitter"></i></a>
                                    </li>
                                @endif
                                @if (\App\Helpers\Frontend::Settings('social', 'twitch'))
                                    <li><a href="{{ \App\Helpers\Frontend::Settings('social', 'twitch') }}"
                                            target="_blank" title="Twitch"><i class="fab fa-twitch"></i></a>
                                    </li>
                                @endif
                                @if (\App\Helpers\Frontend::Settings('social', 'x'))
                                    <li><a href="{{ \App\Helpers\Frontend::Settings('social', 'google-plus') }}"
                                            target="_blank" title="Google Plus"><i class="fab fa-google-plus-g"></i></a>
                                    </li>
                                @endif

                            </ul>
                        </div>
                        <!-- social-links - end -->

                    </div>
                </div>
                <!-- about-wrapper - end -->

                <div class="col-lg-4 col-md-6 col-sm-12">
                </div>

                <!-- usefullinks-wrapper - start -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="usefullinks-wrapper ul-li-block">
                        <h3 class="footer-item-title">
                            useful <strong>links</strong>
                        </h3>
                        <ul>
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="">Event</a></li>
                            <li><a href="">Blogs</a></li>
                            <li><a href="">Gallery</a></li>

                        </ul>

                    </div>
                </div>
                <!-- usefullinks-wrapper - end -->
            </div>
        </div>
    </div>
    <!-- footer-top - end -->

    <div class="footer-bottom">
        <div class="container">
            <div class="row">

                <!-- copyright-text - start -->
                <div class="col-lg-7 col-md-12 col-sm-12">
                    <div class="copyright-text">
                        <span class="m-0">© <a href="#!" class="site-link">Event Management</a> all right
                            reserved, made with <i class="fas fa-heart"></i> by <a href="http://techstringit.com/" target="_blank"
                                class="author-link"><strong>Techstring IT</strong></a> {{ date('Y') }}.</span>
                    </div>
                </div>
                <!-- copyright-text - end -->

                <!-- footer-menu - start -->
                <div class="col-lg-5 col-md-12 col-sm-12">
                    <div class="footer-menu">
                        <ul>
                            <li><a href="#!">Contact us</a></li>
                            <li><a href="#!">About us</a></li>
                            <li><a href="#!">Privacy policy</a></li>
                        </ul>
                    </div>
                </div>
                <!-- footer-menu - end -->

            </div>
        </div>
    </div>

</footer>
