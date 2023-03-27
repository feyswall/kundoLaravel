<?php

namespace App\Http\Controllers\MotorOwner;

use App\Http\Controllers\Controller;
use Database\Seeders\MotorOwner;
use Illuminate\Http\Request;

class MotorServicesController extends Controller
{
    public function motorService()
    {

    }

    public function seeAllMotors(MotorOwner $motorOwner)
    {
        dd($motorOwner);
    }
}
