@inject('addotheritems', 'App\Addotheritem')

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title"><strong>(E) Other Additional Payments 其它付款</strong></h3>
    </div>

    <div class="panel-body">
        <div class="col-md-10 col-md-offset-1">
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
                <tr dir-paginate="addother in addothers | itemsPerPage:itemsPerPage3"  current-page="currentPage3"  
                ng-controller="repeatController3" pagination-id="3">
                    <td class="col-md-1 text-center">@{{ number }}</td>
                    <td class="col-md-7">@{{ addother.addotheritem.name }}</td>
                    <td class="col-md-3 text-right">@{{ (addother.addother_amount/100 * 100).toFixed(2) }}</td>
                    <td class="col-md-1 text-center">
                        @if($payslip->status == 'Pending')
                            <button class="btn btn-danger btn-sm btn-delete" ng-click="confirmDelete3(addother.id)">Delete</button>
                        @else
                            <button class="btn btn-danger btn-sm btn-delete" ng-click="confirmDelete3(addother.id)" disabled>Delete</button>
                        @endif
                    </td>
                </tr>
                <tr ng-if="addothers.length">
                    <td class="col-md-1 text-center"><strong>Total</strong></td>
                    <td colspan="1" class="col-md-3 text-right">
                        <td class="text-right" ng-model="totalAddModel"><strong>@{{ totalAddotherModel }}</strong></td>                            
                    </td>
                </tr>
                <tr ng-show="(addothers | filter:search).addothers == 0 || ! addothers.length">
                    <td colspan="4" class="text-center">No Records Found!</td>
                </tr>                         
            </tbody>                
        </table>

        <dir-pagination-controls max-size="5" direction-links="true" boundary-links="true" class="pull-left" pagination-id="3"> </dir-pagination-controls>
        </div>
    </div>

    <div class="panel-footer">
        <div class="col-md-10 col-md-offset-1">
        {!! Form::model($addother = new \App\Addother, ['id'=>'form_addother', 'action'=>['AddOtherController@store']]) !!}
        {!! Form::text('payslip_id', $payslip->id, ['class'=>'hidden form-control']) !!}
        <div class="row">
            <div class="col-md-7">
                <div class="form-group">
                    {!! Form::label('addotheritem_id', 'Item', ['class'=>'control-label']) !!}    
                    {!! Form::select('addotheritem_id', $addotheritems::lists('name', 'id'), null, ['id'=>'role', 'class'=>'select_tag form-control', 'multiple']) !!}
                </div>  
            </div>

            <div class="col-md-3">
                <div class="form-group"> 
                    {!! Form::label('amount', 'Amount ($)', ['class'=>'control-label']) !!}
                    {!! Form::text('addother_amount', null, ['class'=>'form-control']) !!}
                </div>
            </div>
            <div class="col-md-2">
            {!! Form::submit('Add', ['name'=>'add', 'class'=> 'btn btn-success', 'form'=>'form_addother', 'style'=>'margin-top:31px']) !!}
            </div>
        </div>

        
        {!! Form::close() !!} 
        </div>       
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
