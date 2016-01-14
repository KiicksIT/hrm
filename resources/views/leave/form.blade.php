<div class="col-md-8 col-md-offset-2">

    <div class="form-group">
        {!! Form::label('employee', 'Employee 员工', ['class'=>'control-label']) !!}
        {!! Form::text('employee', 
        $leave->person->name.' - '.$leave->person->position->name, 
        ['class'=>'form-control', 'disabled'=>'disabled']) 
        !!}
    </div>

    <div class="form-group">
        {!! Form::label('total_paidleave', 'Paid Annual Leave/ Year(Days)  每年带薪年假／天', ['class'=>'control-label']) !!}
        {!! Form::text('total_paidleave', null, ['class'=>'form-control']) !!}
    </div> 

    <div class="form-group">
        {!! Form::label('total_paidsickleave', 'Paid Outpatient Sick Leave/ Year(Days)  每年门诊带薪病假／天', ['class'=>'control-label']) !!}
        {!! Form::text('total_paidsickleave', null, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('total_paidhospleave', 'Paid Hospitalisation Leave/ Year(Days)  每年住院带薪病假／天', ['class'=>'control-label']) !!}
        {!! Form::text('total_paidhospleave', null, ['class'=>'form-control']) !!} 
    </div>           
    
</div>