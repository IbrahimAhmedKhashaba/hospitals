<!-- main-sidebar -->
		<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
		<aside class="app-sidebar sidebar-scroll">
			<div class="main-sidebar-header active">
				<a class="desktop-logo logo-light active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('Dashboard/img/brand/logo.jpg')}}" class="main-logo w-100" alt="logo"></a>
				<a class="desktop-logo logo-dark active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('Dashboard/img/brand/logo.jpg')}}" class="main-logo dark-theme" alt="logo"></a>
				<a class="logo-icon mobile-logo icon-light active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('Dashboard/img/brand/logo.jpg')}}" class="logo-icon" alt="logo"></a>
				<a class="logo-icon mobile-logo icon-dark active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('Dashboard/img/brand/logo.jpg')}}" class="logo-icon dark-theme" alt="logo"></a>
			</div>
            @if(auth('web')->check())
            @include('Dashboard.layouts.main-sidebar.main-sidebar-admin')
            @elseif(auth('admins')->check())
            @include('Dashboard.layouts.main-sidebar.main-sidebar-admin')
            @elseif(auth('ray_employees')->check())
            @include('Dashboard.layouts.main-sidebar.main-sidebar-ray_employee')
            @elseif(auth('laboratory_employees')->check())
            @include('Dashboard.layouts.main-sidebar.main-sidebar-laboratory_employee')
            @elseif(auth('patients')->check())
            @include('Dashboard.layouts.main-sidebar.main-sidebar-patients')
            @else
            @include('Dashboard.layouts.main-sidebar.main-sidebar-doctor')
            @endif

</aside>
<!-- main-sidebar -->
