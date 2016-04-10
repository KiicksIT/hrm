<div class="col-md-12">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('basic', 'Basic/ Month 基本工资/月($)', ['class'=>'control-label']) !!}
                {!! Form::text('basic', null, ['class'=>'form-control', 'placeholder'=>'eg. 1500', 'ng-model'=>'basicModel']) !!}
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('basic_rate', 'Basic Rate/Hour 基本工资率／小时($)', ['class'=>'control-label']) !!}
                {!! Form::text('basic_rate', null, ['class'=>'form-control', 'placeholder'=>'eg. 85', 'ng-model'=>'basicRateModel']) !!}
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('ot_rate', 'OT Rate 加班率', ['class'=>'control-label']) !!}
                {!! Form::text('ot_rate', null, ['class'=>'form-control', 'placeholder'=>'eg. 1.5', 'ng-model'=>'otRateModel']) !!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::checkbox('resident', $person->resident, null, ['ng-model'=>'residentModel', 'ng-true-value'=>"'1'", 'ng-false-value'=>"'0'"]) !!}
                {!! Form::label('resident', 'Singaporean/ PR（公民／永久居民)', ['class'=>'control-label']) !!}
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('total_earned', 'Total/ Month 总工资／月($)', ['class'=>'control-label']) !!}
                {!! Form::text('total_earned', null, ['class'=>'form-control', 'placeholder'=>'eg. 1500', 'ng-model'=>'totalEarnedModel']) !!}
            </div>
        </div>
    </div>
</div>
