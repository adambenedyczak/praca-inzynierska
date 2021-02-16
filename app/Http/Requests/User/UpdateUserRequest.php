<?php

namespace App\Http\Requests\Filmy;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateFilmRequest extends FormRequest
{
    /**
     * Reguły walidacji
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required', 
                'string', 
                'min:5',
                'max:100'
            ],
            'password-new' => [
                'string', 
                'min:5'
            ],
            'password-confirm' => [
                'required_with:password-new', 
                'same:password-new',
                'string', 
                'min:5'
            ],
              'password-old' => [
                'required', 
                'string', 
                'min:5'
            ],
        ];
    }
}
