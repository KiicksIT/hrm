@inject('departments', 'App\Department')
@inject('positions', 'App\Position')

<div class="row">
    <div class="col-md-6">
{{--
    <div class="row">

        @if($person->avatar_path)
            <div class="panel panel-default col-md-6 col-md-offset-1" style="padding-top: 0px; padding-left:0px; width:133px; height:171px">
                {!! Html::image($person->avatar_path, 'alt', array( 'width' => 133, 'height' => 171 )) !!}
            </div>

            <div class="col-md-5 col-md-offset-1" style="padding-top: 40px;">
                <div class="form-group">
                    {!! Form::label('avatar', 'Change Avatar', ['class'=>'control-label']) !!}
                    {!! Form::file('avatar', null, ['class'=>'field']) !!}
                </div>
            </div>
        @else
            <div class="panel panel-default col-md-6 col-md-offset-1" style="padding-top: 5px; width:133px; height:171px">
                <strong>No Image</strong>
            </div>

            <div class="col-md-5 col-md-offset-1" style="padding-top: 40px;">
                <div class="form-group">
                    {!! Form::label('avatar', 'Upload Avatar', ['class'=>'control-label']) !!}
                    {!! Form::file('avatar', null, ['class'=>'field']) !!}
                </div>
            </div>
        @endif


    </div>
 --}}
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
                    {!! Form::label('nationality', 'Nationality 国籍', ['class'=>'control-label']) !!}
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
                    {!! Form::checkbox('resident', $person->resident) !!}
                    {!! Form::label('resident', 'Singaporean/ PR（公民／永久居民)', ['class'=>'control-label']) !!}
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
            {!! Form::select('contract_type', ['Full Time'=>'Full Time', 'Part Time'=>'Part Time'], null, ['id'=>'contract_type', 'class'=>'select form-control']) !!}
        </div>

{{--         <div class="form-group">
            {!! Form::label('department', 'Department 部门', ['class'=>'control-label']) !!}
            {!! Form::select('department_id', $departments::lists('name', 'id'), null, ['id'=>'department_id', 'class'=>'select form-control']) !!}
        </div> --}}

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

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('hour_remark', 'Work Hour Details 工作时间细节', ['class'=>'control-label']) !!}
                    {!! Form::textarea('hour_remark', null, ['class'=>'form-control', 'rows'=>'2', 'placeholder'=>'e.g. Mon - Fri: 9am - 6pm &#10;       Lunch break 1 hr']) !!}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('day_remark', 'Work Day Details 每周工作天数', ['class'=>'control-label']) !!}
                    {!! Form::textarea('day_remark', null, ['class'=>'form-control', 'rows'=>'2', 'placeholder'=>'e.g. How Many Days per Week']) !!}
                </div>
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('off_remark', 'Rest Day Details 每周休日', ['class'=>'control-label']) !!}
            {!! Form::textarea('off_remark', null, ['class'=>'form-control', 'rows'=>'2', 'placeholder'=>'e.g. How Many Rest Day per Week']) !!}
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('basic', 'Basic/ Month 基本工资/月($)', ['class'=>'control-label']) !!}
                    {!! Form::text('basic', null, ['class'=>'form-control', 'placeholder'=>'Total Basic for a Month, Numeric']) !!}
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('basic_rate', 'Basic Rate/Hour 基本工资率／小时($)', ['class'=>'control-label']) !!}
                    {!! Form::text('basic_rate', null, ['class'=>'form-control', 'placeholder'=>'Numeric']) !!}
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('ot_rate', 'OT Rate 加班率(e.g. 1.5)', ['class'=>'control-label']) !!}
                    {!! Form::text('ot_rate', null, ['class'=>'form-control', 'placeholder'=>'Multiply Hourly Basic Rate, Fill if Applicable']) !!}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('salary_component', 'Salary Related Components', ['class'=>'control-label', 'style'=>'margin-bottom:0px;']) !!}
                    {!! Form::label('salary_component', '工资相关项目', ['class'=>'control-label', 'style'=>'padding-top:0px;']) !!}
                    {!! Form::textarea('salary_component', null, ['class'=>'form-control', 'rows'=>'3', 'placeholder'=>'Fixed Allowances, Deductions, Claims']) !!}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('total_earned', 'Total/ Month', ['class'=>'col-md-12 row control-label', 'style'=>'margin-bottom:0px;']) !!}
                    {!! Form::label('total_earned', '总工资／月($)', ['class'=>'col-md-12 row control-label', 'style'=>'padding-top:0px;']) !!}
                    {!! Form::text('total_earned', null, ['class'=>'form-control', 'placeholder'=>'Total Earned Salary for a Month']) !!}
                </div>
            </div>
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
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('other_leave', 'Other Types of Leave 其它休假种类', ['class'=>'control-label']) !!}
                    {!! Form::textarea('other_leave', null, ['class'=>'form-control', 'rows'=>'2']) !!}
                </div>
            </div>
            <div class="col-md-6" style="padding-top: 40px;">
                <div class="form-group">
                    {!! Form::checkbox('medic_exam', $person->medic_exam) !!}
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
                    {!! Form::label('contract_start', 'Contract Start 合约开始', ['class'=>'control-label']) !!}
                    <div class="input-group date">
                    {!! Form::text('contract_start', null, ['class'=>'form-control', 'id'=>'prob_start']) !!}
                    <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('contract_length', 'Contract Length 合约期限', ['class'=>'control-label']) !!}
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
                {!! Form::text('status', 'Terminated 停职', ['class'=>'form-control', 'readonly'=>'readonly']) !!}
            </div>
        </div>
        @else
            @if($person->prob_end != null and $person->prob_end < \Carbon\Carbon::now())
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('status', 'Status', ['class'=>'control-label']) !!}
                        {!! Form::text('status', 'Active & Probation In Progress 试用中', ['class'=>'form-control', 'readonly'=>'readonly']) !!}
                    </div>
                </div>
            @else
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('status', 'Status', ['class'=>'control-label']) !!}
                        {!! Form::text('status', 'Active & Confirmed 正式员工', ['class'=>'form-control', 'readonly'=>'readonly']) !!}
                    </div>
                </div>
            @endif
        @endif

        @if($person->prob_end != null)
        <div class="col-md-6">
            <div class="form-group">
                <div class="form-group">
                    {!! Form::label('prob_end', 'Probation End 试用结束', ['class'=>'control-label']) !!}
                    {!! Form::text('prob_end', null, ['class'=>'form-control', 'readonly'=>'readonly']) !!}
                </div>
            </div>
        </div>
        @endif

    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('end_date', 'Work End 停职日期', ['class'=>'control-label']) !!}
                <div class="input-group date">
                {!! Form::text('end_date', null, ['class'=>'form-control', 'id'=>'end_date', 'placeholder'=>'Optional, if Staff Leaves Company']) !!}
                <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('leave_reason', 'Leave Reason 停职原因', ['class'=>'control-label']) !!}
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
