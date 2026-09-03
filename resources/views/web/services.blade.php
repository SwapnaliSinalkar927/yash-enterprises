@extends('web.main')

@section('title', 'Services')

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
                    <h2 class="wow fadeInDown" data-wow-duration="1500ms">Services</h2>
                    <ul class="thm-breadcrumb wow fadeInUp" data-wow-duration="1500ms">
                        <li><a href="index.html">Home</a></li>
                        <li><span class="icon-right-arrow1"></span></li>
                        <li>Services</li>
                    </ul>
                </div>
            </div>
        </section>
        <!--End Page Header-->

        <!--Start Services One-->
        <div class="services-one services-one--services">
            <div class="container">
                <div class="row">
                    <!--Start Services One Single-->
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="services-one__single">
                            <div class="services-one__single-inner text-center">
                                <div class="services-one__single-icon">
                                    <span class="icon-house-2"></span>
                                </div>
                                <h2><a href="house-cleaning.html">House Cleaning</a></h2>
                                <p>It is a long established fact that a reader will be distracted by the readable
                                    content of a page when looking at its layout.</p>

                                <div class="services-one__single-btn">
                                    <a href="house-cleaning.html">Read more <span class="icon-plus"></span></a>
                                </div>
                            </div>

                            <div class="shadow-one"></div>
                            <div class="shadow-two"></div>
                        </div>
                    </div>
                    <!--End Services One Single-->

                    <!--Start Services One Single-->
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="services-one__single">
                            <div class="services-one__single-inner text-center">
                                <div class="services-one__single-icon">
                                    <span class="icon-house"></span>
                                </div>
                                <h2><a href="house-cleaning.html">Office Cleaning</a></h2>
                                <p>It is a long established fact that a reader will be distracted by the readable
                                    content of a page when looking at its layout.</p>

                                <div class="services-one__single-btn">
                                    <a href="house-cleaning.html">Read more <span class="icon-plus"></span></a>
                                </div>
                            </div>

                            <div class="shadow-one"></div>
                            <div class="shadow-two"></div>
                        </div>
                    </div>
                    <!--End Services One Single-->

                    <!--Start Services One Single-->
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="services-one__single">
                            <div class="services-one__single-inner text-center">
                                <div class="services-one__single-icon">
                                    <span class="icon-window-cleaning"></span>
                                </div>
                                <h2><a href="house-cleaning.html">Window Cleaning</a></h2>
                                <p>It is a long established fact that a reader will be distracted by the readable
                                    content of a page when looking at its layout.</p>

                                <div class="services-one__single-btn">
                                    <a href="house-cleaning.html">Read more <span class="icon-plus"></span></a>
                                </div>
                            </div>

                            <div class="shadow-one"></div>
                            <div class="shadow-two"></div>
                        </div>
                    </div>
                    <!--End Services One Single-->

                    <!--Start Services One Single-->
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="services-one__single">
                            <div class="services-one__single-inner text-center">
                                <div class="services-one__single-icon">
                                    <span class="icon-carpet-1"></span>
                                </div>
                                <h2><a href="house-cleaning.html">Carpet Cleaning</a></h2>
                                <p>It is a long established fact that a reader will be distracted by the readable
                                    content of a page when looking at its layout.</p>

                                <div class="services-one__single-btn">
                                    <a href="house-cleaning.html">Read more <span class="icon-plus"></span></a>
                                </div>
                            </div>

                            <div class="shadow-one"></div>
                            <div class="shadow-two"></div>
                        </div>
                    </div>
                    <!--End Services One Single-->

                    <!--Start Services One Single-->
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="services-one__single">
                            <div class="services-one__single-inner text-center">
                                <div class="services-one__single-icon">
                                    <span class="icon-vacuum-cleaner"></span>
                                </div>
                                <h2><a href="house-cleaning.html">Floor Cleaning</a></h2>
                                <p>It is a long established fact that a reader will be distracted by the readable
                                    content of a page when looking at its layout.</p>

                                <div class="services-one__single-btn">
                                    <a href="house-cleaning.html">Read more <span class="icon-plus"></span></a>
                                </div>
                            </div>

                            <div class="shadow-one"></div>
                            <div class="shadow-two"></div>
                        </div>
                    </div>
                    <!--End Services One Single-->

                    <!--Start Services One Single-->
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="services-one__single">
                            <div class="services-one__single-inner text-center">
                                <div class="services-one__single-icon">
                                    <span class="icon-toilet"></span>
                                </div>
                                <h2><a href="house-cleaning.html">Toilet Cleaning</a></h2>
                                <p>It is a long established fact that a reader will be distracted by the readable
                                    content of a page when looking at its layout.</p>

                                <div class="services-one__single-btn">
                                    <a href="house-cleaning.html">Read more <span class="icon-plus"></span></a>
                                </div>
                            </div>

                            <div class="shadow-one"></div>
                            <div class="shadow-two"></div>
                        </div>
                    </div>
                    <!--End Services One Single-->
                </div>
            </div>
        </div>
        <!--End Services One-->

        <!--Start Counter One-->
        <section class="counter-one counter-one--two">
            <div class="shape1 scale"><img src="{{ asset('images/shapes/counter-v2-shape1.png') }}" alt=""></div>
            <div class="shape2 float-bob-x"><img src="{{ asset('images/shapes/counter-v2-shape1.png') }}" alt=""></div>
            <div class="shape3 rotated-style2"><img src="{{ asset('images/shapes/counter-v2-shape1.png') }}" alt=""></div>
            <div class="shape4 float-bob-y"><img src="{{ asset('images/shapes/counter-v2-shape1.png') }}" alt=""></div>
            <div class="shape5 rotated-style2"><img src="{{ asset('images/shapes/counter-v2-shape1.png') }}" alt=""></div>
            <div class="shape6 float-bob-x"><img src="{{ asset('images/shapes/counter-v2-shape1.png') }}" alt=""></div>
            <div class="shape7 scale"><img src="{{ asset('images/shapes/counter-v2-shape1.png') }}" alt=""></div>
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
                                        <h2 class="count-text" data-stop="655" data-speed="1500">00</h2>
                                        <span class="k">k</span>
                                        <span class="plus">+</span>
                                    </div>
                                    <p>Awards Win</p>
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
                                        <h2 class="count-text" data-stop="415" data-speed="1500">00</h2>
                                        <span class="k">k</span>
                                    </div>
                                    <p>Completed Project</p>
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
                                        <h2 class="count-text" data-stop="898" data-speed="1500">00</h2>
                                        <span class="k">k</span>
                                        <span class="plus">+</span>
                                    </div>
                                    <p>Happy Clients</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End Counter One Single-->

                    <!--Start Counter One Single-->
                    <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInRight" data-wow-delay="0ms"
                        data-wow-duration="1500ms">
                        <div class="counter-one__single style2">
                            <div class="counter-one__single-inner">
                                <div class="counter-one__single-icon">
                                    <span class="icon-project-plan"></span>
                                </div>

                                <div class="counter-one__single-content">
                                    <div class="count-box">
                                        <h2 class="count-text" data-stop="558" data-speed="1500">00</h2>
                                        <span class="k">k</span>
                                        <span class="plus">+</span>
                                    </div>
                                    <p>Finish The Job</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End Counter One Single-->
                </div>
            </div>
        </section>
        <!--End Counter One-->

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