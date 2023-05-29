<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\IUserPreferencesRepository;
use App\Repositories\ArticleRepository;
use App\Repositories\AuthorRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\SourceRepository;

class UserPreferencesRepository implements IUserPreferencesRepository
{
    public function __construct(
        private readonly ArticleRepository $articleRepository,
        private readonly AuthorRepository $authorRepository,
        private readonly CategoryRepository $categoryRepository,
        private readonly SourceRepository $sourceRepository,
    ) {
    }

    public function getUserPreferences($userId, $limit = null): array
    {
        return [
            'articles' => $this->articleRepository->getPreferredItemsByUser($userId, $limit),
            'authors' => $this->authorRepository->getPreferredItemsByUser($userId, $limit),
            'categories' => $this->categoryRepository->getPreferredItemsByUser($userId, $limit),
            'sources' => $this->sourceRepository->getPreferredItemsByUser($userId, $limit)
        ];
    }

    public function updateUserPreferences($userId, $data)
    {
        $user = User::findOrFail($userId);

        $user->authors()->sync($data['authors']);
        $user->categories()->sync($data['categories']);
        $user->sources()->sync($data['sources']);

        $user->save();
    }
}
