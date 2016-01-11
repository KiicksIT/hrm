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
            margin-bottom: 7px;
        }

        .panel-heading{
            height: 25px;
            padding-top: 5px;
            padding-bottom: 5px;
            padding-right:0px;
            font-size: 18px;
        }
        .panel-body{
            padding-top: 0px;
            padding-bottom: 0px;
            padding-right:0px;
        }
        .panel-body .border{
            border: solid thin;
            height: 55px;
            width: 241px;
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
            font-size: 10px;
        }
        .content{
            padding-top: 15px;
            font-size: 12px;
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
                            <h4 style="margin-bottom: -20px"><strong>Key Employment Terms</strong></h4>
                            <br> 
                            <span style="font-size:55%;">All fields are mandatory, unless they are not applicable</span>                        
                        </div>
                        <div class="col-xs-5" style="border: solid thin; padding-left: 6px; height: 90%">
                             <span style="margin-bottom: -20px"><strong>Issue on: {{Carbon\Carbon::createFromFormat('d-F-Y', $person->created_at)->format('d/m/Y') }}</strong></span>
                            <br> 
                            <span style="font-size:65%;" class="text-center">All information accurate as of issuance date</span>
                        </div>
                    </div>

                    <div class="row" style="padding-top: 5px">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <strong>Section A | Details of Employment</strong>
                                </h3> 
                            </div>
                            <div class="panel-body">

                                <div class="row">
                                    {{-- company name --}}
                                    <div class="col-xs-6 border">
                                        <span class="subtitle"><strong>Company Name</strong></span> 
                                        <br> 
                                        <span class="content">{{$profile->name}}</span>
                                    </div>
                                    {{-- job title and duties --}}
                                    <div class="col-xs-6 border">
                                        <span class="subtitle"><strong>Job Title, Duties and Responsibilities</strong></span>
                                        <br> 
                                        <span class="content">{{$person->position->name}} - {{$person->position->remark}}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    {{-- employee name --}}
                                    <div class="col-xs-6 border">
                                        <span class="subtitle"><strong>Employee Name</strong></span>
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
                                        <span class="subtitle"><strong>Employee NRIC/FIN</strong></span>
                                        <br> 
                                        <span class="content">{{$person->nric_fin}}</span>
                                    </div> 
                                    {{-- duration --}}
                                    <div class="col-xs-6 border">
                                        <span class="subtitle"><strong>Duration of Employment</strong></span>
                                        <br>
                                        @if($person->contract_length and $person->contract_end) 
                                        <span class="content">{{Carbon\Carbon::createFromFormat('d-F-Y', $person->contract_start)->format('d/m/Y')}}</span>
                                        -
                                        <span class="content">{{Carbon\Carbon::createFromFormat('d-F-Y', $person->contract_end)->format('d/m/Y')}}
                                        </span>
                                        <br>
                                        ({{$person->contract_length}} Contract)
                                        @else
                                        -
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                {{-- start working date --}}
                                    <div class="col-xs-6 border">
                                        <span class="subtitle"><strong>Employment Start Date</strong></span>
                                        <br> 
                                        <span class="content">{{Carbon\Carbon::createFromFormat('d-F-Y', $person->start_date)->format('d/m/Y')}}</span>
                                    </div> 
                                    {{-- address --}}
                                    <div class="col-xs-6 border">
                                        <span class="subtitle"><strong>Place of Work</strong></span>
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
                                    <strong>Section B | Working Hours and Rest Days</strong>
                                </h3> 
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    {{-- work hour remark --}}
                                    <div class="col-xs-6 border" style="height: 110px;">
                                        <span class="subtitle"><strong>Details of Working Hours</strong></span> 
                                        <br> 
                                        <span class="content">{{$person->hour_remark}}</span>
                                    </div>
                                    {{-- work day remark --}}
                                    <div class="col-xs-6 border">
                                        <span class="subtitle"><strong>Number of Working Days Per Week</strong></span>
                                        <br> 
                                        <span class="content">{{$person->day_remark}}</span>
                                    </div>
                                    {{-- off day remark --}}
                                    <div class="col-xs-6 border">
                                        <span class="subtitle"><strong>Rest Day Per Week</strong></span>
                                        <br> 
                                        <span class="content">{{$person->off_remark}}</span>
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <strong>Section C | Salary</strong>
                                </h3> 
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    {{-- salary --}}
                                    <div class="col-xs-6 border" style="height:72px;">
                                        <span class="subtitle"><strong>Salary Period</strong></span> 
                                        <br> 
                                        <span class="content">{{$profile->payslip_start}} - {{$profile->payslip_end}}</span>
                                    </div>
                                    {{-- payday --}}
                                    <div class="col-xs-6 border" style="height:72px;">
                                        <span class="subtitle"><strong>Date(s) of Salary Payment</strong></span>
                                        <br> 
                                        <span class="content">{{$profile->payday}} of every calendar month</span>
                                        <br>
                                        <span class="subtitle"><strong>Date(s) of Overtime Payment</strong></span>
                                        <br> 
                                        <span class="content">{{$profile->ot_payday}} of every calendar month</span>
                                    </div>  
                                    {{-- ot payment --}}
                                    <div class="col-xs-6 border" style="height:72px;">
                                        <span class="subtitle"><strong>Overtime Payment Period</strong></span>
                                        <br> 
                                        <span class="content">{{$profile->payslip_otstart}} - {{$profile->payslip_otend}}</span>
                                    </div>
                                    {{-- payday --}}
                                    <div class="col-xs-6 border" style="height:72px;">
                                        <span class="subtitle"><strong>Basic Salary</strong>(Per Period)</span>
                                        <br> 
                                        <span class="content">{{$person->basic_rate}}/hour</span>
                                        <br>
                                        <span class="subtitle"><strong>Overtime Rate of Pay</strong></span>
                                        <br> 
                                        <span class="content">{{$person->ot_rate}} of hourly basic rate</span>
                                    </div>
                                    {{-- work day remark --}}
                                    <div class="col-xs-6 border">
                                        <span class="subtitle"><strong>Salary-Related Components</strong></span>
                                        <br> 
                                        <span class="content">{{$person->salary_component}}</span>
                                    </div>
                                    {{-- off day remark --}}
                                    <div class="col-xs-6 border">
                                        <span class="subtitle"><strong>CPF Contributions Payable</strong></span>
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
                </div>

                <div class="col-xs-6">
                    <div class="row">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <strong>Section D | Leave and Medical Benefits</strong>
                                </h3> 
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    {{-- leaves --}}
                                    <div class="col-xs-6 border" style="height: 120px;">
                                        <span class="subtitle"><strong>Types of Leave</strong></span> 
                                        <br> 
                                        <span style="font-size:65%;">(applicable if service is at least 3 months)</span>
                                        <br>
                                        <div class="row">
                                            <div class="col-xs-10">
                                                <span class="subtitle"><strong>Paid Annual/Year</strong></span>
                                                <br>
                                                <span class="subtitle"><strong>Paid Outpatient Sick/Year</strong></span>
                                                <br> 
                                                <span class="subtitle"><strong>Paid Hospitalisation/Year</strong></span>
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
                                        <span class="subtitle"><strong>Other Types of Leave</strong></span>
                                        <br> 
                                        <span class="content">{{$person->other_leave}}</span>
                                    </div>
                                    {{-- medical --}}
                                    <div class="col-xs-6 border" style="height:80px;">
                                        <span class="subtitle"><strong>Paid Medical Examination Fee</strong></span>
                                        <br> 
                                        @if($person->medic_exam)
                                        <span class="content text-center">Yes</span>
                                        @else
                                        <span class="content text-center">No</span>
                                        @endif
                                        <br>
                                        <span class="subtitle"><strong>Other Benefits</strong></span>
                                        <br> 
                                        <span class="content">{{$person->benefit_remark}}</span>                                        
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <strong>Section E | Others</strong>
                                </h3> 
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    {{-- leaves --}}
                                    <div class="col-xs-6 border" style="height: 120px;">
                                        <div class="row">
                                            <div class="col-xs-8">
                                                <span class="subtitle"><strong>Length of Probation:</strong></span>
                                                <br>
                                                <span class="subtitle"><strong>Probation Start:</strong></span>
                                                <br> 
                                                <span class="subtitle"><strong>Probation End:</strong></span>
                                            </div>
                                            <div class="col-xs-4">
                                                <span class="content text-right">{{$person->prob_length}}</span>
                                                <br>
                                                @if($person->prob_end and $person->prob_length)
                                                <span class="content text-right">{{Carbon\Carbon::createFromFormat('d-F-Y', $person->prob_start)->format('d/m/Y')}}</span>
                                                <br>
                                                <span class="content text-right">{{Carbon\Carbon::createFromFormat('d-F-Y', $person->prob_end)->format('d/m/Y')}}</span>
                                                @endif
                                            </div> 
                                        </div>
                                    </div>
                                    {{-- other leave --}}
                                    <div class="col-xs-6 border" style="height:120px;">
                                        <span class="subtitle"><strong>Notice Period for Termination of Employment</strong></span>
                                        <br> 
                                        <span style="font-size:65%;">(Initiated by either party whereby the length shall be the same)</span>
                                        <br>
                                        <span class="content">{{$profile->notice}}</span>
                                    </div>                                  
                                </div>
                            </div>
                        </div>
                    </div>                    
                </div>
                </div>                
            </div>
        </div>                                                                                      

    </body>
</html>    