<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        //dd($this->route('id'));
        return [
            'name' => 'string',
            'email' => [
                'email',
                Rule::unique('users')->ignore($this->route('id'))
            ],
            'phone_number' => 'string',
        ];
    }
}
