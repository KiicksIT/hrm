@inject('additems', 'App\AddItem')

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title"><strong>(B) Allowance</strong></h3>
    </div>

    <div class="panel-body">
        <table class="table table-list-search table-hover table-bordered table-condensed">
            <tr style="background-color: #DDFDF8">
                <th class="col-md-1 text-center">
                    #
                </th>
                <th class="col-md-7 text-center">
                    Name
                </th>          
                <th class="col-md-3 text-center">
                    Amount ($)
                </th> 
                <th class="col-md-1 text-center">
                    Action
                </th>                                                           
            </tr> 

            <tbody>
                <tr dir-paginate="addition in additions | itemsPerPage:itemsPerPage1"  current-page="currentPage1"  
                ng-controller="repeatController1" pagination-id="1">
                    <td class="col-md-1 text-center">@{{ number }}</td>
                    <td class="col-md-7">@{{ addition.additem.name }}</td>
                    <td class="col-md-3 text-right" ng-if="addition.add_amount != NULL">@{{ (addition.add_amount/100 * 100).toFixed(2) }}</td>
                    <td class="col-md-3 text-center" ng-if="addition.add_amount == NULL"><strong>TBC</strong></td>
                    <td class="col-md-1 text-center">
                        @if($payslip->status == 'Pending')
                            <button class="btn btn-danger btn-sm btn-delete" ng-click="confirmDelete1(addition.id)">Delete</button>
                        @else
                            <button class="btn btn-danger btn-sm btn-delete" ng-click="confirmDelete1(addition.id)" disabled>Delete</button>
                        @endif
                    </td>
                </tr>
                <tr ng-if="additions.length">
                    <td class="col-md-1 text-center"><strong>Total</strong></td>
                    <td colspan="1" class="col-md-3 text-right">
                        <td class="text-right" ng-model="totalAddModel"><strong>@{{ totalAddModel }}</strong></td>                            
                    </td>
                </tr>
                <tr ng-show="(additions | filter:search).additions == 0 || ! additions.length">
                    <td colspan="4" class="text-center">No Records Found!</td>
                </tr>                         
            </tbody>                
        </table>

        <dir-pagination-controls max-size="5" direction-links="true" boundary-links="true" class="pull-left" pagination-id="1"> </dir-pagination-controls>
    </div>

    <div class="panel-footer">
        {!! Form::model($addition = new \App\Addition, ['id'=>'form_add', 'action'=>['AdditionController@store']]) !!}
        {!! Form::text('payslip_id', $payslip->id, ['class'=>'hidden form-control']) !!}
        <div class="row">
            <div class="col-md-7">
                <div class="form-group">
                    {!! Form::label('additem_id', 'Item', ['class'=>'control-label']) !!}    
                    {!! Form::select('additem_id', $additems::lists('name', 'id'), null, ['id'=>'role', 'class'=>'select_tag form-control', 'multiple']) !!}
                </div>  
            </div>

            <div class="col-md-3">
                <div class="form-group"> 
                    {!! Form::label('add_amount', 'Amount ($)', ['class'=>'control-label']) !!}
                    {!! Form::text('add_amount', null, ['class'=>'form-control']) !!}
                </div>
            </div>
            <div class="col-md-2">
            {!! Form::submit('Add', ['name'=>'add', 'class'=> 'btn btn-success', 'form'=>'form_add', 'style'=>'margin-top:31px']) !!}
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
