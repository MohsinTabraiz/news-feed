<?php

namespace App\External\NewsAPIs\Formatters;

use App\External\NewsAPIs\Contracts\INewsAPIDataFormatter;

class NewYorkTimesAPIDataFormatter implements INewsAPIDataFormatter {
    public function formatData($data) : array{
       
        $response = [];
        foreach($data['response']['docs'] as $article){
            $response[] = [
                'title' => $article['headline']['main'] ?? null,
                'content' => $article['lead_paragraph'] ?? null,
                'author' => $article['byline']['original'] ?? null,
                'source' => $article['source'] ?? null,
                'category' => $article['section_name'] ?? null,
                'published_at' => $article['pub_date'] ?? null,
            ];
        }

        return $response;
    }
}