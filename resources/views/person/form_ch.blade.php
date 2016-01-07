@inject('departments', 'App\Department')
@inject('positions', 'App\Position')

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('name', 'Name 姓名', ['class'=>'control-label']) !!}
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
                    {!! Form::label('nationality 国籍', 'Nationality', ['class'=>'control-label']) !!}
                    {!! Form::text('nationality', null, ['class'=>'form-control']) !!}
                </div>     
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <div class="col-md-5">
                        {!! Form::radio('gender', 'Male 男') !!}
                        {!! Form::label('Male', 'Male', ['class'=>'control-label']) !!}    
                    </div>
                    <div class="col-md-6">
                        {!! Form::radio('gender', 'Female 女') !!} 
                        {!! Form::label('Female', 'Female', ['class'=>'control-label']) !!}   
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::checkbox('resident') !!}
                    {!! Form::label('resident', 'Singaporean/ PR （公民／永久居民)', ['class'=>'control-label']) !!}
                </div>  
            </div> 
        </div>                      

        <div class="form-group">
            {!! Form::label('dob', 'DOB 生日', ['class'=>'control-label']) !!}
            <div class="input-group date">
            {!! Form::text('dob', null, ['class'=>'form-control', 'id'=>'dob', 'placeholder'=>'Birthdate']) !!}
            <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
            </div>
        </div>    

        <div class="form-group">
            {!! Form::label('contract_type', 'Contract Type 合约', ['class'=>'control-label']) !!}
            <select name="contract_type" class="select">
                    <option value="Full Time">Full Time 全职</option>        
                    <option value="Part Time">Part Time 兼职</option>
            </select>     
        </div> 

        <div class="form-group">
            {!! Form::label('department', 'Department 部门', ['class'=>'control-label']) !!}
            {!! Form::select('department_id', $departments::lists('name', 'id'), null, ['id'=>'department_id', 'class'=>'select form-control']) !!}
        </div> 

        <div class="form-group">
            {!! Form::label('position', 'Position 职位', ['class'=>'control-label']) !!}
            {!! Form::select('position_id', $positions::lists('name', 'id'), null, ['id'=>'position_id', 'class'=>'select form-control']) !!}
        </div>        

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('contact', 'Contact Num 联络号码', ['class'=>'control-label']) !!}
                    {!! Form::text('contact', null, ['class'=>'form-control']) !!}
                </div>     
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('email', 'Email 电子邮件', ['class'=>'control-label']) !!}
                    {!! Form::email('email', null, ['class'=>'form-control']) !!}
                </div> 
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('address', 'Address 地址', ['class'=>'control-label']) !!}
            {!! Form::textarea('address', null, ['class'=>'form-control', 'rows'=>'2']) !!}
        </div>  

        <div class="form-group">
            {!! Form::label('education', 'Highest Education 最高学历', ['class'=>'control-label']) !!}
            {!! Form::text('education', null, ['class'=>'form-control']) !!}
        </div> 

        <div class="form-group">
            {!! Form::label('person_remark', 'Remark 备注', ['class'=>'control-label']) !!}
            {!! Form::textarea('person_remark', null, ['class'=>'form-control', 'rows'=>'2']) !!}
        </div>             
     
    </div>

    <div class="col-md-6">                  

        <div class="form-group">
            {!! Form::label('start_date', 'Work Start 受雇开始', ['class'=>'control-label']) !!}
            <div class="input-group date">
            {!! Form::text('start_date', null, ['class'=>'form-control', 'id'=>'start_date']) !!}
            <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
            </div>
        </div> 

        <div class="form-group">
            {!! Form::label('hour_remark', 'Work Hour Details 工作时间细节', ['class'=>'control-label']) !!}
            {!! Form::textarea('hour_remark', null, ['class'=>'form-control', 'rows'=>'2', 'placeholder'=>'e.g. Mon - Fri: 9am - 6pm &#10;       Lunch break 1 hr']) !!}
        </div>   

        <div class="form-group">
            {!! Form::label('day_remark', 'Work Day Details 每周工作天数', ['class'=>'control-label']) !!}
            {!! Form::textarea('day_remark', null, ['class'=>'form-control', 'rows'=>'2', 'placeholder'=>'e.g. How Many Days per Week']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('off_remark', 'Rest Day Details 每周休日', ['class'=>'control-label']) !!}
            {!! Form::textarea('off_remark', null, ['class'=>'form-control', 'rows'=>'2', 'placeholder'=>'e.g. How Many Rest Day per Week']) !!}
        </div>                  
            
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('basic', 'Basic/ Month 基本工资/月 ($)', ['class'=>'control-label']) !!}
                    {!! Form::text('basic', null, ['class'=>'form-control', 'placeholder'=>'Total Basic for a Month, Numeric']) !!}
                </div> 
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('basic_rate', 'Hourly Basic Rate/ Hour 基本工资率／小时($)', ['class'=>'control-label']) !!}
                    {!! Form::text('basic_rate', null, ['class'=>'form-control', 'placeholder'=>'Numeric']) !!}
                </div>     
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('ot_rate', 'OT Rate 加班率 (e.g. 1.5)', ['class'=>'control-label']) !!}
            {!! Form::text('ot_rate', null, ['class'=>'form-control', 'placeholder'=>'Multiply Hourly Basic Rate, Fill if Applicable']) !!}
        </div> 

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('paid_leave', 'Paid Annual Leave/ Year 每年带薪年假', ['class'=>'control-label']) !!}
                    {!! Form::text('paid_leave', null, ['class'=>'form-control', 'placeholder'=>'Day(s)']) !!}
                </div> 
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('mc', 'Paid Outpatient Sick Leave/ Year 每年门诊带薪病假', ['class'=>'control-label']) !!}
                    {!! Form::text('mc', null, ['class'=>'form-control', 'placeholder'=>'Day(s)']) !!}
                </div>     
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('hospital_leave', 'Paid Hospitalise Leave/ Year 每年住院带薪病假', ['class'=>'control-label']) !!}
                    {!! Form::text('hospital_leave', null, ['class'=>'form-control', 'placeholder'=>'Day(s)']) !!}
                </div>     
            </div>        
        </div>

        <div class="row">
            <div class="col-md-10">
                <div class="form-group">
                    {!! Form::checkbox('medic_exam') !!}
                    {!! Form::label('medic_exam', 'Paid Medical Examination Fee 所承担的医药费用', ['class'=>'control-label']) !!}
                </div>  
            </div>
        </div>                   

        <div class="form-group">
            {!! Form::label('benefit_remark', 'Benefit 其它福利', ['class'=>'control-label']) !!}
            {!! Form::textarea('benefit_remark', null, ['class'=>'form-control', 'rows'=>'2']) !!}
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('prob_start', 'Probation Start 试用开始', ['class'=>'control-label']) !!}
                    <div class="input-group date">
                    {!! Form::text('prob_start', null, ['class'=>'form-control', 'id'=>'prob_start']) !!}
                    <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
                    </div>
                </div>
            </div> 

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('prob_length', 'Probation Length 试用期限', ['class'=>'control-label']) !!}
                    {!! Form::select('prob_length', [
                                                        0 =>'None', 
                                                        1 => '1 Month',
                                                        2 => '2 Months',
                                                        3 => '3 Months',
                                                        4 => '6 Months' 
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
        @if($person->prob_end != null)
        <div class="col-md-6">
            <div class="form-group">
                <div class="form-group">
                    {!! Form::label('prob_end', 'Probation End 试用期结束', ['class'=>'control-label']) !!}
                    {!! Form::text('prob_end', null, ['class'=>'form-control', 'readonly'=>'readonly']) !!}
                </div> 
            </div>
        </div>
        @endif

        @if($person->end_date or $person->leave_reason)
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('status', 'Status 状态', ['class'=>'control-label']) !!}
                {!! Form::text('status', 'Terminated', ['class'=>'form-control', 'readonly'=>'readonly']) !!}
            </div>
        </div>
        @else
            @if($person->prob_end < \Carbon\Carbon::now())
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('status', 'Status 状态', ['class'=>'control-label']) !!}
                        {!! Form::text('status', 'Active & Probation In Progress', ['class'=>'form-control', 'readonly'=>'readonly']) !!}
                    </div>
                </div>
            @else
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('status', 'Status 状态', ['class'=>'control-label']) !!}
                        {!! Form::text('status', 'Active & Confirmed', ['class'=>'form-control', 'readonly'=>'readonly']) !!}
                    </div>
                </div>            
            @endif
        @endif       
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('end_date', 'Work End 工作结束', ['class'=>'control-label']) !!}
                <div class="input-group date">
                {!! Form::text('end_date', null, ['class'=>'form-control', 'id'=>'end_date', 'placeholder'=>'Optional, if Staff Leaves Company']) !!}
                <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('leave_reason', 'Leave Reason 离开原因', ['class'=>'control-label']) !!}
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
