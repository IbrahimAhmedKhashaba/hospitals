<button class="btn btn-primary pull-right" wire:click="show_form_add" type="button">{{ trans('Dashboard/Invoices/Invoice.add_invoice') }}</button><br><br>
<div class="table-responsive">
    <table class="table text-md-nowrap" id="example1" data-page-length="50"style="text-align: center">
        <thead>
        <tr>
            <th>#</th>
            <th>{{ trans('Dashboard/Tables/Table.group_name') }}</th>
            <th>{{ trans('Dashboard/Tables/Table.patient_name') }}</th>
            <th>{{ trans('Dashboard/Tables/Table.invoice_date') }}</th>
            <th>{{ trans('Dashboard/Tables/Table.doctor_name') }}</th>
            <th>{{ trans('Dashboard/Tables/Table.section_name') }}</th>
            <th>{{ trans('Dashboard/Tables/Table.price') }}</th>
            <th>{{ trans('Dashboard/Tables/Table.discount_value') }}</th>
            <th>{{ trans('Dashboard/Tables/Table.tax_rate') }}</th>
            <th>{{ trans('Dashboard/Tables/Table.tax_value') }}</th>
            <th>{{ trans('Dashboard/Tables/Table.total_with_tax') }}</th>
            <th>{{ trans('Dashboard/Tables/Table.invoice_type') }}</th>
            <th>{{ trans('Dashboard/Tables/Table.processes') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($group_invoices as $group_invoice)
            <tr>
                <td>{{ $loop->iteration}}</td>
                <td>{{ $group_invoice->group->name }}</td>
                <td>{{ $group_invoice->patient->name }}</td>
                <td>{{ $group_invoice->invoice_date }}</td>
                <td>{{ $group_invoice->doctor->name }}</td>
                <td>{{ $group_invoice->section->name }}</td>
                <td>{{ number_format($group_invoice->price, 2) }}</td>
                <td>{{ number_format($group_invoice->discount_value, 2) }}</td>
                <td>{{ $group_invoice->tax_rate }}%</td>
                <td>{{ number_format($group_invoice->tax_value, 2) }}</td>
                <td>{{ number_format($group_invoice->total_with_tax, 2) }}</td>
                <td>{{ $group_invoice->type == 1 ? trans('Dashboard/Tables/Table.cash') : trans('Dashboard/Tables/Table.delayed') }}</td>
                <td>
                    <button wire:click="edit({{ $group_invoice->id }})" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_invoice" wire:click="delete({{ $group_invoice->id }})" ><i class="fa fa-trash"></i></button>
                    <a href="#"  wire:click="print({{ $group_invoice->id }})" class="btn btn-primary btn-sm" target="_blank"><i class="fas fa-print"></i></a>
                </td>
            </tr>

        @endforeach
    </table>
    @include('livewire.GroupInvoices.delete')
</div>
