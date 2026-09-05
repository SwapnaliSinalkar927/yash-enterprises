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
                        <li><a href="{{ route('index') }}">Home</a></li>
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
                                <h2>Weekly apartment service</h2>
                                <p>Full dusting, mopping, and bathroom scrub in every flat. Same crew each week.</p>


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
                                <h2>Common area maintenance</h2>
                                <p>Lobbies, staircases, and corridors cleaned on a set schedule. No missed spots.</p>


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
                                <h2>Window Cleaning</h2>
                                <p>Quarterly deep scrub for windows, grout, and overlooked corners in every unit.</p>


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
                                <h2>Garbage and recycling runs</h2>
                                <p>Daily waste collection from each floor. Segregated disposal as per society rules.</p>


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
                                <h2>Parking and basement upkeep</h2>
                                <p>Sweeping, mopping, and removing debris from parking areas and basement levels.</p>


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
                                <h2>Custom society packages</h2>
                                <p>Tailored schedules and scope for each building. We work with your committee.</p>


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
                            <a class="thm-btn" href="{{ route('contact-us') }}">get free quote
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