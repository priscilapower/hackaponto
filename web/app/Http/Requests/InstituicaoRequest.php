<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InstituicaoRequest extends FormRequest
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
            'nome' => [
                'required', 'min:3'
            ],
            'latitude' => [
                'required', 'string'
            ],
            'longitude' => [
                'required', 'string'
            ],
        ];
    }
}
