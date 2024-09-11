<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cardregister extends Model
{
    use HasFactory;

    protected $table = 'cards_register';

    protected $primaryKey = 'id';

    protected $connection = 'mysql';

    protected $fillable = [
        'tipo_tarjeta',
        'entidad_bancaria',
        'numero_tarjeta',
        'limite_disponible',
        'dni',
        'nombre',
        'apellido',
        'fecha_expiracion',
        'cvv'
    ];
}


