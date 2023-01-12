<table id="superOrodhaHalmashauriTable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th>Jina la Halmashauri</th>
        <th>Idadi Ya  Tarafa</th>
        <th>Idadi Ya Kata</th>
        <th></th>
    </tr>
    </thead>
    <tbody>

        @foreach( $areas as $key => $council )
        <tr>
            <td>{{ $council->name }}</td>
            <td>{{ $council->divisions()->count() }}</td>
            <td>
                @php
                    $counter = 0;
                    foreach ( $district->councils() as $council ){
                        $number = $council->divisions()->count();
                    }
                echo $counter;
                @endphp
            </td>
            <td>
                <a href="{{ route("super.areas.tarafa.orodha", $council->id) }}" class="btn btn-primary">fungua</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>