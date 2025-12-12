<?php

namespace App\Models;

use App\Services\ECCService; // <--- TAMBAHKAN INI
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'total_price',
        'address', // <--- PASTIKAN INI ADA
        'payment_status',
        'order_status',
    ];
    
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'address', // <--- SEMBUNYIKAN VERSI TERENKRIPSI
    ];

    /**
     * Tambahkan atribut yang telah di-dekripsi ke array model.
     */
    protected $appends = [
        'address_decrypted',
    ];

    // --- AWAL LOGIKA ENKRIPSI DEKRIPSI ---

    /**
     * Interaksi dengan model untuk enkripsi alamat.
     */
    public function setAddressAttribute($value)
    {
        $eccService = app(ECCService::class);
        $this->attributes['address'] = $eccService->encrypt($value);
    }

    /**
     * Interaksi dengan model untuk dekripsi alamat.
     */
    public function getAddressAttribute($value)
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

    // --- AKHIR LOGIKA ENKRIPSI DEKRIPSI ---
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}