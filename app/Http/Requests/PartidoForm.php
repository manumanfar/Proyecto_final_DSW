<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PartidoForm extends FormRequest
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
            'team_local_id' => 'required',
            'team_visitor_id' => 'required',
            'date' => 'required',
            'time' => 'required',
            'image' => 'required|mimes:png,jpg|max:5120',
        ];
    }
}
