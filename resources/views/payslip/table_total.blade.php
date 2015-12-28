<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title"><strong>Total</strong></h3>
    </div>

    <div class="panel-body">
        <div class="col-md-10 col-md-offset-1">
            <div class="form-group">
                {!! Form::label('net_pay', 'Net Pay (A+B-C+D+E)', ['class'=>'control-label']) !!}
                {!! Form::text('net_pay', null, ['class'=>'form-control', 'disabled'=>'disabled', 'ng-model'=>'netPayModel']) !!}
            </div> 
            <div class="form-group row">
                <div class="col-md-12">
                    {!! Form::label('employercont_epf', 'Employer\'s CPF Contributions'  , ['class'=>'control-label']) !!}
                </div>
                <div class="col-md-6">
                    {!! Form::text('employercont_epf', null, ['class'=>'form-control', 'disabled'=>'disabled', 'ng-model'=>'employerEpfModel']) !!}
                </div>
            </div>                                                          
        </div>
    </div>
</div>
