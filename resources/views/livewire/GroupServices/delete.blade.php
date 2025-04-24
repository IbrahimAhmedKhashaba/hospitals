<!-- Modal -->
<div class="modal fade" id="deleteGroup{{$group->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ trans('Dashboard/Services/Service.delete_group_services') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

                <div class="modal-body">
                    <h5>{{trans('Dashboard/Modals/Modal.delete_questions')}}</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('Dashboard/Modals/Modal.close')}}</button>
                    <button type="button" wire:click="delete({{ $group->id }})" class="btn btn-danger">{{trans('Dashboard/Modals/Modal.confirm')}}</button>
                </div>
        </div>
    </div>
</div>
