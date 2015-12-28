<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title"><strong>(D) Overtime</strong></h3>
    </div>

    <div class="panel-body">
        <div class="col-md-10 col-md-offset-1">
            <div class="form-group">
                {!! Form::label('ot_total', 'Total Overtime Pay ($)', ['class'=>'control-label']) !!}
                {!! Form::text('ot_total', null, ['class'=>'form-control', 'ng-model'=>'ottotalModel']) !!}
            </div>                                              
        </div>
    </div>
</div>
