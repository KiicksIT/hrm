<div class="col-md-6">
    <div class="form-group">
        {!! Form::label('name', 'Position 职位', ['class'=>'control-label']) !!}
        {!! Form::text('name', null, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('remark', 'Remark 备注', ['class'=>'control-label']) !!}
        {!! Form::textarea('remark', null, ['class'=>'form-control', 'rows'=>'2']) !!}
    </div>                      
</div>

<div class="col-md-6">
    <div class="form-group">
        {!! Form::label('work_hour', 'Work Hour(s)/ Day 每天工作小时', ['class'=>'control-label']) !!}
        {!! Form::text('work_hour', null, ['class'=>'form-control', 'placeholder'=>'Numeric']) !!}
    </div>  

    <div class="form-group">
        {!! Form::label('work_day', 'Work Day(s)/ Week 每周工作天数', ['class'=>'control-label']) !!}
        {!! Form::text('work_day', null, ['class'=>'form-control', 'placeholder'=>'Numeric']) !!}
    </div>   

    <div class="form-group">
        {!! Form::label('work_off', 'Off Day(s)/ Week 每周休日', ['class'=>'control-label']) !!}
        {!! Form::text('work_off', null, ['class'=>'form-control', 'placeholder'=>'Numeric']) !!}
    </div>          
</div>

<script>
    $('.select').select2({
        tags:false,
        placeholder: 'Select...'
    });     
</script>