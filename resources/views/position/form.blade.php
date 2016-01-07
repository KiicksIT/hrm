<div class="col-md-6">
    <div class="form-group">
        {!! Form::label('name', 'Position', ['class'=>'control-label']) !!}
        {!! Form::text('name', null, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('remark', 'Remark', ['class'=>'control-label']) !!}
        {!! Form::textarea('remark', null, ['class'=>'form-control', 'rows'=>'2']) !!}
    </div>                      
</div>

<div class="col-md-6">
    <div class="form-group">
        {!! Form::label('work_hour', 'Work Hour(s)/ Day', ['class'=>'control-label']) !!}
        {!! Form::text('work_hour', null, ['class'=>'form-control', 'placeholder'=>'Numeric']) !!}
    </div>  

    <div class="form-group">
        {!! Form::label('work_day', 'Work Day(s)/ Week', ['class'=>'control-label']) !!}
        {!! Form::text('work_day', null, ['class'=>'form-control', 'placeholder'=>'Numeric']) !!}
    </div>   

    <div class="form-group">
        {!! Form::label('work_off', 'Off Day(s)/ Week', ['class'=>'control-label']) !!}
        {!! Form::text('work_off', null, ['class'=>'form-control', 'placeholder'=>'Numeric']) !!}
    </div>          
</div>

<script>
    $('.select').select2({
        tags:false,
        placeholder: 'Select...'
    });     
</script>