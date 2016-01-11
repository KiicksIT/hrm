@inject('departments', 'App\Department')
@inject('positions', 'App\Position')

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('name', 'Name', ['class'=>'control-label']) !!}
            {!! Form::text('name', null, ['class'=>'form-control']) !!}
        </div> 

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('nric_fin', 'NRIC/ FIN', ['class'=>'control-label']) !!}
                    {!! Form::text('nric_fin', null, ['class'=>'form-control']) !!}
                </div>
            </div>
            <div class="col-md-6">    
                <div class="form-group">
                    {!! Form::label('nationality', 'Nationality', ['class'=>'control-label']) !!}
                    {!! Form::text('nationality', null, ['class'=>'form-control']) !!}
                </div>     
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <div class="col-md-5">
                        {!! Form::radio('gender', 'Male') !!}
                        {!! Form::label('Male', 'Male', ['class'=>'control-label']) !!}    
                    </div>
                    <div class="col-md-6">
                        {!! Form::radio('gender', 'Female') !!} 
                        {!! Form::label('Female', 'Female', ['class'=>'control-label']) !!}   
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::checkbox('resident', $person->resident) !!}
                    {!! Form::label('resident', 'Singaporean/ PR', ['class'=>'control-label']) !!}
                </div>  
            </div> 
        </div>                      

        <div class="form-group">
            {!! Form::label('dob', 'DOB', ['class'=>'control-label']) !!}
            <div class="input-group date">
            {!! Form::text('dob', null, ['class'=>'form-control', 'id'=>'dob', 'placeholder'=>'Birthdate']) !!}
            <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
            </div>
        </div>    

        <div class="form-group">
            {!! Form::label('contract_type', 'Contract Type', ['class'=>'control-label']) !!}
            <select name="contract_type" class="select">
                    <option value="Full Time">Full Time</option>        
                    <option value="Part Time">Part Time</option>
            </select>     
        </div> 

        <div class="form-group">
            {!! Form::label('department', 'Department', ['class'=>'control-label']) !!}
            {!! Form::select('department_id', $departments::lists('name', 'id'), null, ['id'=>'department_id', 'class'=>'select form-control']) !!}
        </div> 

        <div class="form-group">
            {!! Form::label('position', 'Position', ['class'=>'control-label']) !!}
            {!! Form::select('position_id', $positions::lists('name', 'id'), null, ['id'=>'position_id', 'class'=>'select form-control']) !!}
        </div>        

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('contact', 'Contact Num', ['class'=>'control-label']) !!}
                    {!! Form::text('contact', null, ['class'=>'form-control']) !!}
                </div>     
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('email', 'Email', ['class'=>'control-label']) !!}
                    {!! Form::email('email', null, ['class'=>'form-control']) !!}
                </div> 
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('address', 'Address', ['class'=>'control-label']) !!}
            {!! Form::textarea('address', null, ['class'=>'form-control', 'rows'=>'2']) !!}
        </div>  

        <div class="form-group">
            {!! Form::label('education', 'Highest Education', ['class'=>'control-label']) !!}
            {!! Form::text('education', null, ['class'=>'form-control']) !!}
        </div> 

        <div class="form-group">
            {!! Form::label('person_remark', 'Remark', ['class'=>'control-label']) !!}
            {!! Form::textarea('person_remark', null, ['class'=>'form-control', 'rows'=>'2']) !!}
        </div>             
     
    </div>

    <div class="col-md-6">                  

        <div class="form-group">
            {!! Form::label('start_date', 'Work Start', ['class'=>'control-label']) !!}
            <div class="input-group date">
            {!! Form::text('start_date', null, ['class'=>'form-control', 'id'=>'start_date']) !!}
            <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
            </div>
        </div> 

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('hour_remark', 'Work Hour Details ', ['class'=>'control-label']) !!}
                    {!! Form::textarea('hour_remark', null, ['class'=>'form-control', 'rows'=>'2', 'placeholder'=>'e.g. Mon - Fri: 9am - 6pm &#10;       Lunch break 1 hr']) !!}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('day_remark', 'Work Day Details ', ['class'=>'control-label']) !!}
                    {!! Form::textarea('day_remark', null, ['class'=>'form-control', 'rows'=>'2', 'placeholder'=>'e.g. How Many Days per Week']) !!}
                </div>
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('off_remark', 'Rest Day Details ', ['class'=>'control-label']) !!}
            {!! Form::textarea('off_remark', null, ['class'=>'form-control', 'rows'=>'2', 'placeholder'=>'e.g. How Many Rest Day per Week']) !!}
        </div>                  
            
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('basic', 'Basic/ Month ($)', ['class'=>'control-label']) !!}
                    {!! Form::text('basic', null, ['class'=>'form-control', 'placeholder'=>'Total Basic for a Month, Numeric']) !!}
                </div> 
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('basic_rate', 'Basic Rate/Hour ($)', ['class'=>'control-label']) !!}
                    {!! Form::text('basic_rate', null, ['class'=>'form-control', 'placeholder'=>'Numeric']) !!}
                </div>     
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('ot_rate', 'OT Rate (e.g. 1.5)', ['class'=>'control-label']) !!}
                    {!! Form::text('ot_rate', null, ['class'=>'form-control', 'placeholder'=>'Multiply Hourly Basic Rate, Fill if Applicable']) !!}
                </div>
            </div>            
        </div>

        <div class="form-group">
            {!! Form::label('salary_component', 'Salary Related Components', ['class'=>'control-label']) !!}
            {!! Form::textarea('salary_component', null, ['class'=>'form-control', 'rows'=>'2', 'placeholder'=>'Fixed Allowances, Deductions, Claims']) !!}
        </div>         

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('paid_leave', 'Paid Annual Leave/ Year', ['class'=>'control-label']) !!}
                    {!! Form::text('paid_leave', null, ['class'=>'form-control', 'placeholder'=>'Day(s)']) !!}
                </div> 
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('mc', 'Paid Outpatient Sick Leave/ Year', ['class'=>'control-label']) !!}
                    {!! Form::text('mc', null, ['class'=>'form-control', 'placeholder'=>'Day(s)']) !!}
                </div>     
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('hospital_leave', 'Paid Hospitalise Leave/ Year', ['class'=>'control-label']) !!}
                    {!! Form::text('hospital_leave', null, ['class'=>'form-control', 'placeholder'=>'Day(s)']) !!}
                </div>     
            </div>        
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('other_leave', 'Other Types of Leave', ['class'=>'control-label']) !!}
                    {!! Form::textarea('other_leave', null, ['class'=>'form-control', 'rows'=>'2']) !!}
                </div>     
            </div>         
            <div class="col-md-6" style="padding-top: 40px;">
                <div class="form-group">
                    {!! Form::checkbox('medic_exam', $person->medic_exam) !!}
                    {!! Form::label('medic_exam', 'Paid Medical Examination Fee', ['class'=>'control-label']) !!}
                </div>  
            </div>
        </div>                   

        <div class="form-group">
            {!! Form::label('benefit_remark', 'Benefit', ['class'=>'control-label']) !!}
            {!! Form::textarea('benefit_remark', null, ['class'=>'form-control', 'rows'=>'2']) !!}
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('prob_start', 'Probation Start', ['class'=>'control-label']) !!}
                    <div class="input-group date">
                    {!! Form::text('prob_start', null, ['class'=>'form-control', 'id'=>'prob_start']) !!}
                    <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
                    </div>
                </div>
            </div> 

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('prob_length', 'Probation Length', ['class'=>'control-label']) !!}
                    {!! Form::select('prob_length', [
                                                        'None' =>'None', 
                                                        '1 Month' => '1 Month',
                                                        '2 Months' => '2 Months',
                                                        '3 Months' => '3 Months',
                                                        '6 Months' => '6 Months' 
                                                    ], null, ['class'=>'select form-control']) !!}
                </div>
            </div>
        </div> 

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('contract_start', 'Contract Start', ['class'=>'control-label']) !!}
                    <div class="input-group date">
                    {!! Form::text('contract_start', null, ['class'=>'form-control', 'id'=>'prob_start']) !!}
                    <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
                    </div>
                </div>
            </div> 

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('contract_length', 'Contract Length', ['class'=>'control-label']) !!}
                    {!! Form::select('contract_length', [
                                                        'None' =>'None', 
                                                        '1 Year' => '1 Year',
                                                        '2 Years' => '2 Years',
                                                        '3 Years' => '3 Years',
                                                        '5 Years' => '5 Years' 
                                                    ], null, ['class'=>'select form-control']) !!}
                </div>
            </div>
        </div>                           
    </div>
