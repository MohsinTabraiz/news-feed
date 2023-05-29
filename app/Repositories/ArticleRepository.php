<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Article;
use App\Repositories\AuthorRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\SourceRepository;
use App\Repositories\Contracts\IDataRepository;

class ArticleRepository implements IDataRepository
{
    public function __construct(
        private readonly AuthorRepository $authorRepository,
        private readonly CategoryRepository $categoryRepository,
        private readonly SourceRepository $sourceRepository,
    ) {
    }
    
    public function getAllRecordsAsResponseArray($searchQuery = [])
    {
        return  Article::with('author', 'source', 'category')
            ->when(isset($searchQuery['author_id']), function ($query) use ($searchQuery) {
                return $query->where('author_id', $searchQuery['author_id']);
            })
            ->when(isset($searchQuery['category_id']), function ($query) use ($searchQuery) {
                return $query->where('category_id', $searchQuery['category_id']);
            })
            ->when(isset($searchQuery['keyword']), function ($query) use ($searchQuery) {
                $keyword = $searchQuery['keyword'];
                return $query->where(function ($query) use ($keyword) {
                    $query->orWhere('title', 'like', "%$keyword%")
                        ->orWhere('content', 'like', "%$keyword%");
                });
            })
            ->when(isset($searchQuery['source_id']), function ($query) use ($searchQuery) {
                return $query->where('source_id', $searchQuery['source_id']);
            })
            ->when(isset($searchQuery['start_date']), function ($query) use ($searchQuery) {
                $startDate = date('Y-m-d H:i:s', strtotime($searchQuery['start_date']));
                return $query->whereDate('published_at', '>', $startDate);
            })
            ->when(isset($searchQuery['end_date']), function ($query) use ($searchQuery) {
                $endDate = date('Y-m-d H:i:s', strtotime($searchQuery['end_date']));
                return $query->whereDate('published_at', '<', $endDate);
            })
            ->paginate(isset($searchQuery['limit']) ? $searchQuery['limit'] : 5);
    }

    public function getPreferredItemsByUser($userId, $limit = null)
    {
        $preferredAuthors = $this->authorRepository->getPreferredItemsByUser($userId);
        $preferredCategories = $this->categoryRepository->getPreferredItemsByUser($userId);
        $preferredSources = $this->sourceRepository->getPreferredItemsByUser($userId);

        return Article::with('author', 'source', 'category')
            ->where(function ($query) use ($preferredSources, $preferredCategories, $preferredAuthors) {
                $query->orWhereIn('source_id', $preferredSources)
                    ->orWhereIn('category_id', $preferredCategories)
                    ->orWhereIn('author_id', $preferredAuthors);
            })
            ->paginate($limit ?? 5);
    }
}
