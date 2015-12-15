@extends('template')
@section('title')
{{ $EMAIL_TITLE }}
@stop
@section('content')

    <div class="row">        
    <a class="title_hyper pull-left" href="/massemail"><h1>{{ $EMAIL_TITLE }} <i class="fa fa-envelope-o"></i></h1></a>
    </div>


    <div class="col-md-6">
        {!! Form::open(['method'=>'PATCH','action'=>['MassEmailController@update']]) !!}

        <div class="panel panel-default">
            <div class="panel-heading">
                    <ul class="nav nav-pills nav-justified" role="tablist">
                      <li class="active"><a href="#customer" role="tab" data-toggle="tab">Customer</a></li>
                      <li><a href="#lead" role="tab" data-toggle="tab">Lead</a></li>
                      <li><a href="#prospect" role="tab" data-toggle="tab">Prospect</a></li>
                    </ul>
            </div>

            <div class="panel-body">
                <div class="tab-content">

                     <div class="tab-pane active" id="customer">
                        <div class="table-responsive">
                            <table class="table table-list-search table-hover table-bordered table-striped" id="customer">
                                <thead>
                                    <tr>
                                        <th> <input type="checkbox" id="checkAll1" /></th>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Contact</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>

                                <?php $index1 = $customers->firstItem(); ?>
                                <tbody>
                                    @unless(count($customers)>0)
                                    <td colspan="6" class="text-center">
                                    <h5>No Records Found</h5>
                                    </td>
                                    @else
                                    @foreach($customers as $customer)
                                    <tr>
                                        <td class="col-md-1">
                                        {!! Form::checkbox('selection[]', 'a'.$customer->id, Input::old('selection'), false, ['class'=>'selection']) !!}
                                        </td>
                                        <td class="col-md-1">{{$index1++}}</td>
                                        <td class="col-md-2">{{$customer->name}}</td>
                                        <td class="col-md-1">{{$customer->contact}}</td>
                                        <td class="col-md-1">{{$customer->email}}</td>
                                    </tr>
                                    @endforeach
                                    @endunless
                                </tbody>
                                <tfoot>
                                {!! $customers->render() !!}
                                </tfoot>
                            </table>
                        </div>
                     </div>

                     <div class="tab-pane" id="lead">
                        <div class="table-responsive">
                            <table class="table table-list-search table-hover table-bordered table-striped" id="lead_table">
                                <thead>
                                    <tr>
                                        <th> <input type="checkbox" id="checkAll2" /></th>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Contact</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>

                                <?php $index2 = $leads->firstItem(); ?>
                                <tbody>
                                    @unless(count($leads)>0)
                                    <td colspan="5" class="text-center">
                                    <h5>No Records Found</h5>
                                    </td>
                                    @else
                                    @foreach($leads as $lead)
                                    <tr>
                                        <td class="col-md-1">
                                        {!! Form::checkbox('selection[]', 'b'.$lead->id, Input::old('selection'), false, ['class'=>'selection']) !!}
                                        </td>
                                        <td class="col-md-1">{{$index2++}}</td>
                                        <td class="col-md-2">{{$lead->name}}</td>
                                        <td class="col-md-2">{{$lead->contact}}</td>
                                        <td class="col-md-3">{{$lead->email}}</td>
                                    </tr>
                                    @endforeach
                                    @endunless
                                </tbody>
                                <tfoot>
                                {!! $leads->render() !!}
                                </tfoot>
                            </table>
                        </div>
                     </div>

                     <div class="tab-pane" id="prospect">
                        <div class="table-responsive">
                            <table class="table table-list-search table-hover table-bordered table-striped" id="prospect_table">
                                <thead>
                                    <tr>
                                        <th> <input type="checkbox" id="checkAll3" /></th>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Contact</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>

                                <?php $index3 = $prospects->firstItem(); ?>
                                <tbody>
                                    @unless(count($prospects)>0)
                                    <td colspan="5" class="text-center">
                                    <h5>No Records Found</h5>
                                    </td>
                                    @else
                                    @foreach($prospects as $prospect)
                                    <tr>
                                        <td class="col-md-1">
                                        {!! Form::checkbox('selection[]', 'b'.$prospect->id, Input::old('selection'), false, ['class'=>'selection']) !!}
                                        </td>
                                        <td class="col-md-1">{{$index3++}}</td>
                                        <td class="col-md-4">{{$prospect->name}}</td>
                                        <td class="col-md-3">{{$prospect->contact}}</td>
                                        <td class="col-md-3">{{$prospect->email}}</td>
                                    </tr>
                                    @endforeach
                                    @endunless
                                </tbody>
                                <tfoot>
                                {!! $prospects->render() !!}
                                </tfoot>
                            </table>
                        </div>
                     </div>
                </div>
            </div>
        </div>
    </div>

                            @if(isset($emails))
                                @foreach($emails as $email)
                                {!! Form::hidden('email[]', $email, ['id'=>'email']) !!}
                                @endforeach
                            @endif

                        <div class="col-md-1">
                        {!! Form::submit('>', ['class'=> 'btn btn-success btn-md', 'style'=>'margin-left:15px']) !!}

                        </div>
    <div class="col-md-5">


                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                             <div class="col-md-8">
                                <h3 class="panel-title"></h3>
                             </div>

                                <div class="row">
                                    <ul class="list-inline list-unstyle">
                                        <li>
                                        <a class="btn btn-danger" href="{{ action('MassEmailController@index') }}">Reset</a>
                                        </li>
                                        <li>
                                        <a class="btn btn-success btn-md" id="email_list" href=mailto:{{$email_list}}>Send</a>
                                        </li>
                                    </ul>
                                </div>

                             </div>
                        </div>

                       <div class="panel-body">


                         @unless(count($emails)>0)
                         <h4>No Records Found</h4>
                         @else
                         @foreach($emails as $index => $email)
                             <li class="list-group-item">
                                 <div class="row">
                                     <div class="col-md-3">
                                     {{$index + 1}}.
                                     </div>

                                     <div class="col-md-5">
                                     {{$email}}
                                     </div>

                                 </div>
                             </li>
                         @endforeach
                         @endunless
                       </div>

                    <div class="panel-footer">
                        <label>{{count($emails)}} has selected</label>
                    </div>
                    {!! Form::close() !!}
                </div>

    </div>

<script>

$(function() {
    // for bootstrap 3 use 'shown.bs.tab', for bootstrap 2 use 'shown' in the next line
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        // save the latest tab; use cookies if you like 'em better:
        localStorage.setItem('lastTab', $(this).attr('href'));
    });

    // go to the latest tab, if it exists:
    var lastTab = localStorage.getItem('lastTab');
    if (lastTab) {
        $('[href="' + lastTab + '"]').tab('show');
    }
});


$('#checkAll1').change(function(){
    var all = this;
    $(this).closest('table').find('input[type="checkbox"]').prop('checked', all.checked);
});

$('#checkAll2').change(function(){
    var all = this;
    $(this).closest('table').find('input[type="checkbox"]').prop('checked', all.checked);
});

$('#checkAll3').change(function(){
    var all = this;
    $(this).closest('table').find('input[type="checkbox"]').prop('checked', all.checked);
});


</script>


@stop