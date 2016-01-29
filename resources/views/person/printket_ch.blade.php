<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <style type="text/css">
        .inline {
            display:inline;
        }
        body{
            font-size: 12px;
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
            border:solid thin black;            
            margin-bottom: 7px;
            margin-left: 10px;
        }

        .panel-heading{
            height: 25px;
            padding-top: 5px;
            padding-bottom: 5px;
            padding-right:0px;
            font-size: 18px;
            background-color: #d7d7db;
        }
        .panel-body{
            padding-top: 0px;
            padding-bottom: 0px;
            padding-right:0px;
        }
        .panel-body .border{
            border: solid thin;
            height: 55px;
            width: 242px;
        }        
        .row.no-pad {
          margin-right:0;
          margin-left:0;
        }
        .row.no-pad > [class*='col-'] {
          padding-right:0;
          padding-left:0;
        }
        .subtitle{
            font-size: 11px;
        }
        .content{
            padding-top: 15px;
            font-size: 13px;
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
            <div class="col-xs-12">
                <div class="row">
                <div class="col-xs-6">
                    <div class="row no-pad">
                        <div class="col-xs-7">
                            <h4 style="margin-bottom: -20px"><strong>主要雇佣条件</strong></h4>
                            <br> 
                            <span style="font-size:55%;">除不适用者,所有表格中项目必须填写</span>                        
                        </div>
                        <div class="col-xs-5" style="border: solid thin; padding-left: 15px; height: 90%">
                             <span style="margin-bottom: -20px"><strong>发放日: {{Carbon\Carbon::createFromFormat('d-F-Y', $person->created_at)->format('d/m/Y') }}</strong></span>
                            <br> 
                            <span style="font-size:65%;" class="text-center">所有信息于发放日准确无误</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="panel panel-default" style="padding-top: 5px; width:133px; height:171px">
                            <div class="panel-body">
                                <strong>Image | 照片</strong>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="padding-top: 5px">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <strong>A | 雇佣细节</strong>
                                </h3> 
                            </div>
                            <div class="panel-body">

                                <div class="row">
                                    {{-- company name --}}
                                    <div class="col-xs-6 border">
                                        <span class="subtitle"><strong>公司名称</strong></span> 
                                        <br> 
                                        <span class="content">{{$profile->name}}</span>
                                    </div>
                                    {{-- job title and duties --}}
                                    <div class="col-xs-6 border">
                                        <span class="subtitle"><strong>职位、主要职务与责任</strong></span>
                                        <br> 
                                        <span class="content">{{$person->position->name}}</span> 
                                        <br>- 
                                        <span style="font-size:65%;">{{$person->position->remark}}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    {{-- employee name --}}
                                    <div class="col-xs-6 border">
                                        <span class="subtitle"><strong>员工姓名</strong></span>
                                        <br> 
                                        <span class="content">{{$person->name}}</span>
                                    </div> 
                                    {{-- employee full/part time --}}
                                    <div class="col-xs-6 border"> 
                                        <span class="content">{{$person->contract_type}}</span>
                                    </div>
                                </div>
                                {{-- employee nric/fin --}}
                                <div class="row">
                                    <div class="col-xs-6 border">
                                        <span class="subtitle"><strong>员工身份证/外籍身份号码 (NRIC/FIN)</strong></span>
                                        <br> 
                                        <span class="content">{{$person->nric_fin}}</span>
                                    </div> 
                                    {{-- duration --}}
                                    <div class="col-xs-6 border">
                                        <span class="subtitle"><strong>受雇时期</strong></span>
                                        <br>
                                        @if($person->contract_length and $person->contract_end and ($person->contract_start != $person->contract_end) and $person->contract_length != 'None') 
                                        <span class="content">{{Carbon\Carbon::createFromFormat('d-F-Y', $person->contract_start)->format('d/m/Y')}}</span>
                                        -
                                        <span class="content">{{Carbon\Carbon::createFromFormat('d-F-Y', $person->contract_end)->format('d/m/Y')}}
                                        </span>
                                        <br>
                                        ({{$person->contract_length}} 合约)
                                        @else
                                        -
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                {{-- start working date --}}
                                    <div class="col-xs-6 border">
                                        <span class="subtitle"><strong>受雇开始日期</strong></span>
                                        <br> 
                                        <span class="content">{{Carbon\Carbon::createFromFormat('d-F-Y', $person->start_date)->format('d/m/Y')}}</span>
                                    </div> 
                                    {{-- address --}}
                                    <div class="col-xs-6 border">
                                        <span class="subtitle"><strong>工作地点</strong></span>
                                        <br>
                                        <span class="content">{{$profile->address}}</span>
                                    </div>
                                </div>                                                                                     
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <strong>B | 工作时间和休息日</strong>
                                </h3> 
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    {{-- work hour remark --}}
                                    <div class="col-xs-6 border" style="height: 110px;">
                                        <span class="subtitle"><strong>工作时间细节</strong></span> 
                                        <br> 
                                        <span class="content">{{$person->hour_remark}}</span>
                                    </div>
                                    {{-- work day remark --}}
                                    <div class="col-xs-6 border">
                                        <span class="subtitle"><strong>每周工作天数</strong></span>
                                        <br> 
                                        <span class="content">{{$person->day_remark}}</span>
                                    </div>
                                    {{-- off day remark --}}
                                    <div class="col-xs-6 border">
                                        <span class="subtitle"><strong>每周休日</strong></span>
                                        <br> 
                                        <span class="content">{{$person->off_remark}}</span>
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                    </div>                   
                </div>

                <div class="col-xs-6">
                    <div class="row">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <strong>C | 工资</strong>
                                </h3> 
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    {{-- salary --}}
                                    <div class="col-xs-6 border" style="height:72px;">
                                        <span class="subtitle"><strong>工资周期</strong></span> 
                                        <br> 
                                        <span class="content">{{$profile->payslip_start}} - {{$profile->payslip_end}}</span>
                                    </div>
                                    {{-- payday --}}
                                    <div class="col-xs-6 border" style="height:72px;">
                                        <span class="subtitle"><strong>工资支付日期</strong></span>
                                        <br> 
                                        <span class="content">每日历月份的 {{$profile->payday}} 日</span>
                                        <br>
                                        <span class="subtitle"><strong>加班费支付日期</strong></span>
                                        <br> 
                                        <span class="content">每日历月份的 {{$profile->ot_payday}} 日</span>
                                    </div>  
                                    {{-- ot payment --}}
                                    <div class="col-xs-6 border" style="height:72px;">
                                        <span class="subtitle"><strong>加班费支付周期</strong></span>
                                        <br> 
                                        <span class="content">{{$profile->payslip_otstart}} - {{$profile->payslip_otend}}</span>
                                    </div>
                                    {{-- payday --}}
                                    <div class="col-xs-6 border" style="height:72px;">
                                        <span class="subtitle"><strong>基本工资</strong>(每周期)</span>
                                        <br> 
                                        <span class="content">{{$person->basic}} ({{$person->basic_rate}}/小时)</span>
                                        <br>
                                        <span class="subtitle"><strong>加班费</strong></span>
                                        <br> 
                                        <span class="content">{{$person->ot_rate}} 每小时基本工资率</span>
                                    </div>
                                    {{-- work day remark --}}
                                    <div class="col-xs-6 border">
                                        <span class="subtitle"><strong>其它工资相关项目</strong></span>
                                        <br> 
                                        <span class="content">{{$person->salary_component}}</span>
                                    </div>
                                    {{-- off day remark --}}
                                    <div class="col-xs-6 border">
                                        <span class="subtitle"><strong>公积金缴交额</strong></span>
                                        <br>
                                        @if($person->resident) 
                                        <span class="content text-center">Yes</span>
                                        @else
                                        <span class="content text-center">No</span>
                                        @endif
                                    </div>                                                                        
                                </div>
                            </div>
                        </div>
                    </div>                 
                    <div class="row">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <strong>D | 休假和医疗福利</strong>
                                </h3> 
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    {{-- leaves --}}
                                    <div class="col-xs-6 border" style="height: 120px;">
                                        <span class="subtitle"><strong>休假种类</strong></span> 
                                        <br> 
                                        <span style="font-size:65%;">(至少工作满3个月,休假福利方可生效)</span>
                                        <br>
                                        <div class="row">
                                            <div class="col-xs-10">
                                                <span class="subtitle"><strong>每年带薪年假:</strong></span>
                                                <br>
                                                <span class="subtitle"><strong>每年门诊带薪病假:</strong></span>
                                                <br> 
                                                <span class="subtitle"><strong>每年住院带薪病假:</strong></span>
                                            </div>
                                            <div class="col-xs-2">
                                                <span class="content text-right">{{$person->paid_leave+0}}</span>
                                                <br>
                                                <span class="content text-right">{{$person->mc+0}}</span>
                                                <br>
                                                <span class="content text-right">{{$person->hospital_leave+0}}</span>
                                            </div> 
                                        </div>
                                    </div>
                                    {{-- other leave --}}
                                    <div class="col-xs-6 border" style="height:40px;">
                                        <span class="subtitle"><strong>其它休假种类</strong></span>
                                        <br>
                                        @if($person->other_leave) 
                                            <span class="content">{{$person->other_leave}}</span>
                                        @else
                                            -
                                        @endif
                                    </div>
                                    {{-- medical --}}
                                    <div class="col-xs-6 border" style="height:80px;">
                                        <span class="subtitle"><strong>所承担的医药费用</strong></span>
                                        <br>
                                        @if($person->medic_exam) 
                                        <span class="content text-center">Yes</span>
                                        @else
                                        <span class="content text-center">No</span>
                                        @endif
                                        <br>
                                        <span class="subtitle"><strong>其它福利</strong></span>
                                        <br>
                                        @if($person->benefit_remark) 
                                            <span class="content">{{$person->benefit_remark}}</span>                                        
                                        @else
                                            -
                                        @endif
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <strong>E | 其它事项</strong>
                                </h3> 
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    {{-- leaves --}}
                                    <div class="col-xs-6 border" style="height: 120px;">
                                        <div class="row">
                                            <div class="col-xs-7">
                                                <span class="subtitle"><strong>试用期限:</strong></span>
                                                <br>
                                                <span class="subtitle"><strong>试用期开始日期:</strong></span>
                                                <br> 
                                                <span class="subtitle"><strong>试用期结束日期:</strong></span>
                                            </div>
                                            <div class="col-xs-5">
                                                @if($person->prob_length and $person->prob_end)
                                                <span class="content text-right">{{$person->prob_length}}</span>
                                                <br>
                                                <span class="content text-right">{{Carbon\Carbon::createFromFormat('d-F-Y', $person->prob_start)->format('d/m/Y')}}</span>
                                                <br>
                                                <span class="content text-right">{{Carbon\Carbon::createFromFormat('d-F-Y', $person->prob_end)->format('d/m/Y')}}</span>
                                                @endif
                                            </div> 
                                        </div>
                                    </div>
                                    {{-- other leave --}}
                                    <div class="col-xs-6 border" style="height:120px;">
                                        <span class="subtitle"><strong>终止雇用合约的提前通知期</strong></span>
                                        <br> 
                                        <span style="font-size:65%;">(双方所给予彼此的通知期须为对等)</span>
                                        <br>
                                        <span class="content">{{$profile->notice}}</span>
                                    </div>                                  
                                </div>
                            </div>
                        </div>
                    </div> 

                        <div class="col-xs-6 col-xs-offset-6">
                            <div class="form-group">
                                <span class="text-center col-xs-12" style="margin-bottom:-1px; padding-top:80px">
                                    _______________________________
                                </span>
                                <span class="text-center col-xs-12" style="margin-top:0px">
                                    <strong>Agreed By</strong>
                                </span>
                            </div>                            
                        </div>                                       
                </div>
                </div>                
            </div>
        </div>                                                                                      

    </body>
</html>    