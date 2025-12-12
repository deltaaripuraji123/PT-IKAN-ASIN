<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Services\ECCService; // <--- TAMBAHKAN INI

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'address', // <--- TAMBAHKAN INI
        'phone',   // <--- TAMBAHKAN INI
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'address', // <--- SEMBUNYIKAN VERSI TERENKRIPSI
        'phone',   // <--- SEMBUNYIKAN VERSI TERENKRIPSI
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    
    /**
     * Tambahkan atribut yang telah di-dekripsi ke array model.
     */
    protected $appends = [
        'address_decrypted',
        'phone_decrypted',
    ];
    
    // --- AWAL LOGIKA ENKRIPSI DEKRIPSI ---

    /**
     * Interaksi dengan model untuk enkripsi alamat.
     * Dijalankan saat: $user->address = 'Jl. Sudirman';
     */
    public function setAddressAttribute($value)
    {
        $eccService = app(ECCService::class);
        $this->attributes['address'] = $eccService->encrypt($value);
    }

    /**
     * Interaksi dengan model untuk dekripsi alamat.
     * Dijalankan saat: echo $user->address;
     */
    public function getAddressAttribute($value)
    {
        $eccService = app(ECCService::class);
        // Cek apakah value terlihat seperti base64 untuk menghindari dekripsi ganda
        if (base64_decode($value, true) !== false) {
            return $eccService->decrypt($value);
        }
        return $value; // Kembalikan asli jika tidak terlihat terenkripsi (data lama)
    }
    
    /**
     * Interaksi dengan model untuk enkripsi telepon.
     */
    public function setPhoneAttribute($value)
    {
        $eccService = app(ECCService::class);
        $this->attributes['phone'] = $eccService->encrypt($value);
    }

    /**
     * Interaksi dengan model untuk dekripsi telepon.
     */
    public function getPhoneAttribute($value)
    {
        $eccService = app(ECCService::class);
        if (base64_decode($value, true) !== false) {
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
    
    // --- AKHIR LOGIKA ENKRIPSI DEKRIPSI ---
    
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