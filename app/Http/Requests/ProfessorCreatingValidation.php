<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfessorCreatingValidation extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'unique:users,username',
            'email' => 'unique:users,email',
        ];
    }

    public function messages()
    {
        return [
            'username.unique' => 'Пользователь с таким логином уже существует',
            'email.unique' => 'Пользователь с такой почтой уже существует',
        ];
    }
}
