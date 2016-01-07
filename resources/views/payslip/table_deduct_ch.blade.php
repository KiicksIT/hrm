@inject('deductitems', 'App\DeductItem')

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title"><strong>(C) Deduction 扣款</strong></h3>
    </div>

    <div class="panel-body">
        <table class="table table-list-search table-hover table-bordered table-condensed">
            <tr style="background-color: #DDFDF8">
                <th class="col-md-1 text-center">
                    #
                </th>
                <th class="col-md-7 text-center">
                    Name 项目
                </th>          
                <th class="col-md-3 text-center">
                    Amount 款额($)
                </th> 
                <th class="col-md-1 text-center">
                    Action
                </th>                                                           
            </tr> 

            <tbody>
                <tr dir-paginate="deduction in deductions | itemsPerPage:itemsPerPage2"  current-page="currentPage2"  
                ng-controller="repeatController2" pagination-id="2">
                    <td class="col-md-1 text-center">@{{ number }}</td>
                    <td class="col-md-7">@{{ deduction.deductitem.name }}</td>
                    <td class="col-md-3 text-right" ng-if="deduction.deduct_amount != NULL">@{{ (deduction.deduct_amount/100 * 100).toFixed(2) }}</td>
                    <td class="col-md-3 text-center" ng-if="deduction.deduct_amount == NULL"><strong>TBC</strong></td>
                    <td class="col-md-1 text-center">
                        @if($payslip->status == 'Pending')
                            <button class="btn btn-danger btn-sm btn-delete" ng-click="confirmDelete2(deduction.id)">Delete</button>
                        @else
                            <button class="btn btn-danger btn-sm btn-delete" ng-click="confirmDelete2(deduction.id)" disabled>Delete</button>
                        @endif
                    </td>
                </tr>
                <tr ng-if="deductions.length">
                    <td class="col-md-1 text-center"><strong>Total</strong></td>
                    <td colspan="1" class="col-md-3 text-right">
                        <td class="text-right" ng-model="totalDeductModel"><strong>@{{ totalDeductModel }}</strong></td>                            
                    </td>
                </tr>
                <tr ng-show="(deductions | filter:search).deductions == 0 || ! deductions.length">
                    <td colspan="4" class="text-center">No Records Found!</td>
                </tr>                         
            </tbody>                
        </table>

        <dir-pagination-controls max-size="5" direction-links="true" boundary-links="true" class="pull-left" pagination-id="2"> </dir-pagination-controls>
    </div>

    <div class="panel-footer">
        {!! Form::model($deduction = new \App\Deduction, ['id'=>'form_deduct', 'action'=>['DeductionController@store']]) !!}
        {!! Form::text('payslip_id', $payslip->id, ['class'=>'hidden form-control']) !!}
        <div class="row">
            <div class="col-md-7">
                <div class="form-group">
                    {!! Form::label('deductitem_id', 'Item', ['class'=>'control-label']) !!}    
                    {!! Form::select('deductitem_id', $deductitems::lists('name', 'id'), null, ['id'=>'role', 'class'=>'select_tag form-control', 'multiple']) !!}
                </div>  
            </div>

            <div class="col-md-3">
                <div class="form-group"> 
                    {!! Form::label('deduct_amount', 'Amount ($)', ['class'=>'control-label']) !!}
                    {!! Form::text('deduct_amount', null, ['class'=>'form-control']) !!}
                </div>
            </div>
            <div class="col-md-2">
            {!! Form::submit('Add', ['name'=>'deduct', 'class'=> 'btn btn-success', 'form'=>'form_deduct', 'style'=>'margin-top:31px']) !!}
            </div>
        </div>

        
        {!! Form::close() !!}        
    </div>
</div>

<script>
    $('.select_tag').select2({
        tags:true,
        maximumSelectionLength: 1,

        createTag: function(newItem){
         
         return {
            id: 'new:' + newItem.term,
            text: newItem.term + ' [new]'
                };
        }

    });     
</script>
