<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Source;
use App\Repositories\Contracts\IDataRepository;

class SourceRepository implements IDataRepository
{
    public function getAllRecordsAsResponseArray($query = null)
    {
        $sources = Source::all();
        return $this->formatData($sources);
    }

    public function getPreferredItemsByUser($userId, $limit = null)
    {
        $user = User::findOrFail($userId);
        return $user->sources ? $user->sources->pluck('id') : [];
    }

    private function formatData($sources)
    {
        return $sources->map(function ($item) {
            return [
                'id' => $item->id,
                'title' => $item->title,
            ];
        });
    }
}
