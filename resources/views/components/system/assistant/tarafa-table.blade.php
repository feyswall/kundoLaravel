<table id="assistantsOrodhaTafaraTable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th>Jina la Tarafa</th>
        <th>Idadi Ya  Kata</th>
        <th>Idadi Ya Matawi</th>
        <th></th>
    </tr>
    </thead>
    <tbody>

    @foreach( $areas as $key => $division )
        <tr>
            <td>{{ $division->name }}</td>
            <td>{{ $division->wards()->count() }}</td>
            <td>{{ $division->branches->count() }}</td>
            <td>
                <a href="{{ route("assistants.areas.kata.orodha", $division->id) }}" class="btn btn-primary">fungua</a>
            </td>
        </tr>
    @endforeach

    </tbody>
</table>
