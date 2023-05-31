<?php


namespace App\External\NewsAPIs\Contracts;

interface INewsAPIClient
{
    public function getArticles();
}