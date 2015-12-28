<div class="col-md-10 col-md-offset-1">

    <div class="form-group">
        {!! Form::label('person_id', 'Employee', ['class'=>'control-label']) !!}
        {!! Form::text('person_id', 
        $payslip->person->department->name.' - '.$payslip->person->position->name.' - '.$payslip->person->id.' - '.$payslip->person->name, 
        ['class'=>'form-control', 'disabled'=>'disabled']) !!}
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('payslip_from', 'Payslip From', ['class'=>'control-label']) !!}
                <div class="input-group date">
                {!! Form::text('payslip_from', null, ['class'=>'form-control', 'id'=>'payslip_from']) !!}
                <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('payslip_to', 'Payslip To', ['class'=>'control-label']) !!}
                <div class="input-group date">
                {!! Form::text('payslip_to', null, ['class'=>'form-control', 'id'=>'payslip_to']) !!}
                <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
                </div>
            </div>
        </div>
    </div>             

    <div class="row">
        <div class="col-md-3">    
            <div class="form-group">
                {!! Form::label('pay_date', 'Date of Payment', ['class'=>'control-label']) !!}
                <div class="input-group date">
                {!! Form::text('pay_date', null, ['class'=>'form-control', 'id'=>'pay_date']) !!}
                <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
                </div>
            </div>        
        </div> 

        <div class="col-md-3">       
            {!! Form::label('pay_mode', 'Payment Method', ['class'=>'control-label']) !!}
            {!! Form::select('pay_mode', 
                ['Cash'=>'Cash', 'Cheque'=>'Cheque', 'Bank Deposit'=>'Bank Deposit'], 
                null, 
                [
                'id'=>'pay_mode', 
                'class'=>'select form-control'
                ]) 
            !!}        
        </div>

        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('basic_rate', 'Hourly Pay ($)', ['class'=>'control-label']) !!}
                {!! Form::text('basic_rate', $payslip->person->basic_rate + 0, ['id'=>'basic_rate', 'class'=>'form-control', 'disabled'=>'disabled']) !!}
            </div>        
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('resident', 'Singaporean/ PR', ['class'=>'control-label']) !!}
                {!! Form::text('resident', $payslip->person->resident, ['id'=>'resident', 'class'=>'form-control', 'disabled'=>'disabled']) !!}
            </div>        
        </div>    
    </div>

    <hr>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('ot_from', 'Overtime From', ['class'=>'control-label']) !!}
                <div class="input-group date">
                {!! Form::text('ot_from', null, ['class'=>'form-control', 'id'=>'ot_from']) !!}
                <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('ot_to', 'Overtime To', ['class'=>'control-label']) !!}
                <div class="input-group date">
                {!! Form::text('ot_to', null, ['class'=>'form-control', 'id'=>'ot_to']) !!}
                <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('ot_rate', 'Overtime Rate (Hourly)', ['class'=>'control-label']) !!}
                {!! Form::text('ot_rate', $payslip->person->ot_rate + 0, ['id'=>'ot_rate', 'class'=>'form-control', 'disabled'=>'disabled']) !!}
            </div>        
        </div> 
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('ot_hour', 'OT Worked Hour(s)', ['class'=>'control-label']) !!}
                {!! Form::text('ot_hour', null, ['class'=>'form-control', 'ng-model'=>'othourModel', 
                'ng-change'=>'onOtHourChange()', 'ng-model-options'=>'{debounce:800}', 'placeholder'=>'Fill if Applicable']) !!}
            </div>        
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
