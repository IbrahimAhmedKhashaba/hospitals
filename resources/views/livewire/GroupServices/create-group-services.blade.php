<div>

       {{-- @if ($catchError)
           <div class="alert alert-danger" id="success-danger">
               <button type="button" class="close" data-dismiss="alert">x</button>
               {{ $catchError }}
           </div>
       @endif --}}

        @if ($ServiceSaved)
            <div class="alert alert-info">{{ trans('Dashboard/Services/Service.saved') }}</div>
        @endif

        @if ($ServiceUpdated)
            <div class="alert alert-info">{{ trans('Dashboard/Services/Service.edited') }}</div>
        @endif

        @if($show_table)
            @include('livewire.GroupServices.index')
        @else
            <form wire:submit.prevent="saveGroup" autocomplete="off">
                @csrf
                <div class="form-group">
                    <label>{{ trans('Dashboard/Tables/Table.group_name') }}</label>
                    <input wire:model="name_group" type="text" name="name_group" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>{{ trans('Dashboard/Tables/Table.notes') }}</label>
                    <textarea wire:model="notes" name="notes" class="form-control" rows="5" required></textarea>
                </div>

                <div class="card mt-4">
                    <div class="card-header">
                        <div class="col-md-12">
                            <button class="btn btn-outline-primary"
                                    wire:click.prevent="addService">{{ trans('Dashboard/Services/Service.add_subservice') }}
                            </button>
                        </div>
                    </div>


                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr class="table-primary">
                                    <th>{{ trans('Dashboard/Tables/Table.service_name') }}</th>
                                    <th width="200">{{ trans('Dashboard/Tables/Table.count') }}</th>
                                    <th width="200">{{ trans('Dashboard/Tables/Table.processes') }}</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach ($GroupsItems as $index => $groupItem)
                                    <tr>
                                        <td>
                                            @if($groupItem['is_saved'])
                                                <input type="hidden" name="GroupsItems[{{$index}}][service_id]"
                                                       wire:model="GroupsItems.{{$index}}.service_id"/>
                                                @if($groupItem['service_name'] && $groupItem['service_price'])
                                                    {{ $groupItem['service_name'] }}
                                                    ({{ number_format($groupItem['service_price'], 2) }})
                                                @endif
                                            @else
                                                <select name="GroupsItems[{{$index}}][service_id]"
                                                        class="form-control{{ $errors->has('GroupsItems.' . $index) ? ' is-invalid' : '' }}"
                                                        wire:model="GroupsItems.{{$index}}.service_id">
                                                    <option value="">{{ trans('Dashboard/Tables/Table.choose') }}</option>
                                                    @foreach ($allServices as $service)
                                                        <option value="{{ $service->id }}">
                                                            {{ \App\Models\ServiceTranslation::where(['Service_id' => $service->id])->pluck('name')->first() }}
                                                            ({{ number_format($service->price, 2) }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('GroupsItems.' . $index))
                                                    <em class="invalid-feedback">
                                                        {{ $errors->first('GroupsItems.' . $index) }}
                                                    </em>
                                                @endif
                                            @endif
                                        </td>
                                        <td>
                                            @if($groupItem['is_saved'])
                                                <input type="hidden" name="GroupsItems[{{$index}}][quantity]"
                                                       wire:model="GroupsItems.{{$index}}.quantity"/>
                                                {{ $groupItem['quantity'] }}
                                            @else
                                                <input type="number" name="GroupsItems[{{$index}}][quantity]"
                                                       class="form-control" wire:model="GroupsItems.{{$index}}.quantity"/>
                                            @endif
                                        </td>
                                        <td>
                                            @if($groupItem['is_saved'])
                                                <button class="btn btn-sm btn-primary"
                                                        wire:click.prevent="editService({{$index}})">
                                                        {{ trans('Dashboard/Modals/Modal.edit') }}
                                                </button>
                                            @elseif($groupItem['service_id'])
                                                <button class="btn btn-sm btn-success mr-1"
                                                        wire:click.prevent="saveService({{$index}})">
                                                        {{ trans('Dashboard/Modals/Modal.confirm') }}
                                                </button>
                                            @endif
                                            <button class="btn btn-sm btn-danger"
                                                    wire:click.prevent="removeService({{$index}})">{{ trans('Dashboard/Modals/Modal.delete') }}
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>


                        <div class="col-lg-4 ml-auto text-right">
                            <table class="table pull-right">
                                <tr>
                                    <td style="color: red">{{ trans('Dashboard/Tables/Table.total') }}</td>
                                    <td>{{ number_format($subtotal, 2) }}</td>
                                </tr>

                                <tr>
                                    <td style="color: red">{{ trans('Dashboard/Tables/Table.discount_value') }}</td>
                                    <td width="125">
                                        <input type="number" name="discount_value" class="form-control w-75 d-inline"
                                               wire:model="discount_value">
                                    </td>
                                </tr>

                                <tr>
                                    <td style="color: red">{{ trans('Dashboard/Tables/Table.tax_rate') }}</td>
                                    <td>
                                        <input type="number" name="taxes" class="form-control w-75 d-inline" min="0"
                                               max="100" wire:model="taxes"> %
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color: red">{{ trans('Dashboard/Tables/Table.total_with_tax') }}</td>
                                    <td>{{ number_format($total, 2) }}</td>
                                </tr>
                            </table>
                        </div>
                        <br/>
                        <div>
                            <button class="btn btn-outline-success" type="submit">{{ trans('Dashboard/Modals/Modal.confirm') }}</button>
                            
                        </div>
                    </div>
                </div>

            </form>
        @endif


    </div>


