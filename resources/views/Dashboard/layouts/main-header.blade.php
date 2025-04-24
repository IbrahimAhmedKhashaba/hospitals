<!-- main-header opened -->
			<div class="main-header sticky side-header nav nav-item">
				<div class="container-fluid">
					<div class="main-header-left ">
						<div class="responsive-logo">
							<a href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('Dashboard/img/brand/logo.png')}}" class="logo-1" alt="logo"></a>
							<a href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('Dashboard/img/brand/logo.png')}}" class="dark-logo-1" alt="logo"></a>
							<a href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('Dashboard/img/brand/logo.png')}}" class="logo-2" alt="logo"></a>
							<a href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('Dashboard/img/brand/logo.png')}}" class="dark-logo-2" alt="logo"></a>
						</div>
						<div class="app-sidebar__toggle" data-toggle="sidebar">
							<a class="open-toggle" href="#"><i class="header-icon fe fe-align-left" ></i></a>
							<a class="close-toggle" href="#"><i class="header-icons fe fe-x"></i></a>
						</div>

					</div>
					<div class="main-header-right">
                        <ul class="nav">
                            <li class="">
                                <div class="dropdown  nav-itemd-none d-md-flex">
                                    <a href="#" class="d-flex  nav-item nav-link pl-0 country-flag1" data-toggle="dropdown"
                                       aria-expanded="false">
                                        @if (App::getLocale() == 'ar')
                                            <span class="avatar country-Flag mr-0 align-self-center bg-transparent"><img
                                                    src="{{URL::asset('Dashboard/img/flags/egypt_flag.jpg')}}" alt="img"></span>
                                            <strong
                                                class="mr-2 ml-2 my-auto">{{ LaravelLocalization::getCurrentLocaleName() }}</strong>
                                        @else
                                            <span class="avatar country-Flag mr-0 align-self-center bg-transparent"><img
                                                    src="{{URL::asset('Dashboard/img/flags/us_flag.jpg')}}" alt="img"></span>
                                            <strong
                                                class="mr-2 ml-2 my-auto">{{ LaravelLocalization::getCurrentLocaleName() }}</strong>
                                        @endif
                                        <div class="my-auto">
                                        </div>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-left dropdown-menu-arrow" x-placement="bottom-end">
                                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                            <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}"
                                               href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                                @if($properties['native'] == "English")
                                                    <i class="flag-icon flag-icon-us"></i>
                                                @elseif($properties['native'] == "العربية")
                                                    <i class="flag-icon flag-icon-eg"></i>
                                                @endif
                                                {{ $properties['native'] }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </li>
                        </ul>
						<div class="nav nav-item  navbar-nav-right ml-auto">
							<div class="nav-link" id="bs-example-navbar-collapse-1">
								<form class="navbar-form" role="search">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Search">
										<span class="input-group-btn">
											<button type="reset" class="btn btn-default">
												<i class="fas fa-times"></i>
											</button>
											<button type="submit" class="btn btn-default nav-link resp-btn">
												<svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
											</button>
										</span>
									</div>
								</form>
							</div>

							@if(auth('admins')->check())
                            <div class="dropdown nav-item main-header-notification">
								<a class="new nav-link" href="#">
								<svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg><span id="notification_icon">@if(auth('admins')->user()->unreadNotifications->count() > 0) <span class=" pulse"></span> @endif</span></a>
								<div class="dropdown-menu">
									<div class="menu-header-content bg-primary text-right">
										<div class="d-flex">
											<h6 class="dropdown-title mb-1 tx-15 text-white font-weight-semibold">Notifications</h6>
                                            <a href="{{ route('markAsRead' , 'admins') }}"><span class="badge badge-pill badge-warning mr-auto my-auto float-left">Mark All Read</span></a>

										</div>
										<p class="dropdown-title-text subtext mb-0 text-white op-6 pb-0 tx-12 " id="notifications_count">You have {{ auth('admins')->user()->unreadNotifications->count() }} unread Notifications</p>
									</div>
									<div class="main-notification-list Notification-scroll" id="notifications_container">

										@foreach(auth('admins')->user()->unreadNotifications as $notification)
                                        <a class="d-flex p-3" href="#">
											<div class="notifyimg bg-purple">
												<i class="la la-gem text-white"></i>
											</div>
											<div class="mr-3">
												<h5 class="notification-label mb-1">{{ trans('Dashboard/Notifications.add_booking') }}</h5>
												<div class="notification-subtext">{{ $notification->created_at }}</div>
											</div>
											<div class="mr-auto" >
												<i class="las la-angle-left text-left text-muted"></i>
											</div>
										</a>
                                        @endforeach

									</div>

								</div>
							</div>
                            @elseif(auth('doctors')->check())
                            <div class="dropdown nav-item main-header-notification">
								<a class="new nav-link" href="#">
								<svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg><span id="notification_icon">@if(auth('doctors')->user()->unreadNotifications->count() > 0) <span class=" pulse"></span> @endif</span></a>
								<div class="dropdown-menu">
									<div class="menu-header-content bg-primary text-right">
										<div class="d-flex">
											<h6 class="dropdown-title mb-1 tx-15 text-white font-weight-semibold">Notifications</h6>
                                            <a href="{{ route('markAsRead' , 'doctors') }}"><span class="badge badge-pill badge-warning mr-auto my-auto float-left">Mark All Read</span></a>
										</div>
										<p class="dropdown-title-text subtext mb-0 text-white op-6 pb-0 tx-12 " id="notifications_count">You have {{ auth('doctors')->user()->unreadNotifications->count() }} unread Notifications</p>
									</div>
									<div class="main-notification-list Notification-scroll" id="notifications_container">

										@foreach(auth('doctors')->user()->unreadNotifications as $notification)
                                        <a class="d-flex p-3" href="{{ $notification->data['url'] }}">
											<div class="notifyimg bg-purple">
												<i class="la la-gem text-white"></i>
											</div>
											<div class="mr-3">
												<h5 class="notification-label mb-1">{{ $notification->data['title'] }}</h5>
												<div class="notification-subtext">{{ $notification->created_at }}</div>
											</div>
											<div class="mr-auto" >
												<i class="las la-angle-left text-left text-muted"></i>
											</div>
										</a>
                                        @endforeach

									</div>

								</div>
							</div>
                            @elseif(auth('ray_employees')->check())
                            <div class="dropdown nav-item main-header-notification">
								<a class="new nav-link" href="#">
								<svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg><span id="notification_icon">@if(auth('ray_employees')->user()->unreadNotifications->count() > 0) <span class=" pulse"></span> @endif</span></a>
								<div class="dropdown-menu">
									<div class="menu-header-content bg-primary text-right">
										<div class="d-flex">
											<h6 class="dropdown-title mb-1 tx-15 text-white font-weight-semibold">Notifications</h6>
                                            <a href="{{ route('markAsRead' , 'ray_employees') }}"><span class="badge badge-pill badge-warning mr-auto my-auto float-left">Mark All Read</span></a>
										</div>
										<p class="dropdown-title-text subtext mb-0 text-white op-6 pb-0 tx-12 " id="notifications_count">You have {{ auth('ray_employees')->user()->unreadNotifications->count() }} unread Notifications</p>
									</div>
									<div class="main-notification-list Notification-scroll" id="notifications_container">

										@foreach(auth('ray_employees')->user()->unreadNotifications as $notification)
                                        <a class="d-flex p-3" href="{{ $notification->data['url'] }}">
											<div class="notifyimg bg-purple">
												<i class="la la-gem text-white"></i>
											</div>
											<div class="mr-3">
												<h5 class="notification-label mb-1">{{ $notification->data['title'] }}</h5>
												<div class="notification-subtext">{{ $notification->created_at }}</div>
											</div>
											<div class="mr-auto" >
												<i class="las la-angle-left text-left text-muted"></i>
											</div>
										</a>
                                        @endforeach

									</div>

								</div>
							</div>
                            @elseif(auth('laboratory_employees')->check())
                            <div class="dropdown nav-item main-header-notification">
								<a class="new nav-link" href="#">
								<svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg><span id="notification_icon">@if(auth('laboratory_employees')->user()->unreadNotifications->count() > 0) <span class=" pulse"></span> @endif</span></a>
								<div class="dropdown-menu">
									<div class="menu-header-content bg-primary text-right">
										<div class="d-flex">
											<h6 class="dropdown-title mb-1 tx-15 text-white font-weight-semibold">Notifications</h6>
                                            <a href="{{ route('markAsRead' , 'laboratory_employees') }}"><span class="badge badge-pill badge-warning mr-auto my-auto float-left">Mark All Read</span></a>
										</div>
										<p class="dropdown-title-text subtext mb-0 text-white op-6 pb-0 tx-12 " id="notifications_count">You have {{ auth('laboratory_employees')->user()->unreadNotifications->count() }} unread Notifications</p>
									</div>
									<div class="main-notification-list Notification-scroll" id="notifications_container">

										@foreach(auth('laboratory_employees')->user()->unreadNotifications as $notification)
                                        <a class="d-flex p-3" href="{{ $notification->data['url'] }}">
											<div class="notifyimg bg-purple">
												<i class="la la-gem text-white"></i>
											</div>
											<div class="mr-3">
												<h5 class="notification-label mb-1">{{ $notification->data['title'] }}</h5>
												<div class="notification-subtext">{{ $notification->created_at }}</div>
											</div>
											<div class="mr-auto" >
												<i class="las la-angle-left text-left text-muted"></i>
											</div>
										</a>
                                        @endforeach

									</div>

								</div>
							</div>
                            @elseif(auth('patients')->check())
                            <div class="dropdown nav-item main-header-notification">
								<a class="new nav-link" href="#">
								<svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg><span id="notification_icon">@if(auth('patients')->user()->unreadNotifications->count() > 0) <span class=" pulse"></span> @endif</span></a>
								<div class="dropdown-menu">
									<div class="menu-header-content bg-primary text-right">
										<div class="d-flex">
											<h6 class="dropdown-title mb-1 tx-15 text-white font-weight-semibold">Notifications</h6>
                                            <a href="{{ route('markAsRead' , 'patients') }}"><span class="badge badge-pill badge-warning mr-auto my-auto float-left">Mark All Read</span></a>
										</div>
										<p class="dropdown-title-text subtext mb-0 text-white op-6 pb-0 tx-12 " id="notifications_count">You have {{ auth('patients')->user()->unreadNotifications->count() }} unread Notifications</p>
									</div>
									<div class="main-notification-list Notification-scroll" id="notifications_container">

										@foreach(auth('patients')->user()->unreadNotifications as $notification)
                                        <a class="d-flex p-3" href="{{ $notification->data['url'] }}">
											<div class="notifyimg bg-purple">
												<i class="la la-gem text-white"></i>
											</div>
											<div class="mr-3">
												<h5 class="notification-label mb-1">{{ $notification->data['title'] }}</h5>
												<div class="notification-subtext">{{ $notification->created_at }}</div>
											</div>
											<div class="mr-auto" >
												<i class="las la-angle-left text-left text-muted"></i>
											</div>
										</a>
                                        @endforeach

									</div>

								</div>
							</div>
                            @endif
							<div class="nav-item full-screen fullscreen-button">
								<a class="new nav-link full-screen-link" href="#"><svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-maximize"><path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"></path></svg></a>
							</div>
							<div class="dropdown main-profile-menu nav nav-item nav-link">
								<a class="profile-user d-flex" href=""><img alt="" src="{{URL::asset('Dashboard/img/faces/6.jpg')}}"></a>
								<div class="dropdown-menu">
									<div class="main-header-profile bg-primary p-3">
										<div class="d-flex wd-100p">
											<div class="main-img-user"><img alt="" src="{{URL::asset('Dashboard/img/faces/6.jpg')}}" class=""></div>
											<div class="mr-3 my-auto">
												<h6>{{ Cache::get('user_name') }}</h6><span>{{ Cache::get('user_email') }}</span>
											</div>
										</div>
									</div>


                                    @if(auth('web')->check())
                                        <form method="POST" action="{{ route('logout.user') }}">
                                    @elseif(auth('admins')->check())
                                    <form method="POST" action="{{ route('logout.admin') }}">
                                    @elseif(auth('ray_employees')->check())
                                    <form method="POST" action="{{ route('logout.ray_employee') }}">
                                    @elseif(auth('laboratory_employees')->check())
                                    <form method="POST" action="{{ route('logout.laboratory_employee') }}">
                                    @elseif(auth('patients')->check())
                                    <form method="POST" action="{{ route('logout.patients') }}">
                                    @else
                                    <form method="POST" action="{{ route('logout.doctor') }}">
                                    @endif
                                        @csrf
                                        <a class="dropdown-item" href="{{ route('logout.admin') }}"
                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();"><i class="bx bx-log-out"></i> Sign Out</a>
                                    </form>





								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
<!-- /main-header -->


<script>
    setInterval(function() {
        $('#notifications_count').load(window.location.href + ' #notifications_count');
        $('#notifications_container').load(window.location.href + ' #notifications_container');
        $('#notification_icon').load(window.location.href + ' #notification_icon');
    } , 5000)
</script>

