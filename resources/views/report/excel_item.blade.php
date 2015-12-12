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
                        <th>Company</th>
                        <th>ROC No</th>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Office No</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>PostCode</th>
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
                                    <td>{{$item->person->company}}</td>
                                    <td>{{$item->person->roc_no}}</td>
                                    <td>{{$item->person->name}}</td>
                                    <th>{{$item->person->contact}}</th>
                                    <th>{{$item->person->office_no}}</th>
                                    <td>{{$item->person->email}}</td>
                                    <td>{{$item->person->address}}</td>
                                    <td>{{$item->person->postcode}}</td>
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