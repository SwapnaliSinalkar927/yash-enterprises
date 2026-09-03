@extends('web.main')

@section('title', 'Home')

@section('style')
@endsection

@section('content')
<!--Start Main Slider One-->
        <section class="main-slider-one">
            <div class="main-slider__carousel owl-carousel owl-theme">
                <!--Start Main Slider One Single-->
                <div class="main-slider-one__single">
                    <div class="main-slider-one__bg"
                        style="background-image: url({{ asset('images/slider/slider-v1-img1.jpg') }});"></div>
                    <div class="container">
                        <div class="main-slider-one__content">
                            <div class="tagline">
                                <span>Welcome to Yash Enterprises</span>
                            </div>
                            <div class="title-box">
                                <h2>Professional Cleaning <br> Services</h2>
                            </div>
                            <div class="text-box">
                                <p>Reliable and affordable cleaning solutions for offices, <br> homes & commercial spaces.</p>
                            </div>

                            <div class="main-slider-one__btn">
                                <a class="thm-btn" href="contact-1.html">Take Our Service
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
                <!--End Main Slider One Single-->

                <!--Start Main Slider One Single-->
                <div class="main-slider-one__single">
                    <div class="main-slider-one__bg"
                        style="background-image: url({{ asset('images/slider/slider-v1-img2.jpg') }});"></div>
                    <div class="container">
                        <div class="main-slider-one__content">
                            <div class="tagline">
                                <span>Welcome to Yash Enterprises</span>
                            </div>
                            <div class="title-box">
                                <h2>We Make Clean <br> Look Easy</h2>
                            </div>
                            <div class="text-box">
                                <p>Complete cleaning solutions tailored <br> to your needs.</p>
                            </div>
                            <div class="main-slider-one__btn">
                                <a class="thm-btn" href="contact-1.html">Take Our Service
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
                <!--End Main Slider One Single-->

                <!--Start Main Slider One Single-->
                <div class="main-slider-one__single">
                    <div class="main-slider-one__bg"
                        style="background-image: url({{ asset('images/slider/slider-v1-img3.jpg') }});"></div>
                    <div class="container">
                        <div class="main-slider-one__content">
                            <div class="tagline">
                                <span>Welcome to Yash Enterprises</span>
                            </div>
                            <div class="title-box">
                                <h2>Your Space,<br> Our Responsibility</h2>
                            </div>
                            <div class="text-box">
                                <p>Professional Cleaning Services <br> You Can Trust</p>
                            </div>
                            <div class="main-slider-one__btn">
                                <a class="thm-btn" href="contact-1.html">Take Our Service
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
                <!--End Main Slider One Single-->
            </div>

            <div class="bubbleContainer">
                <div class="bubble-1"></div>
                <div class="bubble-2"></div>
                <div class="bubble-3"></div>
                <div class="bubble-4"></div>
                <div class="bubble-5"></div>
                <div class="bubble-6"></div>
                <div class="bubble-7"></div>
                <div class="bubble-8"></div>
                <div class="bubble-9"></div>
                <div class="bubble-10"></div>
                <div class="bubble-11"></div>
                <div class="bubble-12"></div>
                <div class="bubble-13"></div>
                <div class="bubble-14"></div>
                <div class="bubble-15"></div>
            </div>
        </section>
        <!--End Main Slider One-->

        <!--Start About One-->
        <section class="about-one">
            <div class="shape1"><img src="{{ asset('images/shapes/about-v1-shape1.png') }}" alt=""></div>
            <div class="container">
                <div class="row">
                    <!--Start About One Img-->
                    <div class="col-xl-6 wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <div class="about-one__img">
                            <div class="about-one__video">
                                <a href="https://www.youtube.com/watch?v=06dV9txztKY" class="video-popup">
                                    <div class="about-one__video-icon">
                                        <span class="icon-play-button-arrowhead"></span>
                                        <i class="ripple"></i>
                                    </div>
                                </a>
                            </div>

                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <div class="about-one__img-left">
                                        <div class="single-img">
                                            <img src="{{ asset('images/about/about-v1-img1.jpg') }}" alt="#">
                                        </div>
                                        <div class="single-img">
                                            <img src="{{ asset('images/about/about-v1-img2.jpg') }}" alt="#">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <div class="about-one__img-right">
                                        <div class="about-one__experience">
                                            <div class="count-box">
                                                <h2 class="count-text" data-stop="30" data-speed="1500">00</h2>
                                                <span>+</span>
                                            </div>
                                            <p>Years Of Experience</p>
                                        </div>

                                        <div class="about-one__img-right-img">
                                            <img src="{{ asset('images/about/about-v1-img3.jpg') }}" alt="#">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End About One Img-->

                    <!--Start About One Content-->
                    <div class="col-xl-6 wow fadeInRight" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <div class="about-one__content">
                            <div class="sec-title sec-title-animation animation-style2">
                                <div class="sec-title__tagline">
                                    <div class="icon-box">
                                        <span class="icon-household"></span>
                                    </div>

                                    <div class="text title-animation">
                                        <h4>About Yash Enterprises</h4>
                                    </div>
                                </div>
                                <h2 class="sec-title__title title-animation">Where Cleanliness Meets Excellence
                                </h2>
                            </div>

                            <div class="about-one__content-text">
                                <p>We provide reliable and professional cleaning services
                                     designed to keep your spaces clean, fresh, and 
                                     comfortable.With a focus on reliability, professionalism, 
                                     and customer satisfaction, we make cleanliness simple and 
                                     hassle-free.</p>
                            </div>

                            <div class="about-one__content-list">
                                <ul>
                                    <li>
                                        <div class="icon-box">
                                            <span class="icon-window-cleaner"></span>
                                        </div>

                                        <div class="content-box">
                                            <h3>Weekly apartment service</h3>
                                            <p>Keep your apartment fresh, clean, and comfortable 
                                                with our reliable weekly cleaning service. Our 
                                                team takes care of dusting, mopping, surface 
                                                cleaning, and other essential areas to maintain a
                                                 spotless home every week.</p>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="icon-box">
                                            <span class="icon-cleaning"></span>
                                        </div>

                                        <div class="content-box">
                                            <h3>Common area maintenance </h3>
                                            <p>We keep shared spaces clean, hygienic, and 
                                                welcoming with regular common area maintenance. 
                                                From corridors and entrances to stairways and 
                                                shared facilities, our team ensures every area is
                                                 well-maintained and presentable.</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <div class="about-one__content-btn">
                                <a class="{{ asset('about-us') }}" href="about-1.html">Read More
                                    <i class="icon-next"></i>
                                    <span class="hover-btn hover-bx"></span>
                                    <span class="hover-btn hover-bx2"></span>
                                    <span class="hover-btn hover-bx3"></span>
                                    <span class="hover-btn hover-bx4"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!--End About One Content-->
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

                <div class="container">
                    <div class="row">
                    <!--Start Services Five Single-->
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="services-five__single">
                        <div class="services-five__single-img">
                            <div class="services-five__single-img-inner">
                            <img style="height:340px" src="{{ asset('images/services/serv1.webp') }}" alt="">
                            </div>
                            <div class="icon">
                            <span class="icon-bed"></span>
                            </div>
                        </div>
                        <div class="services-five__single-content text-center">
                            <h2><a href="house-cleaning.php">Weekly apartment service</a></h2>
                            <p>Full dusting, mopping, and bathroom scrub in <br>every flat. Same crew each week.</p>
                        </div>
                        </div>
                    </div>
                    <!--End Services Five Single-->

                    <!--Start Services Five Single-->
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="services-five__single">
                        <div class="services-five__single-img">
                            <div class="services-five__single-img-inner">
                            <img style="height:340px" src="{{ asset('images/services/serv2.webp') }}" alt="">
                            </div>
                            <div class="icon">
                            <span class="icon-window-cleaning"></span>
                            </div>
                        </div>
                        <div class="services-five__single-content text-center">
                            <h2><a href="house-cleaning.php">Common area maintenance</a></h2>
                            <p>Lobbies, staircases, and corridors cleaned on a set <br>schedule. No missed spots.</p>
                        </div>
                        </div>
                    </div>
                    <!--End Services Five Single-->

                    <!--Start Services Five Single-->
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="services-five__single">
                        <div class="services-five__single-img">
                            <div class="services-five__single-img-inner">
                            <img style="height:340px" src="{{ asset('images/services/serv3.webp') }}" alt="">
                            </div>
                            <div class="icon">
                            <span class="icon-house"></span>
                            </div>
                        </div>
                        <div class="services-five__single-content text-center">
                            <h2><a href="house-cleaning.php">Deep cleaning rounds</a></h2>
                            <p>Quarterly deep scrub for windows, grout, and <br>overlooked corners in every unit.</p>
                        </div>
                        </div>
                    </div>
                    <!--End Services Five Single-->

                    <!--Start Services Five Single-->
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="services-five__single">
                        <div class="services-five__single-img">
                            <div class="services-five__single-img-inner">
                            <img style="height:340px" src="{{ asset('images/services/serv4.webp') }}" alt="">
                            </div>
                            <div class="icon">
                            <span class="icon-window-cleaner"></span>
                            </div>
                        </div>
                        <div class="services-five__single-content text-center">
                            <h2><a href="house-cleaning.php">Garbage and recycling runs</a></h2>
                            <p>Daily waste collection from each floor. Segregated <br>disposal as per society rules.</p>
                        </div>
                        </div>
                    </div>
                    <!--End Services Five Single-->

                    <!--Start Services Five Single-->
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="services-five__single">
                        <div class="services-five__single-img">
                            <div class="services-five__single-img-inner">
                            <img style="height:340px" src="{{ asset('images/services/serv5.webp') }}" alt="">
                            </div>
                            <div class="icon">
                            <span class="icon-house-2"></span>
                            </div>
                        </div>
                        <div class="services-five__single-content text-center">
                            <h2><a href="house-cleaning.php">Parking and basement upkeep</a></h2>
                            <p>Sweeping, mopping, and removing debris from <br>parking areas and basement levels.</p>
                        </div>
                        </div>
                    </div>
                    <!--End Services Five Single-->

                    <!--Start Services Five Single-->
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="services-five__single">
                        <div class="services-five__single-img">
                            <div class="services-five__single-img-inner">
                            <img style="height:340px" src="{{ asset('images/services/serv6.webp') }}" alt="">
                            </div>
                            <div class="icon">
                            <span class="icon-car-wash"></span>
                            </div>
                        </div>
                        <div class="services-five__single-content text-center">
                            <h2><a href="house-cleaning.php">Custom society packages</a></h2>
                            <p>Tailored schedules and scope for each building. We <br>work with your committee</p>
                        </div>
                        </div>
                    </div>
                    <!--End Services Five Single-->
                    </div>
                </div>
              
            </div>
        </div>
        <!--End Services One-->

        <!--Start Project One-->
        <section class="project-one">
            <div class="project-one__top">
                <div class="container">
                    <div class="project-one__top-inner">
                        <div class="sec-title sec-title-animation animation-style2">
                            <div class="sec-title__tagline">
                                <div class="icon-box">
                                    <span class="icon-household"></span>
                                </div>

                                <div class="text title-animation">
                                    <h4>Our Successful Project</h4>
                                </div>
                            </div>
                            <h2 class="sec-title__title title-animation">Keep your vision to our latest <br> projects.
                            </h2>
                        </div>


                        <div class="project-one__top-btn">
                            <a class="thm-btn" href="project-1.html">View All Projects
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
            <div class="container-fluid">
                <div class="project-one__inner">
                    <div class="project-one__carousel owl-carousel owl-theme thm-dot-style1">
                        <!--Start Project One Single-->
                        <div class="project-one__single">
                            <div class="project-one__single-img">
                                <div class="inner">
                                    <img style="height:400px" src="{{ asset('images/project/proj1.webp') }}" alt="#">
                                </div>

                                <div class="project-one__single-content">
                                    <div class="text-box">
                                        <h2><a href="projects-details.html">Floor Cleaning</a></h2>
                                        <p>Los Angeles, USA</p>
                                    </div>

                                    <div class="icon-box">
                                        <a class="img-popup" href="{{ asset('images/project/project-v1-img1.jpg') }}"><span
                                                class="icon-plus"></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End Project One Single-->

                        <!--Start Project One Single-->
                        <div class="project-one__single">
                            <div class="project-one__single-img">
                                <div class="inner">
                                    <img style="height:400px" src="{{ asset('images/project/proj2.webp') }}" alt="#">
                                </div>

                                <div class="project-one__single-content">
                                    <div class="text-box">
                                        <h2><a href="projects-details.html">Office Cleaning</a></h2>
                                        <p>Los Angeles, USA</p>
                                    </div>

                                    <div class="icon-box">
                                        <a class="img-popup" href="{{ asset('images/project/project-v1-img2.jpg') }}"><span
                                                class="icon-plus"></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End Project One Single-->

                        <!--Start Project One Single-->
                        <div class="project-one__single">
                            <div class="project-one__single-img">
                                <div class="inner">
                                    <img style="height:400px" src="{{ asset('images/project/proj3.webp') }}" alt="#">
                                </div>

                                <div class="project-one__single-content">
                                    <div class="text-box">
                                        <h2><a href="projects-details.html">Kitchen Cleaning</a></h2>
                                        <p>Los Angeles, USA</p>
                                    </div>

                                    <div class="icon-box">
                                        <a class="img-popup" href="{{ asset('images/project/project-v1-img3.jpg') }}"><span
                                                class="icon-plus"></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End Project One Single-->

                        <!--Start Project One Single-->
                        <div class="project-one__single">
                            <div class="project-one__single-img">
                                <div class="inner">
                                    <img style="height:400px" src="{{ asset('images/project/proj4.webp') }}" alt="#">
                                </div>

                                <div class="project-one__single-content">
                                    <div class="text-box">
                                        <h2><a href="projects-details.html">House Cleaning</a></h2>
                                        <p>Los Angeles, USA</p>
                                    </div>

                                    <div class="icon-box">
                                        <a class="img-popup" href="{{ asset('images/project/project-v1-img4.jpg') }}"><span
                                                class="icon-plus"></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End Project One Single-->

                        <!--Start Project One Single-->
                        <div class="project-one__single">
                            <div class="project-one__single-img">
                                <div class="inner">
                                    <img style="height:400px" src="{{ asset('images/project/proj5.webp') }}" alt="#">
                                </div>

                                <div class="project-one__single-content">
                                    <div class="text-box">
                                        <h2><a href="projects-details.html">Window Cleaning</a></h2>
                                        <p>Los Angeles, USA</p>
                                    </div>

                                    <div class="icon-box">
                                        <a class="img-popup" href="{{ asset('images/project/project-v1-img5.jpg') }}"><span
                                                class="icon-plus"></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End Project One Single-->

                        <!--Start Project One Single-->
                        <div class="project-one__single">
                            <div class="project-one__single-img">
                                <div class="inner">
                                    <img style="height:400px" src="{{ asset('images/project/proj6.webp') }}" alt="#">
                                </div>

                                <div class="project-one__single-content">
                                    <div class="text-box">
                                        <h2><a href="projects-details.html">Floor Cleaning</a></h2>
                                        <p>Los Angeles, USA</p>
                                    </div>

                                    <div class="icon-box">
                                        <a class="img-popup" href="{{ asset('images/project/project-v1-img1.jpg') }}"><span
                                                class="icon-plus"></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End Project One Single-->

                        <!--Start Project One Single-->
                        <div class="project-one__single">
                            <div class="project-one__single-img">
                                <div class="inner">
                                    <img style="height:400px" src="{{ asset('images/project/proj7.webp') }}" alt="#">
                                </div>

                                <div class="project-one__single-content">
                                    <div class="text-box">
                                        <h2><a href="projects-details.html">Office Cleaning</a></h2>
                                        <p>Los Angeles, USA</p>
                                    </div>

                                    <div class="icon-box">
                                        <a class="img-popup" href="{{ asset('images/project/project-v1-img2.jpg') }}"><span
                                                class="icon-plus"></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End Project One Single-->

                        <!--Start Project One Single-->
                        <div class="project-one__single">
                            <div class="project-one__single-img">
                                <div class="inner">
                                    <img style="height:400px" src="{{ asset('images/project/proj8.webp') }}" alt="#">
                                </div>

                                <div class="project-one__single-content">
                                    <div class="text-box">
                                        <h2><a href="projects-details.html">Kitchen Cleaning</a></h2>
                                        <p>Los Angeles, USA</p>
                                    </div>

                                    <div class="icon-box">
                                        <a class="img-popup" href="{{ asset('images/project/project-v1-img3.jpg') }}"><span
                                                class="icon-plus"></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End Project One Single-->
                    </div>
                </div>
            </div>
        </section>
        <!--End Project One-->

        <!--Start Video One-->
        <section class="video-one">
            <div class="shape1 float-bob-x"><img src="{{ asset('images/shapes/video-v1-shape1.png') }}" alt=""></div>
            <div class="shape2 float-bob-x"><img src="{{ asset('images/shapes/video-v1-shape2.png') }}" alt=""></div>
            <div class="container">
                <div class="video-one__inner">
                    <div class="video-one__bg jarallax" data-jarallax data-speed="0.2" data-imgPosition="50% 0%"
                        style="background-image: url({{ asset('images/backgrounds/video-v1-bg.jpg') }});"></div>
                    <div class="video-one__inner-box">
                        <div class="video-one__box">
                            <a href="https://www.youtube.com/watch?v=06dV9txztKY" class="video-popup">
                                <div class="video-one__icon">
                                    <span class="icon-play-button-arrowhead"></span>
                                    <i class="ripple"></i>
                                </div>
                            </a>
                            <span class="border-animation border-1"></span>
                            <span class="border-animation border-2"></span>
                            <span class="border-animation border-3"></span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--End Video One-->

        <!--Start Counter One-->
        <section class="counter-one">
            <div class="container">
                <div class="row">
                    <!--Start Counter One Single-->
                    <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInLeft" data-wow-delay="0ms"
                        data-wow-duration="1500ms">
                        <div class="counter-one__single">
                            <div class="counter-one__single-inner">
                                <div class="counter-one__single-icon">
                                    <span class="icon-trophy"></span>
                                </div>

                                <div class="counter-one__single-content">
                                    <div class="count-box">
                                        <h2 class="count-text" data-stop="3" data-speed="3">3</h2>
                                        <span class="plus">+</span>
                                    </div>
                                    <p>Buildings serviced</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End Counter One Single-->

                    <!--Start Counter One Single-->
                    <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInRight" data-wow-delay="0ms"
                        data-wow-duration="1500ms">
                        <div class="counter-one__single">
                            <div class="counter-one__single-inner">
                                <div class="counter-one__single-icon">
                                    <span class="icon-verification"></span>
                                </div>

                                <div class="counter-one__single-content">
                                    <div class="count-box">
                                        <h2 class="count-text" data-stop="4" data-speed="4">4</h2>
                                    </div>
                                    <p>Person running it

