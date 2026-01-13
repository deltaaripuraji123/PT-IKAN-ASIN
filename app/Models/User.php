<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Services\ECCService;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'address',
        'phone',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'address',
        'phone',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $appends = [
        'address_decrypted',
        'phone_decrypted',
    ];

    // --- ENKRIPSI / DEKRIPSI ---

    public function setAddressAttribute($value)
    {
        if ($value === null || $value === '') {
            $this->attributes['address'] = null;
            return;
        }
        $eccService = app(ECCService::class);
        $this->attributes['address'] = $eccService->encrypt($value);
    }

    public function getAddressAttribute($value)
    {
        if ($value === null || $value === '') {
            return null;
        }

        $eccService = app(ECCService::class);
        $decoded = base64_decode($value, true);

        if ($decoded !== false && strlen($decoded) >= 16) {
            return $eccService->decrypt($value);
        }

        return $value;
    }

    public function setPhoneAttribute($value)
    {
        if ($value === null || $value === '') {
            $this->attributes['phone'] = null;
            return;
        }
        $eccService = app(ECCService::class);
        $this->attributes['phone'] = $eccService->encrypt($value);
    }

    public function getPhoneAttribute($value)
    {
        if ($value === null || $value === '') {
            return null;
        }

        $eccService = app(ECCService::class);
        $decoded = base64_decode($value, true);

        if ($decoded !== false && strlen($decoded) >= 16) {
            return $eccService->decrypt($value);
        }

        return $value;
    }

    public function getAddressDecryptedAttribute()
    {
        return $this->address;
    }

    public function getPhoneDecryptedAttribute()
    {
        return $this->phone;
    }

    // --- RELASI ---
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }
}