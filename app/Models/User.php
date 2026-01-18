<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

     // ========================
    // Relaciones POS
    // ========================

    /**
     * Rol del usuario
     */
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id');
    }

    /**
     * Ventas realizadas por el usuario
     */
    public function ventas()
    {
        return $this->hasMany(Venta::class, 'usuario_id');
    }

    /**
     * Compras registradas por el usuario
     */
    public function compras()
    {
        return $this->hasMany(Compra::class, 'usuario_id');
    }

    /**
     * Cajas abiertas por el usuario
     */
    public function cajas()
    {
        return $this->hasMany(Caja::class, 'usuario_id');
    }

    /**
     * Caja actualmente abierta por el usuario
     */
    public function cajaAbierta()
    {
        return $this->hasOne(Caja::class, 'usuario_id')
            ->where('estado', 'abierta');
    }
}