</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End Counter One Single-->

                    <!--Start Counter One Single-->
                    <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInLeft" data-wow-delay="0ms"
                        data-wow-duration="1500ms">
                        <div class="counter-one__single">
                            <div class="counter-one__single-inner">
                                <div class="counter-one__single-icon">
                                    <span class="icon-customer-review"></span>
                                </div>

                                <div class="counter-one__single-content">
                                    <div class="count-box">
                                        <h2 class="count-text" data-stop="3.5" data-speed="3.5">3.5</h2>
                                        <span class="plus">+</span>
                                    </div>
                                    <p>Years in Chakan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End Counter One Single-->

                    <!--Start Counter One Single-->
                    <div class="col-xl-3 col-lg-6 col-md-6  wow fadeInRight" data-wow-delay="0ms"
                        data-wow-duration="1500ms">
                        <div class="counter-one__single">
                            <div class="counter-one__single-inner">
                                <div class="counter-one__single-icon">
                                    <span class="icon-project-plan"></span>
                                </div>

                                <div class="counter-one__single-content">
                                    <div class="count-box">
                                        <h2 class="count-text" data-stop="100" data-speed="100"></h2>
                                        <span class="plus">%</span>
                                    </div>
                                    <p>On-time arrival</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End Counter One Single-->
                </div>
            </div>
        </section>
        <!--End Counter One-->

        <!--Start Team One-->
        <!-- <section class="team-one">
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
                   
                </div>
            </div>
        </section> -->
        <!--End Team One-->

        <!--Start Contact One -->
        <section class="contact-one">
            <div class="contact-one__bg jarallax" data-jarallax data-speed="0.2" data-imgPosition="50% 0%"
                style="background-image: url({{ asset('images/backgrounds/contact-v1-bg.jpg') }});">
            </div>
            <div class="container">
                <div class="sec-title text-center sec-title-animation animation-style1">
                    <div class="sec-title__tagline center">
                        <div class="icon-box">
                            <span class="icon-household"></span>
                        </div>

                        <div class="text title-animation">
                            <h4> Contact Us</h4>
                        </div>
                    </div>
                    <h2 class="sec-title__title title-animation">Feel free to contact with us for <br> any kind of
                        query.</h2>
                </div>

                <div class="contact-one__inner">
                    <div class="row">
                        <!--Start Contact One Form-->
                        <div class="col-xl-8 col-lg-8">
                            <div class="contact-one__form">
                                <form class="contact-form-validated contact-one__form-box"
                                    action="https://templateholy.mnsithub.com/html/cleanin/main-html/assets/inc/sendemail.php" method="post" novalidate="novalidate">
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-6 col-md-6">
                                            <div class="input-box">
                                                <input type="text" name="name" placeholder="Name" required="">
                                                <div class="icon"><span class="icon-people"></span></div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6">
                                            <div class="input-box">
                                                <input type="email" name="email" placeholder="Email" required="">
                                                <div class="icon"><span class="icon-envelope"></span></div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6">
                                            <div class="input-box">
                                                <input type="text" name="Phone" placeholder="Phone" required="">
                                                <div class="icon"><span class="icon-call"></span></div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6">
                                            <div class="input-box">
                                                <div class="select-box">
                                                    <select class="selectmenu wide">
                                                        <option selected="selected">Subject</option>
                                                        <option>Subject 01</option>
                                                        <option>Subject 02</option>
                                                        <option>Subject 03</option>
                                                        <option>Subject 04</option>
                                                        <option>Subject 05</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-12">
                                            <div class="input-box">
                                                <textarea name="message" placeholder="Message"></textarea>
                                                <div class="icon style2"><span class="fa fa-pencil"></span></div>
                                            </div>
                                        </div>

                                        <div class="col-xl-12">
                                            <div class="contact-page__form-btn">
                                                <button type="submit" class="thm-btn">
                                                    Send us message
                                                    <i class="icon-next"></i>
                                                    <span class="hover-btn hover-bx"></span>
                                                    <span class="hover-btn hover-bx2"></span>
                                                    <span class="hover-btn hover-bx3"></span>
                                                    <span class="hover-btn hover-bx4"></span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="result"></div>
                            </div>
                        </div>
                        <!--End Contact One Form-->

                        <!--Start Contact One Contact Info -->
                        <div class="col-xl-4 col-lg-4">
                            <div class="contact-one__contact-info">
                                <div class="title-box">
                                    <h2>Contact Info</h2>
                                </div>

                                <ul class="contact-one__contact-info-list">
                                    <li class="contact-one__contact-info-list-item">
                                        <div class="icon-box">
                                            <span class="icon-placeholder"></span>
                                        </div>

                                        <div class="text-box">
                                            <p>3060 Commercial Street Road <br>
                                                Fratton, Australia</p>
                                        </div>
                                    </li>

                                    <li class="contact-one__contact-info-list-item">
                                        <div class="icon-box">
                                            <span class="icon-phone-call"></span>
                                        </div>

                                        <div class="text-box">
                                            <p><a href="tel:1234567890">+817 895 74555</a></p>
                                            <p><a href="tel:1234567890">+817 895 74555</a></p>
                                        </div>
                                    </li>

                                    <li class="contact-one__contact-info-list-item">
                                        <div class="icon-box">
                                            <span class="icon-mail"></span>
                                        </div>

                                        <div class="text-box">
                                            <p><a href="mailto:yourmail@email.com">help24/7@cleanin.com</a></p>
                                            <p><a href="mailto:yourmail@email.com">help24/7@cleanin.com</a></p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!--End Contact One Contact Info -->
                    </div>
                </div>
            </div>
        </section>
        <!--End Contact One -->

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
                            <h4>Our Customer’s Feedback</h4>
                        </div>
                    </div>
                    <h2 class="sec-title__title title-animation">Over 850+ shifts completed and counting</h2>
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
                                    <h2>Rajesh Patil</h2>
                                    <h6 style="font-weight:600;margin-bottom:20px">Chairman, Green Valley Society</h6>
                                    <p>Team handles our society's common area cleaning. Never had to follow up. The lobby looks good every morning.</p>

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
                                    <h2>Kavita Shinde</h2>
                                    <h6 style="font-weight:600;margin-bottom:20px">Operations Manager, Apex Industries</h6>
                                    <p>We run a busy packaging unit. Yash sends the same crew every shift, and they know the floor without being told.</p>

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
                                    <h2>Sandeep Jadhav</h2>
                                    <h6 style="font-weight:600;margin-bottom:20px">Partner, Jadhav & Associates</h6>
                                    <p>Called for a deep clean of our office. Yash was on site the same day, quoted a fair price, and finished ahead of schedule.</p>

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
        <section class="brand-one">
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