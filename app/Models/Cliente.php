<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';

    protected $fillable = [
        'nombre',
        'documento',
        'telefono',
        'email',
        'direccion'
    ];

    public function ventas()
    {
        return $this->hasMany(Venta::class);
    }
}
