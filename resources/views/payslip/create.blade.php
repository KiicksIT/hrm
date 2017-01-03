@inject('months', 'App\Month')

@extends('template')
@section('title')
{{ $PAYSLIP_TITLE }}
@stop
@section('content')

<div class="create_edit">
    <div class="panel panel-primary" ng-app="app" ng-controller="payslipController">

        <div class="panel-heading">
            <h3 class="panel-title"><strong>New {{ $PAYSLIP_TITLE }}</strong></h3>
        </div>
        <div class="panel-body">
            {!! Form::model($item = new \App\Payslip, ['action'=>'PayslipController@store']) !!}
            <div class="col-md-8 col-md-offset-2">
                <div class="form-group">
                    {!! Form::label('search_date', 'Select Month 月份', ['class'=>'control-label']) !!}
{{--                     <select name="month">
                            <option value=""></option>
                            @foreach($months::all() as $month)
                                <option value="{{$month->id}}-{{Carbon\Carbon::now()->subYear()->year}}">
                                    {{$month->name}} - {{Carbon\Carbon::now()->subYear()->year}}
                                </option>
                            @endforeach
                            @foreach($months::all() as $month)
                                <option value="{{$month->id}}-{{Carbon\Carbon::now()->year}}">
                                    {{$month->name}} - {{Carbon\Carbon::now()->year}}
                                </option>
                            @endforeach
                            @foreach($months::all() as $month)
                                <option value="{{$month->id}}-{{Carbon\Carbon::now()->addYear()->year}}">
                                    {{$month->name}} - {{Carbon\Carbon::now()->addYear()->year}}
                                </option>
                            @endforeach
                    </select> --}}
                        {!! Form::select('month',
                            [''=>null] + $months::pluck('name', 'id')->all(),
                            null,
                            [
                            'class'=>'select form-control',
                            'ng-model'=>'monthModel',
                            'ng-change'=>'onMonthSelected(monthModel)'
                            ])
                        !!}
                </div>

                <div class="form-group">
                    {!! Form::label('search_person', 'Select Person 选择员工', ['class'=>'control-label']) !!}
                    <select id="person_id" name="person_id" class="select form-control"
                            ng-model="personModel">
                            <option value=""></option>
                            <option ng-repeat="person in people" ng-value="person.id" value="@{{person.id}}">
                                @{{person.position_name}} - @{{person.id}} - @{{person.person_name}}
                            </option>
                    </select>
                </div>
            </div>

                <div class="col-md-12">
                    <div class="form-group pull-right" style="padding: 30px 190px 0px 0px;">
                        {!! Form::submit('Add', ['class'=> 'btn btn-success']) !!}
                        <a href="/payslip" class="btn btn-default">Cancel</a>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

{!! Html::script('/js/payslip.js') !!}
@stop

