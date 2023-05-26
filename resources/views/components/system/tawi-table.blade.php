<table id="superOrodhaKataTable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th>Jina la Tawi</th>
        <th></th>
    </tr>
    </thead>
    <tbody>

    @foreach( $areas as $key => $branch )
        <tr>
            <td>{{ $branch->name }}</td>
            <td>
                <a href="{{ route("super.areas.tawi.fungua", $branch->id) }}"
                     class="btn btn-primary btn-sm">fungua</a>
            </td>
        </tr>
    @endforeach

    </tbody>
</table>
