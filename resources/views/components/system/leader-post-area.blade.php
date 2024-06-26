@props(['leader', 'post'])
<div>
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
        $area =  App\Http\Controllers\Super\AreasController::search_for_area(
            $relation_table,
            $side_column,
            $side_value,
            $leader_id,
            $area_type
        );
        $branch = $area->branch;
        $ward = $area->ward;
        $division = $area->division;
        $council = $area->council;
        $district = $area->district;
        $region = $area->region;
        $area_stack = 'mkoa - '.$region->name.' | ';
        $area_stack .= 'wilaya - '.$district->name.' | ';
        $area_stack .= 'halmashauri - '.$council->name.' | ';
        $area_stack .= 'tarafa - '.$division->name.' | ';
        $area_stack .= 'kata - '.$ward->name.' | ';
        $area_stack .= 'branch - '.$branch->name.' | ';
        if($area){
            echo "<p>".$area_stack."</p>";
            echo $area_string.' <b>'.$area->name.'</b>';
        }
    @endphp
    @endif

    @if ($post->area == 'tawi')
    @php
        $relation_table = 'branch_leader';
        $side_column = 'branch_id';
        $area_type = 'App\Models\Branch';
        $area_string = 'tawi la ';

        $area =  App\Http\Controllers\Super\AreasController::search_for_area(
            $relation_table,
            $side_column,
            $side_value,
            $leader_id,
            $area_type
        );
        $ward = $area->ward;
        $division = $area->division;
        $council = $area->council;
        $district = $area->district;
        $region = $area->region;
        $area_stack = 'mkoa - '.$region->name.' | ';
        $area_stack .= 'wilaya - '.$district->name.' | ';
        $area_stack .= 'halmashauri - '.$council->name.' | ';
        $area_stack .= 'tarafa - '.$division->name.' | ';
        $area_stack .= 'kata - '.$ward->name.' | ';
        if($area){
            echo "<p>".$area_stack."</p>";
            echo $area_string.' <b>'.$area->name.'</b>';
        }
    @endphp
    @endif

    @if ($post->area == 'kata')
    @php
        $relation_table = 'leader_ward';
        $side_column = 'ward_id';
        $area_type = 'App\Models\Ward';
        $area_string = 'kata ya ';
        $area =  App\Http\Controllers\Super\AreasController::search_for_area(
            $relation_table,
            $side_column,
            $side_value,
            $leader_id,
            $area_type
        );
        $division = $area->division;
        $council = $area->council;
        $district = $area->district;
        $region = $area->region;
        $area_stack = 'mkoa - '.$region->name.' | ';
        $area_stack .= 'wilaya - '.$district->name.' | ';
        $area_stack .= 'halmashauri - '.$council->name.' | ';
        $area_stack .= 'tarafa - '.$division->name.' | ';
        if($area){
            echo "<p>".$area_stack."</p>";
            echo $area_string.' <b>'.$area->name.'</b>';
        }
    @endphp
    @endif

    @if ($post->area == 'tarafa')
    @php
        $relation_table = 'division_leader';
        $side_column = 'division_id';
        $area_type = 'App\Models\Division';
        $area_string = 'tarafa ya ';

        $area =  App\Http\Controllers\Super\AreasController::search_for_area(
            $relation_table,
            $side_column,
            $side_value,
            $leader_id,
            $area_type
        );
        $council = $area->council;
        $district = $area->district;
        $region = $area->region;
        $area_stack = 'mkoa - '.$region->name.' | ';
        $area_stack .= 'wilaya - '.$district->name.' | ';
        $area_stack .= 'halmashauri - '.$council->name.' | ';
        if($area){
            echo "<p>".$area_stack."</p>";
            echo $area_string.' <b>'.$area->name.'</b>';
        }
    @endphp
    @endif

    @if ($post->area == 'halmashauri')
    @php
        $relation_table = 'council_leader';
        $side_column = 'council_id';
        $area_type = 'App\Models\Council';
        $area_string = 'halmashauri ya ';

        $area =  App\Http\Controllers\Super\AreasController::search_for_area(
            $relation_table,
            $side_column,
            $side_value,
            $leader_id,
            $area_type
        );
        $district = $area->district;
        $region = $area->region;
        $area_stack = 'mkoa - '.$region->name.' | ';
        $area_stack .= 'wilaya - '.$district->name.' | ';
        if($area){
            echo "<p>".$area_stack."</p>";
            echo $area_string.' <b>'.$area->name.'</b>';
        }
    @endphp
    @endif

    @if ($post->area == 'wilaya')
    @php
        $relation_table = 'district_leader';
        $side_column = 'district_id';
        $area_type = 'App\Models\District';
        $area_string = 'wilaya ya ';

        $area =  App\Http\Controllers\Super\AreasController::search_for_area(
            $relation_table,
            $side_column,
            $side_value,
            $leader_id,
            $area_type
        );
        $region = $area->region;
        $area_stack = 'mkoa - '.$region->name.' | ';
        if($area){
            echo "<p>".$area_stack."</p>";
            echo $area_string.' <b>'.$area->name.'</b>';
        }
    @endphp
    @endif


    @if ($post->area == 'jimbo')
    @php
        $relation_table = 'leader_state';
        $side_column = 'state_id';
        $area_type = 'App\Models\State';
        $area_string = 'jimbo la ';

        $area =  App\Http\Controllers\Super\AreasController::search_for_area(
            $relation_table,
            $side_column,
            $side_value,
            $leader_id,
            $area_type
        );
        $district = $area->district;
        $region = $area->region;
        $area_stack = 'mkoa - '.$region->name.' | ';
        $area_stack .= 'wilaya - '.$district->name.' | ';
        if($area){
            echo "<p>".$area_stack."</p>";
            echo $area_string.' <b>'.$area->name.'</b>';
        }
    @endphp
    @endif

    @if ($post->area == 'mkoa')
    @php
        $relation_table = 'leader_region';
        $side_column = 'region_id';
        $area_type = 'App\Models\Region';
        $area_string = 'mkoa wa simiyu';
    @endphp
    @endif

    @php

    @endphp

</div>
