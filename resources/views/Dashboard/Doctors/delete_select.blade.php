<!-- Modal -->
<div class="modal fade" id="delete_select" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{ trans('Dashboard/Doctors/Doctor.doctor_delete_group') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('doctors.destroy', 'test') }}" method="post">
                {{ method_field('delete') }}
                {{ csrf_field() }}
                <div class="modal-body">
                    <h5>{{trans('Dashboard/Modals/Modal.delete_questions')}}</h5>
                    <input type="hidden" id="delete_select_id" name="delete_select_id" value=''>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('Dashboard/Modals/Modal.close')}}</button>
                    <button type="submit" class="btn btn-danger">{{trans('Dashboard/Modals/Modal.confirm')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
