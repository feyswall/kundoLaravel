<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Branch;
use App\Models\Council;
use App\Models\District;
use App\Models\Division;
use App\Models\Region;
use App\Models\Ward;
use Illuminate\Http\Request;
use DB;

class AreasController extends Controller
{

    public static function discoverArea($name, $id)
    {
        $locObj = '';
        if ($name == 'mkoa') {
            $locObj = Region::where('id', $id)->first();
        } elseif ($name == 'wilaya') {
            $locObj = District::where('id', $id)->first();
        } elseif ($name == 'halmashauri') {
            $locObj = Council::where('id', $id)->first();
        } elseif ($name == 'tarafa') {
            $locObj = Division::where('id', $id)->first();
        } elseif ($name == 'kata') {
            $locObj = Ward::where('id', $id)->first();
        } elseif ($name == 'tawi') {
            $locObj = Branch::where('id', $id)->first();
        }
        if (!$locObj) {
            return ['status' => 'error', 'message' => 'Tatizo Tafadhali Jaribu Tena'];
        }
        return ['status' => 'success', 'data' => $locObj];
    }

    public static function search_for_area(
        $relation_table,
        $side_column,
        $side_value,
        $leader_id,
        $area_type
        ){
            $area = null;

            $ward_single_leader = DB::table($relation_table)
            ->where('leader_id', $leader_id)
            ->where('isActive', true)
            ->where('post_id', $side_value)
            ->first();

            if( $ward_single_leader ){
                $area_id = $ward_single_leader->$side_column;
                $area = $area_type::find( $area_id );
            }

            return $area;
        }
}
