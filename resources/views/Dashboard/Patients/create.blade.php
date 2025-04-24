@extends('Dashboard.layouts.master')
@section('css')
    <!--Internal   Notify -->
    <link href="{{URL::asset('dashboard/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
@endsection
@section('title')
   اضافة مريض جديد
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">{{ trans('main-sidebar_trans.patients') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('Dashboard/Patients/Patient.add_patient') }}</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
@include('Dashboard.messages_alert')
<!-- row -->
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <form action="{{route('patients.store')}}" method="post" autocomplete="off">
                    @csrf
                    <div class="row">
                        <div class="col-3">
                            <label>{{ trans('Dashboard/Tables/Table.patient_name') }}</label>
                            <input type="text" name="name"  value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror " required>
                        </div>

                        <div class="col">
                            <label>{{ trans('Dashboard/Tables/Table.email') }}</label>
                            <input type="email" name="email"  value="{{old('email')}}" class="form-control @error('email') is-invalid @enderror" required>
                        </div>


                        <div class="col">
                            <label>{{ trans('Dashboard/Tables/Table.birth_date') }}</label>
                            <input class="form-control fc-datepicker" name="date_birth" placeholder="YYYY-MM-DD"
                             type="text" required>
                        </div>

                    </div>
                    <br>

                    <div class="row">
                        <div class="col-3">
                            <label>{{ trans('Dashboard/Tables/Table.phone') }}</label>
                            <input type="number" name="phone"  value="{{old('phone')}}" class="form-control @error('phone') is-invalid @enderror" required>
                        </div>

                        <div class="col">
                            <label>{{ trans('Dashboard/Tables/Table.gender') }}</label>
                            <select class="form-control" name="gender" required>
                                <option value="" selected>-- {{ trans('Dashboard/Tables/Table.choose') }} --</option>
                                <option value="1">{{ trans('Dashboard/Tables/Table.male') }}</option>
                                <option value="2">{{ trans('Dashboard/Tables/Table.female') }}</option>
                            </select>
                        </div>

                        <div class="col">
                            <label>{{ trans('Dashboard/Tables/Table.blood_type') }}</label>
                            <select class="form-control" name="blood_group" required>
                                <option value="" selected>-- {{ trans('Dashboard/Tables/Table.blood_type') }} --</option>
                                <option value="O-">O-</option>
                                <option value="O+">O+</option>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                            </select>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col">
                            <label>{{ trans('Dashboard/Tables/Table.address') }}</label>
                            <textarea rows="5" cols="10" class="form-control" name="address"></textarea>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col">
                            <button class="btn btn-success">{{ trans('Dashboard/Modals/Modal.confirm') }}</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('dashboard/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <script>
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();
    </script>
    <script src="{{URL::asset('dashboard/plugins/notify/js/notifIt.js')}}"></script>
    <script src="{{URL::asset('/plugins/notify/js/notifit-custom.js')}}"></script>
@endsection
