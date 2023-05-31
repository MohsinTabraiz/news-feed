<?php

namespace App\External\NewsAPIs\Formatters;

use App\External\NewsAPIs\Contracts\INewsAPIDataFormatter;

class NewsOrgAPIDataFormatter implements INewsAPIDataFormatter {
    public function formatData($data) : array{
       
        $response = [];
        foreach($data['articles'] as $article){
            $response[] = [
                'title' => $article['title'] ?? null,
                'content' => $article['content'] ?? null,
                'author' => $article['author'] ?? null,
                'source' => $article['source']['name'] ?? null,
                'category' => config('api.news_api.api_category'),
                'published_at' => $article['publishedAt'] ?? null,
            ];
        }

        return $response;
    }
}