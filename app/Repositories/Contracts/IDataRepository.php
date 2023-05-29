<?php

namespace App\Repositories\Contracts;

interface IDataRepository
{
    public function getAllRecordsAsResponseArray($query = null);

    public function getPreferredItemsByUser($userId, $limit = null);
}
