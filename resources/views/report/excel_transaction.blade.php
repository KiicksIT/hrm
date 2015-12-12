<table>
    <tbody>

    <tr>
    <th></th>
    <h4>Transaction Report</h4>
    </tr>

    @if(isset($date1) && isset($date2))
        <tr>
        <th></th>
        <th>From</th><td>{{$date1}}</td><th>To</th><td>{{$date2}}</td>
        </tr>
    @endif

    <tr></tr>

    <tr>
    <th></th>
    <th>Product</th>
    <th>Customer</th>
    <th>Purchase On</th>
    <th>Contract Start</th>
    <th>Contract End</th>
    <th>Amount</th>
    </tr>
        {{$mon_subtotal = 0}}
        @foreach($transactions as $index => $transaction)
            <tr>
            <td>{{$index + 1}}</td>
                <td>
                @foreach($transaction->items as $index2 => $item)
                {{$item->name}}
                @if($index2 + 1 != count($transaction->items))
                ,
                @endif
                @endforeach
                </td>
            <td>{{$transaction->person_id}}</td>
            <td>{{$transaction->created_at}}</td>
            <td>{{$transaction->contract_start}}</td>
            <td>{{$transaction->contract_end}}</td>
            <td>{{$transaction->amount}}</td>

            {{$mon_subtotal = $mon_subtotal + $transaction->amount}}
            </tr>
            @if(isset($mon_indicator))

                    @if((Carbon\Carbon::createFromFormat('d-M-y', $transaction->created_at)->format('F') != $mon_indicator) || ($index+1 == count($transactions)))
                    <tr>
                    <td></td>
                    <th>Subtotal ({{ $mon_indicator }})</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <th>{{$mon_subtotal}}</th>
                    {{$mon_subtotal = 0}}
                    {{$mon_indicator = Carbon\Carbon::createFromFormat('d-M-y', $transaction->created_at)->format('F')}}
                    </tr>
                    <tr></tr>
                    @endif
            @else
                    {{$mon_indicator = Carbon\Carbon::createFromFormat('d-M-y', $transaction->created_at)->format('F')}}
            @endif
        @endforeach
    </tbody>
</table>