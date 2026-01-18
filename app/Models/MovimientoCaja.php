<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovimientoCaja extends Model
{
    protected $table = 'movimientos_caja';

    protected $fillable = [
        'caja_id',
        'tipo',
        'monto',
        'descripcion',
        'fecha'
    ];

    protected $casts = [
        'fecha' => 'datetime'
    ];

    public function caja()
    {
        return $this->belongsTo(Caja::class);
    }
}
