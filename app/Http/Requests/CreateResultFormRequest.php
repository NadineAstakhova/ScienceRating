<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateResultFormRequest extends FormRequest
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
            'name' => 'required_without:allField',
            'file' => 'required',
            'date' => 'required_without:allField',


        ];
    }

    public function messages()
    {
        return [
            'name.required_without' => 'Поле Название обязательное',
            'file.required' => 'A file is required',
            'date.required_without' => 'Поле Дата обязательное',
        ];
    }
}
