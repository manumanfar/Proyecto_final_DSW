<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApuestaForm extends FormRequest
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
            'result_local' => 'required|numeric|between:0,100',
            'result_visitor' => 'required|numeric|between:0,100',
            'value_bet' => 'required|numeric|between:0,1000',
        ];
    }
}
