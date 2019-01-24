<?php

namespace App\Domain;

class Kungkido extends Cafe
{
    public function __construct($item)
    {
        $this->local = '경기도';
        $this->name = $item['BIZPLC_NM'];
        $this->lng = (float) $item['REFINE_WGS84_LOGT'];
        $this->lat = (float) $item['REFINE_WGS84_LAT'];
        $this->state = '운영중' === $item['BSN_STATE_NM'];
        $this->addr = $item['REFINE_ROADNM_ADDR'];
        $this->addr_old = $item['REFINE_LOTNO_ADDR'];
        $this->area = $item['LOCPLC_AR'];
        $this->hygiene_conditions = $item['SANITTN_BIZCOND_NM'];
        $this->hygiene_type = $item['SANITTN_INDUTYPE_NM'];
    }
}
