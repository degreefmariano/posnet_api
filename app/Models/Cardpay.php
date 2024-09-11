<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cardpay extends Model
{
    use HasFactory;

    protected $table = 'cards_pay';

    protected $primaryKey = 'id';

    protected $connection = 'mysql';

    protected $fillable = [
        'numero_tarjeta',
        'monto',
        'cuotas'
    ];
}
