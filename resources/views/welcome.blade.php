@extends('WebSite.layouts.master')

@section('content')
    <!-- Main Slider Three -->
    <section class="main-slider-three">
        <div class="banner-carousel">
            <!-- Swiper -->
            <div class="swiper-wrapper">

                <div class="swiper-slide slide">
                    <div class="auto-container">
                        <div class="row clearfix">

                            <!-- Content Column -->
                            <div class="content-column col-lg-6 col-md-12 col-sm-12">
                                <div class="inner-column">
                                    <h2>{{ trans('WebSite/Website.slider_title') }}</h2>
                                    <div class="text">{{ trans('WebSite/Website.slider_desc') }}
                                    </div>
                                    <div class="btn-box">
                                        <a href="#appointment" class="theme-btn appointment-btn"><span class="txt">{{ trans('WebSite/Website.appointment') }}</span></a>
                                        <a href="#sections" class="theme-btn services-btn">{{ trans('WebSite/Website.services') }}</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Image Column -->
                            <div class="image-column col-lg-6 col-md-12 col-sm-12">
                                <div class="inner-column">
                                    <div class="image">
                                        <img src="{{URL::asset('WebSite/images/main-slider/logo.png')}}" alt=""/>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

            </div>

        </div>
    </section>
    <!-- End Main Slider -->

    <!-- Health Section -->
    <section class="health-section">
        <div class="auto-container">
            <div class="inner-container">

                <div class="row clearfix">

                    <!-- Content Column -->
                    <div class="content-column col-lg-7 col-md-12 col-sm-12">
                        <div class="inner-column m-5">
                            <div class="border-line"></div>
                            <!-- Sec Title -->
                            <div class="sec-title">
                                <h2> {{ trans('WebSite/Website.section_two_title') }} <br>{{ trans('WebSite/Website.section_two_title2') }}</h2>
                                <div class="separator"></div>
                            </div>
                            <div class="text">{{ trans('WebSite/Website.section_two_desc') }}
                            </div>

                        </div>
                    </div>

                    <!-- Image Column -->
                    <div class="image-column col-lg-5 col-md-12 col-sm-12">
                        <div class="inner-column wow fadeInRight" data-wow-delay="0ms" data-wow-duration="1500ms">
                            <div class="image border border-primary round-4">
                                <img src="{{URL::asset('WebSite/images/main-slider/logo.png')}}" alt=""/>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
    <!-- End Health Section -->

    <!-- Featured Section -->
    <section class="featured-section">
        <div class="auto-container">
            <div class="row clearfix">

                <!-- Feature Block -->
                <div class="feature-block col-lg-3 col-md-6 col-sm-12">
                    <div class="inner-box wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <div class="upper-box">
                            <div class="icon flaticon-doctor-stethoscope"></div>
                            <h3><a href="#">{{ trans('WebSite/Website.section_three_title1') }}</a></h3>
                        </div>
                        <div class="text">{{ trans('WebSite/Website.section_three_desc1') }}</div>
                    </div>
                </div>

                <!-- Feature Block -->
                <div class="feature-block col-lg-3 col-md-6 col-sm-12">
                    <div class="inner-box wow fadeInLeft" data-wow-delay="250ms" data-wow-duration="1500ms">
                        <div class="upper-box">
                            <div class="icon flaticon-ambulance-side-view"></div>
                            <h3><a href="#">{{ trans('WebSite/Website.section_three_title2') }}</a></h3>
                        </div>
                        <div class="text">سو{{ trans('WebSite/Website.section_three_desc2') }}تك</div>
                    </div>
                </div>

                <!-- Feature Block -->
                <div class="feature-block col-lg-3 col-md-6 col-sm-12">
                    <div class="inner-box wow fadeInLeft" data-wow-delay="500ms" data-wow-duration="1500ms">
                        <div class="upper-box">
                            <div class="icon fas fa-user-md"></div>
                            <h3><a href="#">{{ trans('WebSite/Website.section_three_title3') }}</a></h3>
                        </div>
                        <div class="text">{{ trans('WebSite/Website.section_three_desc3') }}</div>
                    </div>
                </div>

                <!-- Feature Block -->
                <div class="feature-block col-lg-3 col-md-6 col-sm-12">
                    <div class="inner-box wow fadeInLeft" data-wow-delay="750ms" data-wow-duration="1500ms">
                        <div class="upper-box">
                            <div class="icon fas fa-briefcase-medical"></div>
                            <h3><a href="#">{{ trans('WebSite/Website.section_three_title4') }}</a></h3>
                        </div>
                        <div class="text">{{ trans('WebSite/Website.section_three_desc4') }}</div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- End Featured Section -->

    <!-- Department Section Three -->
    <section class="department-section-three" id="sections">
        <div class="image-layer" style="background-image:url(images/background/6.jpg)"></div>
        <div class="auto-container">
            <!-- Department Tabs-->
            <div class="department-tabs tabs-box">
                <div class="row clearfix">
                    <!--Column-->
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <!-- Sec Title -->
                        <div class="sec-title light">
                            <h2>{{ trans('WebSite/Website.sections') }}</h2>
                            <div class="separator"></div>
                        </div>
                        <!--Tab Btns-->
                        <ul class="tab-btns tab-buttons clearfix">
                            @foreach($sections as $section)
                            <li data-tab="#tab-{{ $section->id }}" class="tab-btn">{{ $section->name }}</li>

                            @endforeach
                        </ul>
                    </div>
                    <!--Column-->
                    <div class="col-lg-8 col-md-12 col-sm-12">
                        <!--Tabs Container-->
                        <div class="tabs-content">
                            @foreach($sections as $section)
                                <div class="tab" id="tab-{{ $section->id }}">
                                <div class="content">
                                    <h2>{{ $section->name }}</h2>
                                    <div class="title">{{ $section->name }}</div>
                                    <div class="text">
                                        <p>{{ $section->description }}</p>
                                    </div>


                                </div>
                            </div>
                            @endforeach



                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- End Department Section -->

    <!-- Team Section -->
    <section class="team-section">
        <div class="auto-container">

            <!-- Sec Title -->
            <div class="sec-title centered">
                <h2>{{ trans('WebSite/Website.section_five_title') }}</h2>
                <div class="separator"></div>
            </div>

            <div class="row clearfix">


                <!-- Team Block -->

                @for($i = 0; $i < 4; $i++)
                <div class="team-block col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="inner-box wow fadeInLeft" data-wow-delay="750ms" data-wow-duration="1500ms">

                        <div class="lower-content">
                            <h3><a href="#">{{ $doctors[$i]->name }}</a></h3>
                            <div class="designation">{{ $doctors[$i]->section->name }}</div>
                        </div>
                    </div>
                </div>
                @endfor

            </div>

        </div>
    </section>
    <!-- End Team Section -->

    <!-- Video Section -->
    <section class="video-section" style="background-image:url(images/background/5.jpg)">
        <div class="auto-container">
            <div class="content">
                <a href="https://www.youtube.com/watch?v=kxPCFljwJws" class="lightbox-image play-box"><span
                        class="flaticon-play-button"><i class="ripple"></i></span></a>
                <div class="text">{{ trans('WebSite/Website.section_six_title1') }}<h2>{{ trans('WebSite/Website.section_six_title2') }}</h2>
                </div>
            </div>
    </section>
    <!-- End Video Section -->

    <!-- Appointment Section Two -->
    <section class="appointment-section-two" id="appointment">
        <div class="auto-container">
            <div class="inner-container">
                <div class="row clearfix">

                    <!-- Image Column -->
                    <div class="image-column col-lg-6 col-md-12 col-sm-12">
                        <div class="inner-column wow slideInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                            <div class="image">
                                <img src="images/resource/doctor-2.png" alt=""/>
                            </div>
                        </div>
                    </div>

                    <!-- Form Column -->
                    <div class="form-column col-lg-6 col-md-12 col-sm-12">
                        <div class="inner-column">
                            <!-- Sec Title -->
                            <div class="sec-title">
                                <h2>{{ trans('WebSite/Website.book_appointment') }}</h2>
                                <div class="separator"></div>
                            </div>

                            <!-- Appointment Form -->
                            <div class="appointment-form">
                                <livewire:appointments.create/>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>


    <!-- Counter Section -->
    <section class="counter-section" style="background-image: url(images/background/pattern-3.png)">
        <div class="auto-container">

            <!-- Fact Counter -->
            <div class="fact-counter style-two">
                <div class="row clearfix">

                    <!--Column-->
                    <div class="column counter-column col-lg-4 col-md-6 col-sm-12">
                        <div class="inner wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                            <div class="content">
                                <div class="icon flaticon-logout"></div>
                                <div class="count-outer count-box">
                                    +<span class="count-text" data-speed="2500" data-stop="{{ $patients_count }}">0</span>
                                </div>
                                <h4 class="counter-title">{{ trans('WebSite/Website.last_section_1') }}</h4>
                            </div>
                        </div>
                    </div>

                    <!--Column-->
                    <div class="column counter-column col-lg-4 col-md-6 col-sm-12">
                        <div class="inner wow fadeInLeft" data-wow-delay="300ms" data-wow-duration="1500ms">
                            <div class="content">
                                <div class="icon flaticon-logout"></div>
                                <div class="count-outer count-box alternate">
                                    +<span class="count-text" data-speed="3000" data-stop="{{ $doctors_count }}">0</span>
                                </div>
                                <h4 class="counter-title">{{ trans('WebSite/Website.last_section_2') }}</h4>
                            </div>
                        </div>
                    </div>

                    <!--Column-->
                    <div class="column counter-column col-lg-4 col-md-6 col-sm-12">
                        <div class="inner wow fadeInLeft" data-wow-delay="600ms" data-wow-duration="1500ms">
                            <div class="content">
                                <div class="icon flaticon-logout"></div>
                                <div class="count-outer count-box">
                                    +<span class="count-text" data-speed="3000" data-stop="{{ $sections_count }}">0</span>
                                </div>
                                <h4 class="counter-title">{{ trans('WebSite/Website.last_section_3') }}</h4>
                            </div>
                        </div>
                    </div>



                </div>
            </div>

        </div>
    </section>
    <!-- End Counter Section -->


@endsection
