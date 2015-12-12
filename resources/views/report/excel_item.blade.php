@foreach($itemdata as $data)
   @foreach($items as $item)
        @unless(in_array($data->id, $records))
            @foreach($item->items as $findid)
                 @if($data->id == $findid->id)

                    <table>
                    <tbody>
                    <tr><th></th><h4>{{$data->name}}</h4></tr>
                    {{ $records[] = $data->id }}
                        <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>NRIC</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Car Plate</th>
                        <th>Address</th>
                        <th>Remark</th>
                        <th>Amount</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Transac Remark</th>
                        </tr>

                        {{ $counter = 1 }}
                        @foreach($items as $item)
                            @foreach($item->items as $findid)
                                @if($data->id == $findid->id)
                                    <tr>
                                    <td>{{$counter ++}}</td>
                                    <td>{{$item->person->name}}</td>
                                    <td>{{$item->person->nric}}</td>
                                    <th>{{$item->person->contact}}</th>
                                    <td>{{$item->person->email}}</td>
                                    <td>{{$item->person->carplate}}</td>
                                    <td>{{$item->person->address}}</td>
                                    <td>{{$item->person->remark}}</td>
                                    <td>{{$item->amount}}</td>
                                    <td>{{$item->contract_start}}</td>
                                    <td>{{$item->contract_end}}</td>
                                    @if(isset($item->transremark))
                                    <td>{{$item->transremark}}</td>
                                    @else
                                    <td>-</td>
                                    @endif
                                    </tr>
                                @endif
                            @endforeach
                        @endforeach
                    </tbody>
                    </table>

                    @endif
              @endforeach
           @endunless
   @endforeach

@endforeach