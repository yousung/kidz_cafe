<?php

namespace App\Http\Controllers;

use App\Cafe;
use App\Medical;

class MedicalController extends Controller
{
    public function medical($type, $lat, $lng, $km = 1)
    {
        $medicals = Medical::Distance($lat, $lng, $km)
            ->where('type', $type);

        if ('hospital' == $type) {
            $medicals->where(function ($q) {
                $q->where('name', 'like', '%소아%')
                ->orWhere('etc', 'like', '%영유아%')
                ->orWhere('etc', 'like', '%어린이%');
            });
        }

        return $medicals->get();
    }

    public function kidz($lat, $lng, $km = 1)
    {
        return Cafe::Distance($lat, $lng, $km)
            ->get();
    }
}
