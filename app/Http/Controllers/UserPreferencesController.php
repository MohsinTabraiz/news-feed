<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Traits\HttpResponsesTrait;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreUserPreferencesRequest;
use App\Repositories\Contracts\IUserPreferencesRepository;

class UserPreferencesController extends Controller
{
    use HttpResponsesTrait;

    public function __construct(private readonly IUserPreferencesRepository $userPreferencesRepository)
    {
    }

    public function get(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'limit' => ['integer', 'max:100'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $limit = $request->input('limit') ?? 5;

        return $this->success(
            $this->userPreferencesRepository->getUserPreferences(auth()->user()->id, $limit)
        );
    }

    public function update(StoreUserPreferencesRequest $request)
    {
        $userId = auth()->user()->id;
        $this->userPreferencesRepository->updateUserPreferences($userId, $request);

        return $this->success(
            $this->userPreferencesRepository->getUserPreferences($userId)
        );
    }
}
