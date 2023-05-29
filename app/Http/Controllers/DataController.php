<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetAllDataRequest;
use App\Http\Controllers\Controller;
use App\Http\Traits\HttpResponsesTrait;
use App\Http\Traits\TokenTrait;
use App\Services\Contracts\IDataAggregationService;
use Illuminate\Http\Request;

class DataController extends Controller
{
    use HttpResponsesTrait, TokenTrait;

    public function __construct(private readonly IDataAggregationService $dataAggregationService)
    {
    }

    public function get(GetAllDataRequest $request)
    {
        $data = $this->dataAggregationService->getAllData($request);

        return $this->success($data);
    }
}
