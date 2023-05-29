<?php

namespace App\Services;

use App\Models\Author;
use App\Models\Category;
use App\Models\Source;
use App\Models\Article;
use App\Repositories\ArticleRepository;
use App\Repositories\AuthorRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\SourceRepository;
use Carbon\Carbon;
use App\Services\Contracts\IDataAggregationService;

class DataAggregationService implements IDataAggregationService
{
    public function __construct(
        private readonly ArticleRepository $articleRepository,
        private readonly AuthorRepository $authorRepository,
        private readonly CategoryRepository $categoryRepository,
        private readonly SourceRepository $sourceRepository,
    ) {
    }

    public function getAllData($query)
    {

        $articles = $this->articleRepository->getAllRecordsAsResponseArray($query);
        $authors = $this->authorRepository->getAllRecordsAsResponseArray();
        $categories = $this->categoryRepository->getAllRecordsAsResponseArray();
        $sources = $this->sourceRepository->getAllRecordsAsResponseArray();

        return [
            'articles' => $articles,
            'authors' => $authors,
            'categories' => $categories,
            'sources' => $sources
        ];
    }

    public function processFetchedNewsArticles($data)
    {
        foreach ($data as $articleData) {
            $author = ($articleData['author'] !== null && $articleData['author'] !== '') ? Author::firstOrCreate(['name' => $articleData['author']]) : null;
            $source = ($articleData['source'] !== null && $articleData['source'] !== '') ? Source::firstOrCreate(['title' => $articleData['source']]) : null;
            $category = ($articleData['category'] !== null && $articleData['category'] !== '') ? Category::firstOrCreate(['title' => $articleData['category']]) : null;

            Article::firstOrCreate(
                [
                    'author_id' => ($author !== null) ? $author->id : null,
                    'category_id' => ($category !== null) ?  $category->id : null,
                    'source_id' => ($source !== null) ? $source->id : null,
                    'title' => $articleData['title'],
                ],
                [
                    'content' => $articleData['content'],
                    'published_at' => ($articleData['published_at'] !== null) ? Carbon::parse($articleData['published_at'])->toDateTimeString() : null,
                ]
            );
        }
    }
}
