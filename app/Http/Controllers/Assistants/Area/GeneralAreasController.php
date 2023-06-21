<?php

namespace App\Http\Controllers\Assistants\Area;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GeneralAreasController extends Controller
{
    public function searchIndex() {
        return view('interface.assistants.maeneo.generalArea.anzaKutafuta');
    }
}