</div>

@if(isset($person->id))
<div class="col-md-12">
    <hr>

    <div class="row">
        @if($person->end_date or $person->leave_reason)
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('status', 'Status', ['class'=>'control-label']) !!}
                {!! Form::text('status', 'Terminated', ['class'=>'form-control', 'readonly'=>'readonly']) !!}
            </div>
        </div>
        @else
            @if($person->prob_end != null and $person->prob_end < \Carbon\Carbon::now())
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('status', 'Status', ['class'=>'control-label']) !!}
                        {!! Form::text('status', 'Active & Probation In Progress', ['class'=>'form-control', 'readonly'=>'readonly']) !!}
                    </div>
                </div>
            @else            
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('status', 'Status', ['class'=>'control-label']) !!}
                        {!! Form::text('status', 'Active & Confirmed', ['class'=>'form-control', 'readonly'=>'readonly']) !!}
                    </div>
                </div>            
            @endif         
        @endif

        @if($person->prob_end != null)
        <div class="col-md-6">
            <div class="form-group">
                <div class="form-group">
                    {!! Form::label('prob_end', 'Probation End', ['class'=>'control-label']) !!}
                    {!! Form::text('prob_end', null, ['class'=>'form-control', 'readonly'=>'readonly']) !!}
                </div> 
            </div>
        </div>
        @endif
              
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('end_date', 'Work End', ['class'=>'control-label']) !!}
                <div class="input-group date">
                {!! Form::text('end_date', null, ['class'=>'form-control', 'id'=>'end_date', 'placeholder'=>'Optional, if Staff Leaves Company']) !!}
                <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('leave_reason', 'Leave Reason', ['class'=>'control-label']) !!}
                {!! Form::text('leave_reason', null, ['class'=>'form-control', 'placeholder'=>'Reason why stop working']) !!}
            </div>
        </div>
    </div>


</div>         

@endif

<script>
    $('.select').select2();

    $('.date').datetimepicker({
       format: 'DD-MMMM-YYYY'
    });    
</script>
