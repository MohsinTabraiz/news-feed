<?php

namespace App\External\NewsAPIs\Clients;

use App\External\NewsAPIs\Contracts\INewsAPIClient;
use App\Helpers\Http\Contracts\ClientInterface;

class NewYorkTimesAPIClient implements INewsAPIClient {

    private $API_URL, $API_KEY, $HTTP_CLIENT;

    public function __construct(ClientInterface $client)
    {
        $this->API_URL = config('api.new_york_times_api.api_url');
        $this->API_KEY = config('api.new_york_times_api.api_key');
        $this->HTTP_CLIENT = $client;
    }

    public function getArticles(){
        $url = $this->API_URL . $this->API_KEY;

        return $this->HTTP_CLIENT->makeCall($url, "GET");
    }
}