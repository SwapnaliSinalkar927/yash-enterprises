@extends('web.main')

@section('title', 'About Us')

@section('style')
@endsection

@section('content')
<!--Start Page Header-->
        <section class="page-header">
            <div class="page-header__bg" style="background-image: url({{ asset('images/backgrounds/page-header-bg.jpg') }})">
            </div>
            <div class="shape1 float-bob-x"><img src="{{ asset('images/shapes/main-slider-v4-shape1.png') }}" alt="">
            </div>
            <div class="container">
                <div class="page-header__inner">
                    <h2 class="wow fadeInDown" data-wow-duration="1500ms">About us</h2>
                    <ul class="thm-breadcrumb wow fadeInUp" data-wow-duration="1500ms">
                        <li><a href="index.html">Home</a></li>
                        <li><span class="icon-right-arrow1"></span></li>
                        <li>About us</li>
                    </ul>
                </div>
            </div>
        </section>
        <!--End Page Header-->

        <!--Start About One-->
        <section class="about-two about-two--about">
            <div class="shape2 rotate-me"><img
                src="{{ asset('images/shapes/about-v2-shape2.png') }}" alt=""></div>
            <div class="container">
                <div class="row">
                <!--Start About Two Img-->
                <div class="col-xl-6 wow fadeInRight animated" data-wow-delay="200ms"
                    data-wow-duration="1500ms"
                    style="visibility: visible; animation-duration: 1500ms; animation-delay: 200ms; animation-name: fadeInRight;">
                    <div class="about-two__img">
                    <div class="shape1 float-bob-y"><img
                        src="{{ asset('images/shapes/about-v2-shape1.png') }}" alt="">
                    </div>
                    <div class="about-two__img1">
                        <img src="{{ asset('images/about/about-v2-img1.jpg') }}" alt="">
                    </div>

                    <div class="about-two__img2">
                        <img src="{{ asset('images/about/about-v2-img2.jpg') }}" alt="">
                        <div class="about-one__video">
                        <a href="https://www.youtube.com/watch?v=06dV9txztKY"
                            class="video-popup">
                            <div class="about-one__video-icon">
                            <span class="icon-play-button-arrowhead"></span>
                            <i class="ripple"></i>
                            </div>
                        </a>
                        </div>
                    </div>
                    <div class="about-two__img-content">
                        <div class="progress-box">
                        <div class="graph-outer">
                            <div style="display:inline;width:75px;height:75px;"><canvas
                                width="93" height="93"
                                style="width: 75px; height: 75px;"></canvas><input
                                type="text" class="dial" data-fgcolor="#004a94"
                                data-bgcolor="#08395d" data-width="75" data-height="75"
                                data-linecap="normal" value="95" readonly="readonly"
                                style="display: none; width: 0px; visibility: hidden;">
                            </div>
                            <div class="inner-text count-box counted"><span
                                class="count-text" data-stop="95"
                                data-speed="2000">95</span><span
                                class="count-Parsent">%</span>
                            </div>
                        </div>
                        </div>
                        <div class="text-box">
                        <h3>Customars <br>
                            Satisfy</h3>
                        </div>
                    </div>
                    </div>
                </div>
                <!--End About Two Img-->

                <!--Start About Two Content-->
                <div class="col-xl-6 wow fadeInLeft animated" data-wow-delay="200ms"
                    data-wow-duration="1500ms"
                    style="visibility: visible; animation-duration: 1500ms; animation-delay: 200ms; animation-name: fadeInLeft;">
                    <div class="about-two__content">
                    <div class="sec-title sec-title-animation animation-style2">
                        <h5 class="sec-title__title title-animation"
                        style="perspective: 400px;">
                       About Us
                        </h5>
                    </div>

                    <div class="about-two__content-text">
                        <p>It is a long established fact that a reader will be distracted by
                        the readable
                        content of a page when looking at its layout. The point of using
                        Lorem Ipsum</p>
                    </div>
                    <div class="about-two__tab tab-box">
                        <ul class="tabs-button-box clearfix">
                        <li data-tab="#mission" class="tab-btn-item active-btn">
                            <h3>Why Choose Us</h3>
                        </li>
                        <li data-tab="#vision" class="tab-btn-item">
                            <h3> Our Expertise</h3>
                        </li>
                        <li data-tab="#history" class="tab-btn-item">
                            <h3>Our Commitment</h3>
                        </li>
                        </ul>
                        <div class="tabs-content tabs-content-box">
                        <!--Start Single Tab Content-->
                        <div class="tab tab-active" id="mission">
                            <div class="about-two__single-tab">
                            <div class="about-two__single-tab-inner">
                                <div class="about-two__single-tab-text">
                                <p>We believe a clean space is more than just a spotless appearance—it creates a healthier, safer, and more comfortable environment. Our professional team delivers dependable cleaning services with attention to detail, flexible solutions, and a strong focus on customer satisfaction.
                                </p>
                                </div>

                                <div class="about-two__single-tab-bottom">
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                    <ul class="about-two__single-tab-bottom-list">
                                        <li>
                                        <p><span class="icon-checkmark"></span>Reliable & Professional Team</p>
                                        </li>

                                        <li>
                                        <p><span class="icon-checkmark"></span>Quality Cleaning Standards</p>
                                        </li>
                                    </ul>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                    <ul class="about-two__single-tab-bottom-list">
                                        <li>
                                        <p><span class="icon-checkmark"></span>
                                           Customer-Focused Service</p>
                                        </li>

                                        <li>
                                        <p><span class="icon-checkmark"></span> Flexible Cleaning Solutions</p>
                                        </li>
                                    </ul>
                                    </div>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <!--End Single Tab Content-->

                        <!--Start Single Tab Content-->
                        <div class="tab" id="vision">
                            <div class="about-two__single-tab">
                            <div class="about-two__single-tab-inner">
                                <div class="about-two__single-tab-text">
                                <p>With extensive experience in the cleaning industry, we understand the unique requirements of homes, apartments, offices, and common areas. Our trained team uses effective cleaning methods and pays attention to every detail to deliver consistently high-quality results.
                                </p>
                                </div>

                                <div class="about-two__single-tab-bottom">
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                    <ul class="about-two__single-tab-bottom-list">
                                        <li>
                                        <p><span class="icon-checkmark"></span>Residential & Apartment Cleaning</p>
                                        </li>

                                        <li>
                                        <p><span class="icon-checkmark"></span>Office Cleaning Services</p>
                                        </li>
                                    </ul>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                    <ul class="about-two__single-tab-bottom-list">
                                        <li>
                                        <p><span class="icon-checkmark"></span>
                                            Common Area Maintenance</p>
                                        </li>

                                        <li>
                                        <p><span class="icon-checkmark"></span>Deep & Regular Cleaning</p>
                                        </li>
                                    </ul>
                                    </div>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <!--End Single Tab Content-->

                        <!--Start Single Tab Content-->
                        <div class="tab" id="history">
                            <div class="about-two__single-tab">
                            <div class="about-two__single-tab-inner">
                                <div class="about-two__single-tab-text">
                                <p>We are committed to maintaining clean, hygienic, and welcoming spaces for every customer. From regular maintenance to detailed cleaning, we focus on dependable service, professional standards, and results that you can see and trust.
                                </p>
                                </div>

                                <div class="about-two__single-tab-bottom">
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                    <ul class="about-two__single-tab-bottom-list">
                                        <li>
                                        <p><span class="icon-checkmark"></span>Consistent Service Quality</p>
                                        </li>

                                        <li>
                                        <p><span class="icon-checkmark"></span>Hygiene & Cleanliness</p>
                                        </li>
                                    </ul>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                    <ul class="about-two__single-tab-bottom-list">
                                        <li>
                                        <p><span class="icon-checkmark"></span>
                                            Trained Cleaning Professionals</p>
                                        </li>

                                        <li>
                                        <p><span class="icon-checkmark"></span>Complete Customer Satisfaction</p>
                                        </li>
                                    </ul>
                                    </div>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <!--End Single Tab Content-->
                        </div>
                    </div>

                    <div class="about-two__content-bottom">
                        <div class="about-two__content-founder">
                        <div class="img-box">
                            <img src="{{ asset('images/about/about-v2-img3.jpg') }}" alt="">
                        </div>
                        <div class="text-box">
                            <h3>Yash Fulsundar</h3>
                            <p>Director</p>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                <!--End About Two Content-->
                </div>
            </div>
        </section>
        <!--End About One-->

        <!--Start Services One-->
        <div class="services-one">
            <div class="shape1 float-bob-y"><img src="{{ asset('images/shapes/services-v1-shape1.png') }}" alt=""></div>
            <div class="shape2 float-bob-y"><img src="{{ asset('images/shapes/services-v1-shape1.png') }}" alt=""></div>
            <div class="shape3 float-bob-y"><img src="{{ asset('images/shapes/services-v1-shape1.png') }}" alt=""></div>
            <div class="shape4 float-bob-y"><img src="{{ asset('images/shapes/services-v1-shape1.png') }}" alt=""></div>
            <div class="shape5 float-bob-y"><img src="{{ asset('images/shapes/services-v1-shape1.png') }}" alt=""></div>
            <div class="shape6 float-bob-y"><img src="{{ asset('images/shapes/services-v1-shape1.png') }}" alt=""></div>
            <div class="shape7 float-bob-y"><img src="{{ asset('images/shapes/services-v1-shape1.png') }}" alt=""></div>
            <div class="shape8 float-bob-y"><img src="{{ asset('images/shapes/services-v1-shape1.png') }}" alt=""></div>
            <div class="container">
                <div class="sec-title text-center sec-title-animation animation-style1">
                    <div class="sec-title__tagline center">
                        <div class="icon-box">
                            <span class="icon-household"></span>
                        </div>

                        <div class="text title-animation">
                            <h4> What We Do </h4>
                        </div>
                    </div>
                    <h2 class="sec-title__title title-animation">Our Most Popular Cleaning <br>
                        Services For You </h2>
                </div>

                <div class="services-one__inner">
                   <div class="services-one__carousel owl-carousel owl-theme thm-dot-style1">

                        <!-- Weekly Apartment Service -->
                        <div class="services-one__single">
                            <div class="services-one__single-inner text-center">
                                <div class="services-one__single-icon">
                                    <span class="icon-bed"></span>
                                </div>

                                <h2>
                                    <a href="house-cleaning.php">Weekly Apartment Service</a>
                                </h2>

                                <p>
                                    Full dusting, mopping, and bathroom scrub in every flat.
                                    Same crew each week.
                                </p>

                                </div>

                            <div class="shadow-one"></div>
                            <div class="shadow-two"></div>
                        </div>


                        <!-- Common Area Maintenance -->
                        <div class="services-one__single">
                            <div class="services-one__single-inner text-center">
                                <div class="services-one__single-icon">
                                    <span class="icon-window-cleaning"></span>
                                </div>

                                <h2>
                                    <a href="house-cleaning.php">Common Area Maintenance</a>
                                </h2>

                                <p>
                                    Lobbies, staircases, and corridors cleaned on a set
                                    schedule. No missed spots.
                                </p>

                                </div>

                            <div class="shadow-one"></div>
                            <div class="shadow-two"></div>
                        </div>


                        <!-- Deep Cleaning Rounds -->
                        <div class="services-one__single">
                            <div class="services-one__single-inner text-center">
                                <div class="services-one__single-icon">
                                    <span class="icon-house"></span>
                                </div>

                                <h2>
                                    <a href="house-cleaning.php">Deep Cleaning Rounds</a>
                                </h2>

                                <p>
                                    Quarterly deep scrub for windows, grout, and
                                    overlooked corners in every unit.
                                </p>

                                </div>

                            <div class="shadow-one"></div>
                            <div class="shadow-two"></div>
                        </div>


                        <!-- Garbage and Recycling Runs -->
                        <div class="services-one__single">
                            <div class="services-one__single-inner text-center">
                                <div class="services-one__single-icon">
                                    <span class="icon-window-cleaner"></span>
                                </div>

                                <h2>
                                    <a href="house-cleaning.php">Garbage & Recycling Runs</a>
                                </h2>

                                <p>
                                    Daily waste collection from each floor. Segregated
                                    disposal as per society rules.
                                </p>

                                </div>

                            <div class="shadow-one"></div>
                            <div class="shadow-two"></div>
                        </div>


                        <!-- Parking and Basement Upkeep -->
                        <div class="services-one__single">
                            <div class="services-one__single-inner text-center">
                                <div class="services-one__single-icon">
                                    <span class="icon-house-2"></span>
                                </div>

                                <h2>
                                    <a href="house-cleaning.php">Parking & Basement Upkeep</a>
                                </h2>

                                <p>
                                    Sweeping, mopping, and removing debris from
                                    parking areas and basement levels.
                                </p>

                                </div>

                            <div class="shadow-one"></div>
                            <div class="shadow-two"></div>
                        </div>


                        <!-- Custom Society Packages -->
                        <div class="services-one__single">
                            <div class="services-one__single-inner text-center">
                                <div class="services-one__single-icon">
                                    <span class="icon-car-wash"></span>
                                </div>

                                <h2>
                                    <a href="house-cleaning.php">Custom Society Packages</a>
                                </h2>

                                <p>
                                    Tailored schedules and scope for each building.
                                    We work with your committee.
                                </p>

                                </div>

                            <div class="shadow-one"></div>
                            <div class="shadow-two"></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!--End Services One-->

        <!--Start Working Process One-->
        <section class="working-process-one">
            <div class="shape2 float-bob-y"><img src="{{ asset('images/shapes/working-process-v1-shape1.png') }}" alt=""></div>
            <div class="shape3 float-bob-x"><img src="{{ asset('images/shapes/working-process-v1-shape2.png') }}" alt=""></div>
            <div class="container">
                <div class="sec-title text-center sec-title-animation animation-style1">
                    <div class="sec-title__tagline center">
                        <div class="icon-box">
                            <span class="icon-household"></span>
                        </div>

                        <div class="text title-animation">
                            <h4>How It Works</h4>
                        </div>
                    </div>
                    <h2 class="sec-title__title title-animation">Our Working Process</h2>
                </div>

                <div class="shape1"></div>
                <div class="row">
                    <!--Start Working Process One Single-->
                    <div class="col-xl-4 col-lg-4 wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <div class="working-process-one__single">
                            <div class="icon">
                                <div class="count-box">01</div>
                                <span class="icon-task-complete"></span>
                            </div>

                            <div class="content-box text-center">
                                <h2><a href="#">Make A Plan</a></h2>
                                <p>It is a long established fact that a reader will be distracted by the readable
                                    content of a page when looking at its layout. The point of using.</p>
                            </div>
                        </div>
                    </div>
                    <!--End Working Process One Single-->

                    <!--Start Working Process One Single-->
                    <div class="col-xl-4 col-lg-4 wow fadeInRight" data-wow-delay="100ms" data-wow-duration="1500ms">
                        <div class="working-process-one__single">
                            <div class="icon">
                                <div class="count-box">02</div>
                                <span class="icon-calendar-1"></span>
                            </div>

                            <div class="content-box text-center">
                                <h2><a href="#">Set a Date</a></h2>
                                <p>It is a long established fact that a reader will be distracted by the readable
                                    content of a page when looking at its layout. The point of using.</p>
                            </div>
                        </div>
                    </div>
                    <!--End Working Process One Single-->

                    <!--Start Working Process One Single-->
                    <div class="col-xl-4 col-lg-4 wow fadeInLeft" data-wow-delay="200ms" data-wow-duration="1500ms">
                        <div class="working-process-one__single">
                            <div class="icon">
                                <div class="count-box">03</div>
                                <span class="icon-household"></span>
                            </div>

                            <div class="content-box text-center">
                                <h2><a href="#">Start Cleaning</a></h2>
                                <p>It is a long established fact that a reader will be distracted by the readable
                                    content of a page when looking at its layout. The point of using.</p>
                            </div>
                        </div>
                    </div>
                    <!--End Working Process One Single-->
                </div>
            </div>
        </section>
        <!--End Working Process One-->

        <!--Start Team One-->
        <section class="team-one">
            <div class="container">
                <div class="sec-title text-center sec-title-animation animation-style1">
                    <div class="sec-title__tagline center">
                        <div class="icon-box">
                            <span class="icon-household"></span>
                        </div>

                        <div class="text title-animation">
                            <h4>We’ve Awesome Team Members</h4>
                        </div>
                    </div>
                    <h2 class="sec-title__title title-animation">Meet Our Experienced & <br>
                        Professional Team</h2>
                </div>

                <div class="team-one__carousel owl-carousel owl-theme thm-dot-style1">

                    <!--Start Team One Single-->
                    <div class="team-one__single">
                        <div class="team-one__single-inner">
                            <div class="team-one__single-img">
                                <img src="{{ asset('images/team/team-v1-img1.jpg') }}" alt="">
                            </div>

                            <div class="team-one__single-content">
                                <div class="img-box">
                                    <img src="{{ asset('images/team/team-v1-img5.jpg') }}" alt="#">
                                </div>

                                <div class="text-box">
                                    <h2><a href="team-details.html">Robert Michale</a></h2>
                                    <p>Window Cleaner</p>
                                </div>

                                <div class="social-links">
                                    <a href="#"><span class="icon-facebook-app-symbol"></span></a>
                                    <a href="#"><span class="icon-twitter-1"></span></a>
                                    <a href="#"><span class="icon-instagram"></span></a>
                                    <a href="#"><span class="icon-pinterest"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End Team One Single-->

                    <!--Start Team One Single-->
                    <div class="team-one__single">
                        <div class="team-one__single-inner">
                            <div class="team-one__single-img">
                                <img src="{{ asset('images/team/team-v1-img2.jpg') }}" alt="">
                            </div>

                            <div class="team-one__single-content">
                                <div class="img-box">
                                    <img src="{{ asset('images/team/team-v1-img6.jpg') }}" alt="#">
                                </div>

                                <div class="text-box">
                                    <h2><a href="team-details.html">Mike Hussy</a></h2>
                                    <p>Window Cleaner</p>
                                </div>

                                <div class="social-links">
                                    <a href="#"><span class="icon-facebook-app-symbol"></span></a>
                                    <a href="#"><span class="icon-twitter-1"></span></a>
                                    <a href="#"><span class="icon-instagram"></span></a>
                                    <a href="#"><span class="icon-pinterest"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End Team One Single-->

                    <!--Start Team One Single-->
                    <div class="team-one__single">
                        <div class="team-one__single-inner">
                            <div class="team-one__single-img">
                                <img src="{{ asset('images/team/team-v1-img3.jpg') }}" alt="">
                            </div>

                            <div class="team-one__single-content">
                                <div class="img-box">
                                    <img src="{{ asset('images/team/team-v1-img7.jpg') }}" alt="#">
                                </div>

                                <div class="text-box">
                                    <h2><a href="team-details.html">Robert Mike</a></h2>
                                    <p>Window Cleaner</p>
                                </div>

                                <div class="social-links">
                                    <a href="#"><span class="icon-facebook-app-symbol"></span></a>
                                    <a href="#"><span class="icon-twitter-1"></span></a>
                                    <a href="#"><span class="icon-instagram"></span></a>
                                    <a href="#"><span class="icon-pinterest"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End Team One Single-->

                    <!--Start Team One Single-->
                    <div class="team-one__single">
                        <div class="team-one__single-inner">
                            <div class="team-one__single-img">
                                <img src="{{ asset('images/team/team-v1-img4.jpg') }}" alt="">
                            </div>

                            <div class="team-one__single-content">
                                <div class="img-box">
                                    <img src="{{ asset('images/team/team-v1-img8.jpg') }}" alt="#">
                                </div>

                                <div class="text-box">
                                    <h2><a href="team-details.html">Michale Hussy</a></h2>
                                    <p>Window Cleaner</p>
                                </div>

                                <div class="social-links">
                                    <a href="#"><span class="icon-facebook-app-symbol"></span></a>
                                    <a href="#"><span class="icon-twitter-1"></span></a>
                                    <a href="#"><span class="icon-instagram"></span></a>
                                    <a href="#"><span class="icon-pinterest"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End Team One Single-->

                    <!--Start Team One Single-->
                    <div class="team-one__single">
                        <div class="team-one__single-inner">
                            <div class="team-one__single-img">
                                <img src="{{ asset('images/team/team-v1-img1.jpg') }}" alt="">
                            </div>

                            <div class="team-one__single-content">
                                <div class="img-box">
                                    <img src="{{ asset('images/team/team-v1-img5.jpg') }}" alt="#">
                                </div>

                                <div class="text-box">
                                    <h2><a href="team-details.html">Robert Michale</a></h2>
                                    <p>Window Cleaner</p>
                                </div>

                                <div class="social-links">
                                    <a href="#"><span class="icon-facebook-app-symbol"></span></a>
                                    <a href="#"><span class="icon-twitter-1"></span></a>
                                    <a href="#"><span class="icon-instagram"></span></a>
                                    <a href="#"><span class="icon-pinterest"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End Team One Single-->

                    <!--Start Team One Single-->
                    <div class="team-one__single">
                        <div class="team-one__single-inner">
                            <div class="team-one__single-img">
                                <img src="{{ asset('images/team/team-v1-img2.jpg') }}" alt="">
                            </div>

                            <div class="team-one__single-content">
                                <div class="img-box">
                                    <img src="{{ asset('images/team/team-v1-img6.jpg') }}" alt="#">
                                </div>

                                <div class="text-box">
                                    <h2><a href="team-details.html">Mike Hussy</a></h2>
                                    <p>Window Cleaner</p>
                                </div>

                                <div class="social-links">
                                    <a href="#"><span class="icon-facebook-app-symbol"></span></a>
                                    <a href="#"><span class="icon-twitter-1"></span></a>
                                    <a href="#"><span class="icon-instagram"></span></a>
                                    <a href="#"><span class="icon-pinterest"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End Team One Single-->

                    <!--Start Team One Single-->
                    <div class="team-one__single">
                        <div class="team-one__single-inner">
                            <div class="team-one__single-img">
                                <img src="{{ asset('images/team/team-v1-img3.jpg') }}" alt="">
                            </div>

                            <div class="team-one__single-content">
                                <div class="img-box">
                                    <img src="{{ asset('images/team/team-v1-img7.jpg') }}" alt="#">
                                </div>

                                <div class="text-box">
                                    <h2><a href="team-details.html">Robert Mike</a></h2>
                                    <p>Window Cleaner</p>
                                </div>

                                <div class="social-links">
                                    <a href="#"><span class="icon-facebook-app-symbol"></span></a>
                                    <a href="#"><span class="icon-twitter-1"></span></a>
                                    <a href="#"><span class="icon-instagram"></span></a>
                                    <a href="#"><span class="icon-pinterest"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End Team One Single-->

                    <!--Start Team One Single-->
                    <div class="team-one__single">
                        <div class="team-one__single-inner">
                            <div class="team-one__single-img">
                                <img src="{{ asset('images/team/team-v1-img4.jpg') }}" alt="">
                            </div>

                            <div class="team-one__single-content">
                                <div class="img-box">
                                    <img src="{{ asset('images/team/team-v1-img8.jpg') }}" alt="#">
                                </div>

                                <div class="text-box">
                                    <h2><a href="team-details.html">Michale Hussy</a></h2>
                                    <p>Window Cleaner</p>
                                </div>

                                <div class="social-links">
                                    <a href="#"><span class="icon-facebook-app-symbol"></span></a>
                                    <a href="#"><span class="icon-twitter-1"></span></a>
                                    <a href="#"><span class="icon-instagram"></span></a>
                                    <a href="#"><span class="icon-pinterest"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End Team One Single-->

                    <!--Start Team One Single-->
                    <div class="team-one__single">
                        <div class="team-one__single-inner">
                            <div class="team-one__single-img">
                                <img src="{{ asset('images/team/team-v1-img1.jpg') }}" alt="">
                            </div>

                            <div class="team-one__single-content">
                                <div class="img-box">
                                    <img src="{{ asset('images/team/team-v1-img5.jpg') }}" alt="#">
                                </div>

                                <div class="text-box">
                                    <h2><a href="team-details.html">Robert Michale</a></h2>
                                    <p>Window Cleaner</p>
                                </div>

                                <div class="social-links">
                                    <a href="#"><span class="icon-facebook-app-symbol"></span></a>
                                    <a href="#"><span class="icon-twitter-1"></span></a>
                                    <a href="#"><span class="icon-instagram"></span></a>
                                    <a href="#"><span class="icon-pinterest"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End Team One Single-->

                    <!--Start Team One Single-->
                    <div class="team-one__single">
                        <div class="team-one__single-inner">
                            <div class="team-one__single-img">
                                <img src="{{ asset('images/team/team-v1-img2.jpg') }}" alt="">
                            </div>

                            <div class="team-one__single-content">
                                <div class="img-box">
                                    <img src="{{ asset('images/team/team-v1-img6.jpg') }}" alt="#">
                                </div>

                                <div class="text-box">
                                    <h2><a href="team-details.html">Mike Hussy</a></h2>
                                    <p>Window Cleaner</p>
                                </div>

                                <div class="social-links">
                                    <a href="#"><span class="icon-facebook-app-symbol"></span></a>
                                    <a href="#"><span class="icon-twitter-1"></span></a>
                                    <a href="#"><span class="icon-instagram"></span></a>
                                    <a href="#"><span class="icon-pinterest"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End Team One Single-->

                    <!--Start Team One Single-->
                    <div class="team-one__single">
                        <div class="team-one__single-inner">
                            <div class="team-one__single-img">
                                <img src="{{ asset('images/team/team-v1-img3.jpg') }}" alt="">
                            </div>

                            <div class="team-one__single-content">
                                <div class="img-box">
                                    <img src="{{ asset('images/team/team-v1-img7.jpg') }}" alt="#">
                                </div>

                                <div class="text-box">
                                    <h2><a href="team-details.html">Robert Mike</a></h2>
                                    <p>Window Cleaner</p>
                                </div>

                                <div class="social-links">
                                    <a href="#"><span class="icon-facebook-app-symbol"></span></a>
                                    <a href="#"><span class="icon-twitter-1"></span></a>
                                    <a href="#"><span class="icon-instagram"></span></a>
                                    <a href="#"><span class="icon-pinterest"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End Team One Single-->

                    <!--Start Team One Single-->
                    <div class="team-one__single">
                        <div class="team-one__single-inner">
                            <div class="team-one__single-img">
                                <img src="{{ asset('images/team/team-v1-img4.jpg') }}" alt="">
                            </div>

                            <div class="team-one__single-content">
                                <div class="img-box">
                                    <img src="{{ asset('images/team/team-v1-img8.jpg') }}" alt="#">
                                </div>

                                <div class="text-box">
                                    <h2><a href="team-details.html">Michale Hussy</a></h2>
                                    <p>Window Cleaner</p>
                                </div>

                                <div class="social-links">
                                    <a href="#"><span class="icon-facebook-app-symbol"></span></a>
                                    <a href="#"><span class="icon-twitter-1"></span></a>
                                    <a href="#"><span class="icon-instagram"></span></a>
                                    <a href="#"><span class="icon-pinterest"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End Team One Single-->

                    <!--Start Team One Single-->
                    <div class="team-one__single">
                        <div class="team-one__single-inner">
                            <div class="team-one__single-img">
                                <img src="{{ asset('images/team/team-v1-img1.jpg') }}" alt="">
                            </div>

                            <div class="team-one__single-content">
                                <div class="img-box">
                                    <img src="{{ asset('images/team/team-v1-img5.jpg') }}" alt="#">
                                </div>

                                <div class="text-box">
                                    <h2><a href="team-details.html">Robert Michale</a></h2>
                                    <p>Window Cleaner</p>
                                </div>

                                <div class="social-links">
                                    <a href="#"><span class="icon-facebook-app-symbol"></span></a>
                                    <a href="#"><span class="icon-twitter-1"></span></a>
                                    <a href="#"><span class="icon-instagram"></span></a>
                                    <a href="#"><span class="icon-pinterest"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End Team One Single-->

                    <!--Start Team One Single-->
                    <div class="team-one__single">
                        <div class="team-one__single-inner">
                            <div class="team-one__single-img">
                                <img src="{{ asset('images/team/team-v1-img2.jpg') }}" alt="">
                            </div>

                            <div class="team-one__single-content">
                                <div class="img-box">
                                    <img src="{{ asset('images/team/team-v1-img6.jpg') }}" alt="#">
                                </div>

                                <div class="text-box">
                                    <h2><a href="team-details.html">Mike Hussy</a></h2>
                                    <p>Window Cleaner</p>
                                </div>

                                <div class="social-links">
                                    <a href="#"><span class="icon-facebook-app-symbol"></span></a>
                                    <a href="#"><span class="icon-twitter-1"></span></a>
                                    <a href="#"><span class="icon-instagram"></span></a>
                                    <a href="#"><span class="icon-pinterest"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End Team One Single-->

                    <!--Start Team One Single-->
                    <div class="team-one__single">
                        <div class="team-one__single-inner">
                            <div class="team-one__single-img">
                                <img src="{{ asset('images/team/team-v1-img3.jpg') }}" alt="">
                            </div>

                            <div class="team-one__single-content">
                                <div class="img-box">
                                    <img src="{{ asset('images/team/team-v1-img7.jpg') }}" alt="#">
                                </div>

                                <div class="text-box">
                                    <h2><a href="team-details.html">Robert Mike</a></h2>
                                    <p>Window Cleaner</p>
                                </div>

                                <div class="social-links">
                                    <a href="#"><span class="icon-facebook-app-symbol"></span></a>
                                    <a href="#"><span class="icon-twitter-1"></span></a>
                                    <a href="#"><span class="icon-instagram"></span></a>
                                    <a href="#"><span class="icon-pinterest"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End Team One Single-->

                    <!--Start Team One Single-->
                    <div class="team-one__single">
                        <div class="team-one__single-inner">
                            <div class="team-one__single-img">
                                <img src="{{ asset('images/team/team-v1-img4.jpg') }}" alt="">
                            </div>

                            <div class="team-one__single-content">
                                <div class="img-box">
                                    <img src="{{ asset('images/team/team-v1-img8.jpg') }}" alt="#">
                                </div>

                                <div class="text-box">
                                    <h2><a href="team-details.html">Michale Hussy</a></h2>
                                    <p>Window Cleaner</p>
                                </div>

                                <div class="social-links">
                                    <a href="#"><span class="icon-facebook-app-symbol"></span></a>
                                    <a href="#"><span class="icon-twitter-1"></span></a>
                                    <a href="#"><span class="icon-instagram"></span></a>
                                    <a href="#"><span class="icon-pinterest"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End Team One Single-->
                </div>
            </div>
        </section>
        <!--End Team One-->

        <!--Start Why Choose One-->
        <section class="why-choose-one">
            <div class="why-choose-one__bg"
                style="background-image: url({{ asset('images/backgrounds/why-choose-v1-bg.jpg') }});"></div>
            <div class="shape1"></div>
            <div class="shape2"></div>
            <div class="shape3 scale"><img src="{{ asset('images/shapes/why-choose-v1-shape1.png') }}" alt=""></div>
            <div class="shape4 float-bob-x"><img src="{{ asset('images/shapes/why-choose-v1-shape1.png') }}" alt=""></div>
            <div class="shape5 float-bob-y"><img src="{{ asset('images/shapes/why-choose-v1-shape1.png') }}" alt=""></div>
            <div class="container">
                <div class="why-choose-one__inner">
                    <div class="sec-title sec-title-animation animation-style2">
                        <div class="sec-title__tagline">
                            <div class="icon-box">
                                <span class="icon-household"></span>
                            </div>

                            <div class="text title-animation">
                                <h4>Why Choose us?</h4>
                            </div>
                        </div>
                        <h2 class="sec-title__title title-animation">We Will Make Absolutely Any <br> Place Clean, Neat
                            & Tidy.</h2>
                    </div>

                    <div class="why-choose-one__tab tab-box">
                        <ul class="tabs-button-box clearfix">
                            <li data-tab="#mission" class="tab-btn-item active-btn">
                                <h3><span class="icon-target"></span> Our Mission</h3>
                            </li>
                            <li data-tab="#vision" class="tab-btn-item">
                                <h3><span class="icon-achievement"></span> Our Vision</h3>
                            </li>
                            <li data-tab="#philosophy" class="tab-btn-item">
                                <h3><span class="icon-cleaning-service"></span> Our Philosophy</h3>
                            </li>
                        </ul>

                        <div class="tabs-content tabs-content-box">
                            <!--Start Single Tab Content-->
                            <div class="tab tab-active" id="mission">
                                <div class="why-choose-one__single-tab">
                                    <div class="why-choose-one__single-tab-inner">
                                        <div class="row">
                                            <div class="col-xl-6 col-lg-6">
                                                <div class="why-choose-one__single-tab-img">
                                                    <div class="inner">
                                                        <img src="{{ asset('images/resources/why-choose-v1-img1.jpg') }}"
                                                            alt="#">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xl-6 col-lg-6">
                                                <div class="why-choose-one__single-tab-content">
                                                    <h2>Our Two-Part Satisfaction Guarantee!</h2>
                                                    <p>It is a long established fact that a reader will be distracted by
                                                        the readable content of a page when looking at its layout. The
                                                        point
                                                        of using Lorem Ipsum is that it has a more-or-less normal
                                                        distribution of letters, as opposed.</p>
                                                    <div class="btn-box">
                                                        <a class="thm-btn" href="contact-1.html">View Terms of Service
                                                            <i class="icon-next"></i>
                                                            <span class="hover-btn hover-bx"></span>
                                                            <span class="hover-btn hover-bx2"></span>
                                                            <span class="hover-btn hover-bx3"></span>
                                                            <span class="hover-btn hover-bx4"></span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--End Single Tab Content-->

                            <!--Start Single Tab Content-->
                            <div class="tab" id="vision">
                                <div class="why-choose-one__single-tab">
                                    <div class="why-choose-one__single-tab-inner">
                                        <div class="row">
                                            <div class="col-xl-6 col-lg-6">
                                                <div class="why-choose-one__single-tab-img">
                                                    <div class="inner">
                                                        <img src="{{ asset('images/resources/why-choose-v1-img2.jpg') }}"
                                                            alt="#">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xl-6 col-lg-6">
                                                <div class="why-choose-one__single-tab-content">
                                                    <h2>Expert Cleaning Team </h2>
                                                    <p>It is a long established fact that a reader will be distracted by
                                                        the readable content of a page when looking at its layout. The
                                                        point
                                                        of using Lorem Ipsum is that it has a more-or-less normal
                                                        distribution of letters, as opposed.</p>
                                                    <div class="btn-box">
                                                        <a class="thm-btn" href="contact-1.html">View Terms of Service
                                                            <i class="icon-next"></i>
                                                            <span class="hover-btn hover-bx"></span>
                                                            <span class="hover-btn hover-bx2"></span>
                                                            <span class="hover-btn hover-bx3"></span>
                                                            <span class="hover-btn hover-bx4"></span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--End Single Tab Content-->

                            <!--Start Single Tab Content-->
                            <div class="tab" id="philosophy">
                                <div class="why-choose-one__single-tab">
                                    <div class="why-choose-one__single-tab-inner">
                                        <div class="row">
                                            <div class="col-xl-6 col-lg-6">
                                                <div class="why-choose-one__single-tab-img">
                                                    <div class="inner">
                                                        <img src="{{ asset('images/resources/why-choose-v1-img3.jpg') }}"
                                                            alt="#">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xl-6 col-lg-6">
                                                <div class="why-choose-one__single-tab-content">
                                                    <h2>24/7 Online Support </h2>
                                                    <p>It is a long established fact that a reader will be distracted by
                                                        the readable content of a page when looking at its layout. The
                                                        point
                                                        of using Lorem Ipsum is that it has a more-or-less normal
                                                        distribution of letters, as opposed.</p>
                                                    <div class="btn-box">
                                                        <a class="thm-btn" href="contact-1.html">View Terms of Service
                                                            <i class="icon-next"></i>
                                                            <span class="hover-btn hover-bx"></span>
                                                            <span class="hover-btn hover-bx2"></span>
                                                            <span class="hover-btn hover-bx3"></span>
                                                            <span class="hover-btn hover-bx4"></span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--End Single Tab Content-->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--End Why Choose One-->


        <!--Start Testimonial One-->
        <section class="testimonial-one">
            <div class="shape1"><img src="{{ asset('images/shapes/testimonial-v1-shape1.png') }}" alt=""></div>
            <div class="container">
                <div class="sec-title sec-title-animation animation-style2">
                    <div class="sec-title__tagline">
                        <div class="icon-box">
                            <span class="icon-household"></span>
                        </div>

                        <div class="text title-animation">
                            <h4>Testimonials</h4>
                        </div>
                    </div>
                    <h2 class="sec-title__title title-animation">Our Customer’s Feedback</h2>
                </div>

                <div class="row">
                    <div class="col-xl-12">
                        <div class="testimonial-one__carousel owl-carousel owl-theme">

                            <!--Start Testimonial One Single-->
                            <div class="testimonial-one__single text-center">
                                <div class="testimonial-one__single-img">
                                    <img src="{{ asset('images/testimonial/testimonial-v1-img1.jpg') }}" alt="">
                                </div>
                                <div class="testimonial-one__single-inner">
                                    <h2>Savannah Nguyen</h2>
                                    <p>There are many variations of passages of Lorem Ipsum available, but the majority
                                        have suffered alteration in some form.</p>

                                    <div class="rating-box">
                                        <a href="#"><i class="icon-star"></i></a>
                                        <a href="#"><i class="icon-star"></i></a>
                                        <a href="#"><i class="icon-star"></i></a>
                                        <a href="#"><i class="icon-star"></i></a>
                                        <a href="#"><i class="icon-star"></i></a>
                                    </div>
                                </div>
                                <div class="icon-box">
                                    <span class="icon-quotation-up"></span>
                                </div>
                            </div>
                            <!--End Testimonial One Single-->

                            <!--Start Testimonial One Single-->
                            <div class="testimonial-one__single text-center">
                                <div class="testimonial-one__single-img">
                                    <img src="{{ asset('images/testimonial/testimonial-v1-img2.jpg') }}" alt="">
                                </div>
                                <div class="testimonial-one__single-inner">
                                    <h2>Dwayne Johnson</h2>
                                    <p>There are many variations of passages of Lorem Ipsum available, but the majority
                                        have suffered alteration in some form.</p>

                                    <div class="rating-box">
                                        <a href="#"><i class="icon-star"></i></a>
                                        <a href="#"><i class="icon-star"></i></a>
                                        <a href="#"><i class="icon-star"></i></a>
                                        <a href="#"><i class="icon-star"></i></a>
                                        <a href="#"><i class="icon-star"></i></a>
                                    </div>
                                </div>
                                <div class="icon-box">
                                    <span class="icon-quotation-up"></span>
                                </div>
                            </div>
                            <!--End Testimonial One Single-->

                            <!--Start Testimonial One Single-->
                            <div class="testimonial-one__single text-center">
                                <div class="testimonial-one__single-img">
                                    <img src="{{ asset('images/testimonial/testimonial-v1-img3.jpg') }}" alt="">
                                </div>
                                <div class="testimonial-one__single-inner">
                                    <h2>John D. Alexon</h2>
                                    <p>There are many variations of passages of Lorem Ipsum available, but the majority
                                        have suffered alteration in some form.</p>

                                    <div class="rating-box">
                                        <a href="#"><i class="icon-star"></i></a>
                                        <a href="#"><i class="icon-star"></i></a>
                                        <a href="#"><i class="icon-star"></i></a>
                                        <a href="#"><i class="icon-star"></i></a>
                                        <a href="#"><i class="icon-star"></i></a>
                                    </div>
                                </div>
                                <div class="icon-box">
                                    <span class="icon-quotation-up"></span>
                                </div>
                            </div>
                            <!--End Testimonial One Single-->

                            <!--Start Testimonial One Single-->
                            <div class="testimonial-one__single text-center">
                                <div class="testimonial-one__single-img">
                                    <img src="{{ asset('images/testimonial/testimonial-v1-img1.jpg') }}" alt="">
                                </div>
                                <div class="testimonial-one__single-inner">
                                    <h2>Savannah Nguyen</h2>
                                    <p>There are many variations of passages of Lorem Ipsum available, but the majority
                                        have suffered alteration in some form.</p>

                                    <div class="rating-box">
                                        <a href="#"><i class="icon-star"></i></a>
                                        <a href="#"><i class="icon-star"></i></a>
                                        <a href="#"><i class="icon-star"></i></a>
                                        <a href="#"><i class="icon-star"></i></a>
                                        <a href="#"><i class="icon-star"></i></a>
                                    </div>
                                </div>
                                <div class="icon-box">
                                    <span class="icon-quotation-up"></span>
                                </div>
                            </div>
                            <!--End Testimonial One Single-->

                            <!--Start Testimonial One Single-->
                            <div class="testimonial-one__single text-center">
                                <div class="testimonial-one__single-img">
                                    <img src="{{ asset('images/testimonial/testimonial-v1-img2.jpg') }}" alt="">
                                </div>
                                <div class="testimonial-one__single-inner">
                                    <h2>Dwayne Johnson</h2>
                                    <p>There are many variations of passages of Lorem Ipsum available, but the majority
                                        have suffered alteration in some form.</p>

                                    <div class="rating-box">
                                        <a href="#"><i class="icon-star"></i></a>
                                        <a href="#"><i class="icon-star"></i></a>
                                        <a href="#"><i class="icon-star"></i></a>
                                        <a href="#"><i class="icon-star"></i></a>
                                        <a href="#"><i class="icon-star"></i></a>
                                    </div>
                                </div>
                                <div class="icon-box">
                                    <span class="icon-quotation-up"></span>
                                </div>
                            </div>
                            <!--End Testimonial One Single-->

                            <!--Start Testimonial One Single-->
                            <div class="testimonial-one__single text-center">
                                <div class="testimonial-one__single-img">
                                    <img src="{{ asset('images/testimonial/testimonial-v1-img3.jpg') }}" alt="">
                                </div>
                                <div class="testimonial-one__single-inner">
                                    <h2>John D. Alexon</h2>
                                    <p>There are many variations of passages of Lorem Ipsum available, but the majority
                                        have suffered alteration in some form.</p>

                                    <div class="rating-box">
                                        <a href="#"><i class="icon-star"></i></a>
                                        <a href="#"><i class="icon-star"></i></a>
                                        <a href="#"><i class="icon-star"></i></a>
                                        <a href="#"><i class="icon-star"></i></a>
                                        <a href="#"><i class="icon-star"></i></a>
                                    </div>
                                </div>
                                <div class="icon-box">
                                    <span class="icon-quotation-up"></span>
                                </div>
                            </div>
                            <!--End Testimonial One Single-->

                            <!--Start Testimonial One Single-->
                            <div class="testimonial-one__single text-center">
                                <div class="testimonial-one__single-img">
                                    <img src="{{ asset('images/testimonial/testimonial-v1-img1.jpg') }}" alt="">
                                </div>
                                <div class="testimonial-one__single-inner">
                                    <h2>Savannah Nguyen</h2>
                                    <p>There are many variations of passages of Lorem Ipsum available, but the majority
                                        have suffered alteration in some form.</p>

                                    <div class="rating-box">
                                        <a href="#"><i class="icon-star"></i></a>
                                        <a href="#"><i class="icon-star"></i></a>
                                        <a href="#"><i class="icon-star"></i></a>
                                        <a href="#"><i class="icon-star"></i></a>
                                        <a href="#"><i class="icon-star"></i></a>
                                    </div>
                                </div>
                                <div class="icon-box">
                                    <span class="icon-quotation-up"></span>
                                </div>
                            </div>
                            <!--End Testimonial One Single-->

                            <!--Start Testimonial One Single-->
                            <div class="testimonial-one__single text-center">
                                <div class="testimonial-one__single-img">
                                    <img src="{{ asset('images/testimonial/testimonial-v1-img2.jpg') }}" alt="">
                                </div>
                                <div class="testimonial-one__single-inner">
                                    <h2>Dwayne Johnson</h2>
                                    <p>There are many variations of passages of Lorem Ipsum available, but the majority
                                        have suffered alteration in some form.</p>

                                    <div class="rating-box">
                                        <a href="#"><i class="icon-star"></i></a>
                                        <a href="#"><i class="icon-star"></i></a>
                                        <a href="#"><i class="icon-star"></i></a>
                                        <a href="#"><i class="icon-star"></i></a>
                                        <a href="#"><i class="icon-star"></i></a>
                                    </div>
                                </div>
                                <div class="icon-box">
                                    <span class="icon-quotation-up"></span>
                                </div>
                            </div>
                            <!--End Testimonial One Single-->

                            <!--Start Testimonial One Single-->
                            <div class="testimonial-one__single text-center">
                                <div class="testimonial-one__single-img">
                                    <img src="{{ asset('images/testimonial/testimonial-v1-img3.jpg') }}" alt="">
                                </div>
                                <div class="testimonial-one__single-inner">
                                    <h2>John D. Alexon</h2>
                                    <p>There are many variations of passages of Lorem Ipsum available, but the majority
                                        have suffered alteration in some form.</p>

                                    <div class="rating-box">
                                        <a href="#"><i class="icon-star"></i></a>
                                        <a href="#"><i class="icon-star"></i></a>
                                        <a href="#"><i class="icon-star"></i></a>
                                        <a href="#"><i class="icon-star"></i></a>
                                        <a href="#"><i class="icon-star"></i></a>
                                    </div>
                                </div>
                                <div class="icon-box">
                                    <span class="icon-quotation-up"></span>
                                </div>
                            </div>
                            <!--End Testimonial One Single-->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--End Testimonial One-->

        <!--Start Brand One-->
        <section class="brand-one brand-one--two about">
            <div class="container">
                <div class="brand-one__inner">
                    <div class="brand-one__carousel owl-carousel owl-theme">
                        <!--Start Brand One Single-->
                        <div class="brand-one__single">
                            <div class="brand-one__single-inner">
                                <a href="#">
                                    <img src="{{ asset('images/brand/brand-1-1.png') }}" alt="">
                                    <img src="{{ asset('images/brand/brand-1-2.png') }}" alt="">
                                </a>
                            </div>
                        </div>
                        <!--End Brand One Single-->

                        <!--Start Brand One Single-->
                        <div class="brand-one__single">
                            <div class="brand-one__single-inner">
                                <a href="#">
                                    <img src="{{ asset('images/brand/brand-1-1.png') }}" alt="">
                                    <img src="{{ asset('images/brand/brand-1-2.png') }}" alt="">
                                </a>
                            </div>
                        </div>
                        <!--End Brand One Single-->

                        <!--Start Brand One Single-->
                        <div class="brand-one__single">
                            <div class="brand-one__single-inner">
                                <a href="#">
                                    <img src="{{ asset('images/brand/brand-1-1.png') }}" alt="">
                                    <img src="{{ asset('images/brand/brand-1-2.png') }}" alt="">
                                </a>
                            </div>
                        </div>
                        <!--End Brand One Single-->

                        <!--Start Brand One Single-->
                        <div class="brand-one__single">
                            <div class="brand-one__single-inner">
                                <a href="#">
                                    <img src="{{ asset('images/brand/brand-1-1.png') }}" alt="">
                                    <img src="{{ asset('images/brand/brand-1-2.png') }}" alt="">
                                </a>
                            </div>
                        </div>
                        <!--End Brand One Single-->

                        <!--Start Brand One Single-->
                        <div class="brand-one__single">
                            <div class="brand-one__single-inner">
                                <a href="#">
                                    <img src="{{ asset('images/brand/brand-1-1.png') }}" alt="">
                                    <img src="{{ asset('images/brand/brand-1-2.png') }}" alt="">
                                </a>
                            </div>
                        </div>
                        <!--End Brand One Single-->

                        <!--Start Brand One Single-->
                        <div class="brand-one__single">
                            <div class="brand-one__single-inner">
                                <a href="#">
                                    <img src="{{ asset('images/brand/brand-1-1.png') }}" alt="">
                                    <img src="{{ asset('images/brand/brand-1-2.png') }}" alt="">
                                </a>
                            </div>
                        </div>
                        <!--End Brand One Single-->
                    </div>
                </div>
            </div>
        </section>
        <!--End Brand One-->

        <!--Start Cta One -->
        <section class="cta-one">
            <div class="shape1"></div>
            <div class="cta-one__bg" style="background-image: url({{ asset('images/backgrounds/cta-v1-bg.jpg') }});">
            </div>
            <div class="container clearfix">
                <div class="cta-one__inner">
                    <div class="cta-one__content">
                        <div class="text-box">
                            <p>Quality Services provider</p>
                            <h2>Need Our services?</h2>
                        </div>

                        <div class="btn-box">
                            <a class="thm-btn" href="contact-1.html">get free quote
                                <i class="icon-next"></i>
                                <span class="hover-btn hover-bx"></span>
                                <span class="hover-btn hover-bx2"></span>
                                <span class="hover-btn hover-bx3"></span>
                                <span class="hover-btn hover-bx4"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--End Cta One -->
@endsection

@section('script')
@endsection