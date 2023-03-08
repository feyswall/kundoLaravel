<?php

namespace App\Http\Controllers\Super;

use App\Models\MotorCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MotorCategoriesController extends Controller
{
    public function getTypes($id)
    {
        $motorCategory = MotorCategory::where('id', $id)->first();
        $motorModels = $motorCategory->motor_types;
        return $motorModels;
    }

}
