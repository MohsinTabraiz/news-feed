<?php

namespace App\Helpers\Http\Contracts;

interface ClientInterface {

    public function makeCall($url, $method, $data = []);

}