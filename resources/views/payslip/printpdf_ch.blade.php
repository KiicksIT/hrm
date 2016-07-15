<!DOCTYPE html>
<html lang="zh_CN">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <style type="text/css">
        .inline {
            display:inline;
        }
        body{
            font-size: 12px;
        }
        table{
            font-size: 12px;
            font-family: 'Times New Roman';
        }
        th{
            font-size: 13px;
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
            border:solid thin black;
            margin-bottom: 3px;
        }

        .row{
            padding-top: 4px;
            padding-bottom: 4px;
        }

        .panel-heading{
            height: 20px;
            padding-top: 3px;
            padding-bottom: 1px;
            font-size: 11px;
        }
        .panel-body{
            height: 32%;
        }

    @media print {
        .panel > .panel-heading{
            background-color: #d7d7db !important;
        }
      }

    </style>
    </head>

    <body>
        <div class="container">

            {{-- payslip from and to --}}
            <div class="row">
                <div class="col-xs-10 col-xs-offset-1 text-center" style="font-size:14px; padding-top:0px;">
                    <span>薪水单（工资期） Payslip for <strong>{{Carbon\Carbon::createFromFormat('d-F-Y', $payslip->payslip_from)->format('d M Y') }}</strong> to <strong>{{Carbon\Carbon::createFromFormat('d-F-Y', $payslip->payslip_to)->format('d M Y')}}</strong></span>
                </div>
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
                        {{$person->name}} ({{$person->contract_type}})
                    </div>
                </div>
            </div>

            {{-- showing items --}}
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <div class="row" style="margin-top: -3px;">
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
                            <span class="col-xs-4" style="border-right: solid thin black inherit;">
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
                                    {{$addition->add_amount}}
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
                                    {{$deduction->deduct_amount}}
                                </span>
                            </li>
                        @endforeach

                    </ul>
                </div>
            </div>

            {{-- payment date --}}
            <div class="col-xs-12 row">
                <div class="col-xs-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong>Date of Payment 发薪日期</strong></h3>
                        </div>
                        <div class="panel-body">
                            {{Carbon\Carbon::createFromFormat('d-F-Y', $payslip->pay_date)->format('d M Y') }}
                        </div>
                    </div>
                </div>

                <div class="col-xs-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong>Mode of Payment 支付方式</strong></h3>
                        </div>
                        <div class="panel-body">
                            {{$payslip->pay_mode}}

                            @if($payslip->pay_mode === 'Cheque' and $payslip->cheque_no)
                                 ({{$payslip->cheque_no}})
                            @endif

                        </div>
                    </div>
                </div>
            </div>

            {{-- payment mode --}}
            <div class="row">

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
                                Overtime Payment Period(s)
                                <br>
                                加班费支付周期
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
                                <br>
                                加班时数
                            </span>
                            <span class="col-xs-8">
                                <strong>{{$payslip->ot_hour}}</strong>  (Hourly OT Rate {{$person->basic_rate * $person->ot_rate}})
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
                            <div class="row" style="margin-top: -3px;">
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
                                <strong>Other Additional Payments
                                <br>
                                其它付款</strong> <br> <span style="font-size:70%;">(Breakdown shown below 细节如下)</span>
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
                                    {{$addother->addother_amount}}
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
                        @if($person->resident)
                        {{-- employer cpf contri --}}
                        <li class="list-group-item row">
                            <span class="col-xs-4">
                                Employer's CPF Contribution
                                <br>
                                雇主公积金缴交额
                            </span>
                            <span class="col-xs-8">
                                {{$payslip->employercont_epf}}
                            </span>
                        </li>
                        {{-- employee cpf --}}
                        <li class="list-group-item row">
                            <span class="col-xs-4">
                                Total CPF Amount
                                <br>
                                总公积金缴交额
                            </span>
                            <span class="col-xs-8">
                                <strong>{{number_format($payslip->employercont_epf + $employeecpf, 2)}}
                            </span>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>

            @if($payslip->remark)
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Remark 备注</strong></h3>
                    </div>
                    <div class="panel-body">
                        {{$payslip->remark}}
                    </div>
                </div>
            </div>
            @endif

            <div class="row">
                <div class="col-xs-6 col-xs-offset-6" >
                    <div class="form-group" style="margin-left: 30px;">
                        <span class="text-center col-xs-12" style="margin-bottom:-1px; padding-top:35px">
                            _______________________________
                        </span>
                        <span class="text-center col-xs-12" style="margin-top:0px">
                            <strong>Agreed By</strong>
                        </span>
                    </div>
                </div>
            </div>
    </body>
</html>