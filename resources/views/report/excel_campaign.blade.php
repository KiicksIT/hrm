
@foreach($campaigns as $campaign)
<table>
    <tbody>

    @if($campaign->status == 'Proceeding')
                {{$record = $campaign->status}}
                <tr><th></th><h4>{{$campaign->status}}</h4></tr>
                <tr>
                <th>#</th>
                <th>Event</th>
                <th>Start On</th>
                <th>Invest ($)</th>
                <th>Remark</th>
                </tr>
    @elseif($campaign->status == 'Complete')
                {{$record = $campaign->status}}
                <tr><th></th><h4>{{$campaign->status}}</h4></tr>
                <tr>
                <th>#</th>
                <th>Event</th>
                <th>Start On</th>
                <th>End On</th>
                <th>Invest ($)</th>
                <th>Return</th>
                <th>Earning/Loss</th>
                <th>Rate of Return</th>
                <th>Remark</th>
                </tr>
    @endif

            {{ $counter1 = 1 }}
            {{ $counter2 = 1 }}
            @foreach($campaigns as $campaign)
                @if(($campaign->status == 'Proceeding') && ($campaign->status == $record))
                    <tr>
                    <td>{{$counter1 ++}}</td>
                    <td>{{$campaign->name}}</td>
                    <td>{{$campaign->start_date}}</td>
                    <td>{{$campaign->invest}}</td>
                    <td>{{$campaign->remark}}</td>
                    </tr>
                @elseif($campaign->status == 'Complete' && ($campaign->status == $record))
                    <tr>
                    <td>{{$counter2 ++}}</td>
                    <td>{{$campaign->name}}</td>
                    <td>{{$campaign->start_date}}</td>
                    <td>{{$campaign->end_date}}</td>
                    <td>{{$campaign->invest}}</td>
                    <td>{{$campaign->return}}</td>
                    <td>{{$campaign->return - $campaign->invest}}</td>
                    <td>{{round(($campaign->return/$campaign->invest) * 100 , 0) .'%'}}</td>
                    <td>{{$campaign->remark}}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
@endforeach