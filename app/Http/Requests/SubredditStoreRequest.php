<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubredditStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'unique:subreddits'],
            'slug' => ['required', 'unique:subreddits'],
            'description' => ['required', 'min:5'],
        ];
    }
}
