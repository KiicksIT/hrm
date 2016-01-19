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
            {!! Form::model($payslip,['id'=>'form_submit', 'method'=>'PATCH','action'=>['PayslipController@update', $payslip->id]]) !!}            
            {!! Form::text('payslip_id', $payslip->id, ['id'=>'payslip_id','class'=>'hidden form-control']) !!}
            {!! Form::text('ot_total', null, ['class'=>'hidden form-control', 'ng-model'=>'ottotalModel']) !!}

                @include('payslip.form_ch')
            
                <div class="col-md-12">
                    <div class="pull-right" style="padding: 30px 95px 0px 0px;">
                        @if($payslip->status == 'Pending')
                            {!! Form::submit('Confirm', ['name'=>'confirm', 'class'=> 'btn btn-success', 'form'=>'form_submit']) !!}
                        @else
                            {!! Form::submit('Print', ['name'=>'print', 'class'=> 'btn btn-primary', 'form'=>'form_print']) !!}
                        @endif
                        {!! Form::submit('Confirm', ['name'=>'confirm', 'class'=> 'btn btn-success', 'form'=>'form_submit']) !!}
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
            @include('payslip.table_basic_ch')
        </div>
    </div>
            {!! Form::close() !!}
    <div class="row">
        <div class="col-md-6">
            @include('payslip.table_add_ch')
        </div>
            
        <div class="col-md-6">
            @include('payslip.table_deduct_ch')
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @include('payslip.table_ot_ch')
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @include('payslip.table_addother_ch')
        </div>
    </div> 

    <div class="row">
        <div class="col-md-12">
            @include('payslip.table_total_ch')
        </div>
    </div>            

</div>
@stop

@section('footer')
    <script src="/js/payslip_edit.js"></script> 
@stop