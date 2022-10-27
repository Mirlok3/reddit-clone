<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserStoreRequest extends FormRequest
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
        $userId = Auth::id();

        return [
            'user_image' => ['nullable'],
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,'.$userId,
            'email' => 'email|required|string|max:255|unique:users,email,'.$userId,
            'description' => ['required','string','max:255','nullable'],
        ];
    }
}
