<div class="col-md-8 col-md-offset-2">

    @if($market->status != 'Prospect')
    <div class="form-group">
        {!! Form::label('name', 'Name', ['class'=>'control-label']) !!}
        {!! Form::text('name', null, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('contact', 'Contact', ['class'=>'control-label']) !!}
        {!! Form::text('contact', null, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('email', 'Email', ['class'=>'control-label']) !!}
        {!! Form::email('email', null, ['class'=>'form-control']) !!}
    </div>     
    @endif

    <div class="form-group">
        {!! Form::label('subject', 'Subject', ['class'=>'control-label']) !!}
        {!! Form::text('subject', null, ['class'=>'form-control']) !!}
    </div>    

    @if($market->status != 'Prospect')
    <div class="form-group">
        {!! Form::label('remark', 'Description', ['class'=>'control-label']) !!}
        {!! Form::textarea('remark', null, ['class'=>'form-control', 'rows'=>'3']) !!}
    </div> 
    @endif

    <div class="form-group">
        {!! Form::label('appt_date', 'Appt Date', ['class'=>'control-label']) !!}
        <div class="input-group datetime">
        {!! Form::text('appt_date', null, ['class'=>'datetimepicker form-control']) !!}
        <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
        </div>
    </div>            
    
</div>

<script>
    $('.datetime').datetimepicker({
        format: 'DD-MMMM-YYYY    LT',
        sideBySide: true
    }); 
</script>