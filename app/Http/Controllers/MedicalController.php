<?php

namespace App\Http\Controllers;

use App\Cafe;
use App\Medical;

class MedicalController extends Controller
{
    public function medical($type, $lat, $lng, $km = 1)
    {
        return Medical::Distance($lat, $lng, $km)
            ->where('type', $type)
            ->get();
    }

    public function kidz($lat, $lng, $km = 1)
    {
        return Cafe::Distance($lat, $lng, $km)
            ->get();
    }
}
