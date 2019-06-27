<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
//            'nome' => [
//                'required', 'min:3'
//            ],
//            'usuario' => [
//                'required', 'min:3'
//            ],
//            'email' => [
//                'required', 'email'
//            ],
//            'password' => [
//                $this->route()->user ? 'nullable' : 'required', 'confirmed', 'min:6'
//            ],
//            'foto' => [
//                'required', 'mimes:jpeg'
//            ],
        ];
    }
}
