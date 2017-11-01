<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddOwnersFormRequest extends FormRequest
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
        $rules =[];
        if(count($this->request->get('arrOwners')) == 0){
            $rules['arrOwners.0'] = 'required';
        }
        if(count($this->request->get('arrRole')) == 0){
            $rules['arrRole.0'] = 'required';
        }
        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        $messages = [];

        $messages['arrOwners.required'] = 'A field is required';
        $messages['arrRole.required'] = 'A field is required';

        return $messages;
    }
}
