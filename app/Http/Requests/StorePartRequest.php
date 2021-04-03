<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePartRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            'part_name' => 'nullable|string|min:5|max:100',
            'part_type' => 'required',
          ];
    }

    public function messages()
    {
        return [
            'part_type.required' => 'Typ części jest wymagany',
            'part_name.min' => 'Nazwa musi mieć minimum :min znaków',
            'part_name.max' => 'Nazwa może mieć maksymalnie :max znaków',
            
        ];
    }
}
