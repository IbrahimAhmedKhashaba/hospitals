<div>
    <form wire:submit.prevent="store">
        @if($message)
            <div class="alert alert-success">
                {{ trans('WebSite/WebSite.book_msg') }}
            </div>
        @endif
        <div class="row clearfix">
            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                <input type="text" name="username" wire:model="name" placeholder="{{ trans('Dashboard/Tables/Table.name') }}" required="">
                <span class="icon fa fa-user"></span>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                <input type="email" name="email" wire:model="email" placeholder="{{ trans('Dashboard/Tables/Table.email') }}" required="">
                <span class="icon fa fa-envelope"></span>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                <label>{{ trans('Dashboard/Tables/Table.gender') }}</label>
                <select class="form-control" name="gender"  wire:model="gender" required>
                    <option value="" selected>-- {{ trans('Dashboard/Tables/Table.choose') }} --</option>
                    <option value="1">{{ trans('Dashboard/Tables/Table.male') }}</option>
                    <option value="2">{{ trans('Dashboard/Tables/Table.female') }}</option>
                </select>

            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                <label>{{ trans('Dashboard/Tables/Table.blood_type') }}</label>
                            <select class="form-control" name="blood_group"  wire:model="blood_group" required>
                                <option value="" selected>-- {{ trans('Dashboard/Tables/Table.blood_type') }} --</option>
                                <option value="O-">O-</option>
                                <option value="O+">O+</option>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                            </select>
            </div>




            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                <label for="exampleFormControlSelect1">{{ trans('Dashboard/Tables/Table.doctor_name') }}</label>
                <select name="doctor" wire:model="doctor" class="form-select" id="exampleFormControlSelect1" required="">
                    @foreach($doctors as $doctor)
                        <option value="{{$doctor->id}}">{{$doctor->name}}</option>
                    @endforeach
                </select>
            </div>


            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                <label for="exampleFormControlSelect1">{{ trans('Dashboard/Tables/Table.section_name') }}</label>
                <select class="form-select" name="section" wire:model="section" id="exampleFormControlSelect1" wire:change='getDoctors' required="">
                    <option>-- {{ trans('Dashboard/Tables/Table.choose') }} --</option>
                    @foreach($sections as $section)
                        <option value="{{$section->id}}">{{$section->name}}</option>
                    @endforeach

                </select>
            </div>



            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                <label for="exampleFormControlSelect1">{{ trans('Dashboard/Tables/Table.birth_date') }}</label>
                <div class="input-group date" data-provide="datepicker">
                    <input type="date" class="form-control py-2" name="date_birth" wire:model="date_birth" required="">
                </div>
            </div>

            <div class="col-lg-12 col-md-6 col-sm-12 form-group">
                <input type="tel" name="phone" wire:model="phone" placeholder="{{ trans('Dashboard/Tables/Table.phone') }}" required="">
                <span class="icon fas fa-phone"></span>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                <textarea name="address" wire:model="address" placeholder="{{ trans('Dashboard/Tables/Table.address') }}" required=""></textarea>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                <button class="theme-btn btn-style-two" type="submit" name="submit-form">
                    <span class="txt">{{ trans('Dashboard/Modals/Modal.confirm') }}</span></button>
            </div>
        </div>
    </form>
</div>

{{-- <script>
    window.addEventListener('sectionUpdated', event => {
    console.log('Section updated:', event.detail);
});
</script> --}}
