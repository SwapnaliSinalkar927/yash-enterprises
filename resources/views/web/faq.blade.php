@extends('web.main')

@section('title', 'FAQ')

@section('style')
@endsection

@section('content')
<section class="page-header">
    <div class="page-header__bg" style="background-image: url({{ asset('images/backgrounds/page-header-bg.jpg') }})">
    </div>
    <div class="shape1 float-bob-x"><img src="{{ asset('images/shapes/main-slider-v4-shape1.png') }}" alt="">
    </div>
    <div class="container">
        <div class="page-header__inner">
            <h2 class="wow fadeInDown" data-wow-duration="1500ms">FAQ</h2>
            <ul class="thm-breadcrumb wow fadeInUp" data-wow-duration="1500ms">
                <li><a href="index.html">Home</a></li>
                <li><span class="icon-right-arrow1"></span></li>
                <li>FAQ</li>
            </ul>
        </div>
    </div>
</section>

<section class="faq-one faq-one--faq">
    <div class="container clearfix">
        <div class="row">
            <div class="col-xl-6">
                <div class="accrodion-grp faq-one-accrodion faq-one-accrodion-1" data-grp-name="faq-one-accrodion-1">
                    <div class="accrodion active">
                        <div class="accrodion-title">
                            <h4>Do you serve residential societies and industrial companies both?</h4>
                        </div>

                        <div class="accrodion-content" style="">
                            <div class="inner">
                                <p>Yes. We handle society common area cleaning and industrial shift cleanup. Same crew, same standards, different sites.</p>
                            </div>
                        </div>
                    </div>

                    <div class="accrodion">
                        <div class="accrodion-title">
                            <h4>How do I get a quote?</h4>
                        </div>

                        <div class="accrodion-content" style="display: none;">
                            <div class="inner">
                                <p>Call +91 9922756972 or email yashenterprises5556@gmail.com. We ask about the site size and scope, then give you a price. No back-and-forth.</p>
                            </div>
                        </div>
                    </div>

                    <div class="accrodion">
                        <div class="accrodion-title">
                            <h4>Can you handle last-minute requests?</h4>
                        </div>

                        <div class="accrodion-content" style="display: none;">
                            <div class="inner">
                                <p>We do. Call us and we'll tell you if we can fit it in. We keep our schedule flexible for urgent jobs.</p>
                            </div>
                        </div>
                    </div>

                    <div class="accrodion">
                        <div class="accrodion-title">
                            <h4>What areas do you cover?</h4>
                        </div>

                        <div class="accrodion-content" style="display: none;">
                            <div class="inner">
                                <p>We work across Chakan and nearby industrial areas in Maharashtra. If you're within reach, we'll come by.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6">
                <div class="accrodion-grp faq-one-accrodion faq-one-accrodion-1" data-grp-name="faq-one-accrodion-1">
                    <div class="accrodion">
                        <div class="accrodion-title">
                            <h4>How are your prices decided?</h4>
                        </div>

                        <div class="accrodion-content" style="display: none;">
                            <div class="inner">
                                <p>Based on the site size, how often you need service, and the scope of work. Simple flat rate, no hidden costs.</p>
                            </div>
                        </div>
                    </div>

                    <div class="accrodion">
                        <div class="accrodion-title">
                            <h4>Do you provide cleaning supplies and equipment?</h4>
                        </div>

                        <div class="accrodion-content" style="display: none;">
                            <div class="inner">
                                <p>Yes. We bring everything needed for the job — mops, buckets, machines, and cleaning agents. You just provide the space.</p>
                            </div>
                        </div>
                    </div>

                    <div class="accrodion">
                        <div class="accrodion-title">
                            <h4>Is labour supply included in your industrial services?</h4>
                        </div>

                        <div class="accrodion-content" style="display: none;">
                            <div class="inner">
                                <p>Yes. We provide trained labour for factories and warehouses — loading, packing, sorting, and general support.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
@endsection