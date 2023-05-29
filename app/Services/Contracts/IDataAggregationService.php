<?php


namespace App\Services\Contracts;

interface IDataAggregationService
{
    public function getAllData($data);

    public function processFetchedNewsArticles($data);
}
