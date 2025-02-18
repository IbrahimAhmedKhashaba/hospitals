@extends('Dashboard.layouts.master')
@section('css')
<!--  Owl-carousel css-->
<link href="{{URL::asset('Dashboard/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet" />
<!-- Maps css -->
<link href="{{URL::asset('Dashboard/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="left-content">
						<div>
						  <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">{{trans('Dashboard/dashboard.dashboard')}}</h2>
                          <p class="mg-b-0">{{trans('Dashboard/dashboard.welcome')}} {{auth()->user()->name}}</p>
						</div>
					</div>
					<div class="main-dashboard-header-right">

						<div>
							<label class="tx-13">{{trans('Dashboard/dashboard.total_single_service')}}</label>
							<h5>{{ \App\Models\Service::count()}}</h5>
						</div>
						<div>
							<label class="tx-13">{{trans('Dashboard/dashboard.total_group_service')}}</label>
							<h5>{{ \App\Models\Group::count()}}</h5>
						</div>
					</div>
				</div>
				<!-- /breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row row-sm">
					<div class="col-xl-4 col-lg-4 col-md-4 col-xm-12">
						<div class="card overflow-hidden sales-card bg-primary-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">{{trans('Dashboard/dashboard.total_doctors')}}</h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h4 class="tx-20 font-weight-bold mb-1 text-white">{{ \App\Models\Doctor::count()}}</h4>
										</div>
									</div>
								</div>
							</div>
							<span id="compositeline" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
						</div>
					</div>
					<div class="col-xl-4 col-lg-4 col-md-4 col-xm-12">
						<div class="card overflow-hidden sales-card bg-danger-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">{{trans('Dashboard/dashboard.total_patients')}}</h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h4 class="tx-20 font-weight-bold mb-1 text-white">{{ \App\Models\Patient::count()}}</h4>
										</div>
									</div>
								</div>
							</div>
							<span id="compositeline2" class="pt-1">3,2,4,6,12,14,8,7,14,16,12,7,8,4,3,2,2,5,6,7</span>
						</div>
					</div>
					<div class="col-xl-4 col-lg-4 col-md-4 col-xm-12">
						<div class="card overflow-hidden sales-card bg-success-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">{{trans('Dashboard/dashboard.total_sections')}}</h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h4 class="tx-20 font-weight-bold mb-1 text-white">{{ \App\Models\Section::count()}}</h4>
										</div>
									</div>
								</div>
							</div>
							<span id="compositeline3" class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
						</div>
					</div>

				</div>
				<!-- row closed -->

				<!-- row opened -->
                <div class="table-responsive">
                    <table class="table text-md-nowrap" id="example2">
                        <thead>
                        <tr>
                            <th class="wd-15p border-bottom-0">#</th>
                            <th class="wd-15p border-bottom-0">{{trans('Dashboard/Tables/table.name')}}</th>
                            <th class="wd-15p border-bottom-0">{{trans('Dashboard/Tables/table.email')}}</th>
                            <th class="wd-20p border-bottom-0">{{trans('Dashboard/Tables/table.birth_date')}}</th>
                            <th class="wd-20p border-bottom-0">{{trans('Dashboard/Tables/table.phone')}}</th>
                            <th class="wd-20p border-bottom-0">{{trans('Dashboard/Tables/table.gender')}}</th>
                            <th class="wd-20p border-bottom-0">{{trans('Dashboard/Tables/table.doctor_name')}}</th>
                            <th class="wd-20p border-bottom-0">{{trans('Dashboard/Tables/table.processes')}}</th>
                            <th></th>

                        </tr>
                        </thead>
                        <tbody>
                            <?php $bookings = App\Models\Booking::with(['doctor'])->get(); ?>
                       @foreach($bookings as $booking)
                           <tr>
                               <td>{{$loop->iteration}}</td>
                               <td>{{$booking->name}}</td>
                               <td>{{$booking->email}}</td>
                                <td>{{$booking->date_birth}}</td>
                                <td>{{$booking->phone}}</td>
                                <td>{{$booking->gender == 1 ? trans('Dashboard/Tables/Table.male') : trans('Dashboard/Tables/Table.female')}}</td>
                               <td>{{$booking->doctor->name}}</td>
                               <td>
                                <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"  data-toggle="modal" href="#edit{{$booking->id}}"><i class="las la-pen"></i></a>
                                   <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"  data-toggle="modal" href="#delete{{$booking->id}}"><i class="las la-trash"></i></a>
                               </td>
                               <td></td>
                           </tr>
                           @include('Dashboard.Admin.edit')
                           @include('Dashboard.Admin.delete')

                       @endforeach
                        </tbody>
                    </table>
                </div>
				<!-- row closed -->


			</div>
		</div>
		<!-- Container closed -->
@endsection
@section('js')
<!--Internal  Chart.bundle js -->
<script src="{{URL::asset('Dashboard/plugins/chart.js/Chart.bundle.min.js')}}"></script>
<!-- Moment js -->
<script src="{{URL::asset('Dashboard/plugins/raphael/raphael.min.js')}}"></script>
<!--Internal  Flot js-->
<script src="{{URL::asset('Dashboard/plugins/jquery.flot/jquery.flot.js')}}"></script>
<script src="{{URL::asset('Dashboard/plugins/jquery.flot/jquery.flot.pie.js')}}"></script>
<script src="{{URL::asset('Dashboard/plugins/jquery.flot/jquery.flot.resize.js')}}"></script>
<script src="{{URL::asset('Dashboard/plugins/jquery.flot/jquery.flot.categories.js')}}"></script>
<script src="{{URL::asset('Dashboard/js/dashboard.sampledata.js')}}"></script>
<script src="{{URL::asset('Dashboard/js/chart.flot.sampledata.js')}}"></script>
<!--Internal Apexchart js-->
<script src="{{URL::asset('Dashboard/js/apexcharts.js')}}"></script>
<!-- Internal Map -->
<script src="{{URL::asset('Dashboard/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{URL::asset('Dashboard/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<script src="{{URL::asset('Dashboard/js/modal-popup.js')}}"></script>
<!--Internal  index js -->
<script src="{{URL::asset('Dashboard/js/index.js')}}"></script>
<script src="{{URL::asset('Dashboard/js/jquery.vmap.sampledata.js')}}"></script>
@endsection
