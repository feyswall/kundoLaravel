@extends('layouts.super_system')

@section('content')
<div id="app">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="">Jina Kamili: {{ $leader->firstName }} {{ $leader->middleName == 'null' ? '' : $leader->middleName }}
                        {{ $leader->lastName }}</h4>
                        <h4>namba ya simu: <b>+{{  $leader->phone }}</b></h4>
                    <h4 class="mt-3 text-danger"><b>Nyadhifa / Eneo</b></h4>
                    <ul>
                        @foreach ($leader->posts as $post)
                            <li>{{ $post->name }} - <b>{{ $post->area }}</b></li>
                                @php
                                    $area_id = 0;
                                    $relation_table = null;
                                    $side_column = null;
                                    $area_type = null;
                                    $area = null;

                                    $side_value = $post->id;
                                    $leader_id = $leader->id;
                                @endphp

                            @if ($post->area == 'shina')
                                @php
                                    $relation_table = 'leader_trunk';
                                    $side_column = 'trunk_id';
                                    $area_type = 'App\Models\Trunk';
                                    $area_string = 'Shina la ';
                                @endphp
                            @endif

                            @if ($post->area == 'tawi')
                                @php
                                    $relation_table = 'branch_leader';
                                    $side_column = 'branch_id';
                                    $area_type = 'App\Models\Branch';
                                    $area_string = 'tawi la ';
                                @endphp
                            @endif

                            @if ($post->area == 'kata')
                                @php
                                    $relation_table = 'leader_ward';
                                    $side_column = 'ward_id';
                                    $area_type = 'App\Models\Ward';
                                    $area_string = 'kata ya ';
                                @endphp
                            @endif

                            @if ($post->area == 'tarafa')
                                @php
                                    $relation_table = 'division_leader';
                                    $side_column = 'division_id';
                                    $area_type = 'App\Models\Division';
                                    $area_string = 'tarafa ya ';
                                @endphp
                            @endif

                            @if ($post->area == 'halmashauri')
                                @php
                                    $relation_table = 'council_leader';
                                    $side_column = 'council_id';
                                    $area_type = 'App\Models\Council';
                                    $area_string = 'halmashauri ya ';
                                @endphp
                            @endif

                            @if ($post->area == 'wilaya')
                                @php
                                    $relation_table = 'district_leader';
                                    $side_column = 'district_id';
                                    $area_type = 'App\Models\District';
                                    $area_string = 'wilaya ya ';
                                @endphp
                            @endif

                            @if ($post->area == 'mkoa')
                                @php
                                    $relation_table = 'leader_region';
                                    $side_column = 'region_id';
                                    $area_type = 'App\Models\Region';
                                    $area_string = 'mkoa wa';
                                @endphp
                            @endif

                            @php
                                $area =  App\Http\Controllers\Super\AreasController::search_for_area(
                                    $relation_table,
                                    $side_column,
                                    $side_value,
                                    $leader_id,
                                    $area_type
                                );

                                if($area){
                                    echo $area_string.' <b>'.$area->name.'</b>';
                                }
                            @endphp


                            <ul class="mb-2">
                                @foreach ($post->groups as $group)
                                    <li>{{ $group->name }}</li>
                                @endforeach
                            </ul>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
