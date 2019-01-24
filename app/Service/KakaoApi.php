<?php

namespace App\Service;

use GuzzleHttp\Client;

class KakaoApi
{
    private $key;
    private $client;

    const TRANSCOORD_URI = 'https://dapi.kakao.com/v2/local/geo/transcoord.json';

    private function authorization()
    {
        return [
            'Authorization' => "KakaoAK {$this->key}",
            ];
    }

    private function getQuery($x, $y)
    {
        return [
            'x' => $x,
            'y' => $y,
            'input_coord' => 'WTM',
            'output_coord' => 'WGS84',
        ];
    }

    public function __construct()
    {
        $this->key = config('data.api.kakao');
        $this->client = new Client();
    }

    public function transcoord($x, $y)
    {
        $jsonData = $this->client->get(self::TRANSCOORD_URI, [
            'query' => $this->getQuery($x, $y),
            'headers' => $this->authorization(),
        ]);

        $jsonData = \GuzzleHttp\json_decode($jsonData->getBody(), 1);

        return $jsonData['meta']['total_count'] > 0 ? [
            $jsonData['documents'][0]['x'],
            $jsonData['documents'][0]['y']
        ] : [];
    }
}
