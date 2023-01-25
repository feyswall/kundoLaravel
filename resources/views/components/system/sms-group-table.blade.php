@props(['id', 'sms'])

<table id="{{ $id }}" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th>Status</th>
        <th>Group No_</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>phone</th>
        <th></th>
    </tr>
    </thead>
    <tbody>

    @foreach( $sms->leaders as $key => $leader )
        <tr>
            <td>
                @php $resp = \App\Http\Controllers\SmsServicesControlller::deriveryReport($leader->phone, $sms->request_id) @endphp
                @if( $resp['status'] == 'fail')
                    <span><b class="text-primary">Loading...</b></span>
                    @else
                    @if( isset($resp['response']->error) )
                        <span><b class="text-primary">error</b></span>
                        @else
                        <span><b class="text-{{ $resp['response']->status == "DELIVERED" ? 'success' : 'primary' }}">{{ $resp['response']->status }}</b></span>
                    @endif
                @endif
            </td>
            <td>{{ $key + 1 }}</td>
            <td>{{ $leader->firstName }}</td>
            <td>{{ $leader->lastName }}</td>
            <td>{{ $leader->phone }}</td>
            <td>
                <a href="" class="btn btn-danger">delete</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>