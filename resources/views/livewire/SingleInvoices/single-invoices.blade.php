<div>

    @if ($catchError)
        <div class="alert alert-danger" id="success-danger">
            <button type="button" class="close" data-dismiss="alert">x</button>
            {{ $catchError }}
        </div>
    @endif

    @if ($InvoiceSaved)
        <div class="alert alert-info">{{ trans('Dashboard/Services/Service.saved') }}</div>
    @endif

    @if ($InvoiceUpdated)
        <div class="alert alert-info">{{ trans('Dashboard/Services/Service.edited') }}</div>
    @endif

    @if($show_table)

     @include('livewire.SingleInvoices.Table')

    @else

    <form wire:submit.prevent="store" autocomplete="off">
                @csrf
                <div class="row">
                    <div class="col">
                        <label>{{ trans('Dashboard/Tables/Table.patient_name') }}</label>
                        <select wire:model="patient_id" class="form-control" required>
                            <option value=""  >-- {{ trans('Dashboard/Tables/Table.choose') }} --</option>
                            @foreach($patients as $patient)
                                <option value="{{$patient->id}}">{{$patient->name}}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="col">
                        <label>{{ trans('Dashboard/Tables/Table.doctor_name') }}</label>
                        <select wire:model="doctor_id"  wire:change="get_section" class="form-control"  id="exampleFormControlSelect1" required>
                            <option value="" >-- {{ trans('Dashboard/Tables/Table.choose') }} --</option>
                            @foreach($doctors as $doctor)
                                <option value="{{$doctor->id}}">{{$doctor->name}}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="col">
                        <label>{{ trans('Dashboard/Tables/Table.section_name') }}</label>
                        <input wire:model="section_id" type="text" class="form-control" readonly >
                    </div>

                    <div class="col">
                        <label>{{ trans('Dashboard/Tables/Table.invoice_type') }}</label>
                        <select wire:model="type" class="form-control" {{$updateMode == true ? 'disabled':''}} required>
                            <option value="" >-- {{ trans('Dashboard/Tables/Table.choose') }} --</option>
                            <option value="1">{{ trans('Dashboard/Tables/Table.cash') }}</option>
                            <option value="2">{{ trans('Dashboard/Tables/Table.delayed') }}</option>
                        </select>
                    </div>


                </div><br>

                <div class="row row-sm">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header pb-0">
                                <div class="d-flex justify-content-between">
                                    <h4 class="card-title mg-b-0"></h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped mg-b-0 text-md-nowrap" style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ trans('Dashboard/Tables/Table.service_name') }}</th>
                                            <th>{{ trans('Dashboard/Tables/Table.price') }}</th>
                                            <th>{{ trans('Dashboard/Tables/Table.discount_value') }}</th>
                                            <th>{{ trans('Dashboard/Tables/Table.tax_rate') }}</th>
                                            <th>{{ trans('Dashboard/Tables/Table.tax_value') }}</th>
                                            <th>{{ trans('Dashboard/Tables/Table.total_with_tax') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>
                                                <select wire:model="service_id" class="form-control" wire:change="get_price" id="exampleFormControlSelect1">
                                                    <option value="">-- {{ trans('Dashboard/Tables/Table.choose') }} --</option>
                                                    @foreach($services as $service)
                                                        <option value="{{$service->id}}">{{$service->name}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><input wire:model="price" type="text" class="form-control" readonly></td>
                                            <td><input wire:model="discount_value" type="text" class="form-control"></td>
                                            <th><input wire:model="tax_rate" type="text" class="form-control"></th>
                                            <td><input type="text" class="form-control" value="{{$tax_value}}" readonly ></td>
                                            <td><input type="text" class="form-control" readonly value="{{$subtotal + $tax_value }}"></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div><!-- bd -->
                            </div><!-- bd -->
                        </div><!-- bd -->
                    </div>
                </div>

                <input class="btn btn-outline-success" type="submit" value="{{ trans('Dashboard/Modals/Modal.confirm') }}">
            </form>

    @endif


</div>

