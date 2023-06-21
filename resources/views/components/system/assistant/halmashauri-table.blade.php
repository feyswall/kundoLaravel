<table id="assistantsOrodhaHalmashauriTable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        @foreach ($headers as $header)
          <th>{{$header}}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
        @foreach( $areas as $key => $council )
            <tr>
                <td>{{ $council->name }}</td>
                <td>{{ $council->divisions()->count() }}</td>
                <td>{{ $council->wards->count() }}</td>
                <td>{{ $council->branches->count() }}</td>
                <td>
                    <a href="{{ route("assistants.areas.tarafa.orodha", $council->id) }}" class="btn btn-primary">fungua</a>
                </td>
            </tr>
            @endforeach
    </tbody>
</table>
