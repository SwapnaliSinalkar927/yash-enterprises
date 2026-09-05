@extends('web.main')

@section('title', 'Contact Us')

@section('style')
@endsection

@section('content')
<!--Start Page Header-->
        <section class="page-header">
            <div class="page-header__bg" style="background-image: url(assets/images/backgrounds/page-header-bg.jpg)">
            </div>
            <div class="shape1 float-bob-x"><img src="assets/images/shapes/main-slider-v4-shape1.png" alt="">
            </div>
            <div class="container">
                <div class="page-header__inner">
                    <h2 class="wow fadeInDown" data-wow-duration="1500ms">Contact 02</h2>
                    <ul class="thm-breadcrumb wow fadeInUp" data-wow-duration="1500ms">
                        <li><a href="{{ route('index') }}">Home</a></li>
                        <li><span class="icon-right-arrow1"></span></li>
                        <li>Contact 02</li>
                    </ul>
                </div>
            </div>
        </section>
        <!--End Page Header-->

        <!--Start Contact Page-->
        <section class="contact-page contact-page--two">
            <div class="container">
                <div class="row">
                    <!--Start Contact Page Content-->
                    <div class="col-xl-6">
                        <div class="contact-page--two__content">
                            <div class="sec-title sec-title-animation animation-style2">
                                <div class="sec-title__tagline">
                                    <div class="icon-box">
                                        <span class="icon-household"></span>
                                    </div>
                                    <div class="text title-animation">
                                        <h4>Contact US</h4>
                                    </div>
                                </div>
                                <h2 class="sec-title__title title-animation">Professional Cleaning,
                                    We’re Here to Help</h2>
                            </div>

                            <div class="contact-page--two__content-text1">
                                <p>Looking for reliable and professional cleaning services? Our team is ready to help with solutions tailored to your needs. Get in touch with us today to discuss your requirements and discover how we can make your home or business cleaner, healthier, and more welcoming.</p>
                            </div>

                            <div class="social-links">
                                <a href="#"><span class="icon-instagram"></span></a>
                            </div>
                        </div>
                    </div>
                    <!--End Contact Page Content-->

                    <!--Start Contact Page Form-->
                    <div class="col-xl-6">
                        <div class="contact-page__form-box">
                            <form class="contact-form-validated contact-page__form" action="https://templateholy.mnsithub.com/html/cleanin/main-html/assets/inc/sendemail.php"
                                method="post" novalidate="novalidate">
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
                                            <div class="icon"><span class="icon-phone-call"></span></div>
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
                                            <div class="icon style2"><span class="icon-pen"></span></div>
                                        </div>
                                    </div>

                                    <div class="col-xl-12">
                                        <div class="contact-page__form-btn">
                                            <button type="submit" class="thm-btn">
                                                Submit Now
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
                    <!--End Contact Page Form-->
                </div>

                <!--Start Contact Page Bottom-->
                <div class="contact-page__bottom">
                    <div class="container">
                        <div class="contact-page__bottom-inner">
                            <ul class="list-unstyled">
                                <li class="contact-page__bottom-single">
                                    <div class="icon">
                                        <span class="icon-placeholder"></span>
                                    </div>
                                    <div class="content">
                                        <h2>Location</h2>
                                        <p>Ranubaimala, <br>Chakan - 410501</p>
                                    </div>
                                </li>

                                <li class="contact-page__bottom-single">
                                    <div class="icon">
                                        <span class="icon-stop-watch"></span>
                                    </div>
                                    <div class="content">
                                        <h2>Working Hours</h2>
                                        <p>Monday - Sunday <br> 7:00 AM - 5:00 PM</p>
                                    </div>
                                </li>

                                <li class="contact-page__bottom-single">
                                    <div class="icon">
                                        <span class="icon-mail"></span>
                                    </div>
                                    <div class="content">
                                        <h2>Email</h2>
                                        <p>
                                            <a href="mailto:yashenterprises5556@gmail.com">yashenterprises5556@gmail.com</a>
                                        </p>
                                    </div>
                                </li>

                                <li class="contact-page__bottom-single">
                                    <div class="icon">
                                        <span class="icon-phone-call"></span>
                                    </div>
                                    <div class="content">
                                        <h2>Phones</h2>
                                        <p>
                                            <a href="tel:9922756972">+91 992 275 6972</a>
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--End Contact Page Bottom-->
            </div>
        </section>
        <!--End Contact Page-->

        <!--Start Google Map Two-->
        <section class="google-map-two">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d6209.242755903148!2d-77.04363602434464!3d38.90977276948481!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sus!4v1394992895496"
                class="google-map-two__map">
            </iframe>
        </section>
        <!--End Google Map Two-->
@endsection

@section('script')
@endsection