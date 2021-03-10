<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreObjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            'object_name' => 'required|string|min:5|max:100',
            'object_unit' => 'required',
          ];
    }

    public function messages()
    {
        return [
            'object_name.required' => 'Nazwa jest wymagana',
            'object_name.min' => 'Nazwa musi mieć minimum :min znaków',
            'object_name.max' => 'Nazwa może mieć maksymalnie :max znaków',
            'object_unit.required' => 'Jednostka czasu pracy jest wymagana',
        ];
    }
}
