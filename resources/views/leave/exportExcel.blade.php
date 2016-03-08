<meta charset="utf-8">
<table>
    <tbody>

    <tr>
    <th></th>
    <h4>Leave Attachment</h4>
    </tr>
    <th>{{$person->name}}</th>
    <tr></tr>

    <tr>
    <th>#</th>
    <th>Remark</th>
    <th>Created On</th>
    </tr>
        @foreach($leave_attach as $index => $attach)
            <tr>
            <td>{{$index + 1}}</td>
            <td>{{$attach->remark}}</td>
            <td>{{$attach->created_at}}</td>
            </tr>
        @endforeach
    </tbody>
</table>