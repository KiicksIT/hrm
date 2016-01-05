<!DOCTYPE html>
<html lang="zh_CN">
    <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
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
        .panel{
            margin-bottom: 20px;
        }

        .panel-heading{
            height: 40px;
            padding-top: 5px;
            padding-bottom: 0px;
            font-size: 18px;
        }
        .panel-body{
            height: 70%;
        }
    
    </style>
    </head>

    <body>
        <div class="container">

            {{-- payslip from and to --}}
            <div class="row">
                <div class="col-xs-10 col-xs-offset-1 text-center" style="font-size:16px; padding-top: 50px;">
                    <span>薪水单（工资期） Payslip for <strong>{{Carbon\Carbon::createFromFormat('d-F-Y', $payslip->payslip_from)->format('d M Y') }}</strong> to <strong>{{Carbon\Carbon::createFromFormat('d-F-Y', $payslip->payslip_to)->format('d M Y')}}</strong></span>
                </div>
            </div>

            <div class="row">
                <span class="col-md-12"></span>
            </div>

            {{-- employer name --}}
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Name of Employer 公司名称</strong></h3> 
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
                        <h3 class="panel-title"><strong>Name of Employee 员工姓名</strong></h3> 
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
                                <span class="col-xs-4">Item 项目</span>
                                <span class="col-xs-8">Amount 款额</span>
                                </strong>
                            </div>
                        </h3> 
                    </div>

                    {{-- total basic pay --}}
                    <ul class="list-group">
                        <li class="list-group-item row">
                            <span class="col-xs-4">
                                <strong>Basic Pay 基本工资</strong>
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
                                <strong>Total Allowances 总补贴</strong> <br> <span style="font-size:70%;">(Breakdown shown below 细节如下)</span>
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
                                <strong>Total Deductions 总扣款</strong> <br> <span style="font-size:70%;">(Breakdown shown below 细节如下)</span>
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
                        <h3 class="panel-title"><strong>Date of Payment 发薪日期</strong></h3> 
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
                        <h3 class="panel-title"><strong>Mode of Payment 支付方式</strong></h3> 
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
                        <h3 class="panel-title"><strong>Overtime Details 加班细节</strong></h3> 
                    </div>

                    <ul class="list-group">
                        <li class="list-group-item row">
                            <span class="col-xs-4">
                                Overtime Payment Period(s) 加班费支付周期
                            </span>
                            <span class="col-xs-8">
                                <strong>
                                {{Carbon\Carbon::createFromFormat('d-F-Y', $payslip->ot_from)->format('d M Y') }} to {{Carbon\Carbon::createFromFormat('d-F-Y', $payslip->ot_to)->format('d M Y') }} 
                                </strong>
                            </span>                                 
                        </li>
                        <li class="list-group-item row">
                            <span class="col-xs-4">
                                Overtime Hours Worked 加班时数
                            </span>
                            <span class="col-xs-8">
                                {{$payslip->ot_hour}}
                            </span>                             
                        </li>
                        <li class="list-group-item row">
                            <span class="col-xs-4">
                                <strong>Total Overtime Pay 总加班费</strong>
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
                                <span class="col-xs-4">Item 项目</span>
                                <span class="col-xs-8">Amount 款额</span>
                                </strong>
                            </div>
                        </h3> 
                    </div>

                    <ul class="list-group">
                        {{-- total addother --}}
                        <li class="list-group-item row">
                            <span class="col-xs-4">
                                <strong>Other Additional Payments 其它付款</strong> <br> <span style="font-size:70%;">(Breakdown shown below 细节如下)</span>
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
                                <strong>Net Pay 净工资(A+B-C+D+E)</strong>
                            </span>
                            <span class="col-xs-8">
                                <strong>{{$payslip->net_pay}}</strong>
                            </span> 
                        </li> 

                        {{-- employer cpf contri --}}
                        <li class="list-group-item row">
                            <span class="col-xs-4">
                                Employer's CPF Contribution 雇主公积金缴交额
                            </span>
                            <span class="col-xs-8">
                                <strong>{{$payslip->employercont_epf}}</strong>
                            </span> 
                        </li>                                                
                    </ul>                    
                </div>
            </div>                                                                                      

    </body>
</html>    