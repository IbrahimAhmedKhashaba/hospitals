<!-- Modal -->
<div class="modal fade" id="update_password{{ $doctor->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{ trans('Dashboard/Modals/Modal.update_password') }} {{$doctor->name}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('doctors.update_password' , $doctor->id) }}" method="post" autocomplete="off">
                {{ csrf_field() }}
                {{-- {{ $request->method('put') }} --}}
                @method('put')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="password">{{ trans('Dashboard/Modals/Modal.new_password') }}</label>
                        <input type="password" class="form-control" id="password" name="password" >
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">{{ trans('Dashboard/Modals/Modal.confirm_password') }}</label>
                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('Dashboard/Modals/Modal.close') }}</button>
                    <button type="submit" class="btn btn-primary">{{ trans('Dashboard/Modals/Modal.confirm') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
