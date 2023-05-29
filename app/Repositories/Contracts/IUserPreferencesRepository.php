<?php


namespace App\Repositories\Contracts;

interface IUserPreferencesRepository
{
    public function getUserPreferences($userId, $limit = null): array;

    public function updateUserPreferences($userId, $data);
}
