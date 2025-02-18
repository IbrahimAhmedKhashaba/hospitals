<!-- Modal -->
<div class="modal fade" id="update_status{{ $doctor->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{ trans('Dashboard/Modals/Modal.change_status') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('doctors.update_status' , $doctor->id) }}" method="post" autocomplete="off">
                {{ csrf_field() }}
                @method('put')
                <div class="modal-body">
                    <h3>{{trans('Dashboard/Modals/Modal.change_status_question')}}</h3>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('Dashboard/Modals/Modal.close') }}</button>
                    <button type="submit" class="btn btn-primary">{{ trans('Dashboard/Modals/Modal.confirm') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
