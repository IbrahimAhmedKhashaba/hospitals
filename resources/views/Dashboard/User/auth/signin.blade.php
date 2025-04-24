@extends('Dashboard.layouts.master2')
@section('css')

<style>
    .loginForm{display: none;}
</style>
<!-- Sidemenu-respoansive-tabs css -->
<link href="{{URL::asset('Dashboard/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css')}}" rel="stylesheet">
@endsection
@section('content')
		<div class="container-fluid">
			<div class="row no-gutter">
				<!-- The image half -->
				<div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex bg-primary-transparent">
					<div class="row wd-100p mx-auto text-center">
						<div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
							<img src="{{URL::asset('Dashboard/img/media/login.png')}}" class="my-auto ht-xl-80p wd-md-100p wd-xl-80p mx-auto" alt="logo">
						</div>
					</div>
				</div>
				<!-- The content half -->
				<div class="col-md-6 col-lg-6 col-xl-5 bg-white">
					<div class="login d-flex align-items-center py-2">
						<!-- Demo content-->
						<div class="container p-0">
							<div class="row">
								<div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
									<div class="card-sigin">
										<div class="mb-5 d-flex"> <a href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('Dashboard/img/brand/favicon.png')}}" class="sign-favicon ht-40" alt="logo"></a><h1 class="main-logo1 ml-1 mr-0 my-auto tx-28">Va<span>le</span>x</h1></div>
										<div class="card-sigin">
											<div class="main-signup-header">
												<h2>{{ trans('Dashboard/login_trans.Welcome') }}</h2>
                                                @if($errors->any())
                                                    @foreach($errors->all() as $error)
                                                        <div class="alert alert-danger text-center">{{  trans('Dashboard/auth.failed') }}</div>
                                                    @endforeach
                                                @endif
                                                <div class="form-group">
                                                    <label for="role">{{ trans('Dashboard/login_trans.Select_Enter') }}</label>
                                                    <select name="role" id="role" class="form-control">
                                                        <option disabled selected>{{ trans('Dashboard/login_trans.Choose_list') }}</option>
                                                        <option value="admin">{{ trans('Dashboard/login_trans.admin') }}</option>
                                                        <option value="doctor">{{ trans('Dashboard/login_trans.doctor') }}</option>
                                                        <option value="ray_employee">{{ trans('Dashboard/login_trans.ray_employee') }}</option>
                                                        <option value="laboratory_employee">{{ trans('Dashboard/login_trans.laboratory_employee') }}</option>
                                                        <option value="patient">{{ trans('Dashboard/login_trans.patient') }}</option>
                                                    </select>
                                                </div>

                                                {{-- form user --}}
												<div class="loginForm" id="user">
                                                    <h5 class="font-weight-semibold mb-4">{{ trans('Dashboard/login_trans.user') }}</h5>
												<form method="POST" action="{{ route('login.user') }}">
                                                    @csrf
                                                    <div class="form-group">
														<label>{{ trans('Dashboard/Tables/Table.email') }}</label> <input name="email" class="form-control" placeholder="{{ trans('Dashboard/login_trans.enter_email') }}" type="email">
													</div>
													<div class="form-group">
														<label>{{ trans('Dashboard/Tables/Table.password') }}</label> <input class="form-control" placeholder="{{ trans('Dashboard/login_trans.enter_password') }}" name="password" type="password">
													</div><button type="submit" class="btn btn-main-primary btn-block">{{ trans('Dashboard/Modals/Modal.confirm') }}</button>

												</form>
                                                </div>

                                                {{-- form admin --}}
												<div class="loginForm" id="admin">
                                                    <h5 class="font-weight-semibold mb-4">{{ trans('Dashboard/login_trans.admin') }}</h5>
												<form method="POST" action="{{ route('login.admin') }}">
                                                    @csrf
                                                    <div class="form-group">
														<label>{{ trans('Dashboard/Tables/Table.email') }}</label> <input name="email" class="form-control" placeholder="{{ trans('Dashboard/login_trans.enter_email') }}" type="email">
													</div>
													<div class="form-group">
														<label>{{ trans('Dashboard/Tables/Table.password') }}</label> <input class="form-control" placeholder="{{ trans('Dashboard/login_trans.enter_password') }}" name="password" type="password">
													</div><button type="submit" class="btn btn-main-primary btn-block">{{ trans('Dashboard/Modals/Modal.confirm') }}</button>

												</form>
                                                </div>

                                                {{-- form doctor --}}
												<div class="loginForm" id="doctor">
                                                    <h5 class="font-weight-semibold mb-4">{{ trans('Dashboard/login_trans.doctor') }}</h5>
												<form method="POST" action="{{ route('login.doctor') }}">
                                                    @csrf
                                                    <div class="form-group">
														<label>{{ trans('Dashboard/Tables/Table.email') }}</label> <input name="email" class="form-control" placeholder="{{ trans('Dashboard/login_trans.enter_email') }}" type="email">
													</div>
													<div class="form-group">
														<label>{{ trans('Dashboard/Tables/Table.password') }}</label> <input class="form-control" placeholder="{{ trans('Dashboard/login_trans.enter_password') }}" name="password" type="password">
													</div><button type="submit" class="btn btn-main-primary btn-block">{{ trans('Dashboard/Modals/Modal.confirm') }}</button>

												</form>
                                                </div>

                                                {{-- form ray_employee --}}
												<div class="loginForm" id="ray_employee">
                                                    <h5 class="font-weight-semibold mb-4">{{ trans('Dashboard/login_trans.ray_employee') }}</h5>
												<form method="POST" action="{{ route('login.ray_employee') }}">
                                                    @csrf
                                                    <div class="form-group">
														<label>{{ trans('Dashboard/Tables/Table.email') }}</label> <input name="email" class="form-control" placeholder="{{ trans('Dashboard/login_trans.enter_email') }}" type="email">
													</div>
													<div class="form-group">
														<label>{{ trans('Dashboard/Tables/Table.password') }}</label> <input class="form-control" placeholder="{{ trans('Dashboard/login_trans.enter_password') }}" name="password" type="password">
													</div><button type="submit" class="btn btn-main-primary btn-block">{{ trans('Dashboard/Modals/Modal.confirm') }}</button>

												</form>
                                                </div>

                                                {{-- form laboratory_employee --}}
												<div class="loginForm" id="laboratory_employee">
                                                    <h5 class="font-weight-semibold mb-4">{{ trans('Dashboard/login_trans.ray_employee') }}</h5>
												<form method="POST" action="{{ route('login.laboratory_employee') }}">
                                                    @csrf
                                                    <div class="form-group">
														<label>{{ trans('Dashboard/Tables/Table.email') }}</label> <input name="email" class="form-control" placeholder="{{ trans('Dashboard/login_trans.enter_email') }}" type="email">
													</div>
													<div class="form-group">
														<label>{{ trans('Dashboard/Tables/Table.password') }}</label> <input class="form-control" placeholder="{{ trans('Dashboard/login_trans.enter_password') }}" name="password" type="password">
													</div><button type="submit" class="btn btn-main-primary btn-block">{{ trans('Dashboard/Modals/Modal.confirm') }}</button>

												</form>
                                                </div>

                                                {{-- form patients --}}
												<div class="loginForm" id="patient">
                                                    <h5 class="font-weight-semibold mb-4">{{ trans('Dashboard/login_trans.patient') }}</h5>
												<form method="POST" action="{{ url('patients/login') }}">
                                                    @csrf

													<div class="form-group">
														<label>{{ trans('Dashboard/Tables/Table.email') }}</label> <input name="email" class="form-control" placeholder="{{ trans('Dashboard/login_trans.enter_email') }}" type="email">
													</div>
													<div class="form-group">
														<label>{{ trans('Dashboard/Tables/Table.password') }}</label> <input class="form-control" placeholder="{{ trans('Dashboard/login_trans.enter_password') }}" name="password" type="password">
													</div><button type="submit" class="btn btn-main-primary btn-block">{{ trans('Dashboard/Modals/Modal.confirm') }}</button>

												</form>
                                                </div>

											</div>
										</div>
									</div>
								</div>
							</div>
						</div><!-- End -->
					</div>
				</div><!-- End -->
			</div>
		</div>
@endsection
@section('js')
<script>
    $('#role').change(function(){
        var myId = $(this).val();
        console.log('myId', myId);
        $('.loginForm').each(function(){
            myId === $(this).attr('id') ? $(this).show() : $(this).hide()
        });
    });
</script>
@endsection
