<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateUserRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'min:2','max:100'],
            'password-new' => ['nullable', 'string', 'min:5'],
            'password-confirm' => ['nullable', 'required_with:password-new', 
                                    'same:password-new','string', 'min:5'],
              'password-old' => ['required', 'string', 'min:5']
          ];
    }

    public function messages()
    {
        return [
            'same' => 'Nowe hasła muszą być zgodne',
            'password-new.min' => 'Nowe hasło musi mieć co najmniej :min znaków',
            'password-confirm.min' => 'Nowe hasło musi mieć co najmniej :min znaków',
        ];
    }

}
