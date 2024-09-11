<?php

namespace App\Http\Controllers;

use App\Http\Requests\CardRegisterRequest;
use App\Models\Cardregister;
use Illuminate\Http\Request;

class CardRegisterController extends Controller
{
    public function cardRegister(CardRegisterRequest $request)
    {
        $cardregister = Cardregister::create($request->validated());
        return response()->json([
            'estado' => 'success',
            'data' => $cardregister,
            'message' => 'Tarjeta guardada exitosamente',
        ], 200);
    }
}
