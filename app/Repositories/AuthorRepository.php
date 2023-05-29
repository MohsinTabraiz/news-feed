<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Author;
use App\Repositories\Contracts\IDataRepository;

class AuthorRepository implements IDataRepository
{
    public function getAllRecordsAsResponseArray($query = null)
    {
        $authors = Author::all();
        return $this->formatData($authors);
    }

    public function getPreferredItemsByUser($userId, $limit = null)
    {
        $user = User::findOrFail($userId);

        return $user->authors ? $user->authors->pluck('id') : [];
    }

    private function formatData($authors)
    {
        return $authors->map(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->name,
            ];
        });
    }
}
