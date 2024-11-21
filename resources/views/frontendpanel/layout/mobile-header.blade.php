<!-- altranative-header - start
  ================================================== -->
<div class="header-altranative">
    <div class="container">
        <div class="logo-area float-left">
            <a href="index-1.html">
                <img src="{{ asset(\App\Helpers\Frontend::Settings('website', 'logo')) }}" alt="logo_not_found">
            </a>
        </div>

        <button type="button" id="sidebarCollapse" class="alt-menu-btn float-right">
            <i class="fas fa-bars"></i>
        </button>
    </div>

    <!-- sidebar menu - start -->
    <div class="sidebar-menu-wrapper">
        <div id="sidebar" class="sidebar">
            <span id="sidebar-dismiss" class="sidebar-dismiss">
                <i class="fas fa-arrow-left"></i>
            </span>

            <div class="sidebar-header">
                <a href="#!">
                    <img src="{{ asset(\App\Helpers\Frontend::Settings('website', 'logo')) }}" alt="logo_not_found">
                </a>
            </div>

            <!-- main-pages-links - start -->
            <div class="menu-link-list main-pages-links">
                <h2 class="menu-title">Menu</h2>
                <ul>
                    <li class="active">
                        <a href="{{ route('home') }}">
                            <span class="icon"><i class="fas fa-home"></i></span>
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('about-us') }}">
                            <span class="icon"><i class="fas fa-info"></i></span>
                            About Us
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('events') }}">
                            <span class="icon"><i class="fas fa-calendar-alt"></i></span>
                            Event
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('blogs') }}">
                            <span class="icon"><i class="fas fa-edit"></i></span>
                            Blogs
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('home') }}#event-gallery-section">
                            <span class="icon"><i class="fas fa-images"></i></span>
                            Gallery
                        </a>
                    </li>
                </ul>
            </div>
            <!-- main-pages-links - end -->

            <!-- login-btn-group - start -->
            <div class="login-btn-group">
                <ul>

                    <li>
                        <a href="#alt-register-modal" class="register-modal-btn">
                            Register
                        </a>
                        <div id="alt-register-modal" class="reglog-modal-wrapper register-modal mfp-hide clearfix"
                            style="background-image: url({{ asset('frontendpanel/assets/images/login-modal-bg.jpg') }});">
                            <div class="overlay-black clearfix">

                                <!-- leftside-content - start -->
                                <div class="leftside-content">
                                    <div class="site-logo-wrapper mb-80">
                                        <a href="#!" class="logo">
                                            <img src="{{ asset(\App\Helpers\Frontend::Settings('website', 'logo')) }}"
                                                alt="logo_not_found">
                                        </a>
                                    </div>
                                    <div class="register-login-link mb-80">
                                        <ul>
                                            <li><a href="#!">Login</a></li>
                                            <li class="active"><a href="#!">Register</a></li>
                                        </ul>
                                    </div>
                                    <div class="copyright-text">
                                        <span class="m-0">© <a href="#!" class="site-link">Event
                                                Management</a> all right
                                            reserved, made with <i class="fas fa-heart"></i> by <a
                                                href="http://techstringit.com/" target="_blank"
                                                class="author-link"><strong>Techstring IT</strong></a>
                                            {{ date('Y') }}.</span>
                                    </div>
                                </div>
                                <!-- leftside-content - end -->

                                <!-- rightside-content - start -->
                                <div class="rightside-content text-center">

                                    <div class="mb-30">
                                        <h2 class="form-title title-large white-color">Account
                                            <strong>Register</strong>
                                        </h2>
                                        <span class="form-subtitle white-color">Have an account? <strong>LOGIN
                                                NOW</strong></span>
                                    </div>

                                    <div class="login-form text-center mb-50">
                                        <form action="#!">
                                            <div class="form-item">
                                                <input type="email" placeholder="User Name">
                                            </div>
                                            <div class="form-item">
                                                <input type="password" placeholder="Password">
                                            </div>
                                            <div class="form-item">
                                                <input type="email" placeholder="Repeat Password">
                                            </div>
                                            <div class="form-item">
                                                <input type="password" placeholder="Email Address">
                                            </div>
                                            <div class="human-verification text-left">
                                                <input type="checkbox" id="alt-imnotarobot">
                                                <label for="alt-imnotarobot">I'm not a robot</label>
                                                <span class="verification-image"> frontendpanel/assets
                                                    <img src="{{ asset('frontendpanel/assets/images/iamnotrobot.png') }}"
                                                        alt="Image_not_found">
                                                </span>
                                            </div>
                                            <button type="submit" class="login-btn">login now</button>
                                        </form>
                                    </div>

                                    <div class="bottom-text white-color">
                                        <p class="m-0">
                                            * Denotes mandatory field.
                                        </p>
                                        <p class="m-0">** At least one telephone number is required.</p>
                                    </div>

                                </div>
                                <!-- rightside-content - end -->

                                <a class="popup-modal-dismiss" href="#!">
                                    <i class="fas fa-times"></i>
                                </a>

                            </div>
                        </div>
                    </li>
                    <li>
                        <a href="#alt-login-modal" class="login-modal-btn">
                            Login
                        </a>
                        <div id="alt-login-modal" class="reglog-modal-wrapper mfp-hide clearfix"
                            style="background-image: url({{ asset('frontendpanel/assets/images/login-modal-bg.jpg') }});">
                            <div class="overlay-black clearfix">

                                <!-- leftside-content - start -->
                                <div class="leftside-content">
                                    <div class="site-logo-wrapper mb-80">
                                        <a href="#!" class="logo">
                                            <img src="{{ asset(\App\Helpers\Frontend::Settings('website', 'logo')) }}"
                                                alt="logo_not_found">
                                        </a>
                                    </div>
                                    <div class="register-login-link mb-80">
                                        <ul>
                                            <li class="active"><a href="#!">Login</a></li>
                                            <li><a href="#!">Register</a></li>
                                        </ul>
                                    </div>
                                    <div class="copyright-text">
                                        <p class="m-0">©2018 <a href="#!"
                                                class="yellow-color">Harmoni.com</a> all right reserved, made with
                                            <i class="fas fa-heart"></i> by jThemes Studio
                                        </p>
                                    </div>
                                </div>
                                <!-- leftside-content - end -->

                                <!-- rightside-content - start -->
                                <div class="rightside-content text-center">

                                    <div class="mb-30">
                                        <h2 class="form-title title-large white-color">Account
                                            <strong>Login</strong>
                                        </h2>
                                        <span class="form-subtitle white-color">Login to our website, or
                                            <strong>REGISTER</strong></span>
                                    </div>

                                    <div class="fb-login-btn mb-30">
                                        <a href="#!">
                                            <span class="icon">
                                                <i class="fab fa-facebook-f"></i>
                                            </span>
                                            login with facebook
                                        </a>
                                    </div>

                                    <div class="or-text mb-30">
                                        <span>or sign in</span>
                                    </div>

                                    <div class="login-form text-center mb-50">
                                        <form action="#!">
                                            <div class="form-item">
                                                <input type="email" placeholder="example@gmail.com">
                                            </div>
                                            <div class="form-item">
                                                <input type="password" placeholder="Password">
                                            </div>
                                            <button type="submit" class="login-btn">login now</button>
                                        </form>
                                    </div>

                                    <div class="bottom-text white-color">
                                        <p class="m-0">
                                            * Denotes mandatory field.
                                        </p>
                                        <p class="m-0">** At least one telephone number is required.</p>
                                    </div>

                                </div>
                                <!-- rightside-content - end -->

                                <a class="popup-modal-dismiss" href="#!">
                                    <i class="fas fa-times"></i>
                                </a>

                            </div>
                        </div>
                    </li>

                </ul>
            </div>
            <!-- login-btn-group - end -->

            <!-- social-links - start -->
            <div class="social-links">
                <h2 class="menu-title">get in touch</h2>
                <div class="mb-15">
                    <h3 class="contact-info">
                        <i class="fas fa-phone"></i>
                        <a href="tel:{{ \App\Helpers\Frontend::Settings('website', 'phone') }}">{{ \App\Helpers\Frontend::Settings('website', 'phone') }}</a>
                    </h3>
                    <h3 class="contact-info">
                        <i class="fas fa-envelope"></i>
                        <a href="mailto:{{ \App\Helpers\Frontend::Settings('website', 'email') }}">{{ \App\Helpers\Frontend::Settings('website', 'email') }}</a>
                    </h3>
                </div>
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
                <a href="{{ route('contact') }}" class="contact-btn">contact us</a>
            </div>
            <!-- social-links - end -->

            <div class="overlay"></div>
        </div>
    </div>
    <!-- sidebar menu - end -->
</div>
<!-- altranative-header - end
================================================== -->
