@inject('users', 'App\User')

<div class="col-md-12">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('name', 'Task Name', ['class'=>'control-label']) !!}
            {!! Form::text('name', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('remark', 'Remark', ['class'=>'control-label']) !!}
            {!! Form::textarea('remark', null, ['class'=>'form-control', 'rows'=>'2']) !!}
        </div> 
       {{--  <div class="form-group">
            {!! Form::label('appt_date', 'Appt Date', ['class'=>'control-label']) !!}
            {!! Form::text('appt_date', null, ['id'=>'appt_date', 'class'=>'datetime form-control']) !!}
        </div>  --}}   

    <div class="form-group">
        {!! Form::label('appt_date', 'Appt Date', ['class'=>'control-label']) !!}
        <div class="input-group datetime">
        {!! Form::text('appt_date', null, ['class'=>'datetimepicker form-control']) !!}
        <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
        </div>
    </div>             
    </div>

    <div class="col-md-6"> 
        <div class="form-group">
            {!! Form::label('notify_date', 'Notify On *', ['class'=>'control-label']) !!}
            {!! Form::text('notify_date', null, ['id'=>'notify_date', 'class'=>'date form-control', 'placeholder'=>'Select Date to Enable Email Reminder']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('email_list', 'Notify User', ['class'=>'control-label']) !!}
            {!! Form::select('email_list[]', $users::lists('email', 'id'), null, ['class'=>'select form-control', 'multiple']) !!}
        </div>  
    </div>

    <p class="col-md-offset-1 col-md-11"><em>
    * Filling both <strong>Notify Date</strong> and <strong>Email List</strong> fields to enable <strong>Email Notification
    </strong></em>
    </p>    
</div>

@section('footer')
<script>
    $('.select').select2(); 

    $('.date').datetimepicker({
        format: 'DD-MMMM-YYYY'
    }); 

    $('.datetime').datetimepicker({
        format: 'DD-MMMM-YYYY    LT',
        sideBySide: true
    });           

    $('#notify_date').val('');       
</script>
@stop
