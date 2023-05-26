<table id="superOrodhaKataTable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th>Jina la Kata</th>
        <th>Idadi Ya Matawi</th>
        <th></th>
    </tr>
    </thead>
    <tbody>

    @foreach( $areas as $key => $ward )
        <tr>
            <td>{{ $ward->name }}</td>
            <td>{{ $ward->branches()->count() }}</td>
            <td>
                <a href="{{ route("super.areas.tawi.orodha", $ward->id) }}" class="btn btn-primary btn-sm">fungua</a>
            </td>
        </tr>
    @endforeach

    </tbody>
</table>
