<?php

namespace App\Domain;

use App\Service\KakaoApi;

class Seoul extends Cafe
{
    public function __construct($item)
    {
        $kakaoApi = new KakaoApi();
        $latlng = $kakaoApi->transcoord($item['xcode'], $item['ycode']);
        $this->local = '서울';
        $this->name = $item['nm'];
        $this->lat = (float) $latlng[1];
        $this->lng = (float) $latlng[0];
        $this->tel = $item['tel'];
        $this->state = '운영중' === $item['state'];
        $this->addr = $item['addr'];
        $this->addr_old = $item['addr_old'];
        $this->area = $item['total_scale'];
        $this->hygiene_conditions = $item['hygiene_conditions'];
        $this->hygiene_type = $item['hygiene_type'];
    }
}
