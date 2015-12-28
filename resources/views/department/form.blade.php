@inject('people', 'App\Person')

<div class="col-md-8 col-md-offset-2">

    <div class="form-group">
        {!! Form::label('name', 'Dept Name', ['class'=>'control-label']) !!}
        {!! Form::text('name', null, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('remark', 'Remark', ['class'=>'control-label']) !!}
        {!! Form::textarea('remark', null, ['class'=>'form-control', 'rows'=>'3']) !!}
    </div> 

    <div class="form-group">
        {!! Form::label('hod', 'Head of Dept', ['class'=>'control-label']) !!}
        {!! Form::select('hod', $people::lists('name', 'name'), null, ['id'=>'hod', 'class'=>'select form-control']) !!}
    </div>        
    
</div>

@section('footer')
<script>
    $('.select').select2();           
</script>
@stop