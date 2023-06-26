<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Super\AreasController;
use Illuminate\Http\Request;

class AreasLogicsController extends Controller
{
    public static function findArea($leader, $post)
    {
        $area_id = 0;
        $relation_table = null;
        $side_column = null;
        $area_type = null;
        $area = null;

        $side_value = $post->id;
        $leader_id = $leader->id;


        if ($post->area == 'shina'){
            $relation_table = 'leader_trunk';
            $side_column = 'trunk_id';
            $area_type = 'App\Models\Trunk';
            $area_string = 'Shina la ';
            $area =  AreasController::search_for_area(
                $relation_table,
                $side_column,
                $side_value,
                $leader_id,
                $area_type
            );
            if($area){
                $branch = $area->branch;
                $ward = $area->ward;
                $division = $area->division;
                $council = $area->council;
                $district = $area->district;
                $region = $area->region;
                $area_stack = array();
                $area_stack[] = ['key' => 'mkoa', 'value' => $region->name];
                $area_stack[] = ['key' => 'wilaya', 'value' => $district->name];
                $area_stack[] = ['halmashauri', 'value' => $council->name];
                $area_stack[] = ['key' => 'tarafa', 'value' => $division->name];
                $area_stack[] = ['key' => 'kata', 'value' => $ward->name];
                $area_stack[] = ['key' => 'branch', 'value' => $branch->name];
                return ['stack' => $area_stack, 'area' => $area_string.''.$area->name ];
            }
        }

        if ($post->area == 'tawi'){
            $relation_table = 'branch_leader';
            $side_column = 'branch_id';
            $area_type = 'App\Models\Branch';
            $area_string = 'tawi la ';

            $area =  AreasController::search_for_area(
                $relation_table,
                $side_column,
                $side_value,
                $leader_id,
                $area_type
            );
            if($area){
                $ward = $area->ward;
                $division = $area->division;
                $council = $area->council;
                $district = $area->district;
                $region = $area->region;
                $area_stack = array();
                $area_stack[] = ['key' => 'mkoa', 'value' => $region->name];
                $area_stack[] = ['key' => 'wilaya', 'value' => $district->name];
                $area_stack[] = ['halmashauri', 'value' => $council->name];
                $area_stack[] = ['key' => 'tarafa', 'value' => $division->name];
                $area_stack[] = ['key' => 'kata', 'value' => $ward->name];
                return ['stack' => $area_stack, 'area' => $area_string.''.$area->name ];
            }
        }

        if ($post->area == 'kata'){
            $relation_table = 'leader_ward';
            $side_column = 'ward_id';
            $area_type = 'App\Models\Ward';
            $area_string = 'kata ya ';
            $area =  AreasController::search_for_area(
                $relation_table,
                $side_column,
                $side_value,
                $leader_id,
                $area_type
            );
            if($area){
                $division = $area->division;
                $council = $area->council;
                $district = $area->district;
                $region = $area->region;
                $area_stack = array();
                $area_stack[] = ['key' => 'mkoa', 'value' => $region->name];
                $area_stack[] = ['key' => 'wilaya', 'value' => $district->name];
                $area_stack[] = ['halmashauri', 'value' => $council->name];
                $area_stack[] = ['key' => 'tarafa', 'value' => $division->name];
                return ['stack' => $area_stack, 'area' => $area_string.''.$area->name ];
            }
        }

        if ($post->area == 'tarafa'){
            $relation_table = 'division_leader';
            $side_column = 'division_id';
            $area_type = 'App\Models\Division';
            $area_string = 'tarafa ya ';

            $area =  AreasController::search_for_area(
                $relation_table,
                $side_column,
                $side_value,
                $leader_id,
                $area_type
            );
            if($area){
                $council = $area->council;
                $district = $area->district;
                $region = $area->region;
                $area_stack = array();
                $area_stack[] = ['key' => 'mkoa', 'value' => $region->name];
                $area_stack[] = ['key' => 'wilaya', 'value' => $district->name];
                $area_stack[] = ['halmashauri', 'value' => $council->name];
                return ['stack' => $area_stack, 'area' => $area_string.''.$area->name ];
            }
        }

        if ($post->area == 'halmashauri'){
            $relation_table = 'council_leader';
            $side_column = 'council_id';
            $area_type = 'App\Models\Council';
            $area_string = 'halmashauri ya ';

            $area =  AreasController::search_for_area(
                $relation_table,
                $side_column,
                $side_value,
                $leader_id,
                $area_type
            );
            if($area){
                $district = $area->district;
                $region = $area->region;
                $area_stack = array();
                $area_stack[] = ['key' => 'mkoa', 'value' => $region->name];
                $area_stack[] = ['key' => 'wilaya', 'value' => $district->name];
                return ['stack' => $area_stack, 'area' => $area_string.''.$area->name ];
            }
        }

        if ($post->area == 'wilaya'){
            $relation_table = 'district_leader';
            $side_column = 'district_id';
            $area_type = 'App\Models\District';
            $area_string = 'wilaya ya ';

            $area =  AreasController::search_for_area(
                $relation_table,
                $side_column,
                $side_value,
                $leader_id,
                $area_type
            );
            if($area){
                $region = $area->region;
                $area_stack = array();
                $area_stack[] = ['key' => 'mkoa', 'value' => $region->name];
                return ['stack' => $area_stack, 'area' => $area_string.''.$area->name ];
            }
        }

        if($post->area == 'jimbo'){
            $relation_table = 'leader_state';
            $side_column = 'state_id';
            $area_type = 'App\Models\State';
            $area_string = 'jimbo la ';
            $area =  AreasController::search_for_area(
                $relation_table,
                $side_column,
                $side_value,
                $leader_id,
                $area_type
            );
            if($area){
                $district = $area->district;
                $region = $area->region;
                $area_stack = array();
                $area_stack[] = ['key' => 'mkoa', 'value' => $region->name];
                $area_stack[] = ['key' => 'wilaya', 'value' => $district->name];
                return ['stack' => $area_stack, 'area' => $area_string.''.$area->name ];
            }
        }

        if ($post->area == 'mkoa'){
            $relation_table = 'leader_region';
            $side_column = 'region_id';
            $area_type = 'App\Models\Region';
            $area_string = 'Mkoa wa ';
            $area =  AreasController::search_for_area(
                $relation_table,
                $side_column,
                $side_value,
                $leader_id,
                $area_type
            );
            if($area){
                $region = $area->region;
                $area_stack = array();
                $area_stack[] = ['key' => 'mkoa', 'value' => $region->name];
                return ['stack' => $area_stack, 'area' => $area_string.''.$area->name ];
            }
        }
        return [];
    }
}
