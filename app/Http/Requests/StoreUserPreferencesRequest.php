<?php

namespace App\Http\Requests;

use App\Models\Author;
use App\Models\Category;
use App\Models\Source;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreUserPreferencesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'authors' => ['array'],
            'authors.*' => ['exists:' . Author::class . ',id'],
            'categories' => ['array'],
            'categories.*' => ['exists:' . Category::class . ',id'],
            'sources' => ['array'],
            'sources.*' => ['exists:' . Source::class . ',id'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['errors' => $validator->errors()], 422));
    }
}
