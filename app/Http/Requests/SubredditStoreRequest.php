<?php

namespace App\Http\Requests;

use App\Models\Subreddit;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

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
            'name' => 'required|unique:subreddits|max:255',
            'description' => ['required', 'min:5','max:255'],
            //'subreddit_image' => 'image|mimes:svg,png,jpg' replaced with accept="image/*" in input
        ];
    }
}
