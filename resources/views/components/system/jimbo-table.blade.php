<table id="superOrodhaJimboTable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        {{-- {{dd($states)}} --}}
        <th>Jina la Jimbo</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach( $states as $key => $state )
        <tr>
            <td>{{ $state->name }}</td>
            <td>
                <a href="{{ route("super.areas.wilaya.orodha", $district->id) }}" class="btn btn-primary">fungua</a>
            </td>
        </tr>
    @endforeach

    </tbody>
</table>