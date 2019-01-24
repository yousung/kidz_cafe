<?php

namespace App\Domain;

class Kangwondo extends Cafe
{
    public function __construct($item)
    {
        $this->local = '강원도';
        $this->name = $item['BIZPLC_NM'];
        $this->lng = (float) $item['LNG'];
        $this->lat = (float) $item['LAT'];
        $this->state = '운영중' === $item['BSN_STATE_NM'];
        $this->addr = $item['LOCPLC_ROADNM_ADDR'];
        $this->addr_old = $item['LOCPLC_LOTNO_ADDR'];
        $this->area = $item['LOCPLC_AR'];
        $this->hygiene_conditions = $item['SANITTN_BIZCOND_NM'];
        $this->hygiene_type = $item['SANITTN_INDUTYPE_NM'];
    }
}
