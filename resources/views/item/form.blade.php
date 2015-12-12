<div class="col-md-8 col-md-offset-2">

    <div class="form-group">
        {!! Form::label('name', 'Product', ['class'=>'control-label']) !!}
        {!! Form::text('name', null, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('remark', 'Description', ['class'=>'control-label']) !!}
        {!! Form::textarea('remark', null, ['class'=>'form-control', 'rows'=>'3']) !!}
    </div>       
    
</div>

