<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CardRegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'tipo_tarjeta' => ['required', 'in:Visa,AMEX'],
            'entidad_bancaria' => ['required', 'string'],
            'numero_tarjeta' => ['required', 'digits:8', Rule::unique('cards_register', 'numero_tarjeta')],
            'limite_disponible' => ['required', 'numeric', 'max:1000000'],
            'dni' => ['required', 'numeric', 'digits_between:7,8', Rule::unique('cards_register', 'dni')],
            'nombre' => ['required', 'string', 'max:100'],
            'apellido' => ['required', 'string', 'max:100'],
            'fecha_expiracion' => ['required', 'date_format:m/y'],
            'cvv' => ['required', 'digits:3'],
        ];
    }
}

