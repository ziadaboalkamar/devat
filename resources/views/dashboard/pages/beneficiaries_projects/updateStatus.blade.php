<!-- Modal -->
<div class="modal fade" id="update_status{{ $beneficiary->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    تغيير الحالة</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('update_status') }}" method="post" autocomplete="off">
                {{ csrf_field() }}
                <div class="modal-body">

                    <div class="form-group">
                        <label for="status">{{__('Status')}}</label>
                        <select class="form-control" id="status" name="status_id" required>
                            <option value="" selected disabled>--{{__('اختر')}}--</option>
                            <option value="1" {{ old('status_id',$beneficiary->status_id) == 1 ? 'selected' : null }}>فعال</option>
                            <option value="0" {{ old('status_id',$beneficiary->status_id) == 0 ? 'selected' : null }}>غير فعال</option>
                        </select>
                    </div>
                </div>
                <input type="hidden" name="id" value="{{ $beneficiary->id }}">

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{__('الغاء')}}</button>
                    <button type="submit" class="btn btn-primary">{{__('حفظ')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
