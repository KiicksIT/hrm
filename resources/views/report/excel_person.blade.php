@if($option == 'current')
    <table>
        <tbody>
        <tr>
        <th>#</th>
        <th>Name</th>
        <th>NRIC</th>
        <th>Email</th>
        <th>Contact</th>
        <th>Car Plate</th>
        <th>Address</th>
        <th>Remark</th>
        </tr>
            @foreach($people as $index => $person)
            <tr>
            <td>{{$index + 1}}</td>
            <td>{{$person->name}}</td>
            <td>{{$person->nric}}</td>
            <td>{{$person->email}}</td>
            <th>{{$person->contact}}</th>
            <td>{{$person->carplate}}</td>
            <td>{{$person->address}}</td>
            <td>{{$person->remark}}</td>
            @endforeach
        </tbody>
    </table>
@else
    <table>
        <tbody>
        <tr>
        <th>#</th>
        <th>Name</th>
        <th>NRIC</th>
        <th>Email</th>
        <th>Contact</th>
        <th>Car Plate</th>
        <th>Address</th>
        <th>Subject</th>
        <th>Status</th>
        <th>Remark</th>
        </tr>
            @foreach($people as $index => $person)
            <tr>
            <td>{{$index + 1}}</td>
            <td>{{$person->name}}</td>
            <td>{{$person->nric}}</td>
            <td>{{$person->email}}</td>
            <th>{{$person->contact}}</th>
            <td>{{$person->carplate}}</td>
            <td>{{$person->address}}</td>
            <td>{{$person->subject}}</td>
            <td>{{$person->status}}</td>
            <td>{{$person->remark}}</td>
            @endforeach
        </tbody>
    </table>
@endif
