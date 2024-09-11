<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CardPayRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'numero_tarjeta' => ['required', 'digits:8', Rule::unique('cards_pay', 'numero_tarjeta')],
            'monto' => ['required', 'numeric', 'min:0.01'],
            'cuotas' => ['required', 'numeric', 'between:1,6'],
        ];
    }
}

