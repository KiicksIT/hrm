<div class="col-md-10 col-md-offset-1">

    <div class="form-group">
        {!! Form::label('person_id', 'Employee 员工', ['class'=>'control-label']) !!}
        {!! Form::text('person_id',
        $payslip->person->position->name.' - '.$payslip->person->id.' - '.$payslip->person->name,
        ['class'=>'form-control', 'disabled'=>'disabled']) !!}
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('payslip_from', 'Payslip From 薪水 从', ['class'=>'control-label']) !!}
                <div class="input-group date">
                {!! Form::text('payslip_from', null, ['class'=>'form-control', 'id'=>'payslip_from']) !!}
                <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('payslip_to', 'Payslip To 到', ['class'=>'control-label']) !!}
                <div class="input-group date">
                {!! Form::text('payslip_to', null, ['class'=>'form-control', 'id'=>'payslip_to']) !!}
                <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('pay_date', 'Date of Payment 发薪日期', ['class'=>'control-label']) !!}
                <div class="input-group date">
                {!! Form::text('pay_date', null, ['class'=>'form-control', 'id'=>'pay_date']) !!}
                <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            {!! Form::label('pay_mode', 'Payment Method 支付方式', ['class'=>'control-label']) !!}
            {!! Form::select('pay_mode',
                ['Cash'=>'Cash', 'Cheque'=>'Cheque', 'Bank Deposit'=>'Bank Deposit', 'Giro'=>'Giro', 'Online Transfer' => 'Online Transfer'],
                null,
                [
                'id'=>'pay_mode',
                'class'=>'select form-control',
                ])
            !!}
        </div>

        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('cheque_no', 'Cheque No 支票号码', ['class'=>'control-label']) !!}
                {!! Form::text('cheque_no', null, ['class'=>'form-control', 'placeholder'=>'Fill if Cheque']) !!}
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('basic_rate', 'Hourly Pay 每小时工资($)', ['class'=>'control-label']) !!}
                {!! Form::text('basic_rate', null, ['class'=>'form-control', 'disabled'=>'disabled', 'ng-model'=>'basicRateModel']) !!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('resident', 'Singaporean/ PR (公民/永久居民)', ['class'=>'control-label']) !!}
                {!! Form::text('resident', null, ['class'=>'form-control', 'disabled'=>'disabled', 'ng-model'=>'residentModel']) !!}
            </div>
        </div>
    </div>

    <hr>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('ot_from', 'Overtime From 加班 从', ['class'=>'control-label']) !!}
                <div class="input-group date">
                {!! Form::text('ot_from', null, ['class'=>'form-control', 'id'=>'ot_from']) !!}
                <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('ot_to', 'Overtime To 到', ['class'=>'control-label']) !!}
                <div class="input-group date">
                {!! Form::text('ot_to', null, ['class'=>'form-control', 'id'=>'ot_to']) !!}
                <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('ot_rate', 'Overtime Rate 加班费 率', ['class'=>'control-label']) !!}
                {!! Form::text('ot_rate', null, ['class'=>'form-control', 'disabled'=>'disabled', 'ng-model'=>'otRateModel']) !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('ot_hour', 'OT Worked Hour(s) 加班时数 (小时)', ['class'=>'control-label']) !!}
                {!! Form::text('ot_hour', null, ['class'=>'form-control', 'ng-model'=>'othourModel',
                'ng-change'=>'onOtHourChange()', 'placeholder'=>'Fill if Applicable']) !!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            {!! Form::label('remark', 'Remark 备注', ['class'=>'control-label']) !!}
            {!! Form::textarea('remark', null, ['class'=>'form-control', 'rows'=>'3']) !!}
        </div>
    </div>
</div>

<script>
    $('.select').select2({
        placeholder: 'Select...'
    });

    $('.date').datetimepicker({
       format: 'DD-MMMM-YYYY'
    });
</script>
