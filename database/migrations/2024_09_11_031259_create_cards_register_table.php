<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards_register', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo_tarjeta', ['Visa', 'AMEX']);
            $table->string('entidad_bancaria', 100);
            $table->string('numero_tarjeta', 8);
            $table->decimal('limite_disponible', 10, 2);
            $table->string('dni', 8);
            $table->string('nombre', 100);
            $table->string('apellido', 100);
            $table->string('fecha_expiracion');
            $table->string('cvv', 3);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cards_register');
    }
};
