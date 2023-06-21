<table id="assistantsOrodhaWilayaTable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th>Jina la Wilaya</th>
        <th>Idadi Ya  Halmashauri</th>
        <th>Idadi Ya Tarafa</th>
        <th>Idadi ya Kata</th>
        <th>Idadi ya Matawi</th>
        <th>Idadi ya Majimbo</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach( $areas as $key => $district )
            <tr>
                <td>{{ $district->name }}</td>
                <td>{{ $district->councils()->count() }}</td>
                <td>
                    {{--@php--}}
                        {{--$counter = 0;--}}
                        {{--foreach ( $district->councils() as $council ){--}}
                            {{--$number = $council->divisions()->count();--}}
                        {{--}--}}
                    {{--echo $counter;--}}
                    {{--@endphp--}}
                    {{ $district->divisions()->count() }}
                </td>
                <td>{{ $district->wards->count() }}</td>
                <td>{{ $district->branches->count() }}</td>
                <td>{{ $district->states->count() }}</td>
                <td>
                    <a href="{{ route('assistants.areas.halmashauri.orodha', $district->id) }}" class="btn btn-primary">fungua</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
