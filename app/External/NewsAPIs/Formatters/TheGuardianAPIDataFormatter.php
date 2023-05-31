<?php

namespace App\External\NewsAPIs\Formatters;

use App\External\NewsAPIs\Contracts\INewsAPIDataFormatter;

class TheGuardianAPIDataFormatter implements INewsAPIDataFormatter {
    public function formatData($data) : array{
       
        $response = [];
        foreach($data['response']['results'] as $article){
            $response[] = [
                'title' => $article['fields']['headline'] ?? null,
                'content' => $article['fields']['bodyText'] ?? null,
                'author' => $article['fields']['byline'] ?? null,
                'source' => $article['fields']['publication'] ?? null,
                'category' => $article['sectionName'] ?? null,
                'published_at' => $article['fields']['firstPublicationDate'] ?? null,
            ];
        }

        return $response;
    }
}