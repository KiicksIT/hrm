@extends('template')
@section('title')
Payslip Policy
@stop
@section('content')

<div class="create_edit">
<div class="panel panel-primary">

    <div class="panel-heading">
        <h3 class="panel-title"><strong>Payslip Policy Default Setting</strong></h3>
    </div>

    <div class="panel-body">
        {!! Form::model($profile,['method'=>'PATCH','action'=>['ProfileController@update', $profile->id]]) !!}            

            @include('person.profile.form')

            <div class="col-md-12">
                <div class="pull-right form_button_right">
                    {!! Form::submit('Edit', ['class'=> 'btn btn-primary']) !!}
        {!! Form::close() !!}

                    <a href="/payslip" class="btn btn-default">Back</a>            
                </div>              
            </div>
    </div>
</div>
</div>

@stop