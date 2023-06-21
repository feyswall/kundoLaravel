<table id="assistantsOrodhaShinaTable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
        <tr>
            <th>Jina la Shina</th>
            <th></th>
        </tr>
    </thead>
    <tbody>

    @foreach( $trunks as $key => $trunk )
        <tr>
            <td>{{ $trunk->name }}</td>
            <td><a href="{{ route("assistants.areas.shina.fungua", $trunk->id) }}" class="btn btn-primary">fungua</a></td>
        </tr>
    @endforeach

    </tbody>
</table>
