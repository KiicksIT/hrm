@if($option == 'current')
    <table>
        <tbody>
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
        </tr>
            @foreach($people as $index => $person)
            <tr>
            <td>{{$index + 1}}</td>
            <td>{{$person->company}}</td>
            <td>{{$person->roc_no}}</td>
            <td>{{$person->name}}</td>
            <td>{{$person->contact}}</td>
            <td>{{$person->office_no}}</td>
            <td>{{$person->email}}</td>
            <td>{{$person->address}}</td>
            <td>{{$person->postcode}}</td>
            <td>{{$person->remark}}</td>
            @endforeach
        </tbody>
    </table>
@else
    <table>
        <tbody>
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
        <th>Subject</th>
        <th>Status</th>
        <th>Remark</th>
        </tr>
            @foreach($people as $index => $person)
            <tr>
            <td>{{$index + 1}}</td>
            <td>{{$person->company}}</td>
            <td>{{$person->roc_no}}</td>
            <td>{{$person->name}}</td>
            <td>{{$person->contact}}</td>
            <td>{{$person->office_no}}</td>
            <td>{{$person->email}}</td>
            <td>{{$person->address}}</td>
            <td>{{$person->postcode}}</td>
            <td>{{$person->subject}}</td>
            <td>{{$person->status}}</td>
            <td>{{$person->remark}}</td>
            @endforeach
        </tbody>
    </table>
@endif
