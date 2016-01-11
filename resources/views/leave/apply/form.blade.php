@inject('people', 'App\Person')

<div class="col-md-8 col-md-offset-2" ng-app="app" ng-controller="applyleaveController">
    {!! Form::text('person_id', $person->id, ['id'=>'person_id','class'=>'hidden form-control']) !!}
    {!! Form::text('status', 'Pending', ['id'=>'status','class'=>'hidden form-control']) !!}

    @if(isset($applyleave->id))
    <div class="form-group">
        {!! Form::label('status', 'Status', ['class'=>'control-label']) !!}
        {!! Form::text('status', $applyleave->status, ['class'=>'form-control', 'disabled'=>'disabled']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('leave_type', 'Leave Type', ['class'=>'control-label']) !!}
        @if($applyleave->status == 'Pending')    
            @if($applyleave->leave_type == 'Paid Leave')
                {!! Form::text('leave_type', 
                                            'Paid Leave   (Before) '.$person->leave->total_paidleave.' - '.$applyleave->day_num.' = '.($person->leave->total_paidleave - $applyleave->day_num).' (After)', 
                                            ['class'=>'form-control', 'disabled'=>'disabled']) !!}
            @elseif($applyleave->leave_type == 'Paid Sick Leave')
                {!! Form::text('leave_type', 
                                            'Paid Sick Leave   (Before) '.$person->leave->total_paidsickleave.' - '.$applyleave->day_num.' = '.($person->leave->total_paidsickleave - $applyleave->day_num).' (After)', 
                                            ['class'=>'form-control', 'disabled'=>'disabled']) !!}
            @elseif($applyleave->leave_type == 'Paid Hospitalisation Leave')
                {!! Form::text('leave_type', 
                                            'Paid Hospitalisation Leave   (Before) '.$person->leave->total_paidhospleave.' - '.$applyleave->day_num.' = '.($person->leave->total_paidhospleave - $applyleave->day_num).' (After)', 
                                            ['class'=>'form-control', 'disabled'=>'disabled']) !!}
            @elseif($applyleave->leave_type == 'Unpaid Leave')
                {!! Form::text('leave_type', 
                                            'Unpaid Leave', 
                                            ['class'=>'form-control', 'disabled'=>'disabled']) !!}                                        
            @endif
            <p><em>*Calculation only valid after Leave has been Approved</em></p>
        @else
            @if($applyleave->leave_type == 'Paid Leave')
                {!! Form::text('leave_type', 
                                            'Paid Leave', 
                                            ['class'=>'form-control', 'disabled'=>'disabled']) !!}
            @elseif($applyleave->leave_type == 'Paid Sick Leave')
                {!! Form::text('leave_type', 
                                            'Paid Sick Leave', 
                                            ['class'=>'form-control', 'disabled'=>'disabled']) !!}
            @elseif($applyleave->leave_type == 'Paid Hospitalisation Leave')
                {!! Form::text('leave_type', 
                                            'Paid Hospitalisation Leave', 
                                            ['class'=>'form-control', 'disabled'=>'disabled']) !!}
            @elseif($applyleave->leave_type == 'Unpaid Leave')
                {!! Form::text('leave_type', 
                                            'Unpaid Leave', 
                                            ['class'=>'form-control', 'disabled'=>'disabled']) !!}                                        
            @endif
        @endif            
    </div>

    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                {!! Form::label('leave_from', 'Leave From', ['class'=>'control-label']) !!}
                <div class="input-group date">
                {!! Form::text('leave_from', null, ['class'=>'form-control', 'id'=>'leave_from', 'disabled'=>'disabled']) !!}
                <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="form-group">
                {!! Form::label('leave_to', 'Leave To', ['class'=>'control-label']) !!}
                <div class="input-group date">
                {!! Form::text('leave_to', null, ['class'=>'form-control', 'id'=>'leave_to', 'disabled'=>'disabled']) !!}
                <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <div class="form-group">
                {!! Form::label('day_num', 'Total Day', ['class'=>'control-label']) !!}
                {!! Form::text('day_num', null, ['class'=>'form-control', 'disabled'=>'disabled']) !!}
            </div>            
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('reason', 'Reason', ['class'=>'control-label']) !!}
        {!! Form::textarea('reason', null, ['class'=>'form-control', 'rows'=>'2', 'disabled'=>'disabled']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('leave_type', 'Handover To', ['class'=>'control-label']) !!}
        {!! Form::text('leave_type', $applyleave->handover_person, ['class'=>'form-control', 'disabled'=>'disabled']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('leaveremark', 'Remark', ['class'=>'control-label']) !!}
        {!! Form::textarea('leaveremark', null, ['class'=>'form-control', 'rows'=>'2']) !!}
    </div>    
    @else
    <div class="form-group">
        {!! Form::label('leave_type', 'Leave Type', ['class'=>'control-label']) !!}
        {!! Form::select('leave_type', [
                                            ''  => null,
                                            '1' =>'Paid Leave'.' - '.$person->leave->total_paidleave.' day(s) available', 
                                            '2' => 'Paid Sick Leave'.' - '.$person->leave->total_paidsickleave.' day(s) available',
                                            '3' => 'Hospitalisation Leave'.' - '.$person->leave->total_paidhospleave.' day(s) available',
                                            '4' => 'Unpaid Leave'

                                        ], null, ['class'=>'select form-control']) !!}
    </div>

    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                {!! Form::label('leave_from', 'Leave From', ['class'=>'control-label']) !!}
                <div class="input-group date">
                {!! Form::text('leave_from', null, ['class'=>'form-control', 'id'=>'leave_from']) !!}
                <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="form-group">
                {!! Form::label('leave_to', 'Leave To', ['class'=>'control-label']) !!}
                <div class="input-group date">
                {!! Form::text('leave_to', null, ['class'=>'form-control', 'id'=>'leave_to']) !!}
                <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <div class="form-group">
                {!! Form::label('day_num', 'Total Day', ['class'=>'control-label']) !!}
                {!! Form::text('day_num', null, ['class'=>'form-control']) !!}
            </div>            
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('reason', 'Reason', ['class'=>'control-label']) !!}
        {!! Form::textarea('reason', null, ['class'=>'form-control', 'rows'=>'2']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('handover_person', 'Handover To', ['class'=>'control-label']) !!}
        <select id="handover_person" name="handover_person" class="select form-control" 
                ng-model="applyleaveModel">
                <option value=""></option>
                <option ng-repeat="person in people" ng-value="person.name" value="@{{person.name}}">
                    @{{person.department.name}} - @{{person.position.name}} - @{{person.name}}
                </option>                            
        </select>        
    </div>            
    @endif 
    
</div>

<script src="/js/applyleave_create.js"></script>
<script>
    $('.select').select2({
        placeholder: 'Select...'
    });

    $('.date').datetimepicker({
       format: 'DD-MMMM-YYYY'
    });     
</script>
