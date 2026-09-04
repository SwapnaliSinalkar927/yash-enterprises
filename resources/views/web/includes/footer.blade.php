        <!--Start Site Footer-->
        <footer class="site-footer">
            <div class="shape1 float-bob-x"><img src="{{ asset('images/shapes/footer-v1-shape1.png') }}" alt=""></div>
            <div class="shape2 scale"><img src="{{ asset('images/shapes/footer-v1-shape2.png') }}" alt=""></div>
            <div class="shape3 scale"><img src="{{ asset('images/shapes/footer-v1-shape2.png') }}" alt=""></div>
            <!--Start Site Footer Top-->
            <div class="site-footer__top">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-3 col-lg-6 col-md-6  wow fadeInUp" data-wow-delay=".0s">
                            <div class="footer-widget__single footer-widget__about">
                                <div class="site-footer__logo">
                                    <a href="index.html"><img src="{{ asset('images/resources/logo-2.png') }}" alt=""></a>
                                </div>

                                <div class="footer-widget__about-text">
                                    <p>Professional cleaning with care for the environment.
                                        Our products are carefully selected to provide a safe and effective clean.
                                        </p>
                                </div>

                                <div class="footer-widget__about-social-links">
                                    <ul>
                                        <!-- <li><a href="#"><span class="icon-facebook-app-symbol"></span></a></li>
                                        <li><a href="#"><span class="icon-twitter-1"></span></a></li>
                                        <li><a href="#"><span class="icon-linkedin-big-logo"></span></a></li> -->
                                        <li><a href="#"><span class="icon-instagram"></span></a></li>
                                    </ul>
                                </div>

                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-6 col-md-6  wow fadeInUp" data-wow-delay=".1s">
                            <div class="footer-widget__single footer-widget__services">
                                <div class="title-box">
                                    <h2>Links</h2>
                                    <div class="line"></div>
                                </div>

                                <ul class="footer-widget__services-list">
                                    <li><a href="{{ asset('about-us') }}"><span class="icon-right-chevron"></span>About Us</a>
                                    </li>
                                    <li><a href="{{ asset('services') }}"><span class="icon-chevron"></span>Services</a></li>
                                    <li><a href="{{ asset('contact-us') }}"><span class="icon-right-chevron"></span>
                                           Contact Us</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-6 col-md-6  wow fadeInUp" data-wow-delay=".1s">
                            <div class="footer-widget__single footer-widget__services">
                                <div class="title-box">
                                    <h2>Quick Links</h2>
                                    <div class="line"></div>
                                </div>

                                <ul class="footer-widget__services-list">
                                    <li><a href="{{ asset('faq') }}"><span class="icon-right-chevron"></span>FAQ</a>
                                    </li>
                                    <li><a href=""><span class="icon-chevron"></span>Term & Conditions</a></li>
                                    <li><a href=""><span class="icon-right-chevron"></span>
                                           Privacy Policies</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-6 col-md-6  wow fadeInUp" data-wow-delay=".2s">
                            <div class="footer-widget__single footer-widget__contact">
                                <div class="title-box">
                                    <h2>Official info:</h2>
                                    <div class="line"></div>
                                </div>

                                <ul class="footer-widget__contact-list">
                                    <li>
                                        <div class="icon-box">
                                            <span class="icon-placeholder"></span>
                                        </div>

                                        <div class="text-box">
                                             <p>Near Maruti Mandir, Ranubaimala, Chakan - 410501 <br>
                                                Tal - Khed, Dist - Pune</p>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="icon-box">
                                            <span class="icon-phone-call"></span>
                                        </div>

                                        <div class="text-box">
                                            <p><a href="tel:9922756972">+91 992 275 6972</a></p>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="icon-box">
                                            <span class="icon-envelope"></span>
                                        </div>

                                        <div class="text-box">
                                             <p><a href="mailto:yashenterprises5556@gmail.com">yashenterprises5556@gmail.com</a></p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!--End Site Footer Top-->

            <!--Start Site Footer Bottom-->
            <div class="site-footer__bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="site-footer__bottom-inner">
                                <div class="site-footer__copyright">
                                    <p>Copyright@ {{ date('Y') }} Yash Enterprises. All Rights Reserved.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Site Footer Bottom-->
        </footer>
        <!--End Site Footer-->

    </div><!-- /.page-wrapper -->


    <div class="mobile-nav__wrapper">
        <div class="mobile-nav__overlay mobile-nav__toggler"></div>


        <div class="mobile-nav__content">
            <span class="mobile-nav__close mobile-nav__toggler">
                <i class="fa fa-times"></i>
            </span>
            <div class="logo-box">
                <a href="index.html" aria-label="logo image">
                    <img src="{{ asset('images/resources/logo-2.png') }}" alt="Logo" />
                </a>
            </div>
            <div class="mobile-nav__container"></div>
            <ul class="mobile-nav__contact list-unstyled">
                <li>
                    <i class="icon-envelope"></i>
                    <a href="mailto:needhelp@packageName__.com">needhelp@cleanin.com</a>
                </li>
                <li>
                    <i class="icon-phone-call"></i>
                    <a href="tel:666-888-0000">666 888 0000</a>
                </li>
            </ul>
            <div class="mobile-nav__top">
                <div class="mobile-nav__social">
                    <a href="#" class="icon-facebook-app-symbol"></a>
                    <a href="#" class="icon-twitter-1"></a>
                    <a href="#" class="icon-instagram"></a>
                    <a href="#" class="icon-pinterest"></a>
                </div>
            </div>
        </div>


    </div>
    <!-- /.mobile-nav__wrapper -->

    <!-- ==== search popup start ==== -->
    <div class="search-popup">
        <button class="close-search" aria-label="close search box" title="close search box">
            <span class="icon-plus-1"></span>
        </button>
        <form action="#" method="post">
            <div class="search-popup__group">
                <input type="text" name="search-field" id="searchField" placeholder="Search Here..." required>
                <button type="submit" aria-label="search products" title="search products">
                    <i class="icon-search-interface-symbol"></i>
                </button>
            </div>
        </form>
    </div>
    <!-- ==== / search popup end ==== -->

    <a href="#" data-target="html" class="scroll-to-target scroll-to-top">
        <span class="scroll-to-top__wrapper"><span class="scroll-to-top__inner"></span></span>
        <span class="scroll-to-top__text"> Go Back Top</span>
    </a>


    <script src="{{ asset('js/jquery-latest.js') }}"></script>
    <script src="{{ asset('js/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('js/jquery.circle-progress.min.js') }}"></script>
    <script src="{{ asset('js/jquery.event.move.js') }}"></script>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/swiper.min.js') }}"></script>
    <script src="{{ asset('js/knob.js') }}"></script>
    <script src="{{ asset('js/marquee.min.js') }}"></script>
    <script src="{{ asset('js/twentytwenty.js') }}"></script>
    <script src="{{ asset('js/typed-2.0.11.js') }}"></script>
    <script src="{{ asset('js/wNumb.min.js') }}"></script>
    <script src="{{ asset('js/curved-text/jquery.circleType.js') }}"></script>
    <script src="{{ asset('js/curved-text/jquery.fittext.js') }}"></script>
    <script src="{{ asset('js/curved-text/jquery.lettering.min.js') }}"></script>
    <script src="{{ asset('js/gsap/gsap.js') }}"></script>
    <script src="{{ asset('js/gsap/ScrollTrigger.js') }}"></script>
    <script src="{{ asset('js/gsap/SplitText.js') }}"></script>


    <script src="{{ asset('js/01-bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/02-countdown.min.js') }}"></script>
    <script src="{{ asset('js/03-jquery.appear.min.js') }}"></script>
    <script src="{{ asset('js/04-jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('js/05-owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/06-jarallax.min.js') }}"></script>
    <script src="{{ asset('js/07-odometer.min.js') }}"></script>
    <script src="{{ asset('js/08-jquery-ui.js') }}"></script>
    <script src="{{ asset('js/09-jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/10-wow.js') }}"></script>
    <script src="{{ asset('js/11-isotope.js') }}"></script>
    <script src="{{ asset('js/12-jquery-sidebar-content.js') }}"></script>


    <!-- template js -->
    <script src="{{ asset('js/script.js') }}"></script>