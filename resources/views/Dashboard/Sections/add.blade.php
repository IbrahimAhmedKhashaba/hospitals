<!-- Modal -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{trans('Dashboard/Sections/section.add_section')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('sections.store') }}" method="post" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <label for="exampleInputPassword1">{{trans('Dashboard/Tables/table.name')}}</label>
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="modal-body">
                    <label for="exampleInputPassword1">{{trans('Dashboard/Tables/table.description')}}</label>
                    <textarea type="text" name="description" class="form-control"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('Dashboard/Modals/modal.close')}}</button>
                    <button type="submit" class="btn btn-primary">{{trans('Dashboard/Modals/modal.confirm')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
