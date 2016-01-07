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
                    {!! Form::label('search_person', 'Select Person', ['class'=>'control-label']) !!}
                    {{-- {!! Form::label('search_person', 'Select Person 选择员工', ['class'=>'control-label']) !!} --}}
                    <select id="person_id" name="person_id" class="select form-control" 
                            ng-model="personModel" ng-change="onPersonSelected(personModel)">
                            <option value=""></option>
                            <option ng-repeat="person in people" ng-value="person.id" value="@{{person.id}}">
                                @{{person.department.name}} - @{{person.position.name}} - @{{person.id}} - @{{person.name}}
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
@stop

@section('footer')
<script src="/js/payslip.js"></script>
<script>
    $('.select').select2({
        placeholder: 'Select...',
        allowClear: true
    });
</script>  
@stop

