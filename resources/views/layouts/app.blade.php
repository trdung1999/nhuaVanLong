<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    <title>@yield('title')</title>

    <meta name="keywords" content="Marketplace ecommerce responsive HTML5 Template" />
    <meta name="description" content="Wolmart is powerful marketplace &amp; ecommerce responsive Html5 Template.">
    <meta name="author" content="D-THEMES">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo.png') }}">

    <!-- WebFont.js -->
    <script>
        WebFontConfig = {
            google: { families: ['Poppins:400,500,600,700'] }
        };
        (function (d) {
            var wf = d.createElement('script'), s = d.scripts[0];
            wf.src = 'assets/js/webfont.js';
            wf.async = true;
            s.parentNode.insertBefore(wf, s);
        })(document);
    </script>

    <link rel="preload" href="{{ asset('assets/vendor/fontawesome-free/webfonts/fa-regular-400.woff2') }}" as="font" type="font/woff2"
        crossorigin="anonymous">
    <link rel="preload" href="{{ asset('assets/vendor/fontawesome-free/webfonts/fa-solid-900.woff2') }}" as="font" type="font/woff2"
        crossorigin="anonymous">
    <link rel="preload" href="{{ asset('assets/vendor/fontawesome-free/webfonts/fa-brands-400.woff2') }}" as="font" type="font/woff2"
        crossorigin="anonymous">
    <link rel="preload" href="{{ asset('assets/fonts/wolmart.woff%3Fpng09e') }}" as="font" type="font/woff" crossorigin="anonymous">

    <!-- Vendor CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}">

    <!-- Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/animate/animate.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/magnific-popup/magnific-popup.min.css') }}">

    <!-- Default CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/demo2.min.css') }}">
</head>

