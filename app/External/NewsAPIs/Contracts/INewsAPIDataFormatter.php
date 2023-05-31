<?php


namespace App\External\NewsAPIs\Contracts;

interface INewsAPIDataFormatter
{
    public function formatData($data): array;
}