@inject('items', 'App\Item')

<div class="col-md-8 col-md-offset-2">

    <div class="form-group">
        {!! Form::label('item', 'Item', ['class'=>'control-label']) !!}
        {!! Form::select('item_list[]', $items::lists('name', 'id'), null, ['id'=>'item_list', 'class'=>'form-control', 'multiple']) !!}
    </div> 

    <div class="form-group">
        {!! Form::label('amount', 'Amount', ['class'=>'control-label']) !!}
        {!! Form::text('amount', null, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('contract_start', 'Contract From', ['class'=>'control-label']) !!}
        <div class="input-group date">
        {!! Form::text('contract_start', null, ['class'=>'date form-control', 'id'=>'contract_start']) !!}
        <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
        </div>
    </div> 

    <div class="form-group">
        {!! Form::label('contract_end', 'Contract To', ['class'=>'control-label']) !!}
        <div class="input-group date">
        {!! Form::text('contract_end', null, ['class'=>'date form-control', 'id'=>'contract_end']) !!}
        <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
        </div>
    </div>

    <div class="form-group">
        {!! Form::checkbox('reminder', null, ['class'=>'form-control']) !!}
        {!! Form::label('reminder', 'Remind 2 Months Before Expiry', ['class'=>'control-label', 'style'=>'padding-left: 10px;']) !!}
    </div>           

    <div class="form-group">
        {!! Form::label('transremark', 'Transaction Remark', ['class'=>'control-label']) !!}
        {!! Form::textarea('transremark', null, ['class'=>'form-control', 'rows'=>'3']) !!}
    </div>    

</div>

@section('footer')
<script>
    $('.date').datetimepicker({
       format: 'DD-MMMM-YYYY'
    });

    $('#item_list').select2({
        tags:true,

        createTag: function(newItem){
         
         return {
                    id: 'new:' + newItem.term,
                    text: newItem.term + ' [new]'
                };
        }

    });           
</script>
@stop
