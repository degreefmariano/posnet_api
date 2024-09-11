<?php

namespace App\Http\Controllers;

use App\Http\Requests\CardPayRequest;
use App\Models\Cardpay;
use App\Models\Cardregister;
use Illuminate\Http\Request;

class PosnetController extends Controller
{
    public function doPayment(CardPayRequest $request)
    {
        $numero_tarjeta = $request->numero_tarjeta;
        $card = Cardregister::where('numero_tarjeta', $numero_tarjeta)->first();

        if (!$card) {
            return response()->json([
                'estado' => 'error',
                'message' => 'Tarjeta no encontrada',
            ], 404);
        }

        $monto = $request->monto;
        $cuotas = $request->cuotas;
    
        // Si el pago es mayor a 1 cuota, se incrementa el monto en 3% por cada cuota extra
        if ($cuotas > 1) {
            $recargo = ($cuotas - 1) * 0.03;  // 3% de incremento por cada cuota adicional
            $monto += $monto * $recargo;  // Sumar el recargo al monto original
        }
    
        if ($card->limite_disponible < $monto) {
            return response()->json([
                'estado' => 'error',
                'message' => 'Límite insuficiente para efectuar el pago',
            ], 400);
        }

        // Actualizar el límite disponible restando el monto del pago
        $card->limite_disponible -= $monto;
        $card->save();
    
        // Calcular el monto de cada cuota
        $monto_por_cuota = $monto / $cuotas;
    
        // Crear el registro del pago
        $cardpay = Cardpay::create([
            'numero_tarjeta' => $card->numero_tarjeta,
            'monto' => $monto,
            'cuotas' => $cuotas
        ]);
    
        return response()->json([
            'estado' => 'success',
            'message' => 'Pago realizado con éxito',
            'nombre' => $card->nombre,
            'apellido' => $card->apellido,
            'monto_total_a_pagar' => $monto,
            'monto_por_cuota' => number_format($monto_por_cuota, 2),                
            'cuotas' => $cuotas,
        ], 200);

    }
    
}
