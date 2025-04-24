<!-- Modal -->
<div class="modal fade" id="delete{{ $laboratory_employee->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ trans('Dashboard/Laboratories/Laboratory.edit_laboratory_employee') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('laboratory_employees.destroy', $laboratory_employee->id) }}" method="post">
                {{ method_field('delete') }}
                {{ csrf_field() }}
            <div class="modal-body">
                <h5>{{ trans('Dashboard/Modals/Modal.delete_questions') }} {{$laboratory_employee->name}}</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('Dashboard/Modals/Modal.close') }}</button>
                <button type="submit" class="btn btn-danger">{{ trans('Dashboard/Modals/Modal.confirm') }}</button>
            </div>
            </form>
        </div>
    </div>
</div>
