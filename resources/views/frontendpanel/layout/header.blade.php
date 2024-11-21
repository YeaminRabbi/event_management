<header id="header-section" class="
    @if (Route::currentRouteName() == 'home') 
        header-section sticky-header-section not-stuck clearfix
    @else
        header-section default-header-section auto-hide-header clearfix
    @endif
">
    @if (!in_array(request()->route()->getName(), ['home']))
        <div class="header-top">
            <div class="container">
                <div class="row">

                    <!-- basic-contact - start -->
                    <div class="col-lg-6">
                        <div class="basic-contact">
                            <ul>
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
                    </div>
                    <!-- basic-contact - end -->

                    <!-- register-login-group - start -->
                    <div class="col-lg-6">
                        <div class="register-login-group">
                            <ul>
                                <li>
                                    <a href="#register-modal" class="register-modal-btn">
                                        <i class="fas fa-user"></i>
                                        Register
                                    </a>
                                    <div id="register-modal"
                                        class="reglog-modal-wrapper register-modal mfp-hide clearfix"
                                        style="background-image: url('{{ asset('frontendpanel/assets/images/login-modal-bg.jpg') }}');">
                                        <div class="overlay-black clearfix">

                                            <!-- leftside-content - start -->
                                            <div class="leftside-content">
                                                <div class="site-logo-wrapper mb-80">
                                                    <a href="#!" class="logo">
                                                        <img src="{{ asset(\App\Helpers\Frontend::Settings('website', 'logo')) }}" alt="logo_not_found">
                                                    </a>
                                                </div>
                                                <div class="register-login-link mb-80">
                                                    <ul>
                                                        <li><a href="#!">Login</a></li>
                                                        <li class="active"><a href="#!">Register</a></li>
                                                    </ul>
                                                </div>
                                                <div class="copyright-text">
                                                    <span class="m-0">© <a href="#!" class="site-link">Event Management</a> all right
                                                        reserved, made with <i class="fas fa-heart"></i> by <a href="http://techstringit.com/" target="_blank"
                                                            class="author-link"><strong>Techstring IT</strong></a> {{ date('Y') }}.</span>
                                                </div>
                                            </div>
                                            <!-- leftside-content - end -->

                                            <!-- rightside-content - start -->
                                            <div class="rightside-content text-center">

                                                <div class="mb-30">
                                                    <h2 class="form-title title-large white-color">Account
                                                        <strong>Register</strong>
                                                    </h2>
                                                    <span class="form-subtitle white-color">Have an account?
                                                        <strong>LOGIN NOW</strong></span>
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
                                                            <input type="checkbox" id="imnotarobot">
                                                            <label for="imnotarobot">I'm not a robot</label>
                                                            <span class="verification-image">
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
                                    <a href="#login-modal" class="login-modal-btn">
                                        <i class="fas fa-lock"></i>
                                        Login
                                    </a>
                                    <div id="login-modal" class="reglog-modal-wrapper mfp-hide clearfix"
                                        style="background-image: url('{{ asset('frontendpanel/assets/images/login-modal-bg.jpg') }}');">
                                        <div class="overlay-black clearfix">

                                            <!-- leftside-content - start -->
                                            <div class="leftside-content">
                                                <div class="site-logo-wrapper mb-80">
                                                    <a href="#!" class="logo">
                                                        <img src="{{ asset(\App\Helpers\Frontend::Settings('website', 'logo')) }}" alt="logo_not_found">
                                                    </a>
                                                </div>
                                                <div class="register-login-link mb-80">
                                                    <ul>
                                                        <li class="active"><a href="#!">Login</a></li>
                                                        <li><a href="#!">Register</a></li>
                                                    </ul>
                                                </div>
                                                <div class="copyright-text">
                                                    <span class="m-0">© <a href="#!" class="site-link">Event Management</a> all right
                                                        reserved, made with <i class="fas fa-heart"></i> by <a href="http://techstringit.com/" target="_blank"
                                                            class="author-link"><strong>Techstring IT</strong></a> {{ date('Y') }}.</span>
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
                    </div>
                    <!-- register-login-group - end -->

                </div>
            </div>
        </div>
    @endif
    
    <div class="header-bottom">
        <div class="container">
            <div class="row">

                <!-- site-logo-wrapper - start -->
                <div class="col-lg-3">
                    <div class="site-logo-wrapper">
                        <a href="{{ route('home') }}" class="logo">
                            <img src="{{ asset(\App\Helpers\Frontend::Settings('website', 'logo')) }}"
                                alt="logo_not_found">
                        </a>
                    </div>
                </div>
                <!-- site-logo-wrapper - end -->

                <!-- mainmenu-wrapper - start -->
                <div class="col-lg-9">
                    <div class="mainmenu-wrapper">
                        <div class="row">

                            <!-- menu-item-list - start -->
                            <div class="col-lg-10">
                                <div class="menu-item-list ul-li clearfix">
                                    <ul>
                                        <li class="menu-item-has-children {{ Request::routeIs('home') ? 'active' : '' }}">
                                            <a href="{{ route('home') }}">home</a>

                                        </li>
                                        <li class="menu-item-has-children {{ Request::routeIs('about-us') ? 'active' : '' }}">
                                            <a href="{{ route('about-us') }}">about</a>
                                        </li>
                                        <li class="menu-item-has-children">
                                            <a href="{{ route('events') }}">events</a>
                                        </li>
                                        <li class="menu-item-has-children">
                                            <a href="{{ route('blogs') }}">blogs</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('home') }}#event-gallery-section">gallery</a>
                                        </li>
                                        <li class="menu-item-has-children">
                                            <a href="{{ route('contact') }}">contact</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- menu-item-list - end -->

                            <!-- menu-item-list - start -->
                            <div class="col-lg-2">
                                <div class="user-search-btn-group ul-li clearfix">
                                    <ul>
                                        <li>
                                            <a href="#login-modal" class="login-modal-btn">
                                                <i class="fas fa-user"></i>
                                            </a>
                                            <div id="login-modal" class="reglog-modal-wrapper mfp-hide clearfix"
                                                style="background-image: url('{{ asset('frontendpanel/assets/images/login-modal-bg.jpg') }}');">
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
                                                                <li class="active"><a href="#!">Login</a>
                                                                </li>
                                                                <li><a href="#!">Register</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="copyright-text">
                                                            <span class="m-0">© <a href="#!"
                                                                    class="site-link">Event Management</a> all right
                                                                reserved, made with <i class="fas fa-heart"></i> by <a
                                                                    href="http://techstringit.com/" target="_blank"
                                                                    class="author-link"><strong>Techstring
                                                                        IT</strong></a> {{ date('Y') }}.</span>
                                                        </div>
                                                    </div>
                                                    <!-- leftside-content - end -->

                                                    <!-- rightside-content - start -->
                                                    <div class="rightside-content text-center">

                                                        <div class="mb-30">
                                                            <h2 class="form-title title-large white-color">Account
                                                                <strong>Login</strong>
                                                            </h2>
                                                            <span class="form-subtitle white-color">Login to our
                                                                website, or <strong>REGISTER</strong></span>
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
                                                                    <input type="email"
                                                                        placeholder="example@gmail.com">
                                                                </div>
                                                                <div class="form-item">
                                                                    <input type="password" placeholder="Password">
                                                                </div>
                                                                <button type="submit" class="login-btn">login
                                                                    now</button>
                                                            </form>
                                                        </div>

                                                        <div class="bottom-text white-color">
                                                            <p class="m-0">
                                                                * Denotes mandatory field.
                                                            </p>
                                                            <p class="m-0">** At least one telephone number is
                                                                required.</p>
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
                            </div>
                            <!-- menu-item-list - end -->

                        </div>
                    </div>
                </div>
                <!-- mainmenu-wrapper - end -->

            </div>
        </div>
    </div>
</header>
