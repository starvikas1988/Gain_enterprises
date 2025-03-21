<!DOCTYPE html>
<html lang="en">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <meta name="description" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>{{ config('webconfig.website') }}</title>
        <link rel="shortcut icon" href="{{ asset('public/frontend/assets/images/favicon.png') }}" type="image/png" />
        <link rel="stylesheet" href="{{ asset('public/frontend/assets/css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('public/frontend/assets/css/font-awesome.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('public/frontend/assets/css/animate.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('public/frontend/assets/css/magnific-popup.css') }}" />
        <link rel="stylesheet" href="{{ asset('public/frontend/assets/css/slick.css') }}" />
        <link rel="stylesheet" href="{{ asset('public/frontend/assets/css/custom-animation.css') }}" />
        <link rel="stylesheet" href="{{ asset('public/frontend/assets/css/default.css') }}" />
        <link rel="stylesheet" href="{{ asset('public/frontend/assets/css/style.css') }}" />
        <link rel="stylesheet" href="{{ asset('public/frontend/assets/css/responsive.css') }}" />
    </head>
    <body>
        <div class="off_canvars_overlay"></div>
        <div class="offcanvas_menu">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="offcanvas_menu_wrapper">
                            <div class="canvas_close">
                                <a href="javascript:void(0)"><i class="fa fa-times"></i></a>
                            </div>
                            <div class="offcanvas-brand text-center mb-40">
                                <a href="index.php"><img src="{{ asset('public/frontend/assets/images/logo.png') }}" alt="" /></a>
                            </div>
                            <div id="menu" class="text-left">
                                <ul class="offcanvas_main_menu">
                                    <li class="menu-item-has-children"><a href="{{ route('index') }}">Home</a></li>
                                    <li class="menu-item-has-children"><a href="{{ route('termsconditions') }}">Terms & Conditions</a></li>
                                    <li class="menu-item-has-children"><a href="{{ route('privacypolicy') }}">Privacy Policy</a></li>
                                    <li class="menu-item-has-children"><a href="{{ route('cancellationrefund') }}">Cancellation & Refund Policy</a></li>
									 
                                    <li class="menu-item-has-children"><a href="{{ route('contactus') }}">Contact Us</a></li>
                                </ul>
                            </div>
                            <div class="offcanvas-social">
                                <ul class="text-center">
                                    <li>
                                        <a href="%24"><i class="fab fa-facebook-f"></i></a>
                                    </li>
                                    <li>
                                        <a href="%24"><i class="fab fa-twitter"></i></a>
                                    </li>
                                    <li>
                                        <a href="%24"><i class="fab fa-instagram"></i></a>
                                    </li>
                                    <li>
                                        <a href="%24"><i class="fab fa-dribbble"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="footer-widget-info">
                                <ul>
                                    <li>
                                        <a href="mailto:{{ config('webconfig.email') }}"><i class="fal fa-envelope"></i> {{ config('webconfig.email') }}</a>
                                    </li>
                                    <li>
                                        <a href="tel:{{ config('webconfig.mobile') }}"><i class="fal fa-phone"></i> {{ config('webconfig.mobile') }}</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)"><i class="fal fa-map-marker-alt"></i> {{ config('webconfig.address') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <header class="appie-header-area appie-sticky">
            <div class="container">
                <div class="header-nav-box">
                    <div class="row align-items-center">
                        <div class="col-lg-2 col-md-4 col-sm-5 col-6 order-1 order-sm-1">
                            <div class="appie-logo-box">
                                <a href="{{ url('/') }}"><img src="{{ asset('public/frontend/assets/images/logo.png') }}" alt="" /></a>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-1 col-sm-1 order-3 order-sm-2 text-center">
                            <div class="appie-header-main-menu">
                                <ul>
                                    <li><a href="{{ url('/') }}">Home</a></li>
                                    <li><a href="{{ route('termsconditions') }}">Terms & Conditions</a></li>
                                    <li><a href="{{ route('privacypolicy') }}">Privacy Policy</a></li>
                                    <li><a href="{{ route('cancellationrefund') }}">Cancellation & Refund Policy</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-7 col-sm-6 col-6 order-2 order-sm-3">
                            <div class="appie-btn-box text-right">
                                <a class="animated_btn ml-30 d-none d-sm-block" href="{{ route('contactus') }}">Contact Us</a>
                                <div class="toggle-btn ml-30 canvas_open d-lg-none d-block"><i class="fa fa-bars"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        @yield('content')
    <section class="appie-footer-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-6">
                <div class="footer-about-widget">
                    <div class="logo"> <a href="#"><img src="{{ asset('public/frontend/assets/images/logo.png') }}" alt=""></a> </div>
                    <div class="social mt-30">
                        <ul>
                            <li><a href="javascript:void(0)"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="javascript:void(0)"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="javascript:void(0)"><i class="fab fa-pinterest-p"></i></a></li>
                            <li><a href="javascript:void(0)"><i class="fab fa-linkedin-in"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="footer-navigation">
                    <h4 class="title">Quick Links</h4>
                    <ul>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="{{ route('termsconditions') }}">Terms & Conditions</a></li>
                        <li><a href="{{ route('privacypolicy') }}">Privacy Policy</a></li>
                        <li><a href="{{ route('cancellationrefund') }}">Cancellation & Refund Policy</a></li>
                        <li><a href="{{ route('contactus') }}">Contact Us</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="footer-widget-info">
                    <h4 class="title">Get In Touch</h4>
                    <ul>
                        <li><a href="mailto:{{ config('webconfig.email') }}"><i class="fal fa-envelope"></i> {{ config('webconfig.email') }}</a></li>
                        <li><a href="tel:{{ config('webconfig.mobile') }}"><i class="fal fa-phone"></i> {{ config('webconfig.mobile') }}</a></li>
                        <li><a href="javascript:void(0)"><i class="fal fa-map-marker-alt"></i> {{ config('webconfig.address') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="footer-copyright d-flex align-items-center justify-content-between pt-35">
                    <div class="apps-download-btn">
                        <ul>
                            <li><a class="item-2" target="_blank" href="#"><i class="fab fa-google-play"></i> Download for Android</a></li>
                        </ul>
                    </div>
                    <div class="copyright-text">
                        <p>Copyright &copy; 2022 {{ config('webconfig.website') }}. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="back-to-top"> <a href="#"><i class="fal fa-arrow-up"></i></a></div>
<script src="{{ asset('public/frontend/assets/js/jquery-3.6.0.js') }}"></script>
<script src="{{ asset('public/frontend/assets/js/vendor/modernizr-3.6.0.min.js') }}"></script>
<script src="{{ asset('public/frontend/assets/js/vendor/jquery-1.12.4.min.js') }}"></script>
<script src="{{ asset('public/frontend/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('public/frontend/assets/js/popper.min.js') }}"></script>
<script src="{{ asset('public/frontend/assets/js/wow.js') }}"></script>
<script src="{{ asset('public/frontend/assets/js/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('public/frontend/assets/js/waypoints.min.js') }}"></script>
<script src="{{ asset('public/frontend/assets/js/TweenMax.min.js') }}"></script>
<script src="{{ asset('public/frontend/assets/js/slick.min.js') }}"></script>
<script src="{{ asset('public/frontend/assets/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('public/frontend/assets/js/main.js') }}"></script>
</body>
</html>