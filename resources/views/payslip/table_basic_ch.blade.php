<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title"><strong>(A) Basic</strong></h3>
    </div>

    <div class="panel-body">
        <div class="col-md-10 col-md-offset-1">

            <div class="form-group">
                {!! Form::label('basic', 'Basic 基本工资 ($) ', ['class'=>'control-label']) !!}
                {!! Form::text('basic', null, ['class'=>'form-control', 'id'=>'basic', 'ng-model'=>'basicModel']) !!}
            </div> 

{{--             <div class="form-group">
                <div class="col-md-12 row">
                    {!! Form::label('workday 工作天', 'Actual/Total Working Day(s)', ['class'=>'control-label']) !!}
                </div>
                <div class="row">
                    <div class="col-md-2">
                        {!! Form::text('workday_actual', null, ['class'=>'form-control']) !!}days
                    </div>
                    <div class="col-md-1 text-center" style="font-size: 150%">
                        /
                    </div>
                    <div class="col-md-2">
                        {!! Form::text('workday_total', null, ['class'=>'form-control']) !!}days
                    </div>
                </div>
            </div>  --}}

        </div>
    </div>
</div>
