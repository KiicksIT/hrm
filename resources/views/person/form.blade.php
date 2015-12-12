@inject('payterm', 'App\Payterm')

<div class="col-md-6">

    <div class="form-group">
        {!! Form::label('name', 'Name', ['class'=>'control-label']) !!}
        {!! Form::text('name', null, ['class'=>'form-control']) !!}
    </div> 

    <div class="form-group">
        {!! Form::label('nric', 'NRIC', ['class'=>'control-label']) !!}
        {!! Form::text('nric', null, ['class'=>'form-control']) !!}
    </div>       

    <div class="form-group">
        {!! Form::label('contact', 'Contact', ['class'=>'control-label']) !!}
        {!! Form::text('contact', null, ['class'=>'form-control']) !!}
    </div>    

    <div class="form-group">
        {!! Form::label('carplate', 'Car Plate', ['class'=>'control-label']) !!}
        {!! Form::text('carplate', null, ['class'=>'form-control']) !!}
    </div> 
</div>

<div class="col-md-6">
    <div class="form-group">
        {!! Form::label('email', 'Email', ['class'=>'control-label']) !!}
        {!! Form::email('email', null, ['class'=>'form-control']) !!}
    </div> 

    <div class="form-group">
        {!! Form::label('address', 'Address', ['class'=>'control-label']) !!}
        {!! Form::textarea('address', null, ['class'=>'form-control', 'rows'=>'3']) !!}
    </div>            

    <div class="form-group">
        {!! Form::label('remark', 'Remark', ['class'=>'control-label']) !!}
        {!! Form::textarea('remark', null, ['class'=>'form-control', 'rows'=>'3']) !!}
    </div>        
</div>

<script>
    $('.select').select2();
</script>
