@extends('Dashboard.layouts.master')
@section('title')
    {{trans('main-sidebar_trans.doctors')}}
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
                <h4 class="content-title mb-0 my-auto">{{trans('main-sidebar_trans.doctors')}}/</h4>

            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @include('Dashboard.messages_alert')
    <!-- row opened -->
    <div class="row row-sm">
        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">

                    <a href="{{route('doctors.create')}}" class="btn btn-primary" role="button"
                       aria-pressed="true">{{trans('Dashboard/Doctors/Doctor.doctor_add')}}</a>
                    <button type="button" class="btn btn-danger"
                            id="btn_delete_all">{{trans('Dashboard/Doctors/Doctor.doctor_delete_group')}}</button>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table key-buttons text-md-nowrap">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th><input name="select_all"  id="example-select-all"  type="checkbox"/></th>
                                <th>{{trans('Dashboard/Tables/Table.doctor_name')}}</th>
                                <th>{{trans('Dashboard/Tables/Table.img')}}</th>
                                <th>{{trans('Dashboard/Tables/Table.email')}}</th>
                                <th>{{trans('Dashboard/Tables/Table.section_name')}}</th>
                                <th>{{trans('Dashboard/Tables/Table.phone')}}</th>
                                <th>{{trans('Dashboard/Tables/Table.appointments')}}</th>
                                <th>{{trans('Dashboard/Tables/Table.status')}}</th>
                                <th>{{trans('Dashboard/Tables/Table.created_at')}}</th>
                                <th>{{trans('Dashboard/Tables/Table.processes')}}</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($doctors as $doctor)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <input type="checkbox" name="delete_select" value="{{$doctor->id}}" class="delete_select">
                                    </td>
                                    <td>{{ $doctor->name }}</td>
                                    <td>
                                        @if($doctor->image)
                                            <img src="{{Url::asset('Dashboard/img/doctors/'.$doctor->image->file_name)}}"
                                                 height="50px" width="50px" alt="">

                                        @else
                                            <img src="{{Url::asset('Dashboard/img/doctor_default.png')}}" height="50px"
                                                 width="50px" alt="">
                                        @endif
                                    </td>
                                    <td>{{ $doctor->email }}</td>
                                    <td>{{ $doctor->section->name}}</td>
                                    <td>{{ $doctor->phone}}</td>
                                    <td>
                                        @foreach($doctor->appointments as $appointment)
                                            {{$appointment->translations[0]->name}}
                                        @endforeach
                                    </td>
                                    <td>
                                        <div
                                            class="dot-label bg-{{$doctor->status == 1 ? 'success':'danger'}} ml-1"></div>
                                        {{$doctor->status == 1 ? trans('Dashboard/Tables/Table.enabled'):trans('Dashboard/Tables/Table.not_enabled')}}
                                    </td>

                                    <td>{{ $doctor->created_at->diffForHumans()}}</td>
                                    <td>

                                        <div class="dropdown">
                                            <button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-outline-primary btn-sm" data-toggle="dropdown" type="button">{{trans('Dashboard/Tables/Table.processes')}}<i class="fas fa-caret-down mr-1"></i></button>
                                            <div class="dropdown-menu tx-13">
                                                <a class="dropdown-item" href="{{route('doctors.edit',$doctor->id)}}"><i style="color: #0ba360" class="text-success ti-user"></i>&nbsp;&nbsp;{{trans('Dashboard/Tables/Table.edit_info')}}</a>
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#update_password{{$doctor->id}}"><i   class="text-primary ti-key"></i>&nbsp;&nbsp;{{trans('Dashboard/Tables/Table.change_password')}}</a>
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#update_status{{$doctor->id}}"><i   class="text-warning ti-back-right"></i>&nbsp;&nbsp;{{trans('Dashboard/Tables/Table.change_status')}}</a>
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete{{$doctor->id}}"><i   class="text-danger  ti-trash"></i>&nbsp;&nbsp;{{trans('Dashboard/Tables/Table.delete_info')}}</a>
                                            </div>
                                        </div>

                                    </td>
                                    <td></td>
                                </tr>
                                @include('Dashboard.Doctors.delete')
                                @include('Dashboard.Doctors.delete_select')
                                @include('Dashboard.Doctors.update_password')
                                @include('Dashboard.Doctors.update_status')
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/div-->
    </div>
    <!-- /row -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!--Internal  Notify js -->
    <script src="{{URL::asset('Dashboard/plugins/notify/js/notifIt.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/notify/js/notifit-custom.js')}}"></script>

    <script>
        $(function() {
            jQuery("[name=select_all]").click(function(source) {
                checkboxes = jQuery("[name=delete_select]");
                for(var i in checkboxes){
                    checkboxes[i].checked = source.target.checked;
                }
            });
        })
    </script>


    <script type="text/javascript">
        $(function () {
            $("#btn_delete_all").click(function () {
                var selected = [];
                $("#example input[name=delete_select]:checked").each(function () {
                    selected.push(this.value);
                });

                if (selected.length > 0) {
                    $('#delete_select').modal('show')
                    $('input[id="delete_select_id"]').val(selected);
                }
            });
        });
    </script>



@endsection
