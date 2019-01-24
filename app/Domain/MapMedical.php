<?php

namespace App\Domain;

class MapMedical
{
    public $type;
    public $name;
    public $hpid;
    public $tel;
    public $etc;
    public $addr;
    public $lat;
    public $lng;

    public $weekday_s;
    public $weekday_e;
    public $saturday_s;
    public $saturday_e;
    public $sunday_s;
    public $sunday_e;
    public $holiday_s;
    public $holiday_e;

    public function __construct($data)
    {
        $this->name = $data['dutyName'];
        $this->hpid = $data['hpid'];
        $this->tel = $data['dutyTel1'];
        $this->etc = $data['dutyEtc'] ?? null;
        $this->addr = $data['dutyAddr'];
        $this->lat = $data['wgs84Lat'] ?? null;
        $this->lng = $data['wgs84Lon'] ?? null;

        // 평일
        $this->weekday_s = $data['dutyTime1s'] ?? null;
        $this->weekday_e = $data['dutyTime1c'] ?? null;
        // 토요일
        $this->saturday_s = $data['dutyTime6s'] ?? null;
        $this->saturday_e = $data['dutyTime6c'] ?? null;
        // 일요일
        $this->sunday_s = $data['dutyTime7s'] ?? null;
        $this->sunday_e = $data['dutyTime7c'] ?? null;
        // 공휴일
        $this->holiday_s = $data['dutyTime8s'] ?? null;
        $this->holiday_e = $data['dutyTime8c'] ?? null;
    }
}