<body class="home">
    <div class="page-wrapper">
        @php
            $setting = App\Models\Setting::first();
            $description = 'description_'.config('app.locale');
        @endphp
        <!-- Start of Header -->
        <header class="header">
            <div class="header-top">
                <div class="container">
                    <div class="header-left">
                        <p class="welcome-msg">Ch??o m???ng ?????n v???i nh???a V??n Long!</p>
                    </div>
                    <div class="header-right pr-0">
                        <span class="divider d-lg-show"></span>
                        <a href="/blogs" class="d-lg-show">Tin t???c</a>
                        <a href="/contact-us" class="d-lg-show">Li??n h???</a>
                        @if(Route::has('login'))
                            @auth
                            <a href="{{ route('user.dashboard') }}" class="d-lg-show">T??i kho???n c???a t??i</a>
                            @else
                            <a href="{{ route('login') }}" class="d-lg-show login sign-in"><i
                                    class="w-icon-account"></i>????ng nh???p</a>
                            <span class="delimiter d-lg-show">/</span>
                            <a href="{{ route('register') }}" class="ml-0 d-lg-show login register">????ng k??</a>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
            <!-- End of Header Top -->

            <div class="header-middle">
                <div class="container">
                    <div class="header-left mr-md-4">
                        <a href="/" class="mobile-menu-toggle  w-icon-hamburger" aria-label="menu-toggle">
                        </a>
                        <a href="/" class="logo ml-lg-0">
                            <img src="{{ asset('assets/images/demos/demo2/logo.png')}}" alt="logo" width="94" height="45" />
                        </a>
                        <nav class="main-nav">
                            <ul class="menu">
                                <li class="{{ Request::is('/') ? 'active' : '' }}">
                                    <a href="/">Trang ch???</a>
                                </li>
                                <li class="{{ Request::is('about-us') ? 'active' : '' }}">
                                    <a href="/about-us">Gi???i thi???u</a>
                                </li>
                                <li class="{{ Request::is('shop') ? 'active' : '' }}">
                                    <a href="/shop">S???n ph???m</a>
                                </li>
                                <li class="{{ Request::is('blogs') ? 'active' : '' }}">
                                    <a href="/blogs">Tin t???c && s??? ki???n</a>
                                </li>
                                <li class="{{ Request::is('contact-us') ? 'active' : '' }}">
                                    <a href="/contact-us">Li??n l???c</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="header-right ml-4">
                        <div class="header-call d-xs-show d-lg-flex align-items-center">
                            <a href="tel:{{ $setting->phone }}"><i class="fa fa-phone mr-2" style="font-size: 20px"></i></a>
                            <div class="call-info d-xl-show">
                                <span>G???i ngay</span>
                                <h4 class="chat font-weight-normal font-size-md text-normal ls-normal text-light mb-0">
                                <a href="tel:{{ $setting->phone ?? '' }}" class="phone-number font-weight-bolder ls-50">{{ $setting->phone ?? '' }}</a>
                            </div>
                        </div>
                        <a class="wishlist label-down link d-xs-show" href="/wishlist">
                            <i class="fa fa-heart"></i>
                            <span class="wishlist-label d-lg-show">Y??u th??ch</span>
                        </a>
                        <div class="dropdown cart-dropdown mr-0 mr-lg-2">
                            <div class="cart-overlay"></div>
                            <a href="/cart" class="cart-toggle label-down link">
                                <i class="fa fa-shopping-cart">
                                </i>
                                <span class="cart-label">Gi??? h??ng</span>
                            </a>
                            <!-- End of Dropdown Box -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Header Middle -->

            
        </header>
        <!-- End of Header -->

        @yield('content')
        <!-- End of Main -->

        <!-- Start of Footer -->
        <footer class="footer appear-animate" data-animation-options="{
            'name': 'fadeIn'
        }">
            <div class="footer-newsletter bg-primary pt-6 pb-6">
                <div class="container">
                </div>
            </div>
            <div class="container">
                <div class="footer-top">
                    <div class="row">
                        <div class="col-lg-4 col-sm-6">
                            <div class="widget widget-about">
                                <a href="/" class="logo-footer">
                                    <img src="{{ asset('assets/images/demos/demo2/logo.png') }}" alt="logo-footer" width="104"
                                        height="45" />
                                </a>
                                <div class="widget-body">
                                    <p class="widget-about-title">G???i ngay cho ch??ng t??i !</p>
                                    <a href="tel:{{ $setting->phone ?? '' }}" class="widget-about-call">{{ $setting->phone ?? '' }}</a>
                                    <p class="widget-about-desc">{{ $setting->$description ?? '' }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="widget">
                                <h3 class="widget-title">V??? ch??ng t??i</h3>
                                <ul class="widget-body">
                                    <li><a href="/about-us">Gi???i thi???u</a></li>
                                    <li><a href="">??i???u kho???n</a></li>
                                    <li><a href="">Ch??nh s??ch mua h??ng</a></li>
                                    <li><a href="/contact-us">Li??n l???c</a></li>
                                    <li><a href="">Chi nh??nh</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="widget">
                                <h4 class="widget-title">T??i kho???n c???a b???n</h4>
                                <ul class="widget-body">
                                    <li><a href="/cart">Gi??? h??ng</a></li>
                                    <li><a href="#">H??? tr???</a></li>
                                    <li><a href="wishlist.html">Y??u th??ch</a></li>
                                    <li><a href="#">Ch??nh s??ch b???o m???t</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="widget">
                                <h4 class="widget-title">D???ch v??? kh??ch h??ng</h4>
                                <ul class="widget-body">
                                    <li><a href="">Ph????ng th???c thanh to??n</a></li>
                                    <li><a href="">H??? tr??? tr??? h??ng</a></li>
                                    <li><a href="">Trung t??m h??? tr???</a></li>
                                    <li><a href="">V???n chuy???n</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-bottom">
                    <div class="footer-left">
                        <p class="copyright">Copyright ?? 2021 VanLong Plastic. All Rights Reserved.</p>
                    </div>
                    <div class="footer-right">
                        <span class="payment-label mr-lg-8">Ch??ng t??i s??? d???ng ph????ng th???c thanh to??n</span>
                        <figure class="payment">
                            <img src="assets/images/payment.png" alt="payment" width="159" height="25" />
                        </figure>
                    </div>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->
    </div>
    <!-- End of .page-wrapper -->   

    <!-- Plugin JS File -->
    <script src="https://portotheme.com/html/wolmart/assets/vendor/jquery.plugin/jquery.plugin.min.js"></script>
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery.countdown/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/floating-parallax/parallax.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/zoom/jquery.zoom.js') }}"></script>

    <!-- Main Js -->
    <script src="{{ asset('assets/js/main.min.js') }}"></script>
</body>

</html>