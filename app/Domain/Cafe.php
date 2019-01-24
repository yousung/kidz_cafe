<?php

namespace App\Domain;

abstract class Cafe
{
    public $name;
    public $local;
    public $lat;
    public $lng;
    public $tel;
    public $state;
    public $addr;
    public $addr_old;
    public $area;
    public $hygiene_conditions;
    public $hygiene_type;

    public function toArray()
    {
        return collect($this)->toArray();
    }
}
