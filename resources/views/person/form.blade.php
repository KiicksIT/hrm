@inject('payterm', 'App\Payterm')

<div class="col-md-6">

    <div class="form-group">
        {!! Form::label('company', 'Company', ['class'=>'control-label']) !!}
        {!! Form::text('company', null, ['class'=>'form-control']) !!}
    </div> 

    <div class="form-group">
        {!! Form::label('roc_no', 'ROC No', ['class'=>'control-label']) !!}
        {!! Form::text('roc_no', null, ['class'=>'form-control']) !!}
    </div> 

    <div class="form-group">
        {!! Form::label('name', 'Name', ['class'=>'control-label']) !!}
        {!! Form::text('name', null, ['class'=>'form-control']) !!}
    </div>           

    <div class="form-group">
        {!! Form::label('contact', 'Contact', ['class'=>'control-label']) !!}
        {!! Form::text('contact', null, ['class'=>'form-control']) !!}
    </div>    

    <div class="form-group">
        {!! Form::label('office_no', 'Office No', ['class'=>'control-label']) !!}
        {!! Form::text('office_no', null, ['class'=>'form-control']) !!}
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
    <div class="col-md-5">
        <div class="form-group">
            {!! Form::label('postcode', 'Postcode', ['class'=>'control-label']) !!}
            {!! Form::text('postcode', null, ['class'=>'form-control']) !!}
        </div>                
    </div>

    <div class="form-group col-md-12">
        {!! Form::label('remark', 'Remark', ['class'=>'control-label']) !!}
        {!! Form::textarea('remark', null, ['class'=>'form-control', 'rows'=>'3']) !!}
    </div>          
</div>

<script>
    $('.select').select2();
</script>
