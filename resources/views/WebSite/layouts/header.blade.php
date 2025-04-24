<div class="nav-outer clearfix">
    <!--Mobile Navigation Toggler For Mobile--><div class="mobile-nav-toggler"><span class="icon flaticon-menu"></span></div>
    <nav class="main-menu navbar-expand-md navbar-light">
        <div class="navbar-header">
            <!-- Togg le Button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="icon flaticon-menu"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse clearfix" id="navbarSupportedContent">
            <ul class="navigation clearfix">
                <li class="current dropdown"><a href="#">{{ trans('WebSite/Website.home') }}</a>

                </li>


                <li class="dropdown"><a href="#">{{ LaravelLocalization::getCurrentLocaleNative() }}</a>
                    <ul>
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <li>
                                <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                    {{ $properties['native'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            </ul>
        </div>

    </nav>
    <!-- Main Menu End-->

    <!-- Main Menu End-->
    <div class="outer-box clearfix">
        <!-- Main Menu End-->


        <!-- Social Box -->
        <ul class="social-box clearfix">
            <li><a href="{{ $settings->facebook }}" target="_blank"><span class="fab fa-facebook-f"></span></a></li>
                                    <li><a href="{{ $settings->gmail }}" target="_blank"><span class="fab fa-google"></span></a></li>
                                    <li><a href="{{ $settings->twitter }}" target="_blank"><span class="fab fa-twitter"></span></a></li>
                                    <li><a href="{{ $settings->skype }}" target="_blank"><span class="fab fa-skype"></span></a></li>
                                    <li><a href="{{ $settings->linkedin }}" target="_blank"><span class="fab fa-linkedin"></span></a></li>
            @if(auth('admins')->check())
            <li><a title="الدخول إلى لوحة التحكم" href="{{ route('dashboard.admin') }}"><span class="fas fa-tachometer-alt"></span></a></li>
            @elseif(auth('ray_employees')->check())
            <li><a title="الدخول إلى لوحة التحكم" href="{{ route('dashboard.ray_employees') }}"><span class="fas fa-tachometer-alt"></span></a></li>
            @elseif(auth('laboratory_employees')->check())
            <li><a title="الدخول إلى لوحة التحكم" href="{{ route('dashboard.laboratory_employee') }}"><span class="fas fa-tachometer-alt"></span></a></li>
            @elseif(auth('patients')->check())
            <li><a title="الدخول إلى لوحة التحكم" href="{{ route('dashboard.patients') }}"><span class="fas fa-tachometer-alt"></span></a></li>
            @elseif(auth('doctors')->check())
            <li><a title="الدخول إلى لوحة التحكم" href="{{ route('dashboard.doctor') }}"><span class="fas fa-tachometer-alt"></span></a></li>
            @else
            <li><a title="تسجيل دخول" href="{{ route('dashboard.patients') }}"><span class="fas fa-user"></span></a></li>
            @endif

        </ul>



    </div>
</div>
