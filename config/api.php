<?php

use App\External\NewsAPIs\Clients\NewsOrgAPIClient;
use App\External\NewsAPIs\Clients\NewYorkTimesAPIClient;
use App\External\NewsAPIs\Clients\TheGuardianAPIClient;
use App\External\NewsAPIs\Formatters\NewsOrgAPIDataFormatter;
use App\External\NewsAPIs\Formatters\NewYorkTimesAPIDataFormatter;
use App\External\NewsAPIs\Formatters\TheGuardianAPIDataFormatter;

return [
    'news_api_clients' => [
        [
            'client' => NewsOrgAPIClient::class,
            'data_formatter' => NewsOrgAPIDataFormatter::class
        ],
        [
            'client' => NewYorkTimesAPIClient::class,
            'data_formatter' => NewYorkTimesAPIDataFormatter::class
        ],
        [
            'client' => TheGuardianAPIClient::class,
            'data_formatter' => TheGuardianAPIDataFormatter::class
        ],
    ],

    'news_org_api' => [
        'api_url' => env('NEWS_ORG_API_URL'),
        'api_key' => env('NEWS_ORG_API_KEY'),
        'api_category' => env('NEWS_ORG_API_CATEGORY'),
    ],

    'new_york_times_api'=> [
        'api_url' => env('NYT_API_URL'),
        'api_key' => env('NYT_API_KEY'),
    ],

    'the_guardian_api'=> [
        'api_url' => env('THE_GUARDIAN_API_URL'),
        'api_key' => env('THE_GUARDIAN_API_KEY'),
    ],
];