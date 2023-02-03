<?php

namespace App\Http\Controllers\Super\Area;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GeneralAreasController extends Controller
{
    public function searchIndex() {
        return view('interface.super.maeneo.generalArea.anzaKutafuta');
    }
}
