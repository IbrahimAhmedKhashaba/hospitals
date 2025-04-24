@extends('Dashboard.layouts.master')
@section('title')
    {{trans('Dashboard/main-sidebar_trans.sections')}}
@stop
@section('css')
    <!-- Internal Data table css -->
    <link href="{{URL::asset('Dashboard/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <!--Internal   Notify -->
    <link href="{{URL::asset('dashboard/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">{{ trans('main-sidebar_trans.patient_processes') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('main-sidebar_trans.account_statements') }}</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
@include('Dashboard.messages_alert')
				<!-- row -->
                    <!-- row opened -->
                    <div class="row row-sm">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header pb-0">
                                </div>
                                {{-- <a href="{{ $payLink }}" class="btn btn-primary btn-block"> {{ trans('main-sidebar_trans.pay_now') }} </a>Pay</a> --}}
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table style="text-align: center" class="table text-md-nowrap" id="example1">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{ trans('Dashboard/Tables/Table.created_at') }}</th>
                                                <th>{{ trans('Dashboard/Tables/Table.description') }}</th>
                                                <th>{{ trans('Dashboard/Tables/Table.debtor') }}</th>
                                                <th>{{ trans('Dashboard/Tables/Table.creditor') }}</th>
                                                <th>{{ trans('Dashboard/Tables/Table.last_total') }}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($Patient_accounts as $Patient_account)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$Patient_account->date}}</td>
                                                    <td>
                                                        @if($Patient_account->invoice_id == true)
                                                            {{$Patient_account->invoice->service->name ?? $invoice->group->name}}

                                                        @elseif($Patient_account->receipt_account_id == true)
                                                            {{$Patient_account->receipt_account->description}}

                                                        @elseif($Patient_account->payment_account_id == true)
                                                            {{$Patient_account->payment_account->description}}
                                                        @endif

                                                    </td>
                                                    <td>{{ $Patient_account->debit}}</td>
                                                    <td>{{ $Patient_account->credit}}</td>
                                                    <td></td>
                                                </tr>
                                                <br>
                                            @endforeach
                                            <tr>
                                                <th colspan="3" scope="row" class="alert alert-success">
                                                    <th>{{ trans('Dashboard/Tables/Table.last_total') }}</th>
                                                </th>
                                                <td class="alert alert-primary">{{ number_format( $debit = $Patient_accounts->sum('debit'), 2) }}</td>
                                                <td class="alert alert-primary">{{ number_format( $credit = $Patient_accounts->sum('credit'), 2) }}</td>
                                                <td class="alert alert-danger">
                                                    <span class="text-danger"> {{$debit - $credit}}   {{ $debit-$credit > 0 ? trans('Dashboard/Tables/Table.debtor') :trans('Dashboard/Tables/Table.creditor')}}</span>                                                        </td>
                                            </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div><!-- bd -->
                            </div><!-- bd -->
                        </div>
                        <!--/div-->

                    @include('Dashboard.Sections.add')
                    <!-- /row -->

				</div>
				<!-- row closed -->

			<!-- Container closed -->

		<!-- main-content closed -->
@endsection
@section('js')


    <!--Internal  Notify js -->
    <script src="{{URL::asset('dashboard/plugins/notify/js/notifIt.js')}}"></script>
    <script src="{{URL::asset('/plugins/notify/js/notifit-custom.js')}}"></script>

@endsection
