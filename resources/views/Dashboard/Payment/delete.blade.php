<!-- Modal -->
<div class="modal fade" id="delete{{ $payment->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ trans('Dashboard/Payments/Payment.delete_payment') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('payments.destroy', 'test') }}" method="post">
                {{ method_field('delete') }}
                {{ csrf_field() }}
            <div class="modal-body">
                <input type="hidden" name="id" value="{{ $payment->id }}">
                <h5>{{trans('Dashboard/Modals/Modal.delete_questions')}}<span style="color: red"> {{ $payment->patients->name }}</span></h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('Dashboard/Modals/Modal.close')}}</button>
                <button type="submit" class="btn btn-danger">{{trans('Dashboard/Modals/Modal.confirm')}}</button>
            </div>
            </form>
        </div>
    </div>
</div>
