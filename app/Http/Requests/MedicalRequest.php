<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MedicalRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [];
//        return [
//            'lat' => 'required',
//            'lng' => 'required',
//            'type' => 'required',
//        ];
    }

    public function attributes()
    {
        return [
            'lat' => '좌표 Lat',
            'lng' => '좌표 Lng',
            'type' => '구부',
        ];
    }
}
