<div class="col-md-8 col-md-offset-2">

    <div class="form-group">
        {!! Form::label('name', 'Event Name', ['class'=>'control-label']) !!}
        {!! Form::text('name', null, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('start_date', 'Start On', ['class'=>'control-label']) !!}
        {!! Form::text('start_date', null, ['id'=>'start_date', 'class'=>'date form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('end_date', 'Ended On *', ['class'=>'control-label']) !!}
        {!! Form::text('end_date', null, ['id'=>'end_date', 'class'=>'date form-control', 'placeholder'=>'Select to End the Event']) !!}
    </div>    

    <div class="form-group">
        {!! Form::label('invest', 'Invested ($)', ['class'=>'control-label']) !!}
        {!! Form::text('invest', null, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('return', 'Return ($) *', ['class'=>'control-label']) !!}
        {!! Form::text('return', null, ['class'=>'form-control', 'placeholder'=>'Fill In to End the Event']) !!}
    </div>      

    <div class="form-group">
        {!! Form::label('remark', 'Description', ['class'=>'control-label']) !!}
        {!! Form::textarea('remark', null, ['class'=>'form-control', 'rows'=>'2']) !!}
    </div>  

    <p class="pull-left"><em>
    * Filling both <strong>Ended On</strong> and <strong>Return</strong> fields to change status to <strong>Confirmed
    </strong></em>
    </p>          
    
</div>

@section('footer')
<script>
    $('.date').datetimepicker({
        format: 'DD-MMMM-YYYY'
    }); 

    $('#end_date').val('');            
</script>
@stop
