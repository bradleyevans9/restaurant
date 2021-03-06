<div class="form-group">
    <div class="row">
        <div class="col-lg-3 col-md-4">
            {!! Form::label('primary_phone_location_id', 'Primary phone:') !!}
            {!! Form::select('primary_phone_location_id', $primary_phones, config('polanco.location_type.home').":Phone", ['class' => 'form-control']) !!}
        </div>
    </div>
</div><div class="form-group">
    <ul role="tablist" class="nav nav-tabs">
        <li class="nav-item" role="tab">
                <a class="nav-link active" data-toggle="tab" role="tab" href="#phone_home">
                <i class="fa fa-home"></i>
                <label>Home</label>
            </a>
        </li>
        <li class="nav-item" role="tab">
                <a class="nav-link" data-toggle="tab" role="tab" href="#phone_work">
                <i class="fa fa-archive"></i>
                <label>Work</label>
            </a>
        </li>
        <li class="nav-item" role="tab">
                <a class="nav-link" data-toggle="tab" role="tab" href="#phone_other">
                <i class="fa fa-cog"></i>
                <label>Other</label>
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div id="phone_home" class="tab-pane fade show active" role="tabpanel">
            <h4>Home phone numbers</h4>

            <div class="row">
                <div class="col-lg-3 col-md-4">
                    {!! Form::label('phone_home_phone', 'Main:') !!}
                    {!! Form::text('phone_home_phone', null, ['class' => 'form-control']) !!}
                </div>
                <div class="col-lg-3 col-md-4">
                    {!! Form::label('phone_home_mobile', 'Mobile:') !!}
                    {!! Form::text('phone_home_mobile', null, ['class' => 'form-control']) !!}
                </div>
                <div class="col-lg-3 col-md-4">
                    {!! Form::label('phone_home_fax', 'Fax:') !!}
                    {!! Form::text('phone_home_fax', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
        <div id="phone_work" class="tab-pane fade" role="tabpanel">
            <h4>Work phone numbers</h4>

            <div class="row">
                <div class="col-lg-3 col-md-4">
                    {!! Form::label('phone_work_phone', 'Main:') !!}
                    {!! Form::text('phone_work_phone', null, ['class' => 'form-control']) !!}
                </div>
                <div class="col-lg-3 col-md-4">
                    {!! Form::label('phone_work_mobile', 'Mobile:') !!}
                    {!! Form::text('phone_work_mobile', null, ['class' => 'form-control']) !!}
                </div>
                <div class="col-lg-3 col-md-4">
                    {!! Form::label('phone_work_fax', 'Fax:') !!}
                    {!! Form::text('phone_work_fax', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
        <div id="phone_other" class="tab-pane fade" role="tabpanel">
            <h4>Other phone numbers</h4>

            <div class="row">
                <div class="col-lg-3 col-md-4">
                    {!! Form::label('phone_other_phone', 'Main:') !!}
                    {!! Form::text('phone_other_phone', null, ['class' => 'form-control']) !!}
                </div>
                <div class="col-lg-3 col-md-4">
                    {!! Form::label('phone_other_mobile', 'Mobile:') !!}
                    {!! Form::text('phone_other_mobile', null, ['class' => 'form-control']) !!}
                </div>
                <div class="col-lg-3 col-md-4">
                    {!! Form::label('phone_other_fax', 'Fax:') !!}
                    {!! Form::text('phone_other_fax', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-group form-check">
    {!! Form::checkbox('do_not_phone', 1, 0,['class' => 'form-check-input', 'id' => 'do_not_phone']) !!}
    {!! Form::label('do_not_phone', 'Do not call', ['class' => 'form-check-label', 'id' => 'do_not_phone']) !!}
</div>
<div class="form-group form-check">
    {!! Form::checkbox('do_not_sms', 1, 0,['class' => 'form-check-input', 'id' => 'do_not_sms']) !!}
    {!! Form::label('do_not_sms', 'Do not text', ['class' => 'form-check-label', 'id' => 'do_not_sms']) !!}
</div>
