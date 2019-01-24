<?php

namespace App\Service;

use App\Cafe;
use App\Domain\Kangwondo;
use App\Domain\Kungkido;
use App\Domain\Seoul;
use GuzzleHttp\Client;
use Vyuldashev\XmlToArray\XmlToArray;

class LocalCafe
{
    private $kungkido;
    private $kangwondo;
    private $service;

    const KUNGKIDO1 = 'https://openapi.gg.go.kr/Kidscafe?Type=json&pIndex=1&pSize=200';
    const KUNGKIDO2 = 'https://openapi.gg.go.kr/Resrestrtkidscafe?Type=json&pIndex=1&pSize=300';
    const KANGWONDO1 = 'http://data.gwd.go.kr/apiservice/';
    const KANGWONDO2 = '/json/localdata-food-kids_cafe/1/300/';

    public function __construct()
    {
        $this->kungkido = config('data.api.kungkido');
        $this->kangwondo = config('data.api.kangwondo');
        $this->service = new Client();
    }

    public function seoul()
    {
        $jsonData = file_get_contents(storage_path('sql/seoul.json'), 1);

        return collect(\GuzzleHttp\json_decode($jsonData, 1)['DATA'])
            ->mapInto(Seoul::class)->filter(function ($item) {
                return $item->state;
            })->each(function ($item) {
                Cafe::create($item->toArray());
            });
    }

    public function kangwondo()
    {
        $res = $this->service->get(self::KANGWONDO1.$this->kangwondo.self::KANGWONDO2);
        $data = \GuzzleHttp\json_decode($res->getBody(), 1);

        Cafe::where('local', '강원도')->delete();

        return collect($data['localdata-food-kids_cafe']['row'])
            ->mapInto(Kangwondo::class)
            ->filter(function ($item) {
                return $item->state;
            })->each(function ($item) {
                Cafe::create($item->toArray());
            });
    }

    public function kungkido()
    {
        $str = $this->service->get(self::KUNGKIDO1.'&KEY='.$this->kungkido);
        $data = \GuzzleHttp\json_decode($str->getBody(), 1);

        Cafe::where('local', '경기도')->delete();

        $item1 = collect($data['Kidscafe'][1]['row'])
            ->mapInto(Kungkido::class)
            ->filter(function ($item) {
                return $item->state;
            })->toArray();

        $str = $this->service->get(self::KUNGKIDO2.'&KEY='.$this->kungkido);
        $data = \GuzzleHttp\json_decode($str->getBody(), 1);

        $item2 = collect($data['Resrestrtkidscafe'][1]['row'])
            ->mapInto(Kungkido::class)
            ->filter(function ($item) {
                return $item->state;
            })->toArray();

        return collect(array_merge($item1, $item2))->each(function (\App\Domain\Cafe $item) {
            Cafe::create($item->toArray());
        });
    }
}
