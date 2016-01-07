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
            margin-bottom: 10px;
        }

        .panel-heading{
            height: 25px;
            padding-top: 5px;
            padding-bottom: 0px;
            font-size: 18px;
        }
        .panel-body{
            height: 60%;
        }
        .row.no-pad {
          margin-right:0;
          margin-left:0;
        }
        .row.no-pad > [class*='col-'] {
          padding-right:0;
          padding-left:0;
        }        
    </style>
    </head>

    <body>
        <div class="container">
            <div class="col-xs-12">
                <div class="col-xs-6">
                    <div class="row no-pad">
                        <div class="col-xs-7">
                            <h4 style="margin-bottom: -20px"><strong>Key Employment Terms</strong></h4>
                            <br> 
                            <span style="font-size:55%;">All fields are mandatory, unless they are not applicable</span>                        
                        </div>
                        <div class="col-xs-5" style="border: solid thin; padding-left: 6px">
                             <span style="margin-bottom: -10px"><strong>Issue on: {{Carbon\Carbon::createFromFormat('d-F-Y', $person->created_at)->format('d/m/Y') }}</strong></span>
                            <br> 
                            <span style="font-size:65%;" class="text-center">All information accurate as of issuance date</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>                                                                                      

    </body>
</html>    