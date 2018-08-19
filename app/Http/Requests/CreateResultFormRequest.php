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
            'file' => 'required|mimes:pdf,doc,docx,rar,zip',
            'date' => 'required_without:allField',


        ];
    }

    public function messages()
    {
        return [
            'name.required_without' => 'При ручном вводе данных поле Название обязательное',
            'file.required' => 'Поле является обязательным',
            'file.mimes' => 'Не верный тип файла',
            'date.required_without' => 'При ручном вводе данных поле Дата обязательное',
        ];
    }
}
