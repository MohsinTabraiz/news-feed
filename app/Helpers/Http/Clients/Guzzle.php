<?php

namespace App\Helpers\Http\Clients;

use App\Helpers\Http\Contracts\ClientInterface;

class Guzzle implements ClientInterface {

    public function makeCall($url, $method, $data = [])
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request($method, $url, [
            'form_params' => $data
        ]);
        return json_decode($response->getBody()->getContents(), true);
    }

}