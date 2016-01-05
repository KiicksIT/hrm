@extends('template')
@section('footer')
    <style type="text/css">
        .inline {
            display:inline;
        }
        body{
            font-size: 14px;
        }
        table{
            font-size: 14px;
            font-family: 'Times New Roman';
        }    
        th{
            font-size: 17px;
        }
        footer{
            position: fixed;
            height: 400px;
            bottom: 0;
            width: 100%;
        }   
        html, body{
            height: 100%;
        } 
        pre{
            font-size: 13px;
            font-family: 'Times New Roman';
            background-color: transparent;            
        } 
        .panel{
            margin-bottom: 20px;
        }

        .panel-heading{
            height: 30px;
            padding-top: 2px;
            padding-bottom: 0px;
        }
        .panel-body{
            height: 70%;
        }
       
       /* @media print {
          *,
          *:before,
          *:after {
            background: color hex code !important;
            color: #000 !important; 
          }*/
    </style>

        <div class="container">

            {{-- payslip from and to --}}
            <div class="row">
                <div class="col-xs-10 col-xs-offset-1 text-center" style="font-size:16px; padding-top: 50px;">
                    <span>Payslip for <strong>{{Carbon\Carbon::createFromFormat('d-F-Y', $payslip->payslip_from)->format('d M Y') }}</strong> to <strong>{{Carbon\Carbon::createFromFormat('d-F-Y', $payslip->payslip_to)->format('d M Y')}}</strong></span>
                </div>
            </div>

            <div class="row">
                <span class="col-md-12"></span>
            </div>

            {{-- employer name --}}
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Name of Employer</strong></h3> 
                    </div>
                    <div class="panel-body">
                        {{$profile->name}}
                    </div>
                </div>
            </div>

            {{-- employee name --}}
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Name of Employee</strong></h3> 
                    </div>
                    <div class="panel-body">
                        {{$person->name}}
                    </div>
                </div>
            </div> 

            {{-- showing items --}}
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <div class="row">
                                <strong>
                                <span class="col-xs-4">Item</span>
                                <span class="col-xs-8">Amount</span>
                                </strong>
                            </div>
                        </h3> 
                    </div>

                    {{-- total basic pay --}}
                    <ul class="list-group">
                        <li class="list-group-item row">
                            <span class="col-xs-4">
                                <strong>Basic Pay</strong>
                            </span>
                            <span class="col-xs-7">
                                <strong>{{$payslip->basic}}</strong>
                            </span> 
                            <span class="col-xs-1">
                                <strong>(A)</strong>
                            </span>
                        </li>                                                

                        {{-- total allowance --}}
                        <li class="list-group-item row">
                            <span class="col-xs-4">
                                <strong>Total Allowances</strong> <br> <span style="font-size:70%;">(Breakdown shown below)</span>
                            </span>
                            <span class="col-xs-7">
                                <strong>{{$payslip->add_total}}</strong>
                            </span> 
                            <span class="col-xs-1">
                                <strong>(B)</strong>
                            </span>
                        </li>

                        {{-- allowance breakdown --}}
                        @foreach($additions as $addition)

                            <li class="list-group-item row">
                                <span class="col-xs-4">
                                    {{$addition->additem->name}}
                                </span>
                                <span class="col-xs-8">
                                    {{$addition->amount}}
                                </span> 
                            </li>                                                       
                        @endforeach

                        {{-- total deduction --}}
                        <li class="list-group-item row">
                            <span class="col-xs-4">
                                <strong>Total Deductions</strong> <br> <span style="font-size:70%;">(Breakdown shown below)</span>
                            </span>
                            <span class="col-xs-7">
                                <strong>{{$payslip->deduct_total}}</strong>
                            </span> 
                            <span class="col-xs-1">
                                <strong>(C)</strong>
                            </span>
                        </li>

                        {{-- deduction breakdown --}}
                        @foreach($deductions as $deduction)
                            <li class="list-group-item row">
                                <span class="col-xs-4">
                                    {{$deduction->deductitem->name}}
                                </span>
                                <span class="col-xs-8">
                                    {{$deduction->amount}}
                                </span> 
                            </li>                                                        
                        @endforeach                                                

                    </ul>
                </div>
            </div>

            {{-- payment date --}}
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Date of Payment</strong></h3> 
                    </div>
                    <div class="panel-body">
                        {{Carbon\Carbon::createFromFormat('d-F-Y', $payslip->pay_date)->format('d M Y') }}
                    </div>
                </div>
            </div>

            {{-- payment mode --}}
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Mode of Payment</strong></h3> 
                    </div>
                    <div class="panel-body">
                        {{$payslip->pay_mode}}
                    </div>
                </div>
            </div>

            {{-- overtiem details --}}
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Overtime Details</strong></h3> 
                    </div>

                    <ul class="list-group">
                        <li class="list-group-item row">
                            <span class="col-xs-4">
                                Overtime Payment Period(s)
                            </span>
                            <span class="col-xs-8">
                                <strong>
                                {{Carbon\Carbon::createFromFormat('d-F-Y', $payslip->ot_from)->format('d M Y') }} to {{Carbon\Carbon::createFromFormat('d-F-Y', $payslip->ot_to)->format('d M Y') }} 
                                </strong>
                            </span>                                 
                        </li>
                        <li class="list-group-item row">
                            <span class="col-xs-4">
                                Overtime Hours Worked
                            </span>
                            <span class="col-xs-8">
                                {{$payslip->ot_hour}}
                            </span>                             
                        </li>
                        <li class="list-group-item row">
                            <span class="col-xs-4">
                                <strong>Total Overtime Pay</strong>
                            </span>
                            <span class="col-xs-7">
                                <strong>{{$payslip->ot_total}}</strong>
                            </span>
                            <span class="col-xs-1">
                                <strong>(D)</strong>
                            </span>                              
                        </li>
                    </ul>                                                                        
                </div>
            </div>

            {{-- showing addother --}}
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <div class="row">
                                <strong>
                                <span class="col-xs-4">Item</span>
                                <span class="col-xs-8">Amount</span>
                                </strong>
                            </div>
                        </h3> 
                    </div>

                    <ul class="list-group">
                        {{-- total addother --}}
                        <li class="list-group-item row">
                            <span class="col-xs-4">
                                <strong>Other Additional Payments</strong> <br> <span style="font-size:70%;">(Breakdown shown below)</span>
                            </span>
                            <span class="col-xs-7">
                                <strong>{{$payslip->other_total}}</strong>
                            </span> 
                            <span class="col-xs-1">
                                <strong>(E)</strong>
                            </span>
                        </li>

                        {{-- addother breakdown --}}
                        @foreach($addothers as $addother)

                            <li class="list-group-item row">
                                <span class="col-xs-4">
                                    {{$addother->addotheritem->name}}
                                </span>
                                <span class="col-xs-8">
                                    {{$addother->amount}}
                                </span> 
                            </li>                                                       
                        @endforeach

                        {{-- net pay --}}
                        <li class="list-group-item row">
                            <span class="col-xs-4">
                                <strong>Net Pay (A+B-C+D+E)</strong>
                            </span>
                            <span class="col-xs-8">
                                <strong>{{$payslip->net_pay}}</strong>
                            </span> 
                        </li> 

                        {{-- employer cpf contri --}}
                        <li class="list-group-item row">
                            <span class="col-xs-4">
                                Employer's CPF Contribution
                            </span>
                            <span class="col-xs-8">
                                <strong>{{$payslip->employercont_epf}}</strong>
                            </span> 
                        </li>                                                
                    </ul>                    
                </div>
            </div>                                                                                
@stop