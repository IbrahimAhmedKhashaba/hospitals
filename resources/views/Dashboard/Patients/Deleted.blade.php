<!-- Deleted insurance -->
<div class="modal fade" id="Deleted{{ $Patient->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ trans('Dashboard/Patients/Patient.delete_patient') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('patients.destroy', 'test') }}" method="post">
                    @method('DELETE')
                    @csrf
                    <input type="hidden" name="id" value="{{ $Patient->id }}">
                    <div class="row">
                        <div class="col">
                            <p class="h5 text-danger">{{trans('Dashboard/Modals/Modal.delete_questions')}}</p>
                            <input type="text" class="form-control" readonly value="{{ $Patient->name }}">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{trans('Dashboard/Modals/Modal.close')}}</button>
                        <button class="btn btn-success">{{trans('Dashboard/Modals/Modal.confirm')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
