@extends('template')
@section('title')
{{ $PAYSLIP_TITLE }}
@stop
@section('content')

<div class="create_edit" ng-app="app" ng-controller="payslipController">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><strong>Payslip for {{$payslip->id}} : {{$payslip->person->name}}  -  ({{$payslip->status}})</strong></h3> 
        </div>

        <div class="panel-body">
            {!! Form::open(['id'=>'form_print', 'method'=>'POST', 'action'=>['PayslipController@generatePayslip', $payslip->id]]) !!}
            {!! Form::close() !!}        
            {!! Form::model($payslip,['id'=>'form_submit', 'method'=>'PATCH','action'=>['PayslipController@update', $payslip->id], 'ng-submit'=>'calTotal()']) !!}            
            {!! Form::text('payslip_id', $payslip->id, ['id'=>'payslip_id','class'=>'hidden form-control']) !!}
            {!! Form::text('ot_total', null, ['class'=>'hidden form-control', 'ng-model'=>'ottotalModel']) !!}
            {!! Form::text('plus_all', null, ['class'=>'hidden form-control', 'ng-model'=>'plusAllModel']) !!}
            {!! Form::text('employercont_epf', null, ['class'=>'hidden form-control', 'ng-model'=>'employerEpfModel']) !!}
            {!! Form::text('employee_epf', null, ['class'=>'hidden form-control', 'ng-model'=>'employeeEpfModel']) !!}
            {{-- {!! Form::text('add_total', null, ['class'=>'hidden form-control', 'ng-model'=>'totalAddModel']) !!} --}}
            {{-- {!! Form::text('deduct_total', null, ['class'=>'hidden form-control', 'ng-model'=>'totalDeductModel']) !!} --}}
            {{-- {!! Form::text('other_total', null, ['class'=>'hidden form-control', 'ng-model'=>'totalAddotherModel']) !!} --}}
            {{-- {!! Form::text('net_pay', null, ['class'=>'hidden form-control', 'ng-model'=>'netPayModel']) !!} --}}
                @include('payslip.form')
            
                <div class="col-md-12">
                    <div class="pull-right" style="padding: 30px 95px 0px 0px;">
                        @if($payslip->status == 'Pending')
                            {!! Form::submit('Confirm', ['name'=>'confirm', 'class'=> 'btn btn-primary', 'form'=>'form_submit']) !!}
                        @else
                            {!! Form::submit('Print', ['name'=>'print', 'class'=> 'btn btn-primary', 'form'=>'form_print']) !!}
                        @endif
                        {!! Form::submit('Save', ['name'=>'save', 'class'=> 'btn btn-default', 'form'=>'form_submit']) !!}
                        <a href="/payslip" class="btn btn-default">Cancel</a>            
                    </div>
                    <div class="pull-left" style="padding: 30px 0px 0px 95px;">
                        <button class="btn btn-danger btn-delete" ng-click="confirmDelete({{$payslip->id}})">Delete</button> 
                    </div>                
                </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @include('payslip.table_basic')
        </div>
    </div>
            {!! Form::close() !!}
    <div class="row">
        <div class="col-md-6">
            @include('payslip.table_add')
        </div>
            
        <div class="col-md-6">
            @include('payslip.table_deduct')
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @include('payslip.table_ot')
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @include('payslip.table_addother')
        </div>
    </div> 

    <div class="row">
        <div class="col-md-12">
            @include('payslip.table_total')
        </div>
    </div>            

</div>
@stop

@section('footer')
    <script src="/js/payslip_edit.js"></script> 
@stop