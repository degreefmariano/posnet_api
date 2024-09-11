<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class PrimeController extends Controller
{
    public function checkPrime(Request $request)
    {
        $numero = $request->numero;
        $primos = $this->primos();

        if ($this->esPrimo($numero)) {
            return response()->json([
                'estado' => 'success',
                'data' => $numero,
                'message' => $numero . ' es un número primo',
                'numeros_primos' => $primos
            ], 200);
        } else {
            return response()->json([
                'estado' => 'error',
                'data' => $numero,
                'message' => $numero . ' no es un número primo',
            ], 200);
        }
    }

    private function esPrimo($numero) {
        if ($numero < 2) {
            return false;
        }

        for ($i = 2; $i <= sqrt($numero); $i++) {
            if ($numero % $i == 0) {
                return false;
            }
        }
        return true;
    }

    private function primos() {
        $primos = [];
    
        for ($i = 2; $i <= 100; $i++) {
            if ($this->esPrimo($i)) {
                $primos[] = $i;
            }
        }
    
        return $primos;
    }
}
