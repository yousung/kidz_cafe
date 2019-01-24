<?php

namespace App\Repository;

use App\Domain\Pharmacy;
use GuzzleHttp\Client;
use Vyuldashev\XmlToArray\XmlToArray;

class DataApi implements IDataApi
{
    private $client;
    private $key;
    private $row;
    private $page;

    const BASE_URL = 'http://apis.data.go.kr/B552657/';
    const PHARMACY = 'ErmctInsttInfoInqireService/getParmacyFullDown';
    const HOSPITAL = 'HsptlAsembySearchService/getHsptlMdcncFullDown';

    public function __construct()
    {
        $this->client = new Client();
        $this->key = config('data.api.key');
        $this->row = config('data.api.row');
    }

    private function generateUrl($url)
    {
        $data = [
            'serviceKey' => urldecode($this->key),
            'numOfRows' => $this->row,
            'pageNo' => $this->page
        ];

        return $url.'?'.http_build_query($data);
    }

    private function getApi($apiUri)
    {
        $uri = $this->generateUrl($apiUri);
        $res = $this->client->get($uri);

        $arrayItem = XmlToArray::convert($res->getBody());
        $body = $arrayItem['response']['body'];
        $row = (int) $body['numOfRows'];
        $page = (int) $body['pageNo'];
        $total = (int) $body['totalCount'];
        $totalPage = ceil($total / $row);

        return collect([
            'items' => $body['items']['item'],
            'numOfRows' => $row,
            'pageNo' => $page,
            'totalCount' => $total,
            'totalPage' => $totalPage,
            'isNext' => $totalPage > $page
        ]);
    }

    public function getPharmacy($page = 1)
    {
        $apiUri = self::BASE_URL.self::PHARMACY;

        $this->page = $page;

        return $this->getApi($apiUri);
    }

    public function getHospital($page = 1)
    {
        $apiUri = self::BASE_URL.self::HOSPITAL;

        $this->page = $page;

        return $this->getApi($apiUri);
    }
}
