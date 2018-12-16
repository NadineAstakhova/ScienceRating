<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Lang;

class AddTypeOfExistedPublication extends FormRequest
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
        if(count($this->request->get('arrMark')) == 0){
            $rules['arrMark.0'] = 'required';
        }
        if(count($this->request->get('arrTypes')) == 0){
            $rules['arrTypes.0'] = 'required';
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

        $messages['arrMark.*.required'] = Lang::get('messages.mark_req');
        $messages['arrTypes.*.required'] =  Lang::get('messages.type_req');

        return $messages;
    }
}
