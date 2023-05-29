<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Category;
use App\Repositories\Contracts\IDataRepository;

class CategoryRepository implements IDataRepository
{
    public function getAllRecordsAsResponseArray($query = null)
    {
        $categories = Category::all();
        return $this->formatData($categories);
    }

    public function getPreferredItemsByUser($userId, $limit = null)
    {
        $user = User::findOrFail($userId);

        return $user->categories ? $user->categories->pluck('id') : [];
    }

    private function formatData($categories)
    {
        return $categories->map(function ($item) {
            return [
                'id' => $item->id,
                'title' => $item->title,
            ];
        });
    }
}
