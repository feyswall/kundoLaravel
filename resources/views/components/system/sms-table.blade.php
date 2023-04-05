@props(['id', 'smses'])

<table id="{{ $id }}" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th>Group No_</th>
        <th>Sms</th>
        <th>Wahusika</th>
        <th>Date</th>
        <th></th>
    </tr>
    </thead>
    <tbody>

    @foreach( $smses as $key => $sms )
        <tr>
            <td>{{ $sms->request_id }}</td>
            <td>{{ $sms->message }}</td>
            <td>{{ $sms->leaders()->count() }}</td>
            <td>{{ $sms->created_at }}</td>
            <td>
                <a href="{{ route('sms.orodha.group.moja', $sms->id) }}" class="btn btn-primary">fungua</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
