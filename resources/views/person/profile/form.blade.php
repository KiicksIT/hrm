<div class="col-md-8 col-md-offset-2">
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('payslip_start', 'Salary From (Day)', ['class'=>'control-label']) !!}
                {!! Form::text('payslip_start', null, ['class'=>'num form-control', 'placeholder'=>'Numeric']) !!}
            </div> 
        </div>

        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('payslip_end', 'Salary To (Day)', ['class'=>'control-label']) !!}
                {!! Form::text('payslip_end', null, ['class'=>'num form-control', 'placeholder'=>'Numeric']) !!}
            </div>     
        </div>

        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('payslip_otstart', 'OT Pay From (Day)', ['class'=>'control-label']) !!}
                {!! Form::text('payslip_otstart', null, ['class'=>'num form-control', 'placeholder'=>'Numeric']) !!}
            </div> 
        </div>

        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('payslip_otend', 'OT Pay To (Day)', ['class'=>'control-label']) !!}
                {!! Form::text('payslip_otend', null, ['class'=>'num form-control', 'placeholder'=>'Numeric']) !!}
            </div>     
        </div>        
    </div> 
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('payday', 'Pay Date', ['class'=>'control-label']) !!}
                {!! Form::text('payday', null, ['class'=>'num form-control', 'placeholder'=>'Numeric']) !!}
                {!! Form::label('payday2', 'of every calender month', ['class'=>'control-label']) !!}
            </div> 
        </div>

        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('ot_payday', 'OT Pay Date', ['class'=>'control-label']) !!}
                {!! Form::text('ot_payday', null, ['class'=>'num form-control', 'placeholder'=>'Numeric']) !!}
                {!! Form::label('ot_payday2', 'of every calender month', ['class'=>'control-label']) !!}
            </div> 
        </div>      
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::label('notice', 'Notice Period for Termination of Employment', ['class'=>'control-label']) !!}
                {!! Form::textarea('notice', null, ['class'=>'form-control', 'placeholder'=>'(Initiated by either party whereby the length shall be the same)', 'rows'=>'2']) !!}
            </div>
        </div>     
    </div>
</div>
