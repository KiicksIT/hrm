<div class="col-md-10 col-md-offset-1">
    <div class="form-group">
        {!! Form::label('title', 'Title 题目', ['class'=>'control-label']) !!}
        {!! Form::text('title', null, ['class'=>'form-control']) !!}
    </div>        
    <div class="form-group">
        {!! Form::label('content', 'Content 内容', ['class'=>'control-label']) !!}
        {!! Form::textarea('content', null, ['class'=>'form-control', 'rows'=>'3']) !!}
    </div>        
</div>
 
