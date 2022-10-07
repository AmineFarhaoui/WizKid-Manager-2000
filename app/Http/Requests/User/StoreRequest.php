<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($this->route('id'))
            ],
            'role' => [
                'required',
                Rule::in(User::$roles),
            ],
            'phone_number' => 'required',
            'password' => 'required'
        ];
    }
}
