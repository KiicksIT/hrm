<div class="col-md-8 col-md-offset-2">

    <div class="form-group">
        {!! Form::label('employee', 'Employee', ['class'=>'control-label']) !!}
        {!! Form::text('employee', 
        $leave->person->name.' - '.$leave->person->department->name.' - '.$leave->person->position->name, 
        ['class'=>'form-control', 'disabled'=>'disabled']) 
        !!}
    </div>

    <div class="form-group">
        {!! Form::label('total_paidleave', 'Paid Annual Leave/ Year (Days)', ['class'=>'control-label']) !!}
        {!! Form::text('total_paidleave', null, ['class'=>'form-control']) !!}
    </div> 

    <div class="form-group">
        {!! Form::label('total_paidsickleave', 'Paid Outpatient Sick Leave/ Year (Days)', ['class'=>'control-label']) !!}
        {!! Form::text('total_paidsickleave', null, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('total_paidhospleave', 'Paid Hospitalisation Leave/ Year (Days)', ['class'=>'control-label']) !!}
        {!! Form::text('total_paidhospleave', null, ['class'=>'form-control']) !!} 
    </div>           
    
</div>