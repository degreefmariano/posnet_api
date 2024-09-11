<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class PosnetControllerTest extends TestCase
{
    use RefreshDatabase; // Para migraciones y rollbacks de base de datos

    /** @test */
public function it_should_process_payment_successfully()
{
    // Preparar datos de prueba
    $card = \App\Models\CardRegister::create([
        "tipo_tarjeta" => "Visa",
        "entidad_bancaria" => "Banco Santander Rio",
        "numero_tarjeta" => "12345678",
        "limite_disponible" => "100000",
        "dni" => "26789012",
        "nombre" => "Jose Alfredo",
        "apellido" => "Gómez",
        "fecha_expiracion" => "03/25",
        "cvv" => "195"

    ]);

    // Datos de la solicitud
    $data = [
        'numero_tarjeta' => '12345678',
        'monto' => "5000",
        'cuotas' => "3",
    ];

    // Realizar la solicitud POST
    $response = $this->postJson('/api/card-pay', $data);

    // Verificar la respuesta
    $response->assertStatus(200)
             ->assertJson([
                 'estado' => 'success',
                 'message' => 'Pago realizado con éxito',
                 'nombre' => 'Jose Alfredo',
                 'apellido' => 'Gómez',
                 'monto_total_a_pagar' => '5300',
                 'monto_por_cuota' => '1,766.67',
                 'cuotas' => "3"
             ]);

    // Verificar que el límite disponible ha sido descontado
    $card->refresh();
    $this->assertEquals(94700.00, $card->limite_disponible);
}

/** @test */
public function it_should_return_error_if_insufficient_limit()
{
    // Preparar datos de prueba con límite insuficiente
    $card = \App\Models\CardRegister::create([
        "tipo_tarjeta" => "AMEX",
        "entidad_bancaria" => "Banco Santa Fe",
        "numero_tarjeta" => "87654321",
        "limite_disponible" => "500000",
        "dni" => "29745686",
        "nombre" => "María José",
        "apellido" => "López",
        "fecha_expiracion" => "11/26",
        "cvv" => "306"
    ]);

    // Datos de la solicitud
    $data = [
        'numero_tarjeta' => '87654321',
        'monto' => "800000",
        'cuotas' => "5",
    ];

    // Realizar la solicitud POST
    $response = $this->postJson('/api/card-pay', $data);

    // Verificar la respuesta de error
    $response->assertStatus(400)
             ->assertJson([
                 'estado' => 'error',
                 'message' => 'Límite insuficiente para efectuar el pago',
             ]);
    }
}
