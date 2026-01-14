<?php

namespace App\Models;

use App\Services\ECCService; // <--- PASTIKAN INI
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
        'address', // Alamat pengiriman
        'payment_status',
        'order_status',
        'customer_name', // <--- TAMBAHKAN INI
        'customer_phone', // <--- TAMBAHKAN INI
        'customer_email', // <--- TAMBAHKAN INI
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
        'customer_phone_decrypted', // <--- TAMBAHKAN INI
        'customer_email_decrypted', // <--- TAMBAHKAN INI
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

    // --- AWAL TAMBAHAN: MUTATOR UNTUK ENKRIPSI DATA PESANAN ---

    /**
     * Interaksi dengan model untuk enkripsi nama pemesan.
     */
    public function setCustomerNameAttribute($value)
    {
        $eccService = app(ECCService::class);
        $this->attributes['customer_name'] = $eccService->encrypt($value);
    }

    /**
     * Interaksi dengan model untuk enkripsi telepon pemesan.
     */
    public function setCustomerPhoneAttribute($value)
    {
        $eccService = app(ECCService::class);
        $this->attributes['customer_phone'] = $eccService->encrypt($value);
    }

    /**
     * Interaksi dengan model untuk enkripsi email pemesan.
     */
    public function setCustomerEmailAttribute($value)
    {
        $eccService = app(ECCService::class);
        $this->attributes['customer_email'] = $eccService->encrypt($value);
    }

    // --- AWAL TAMBAHAN: ACCESSOR UNTUK DEKRIPSI DATA PESANAN ---

    /**
     * Interaksi dengan model untuk mendekripsi nama pemesan.
     */
    public function getCustomerNameAttribute($value)
    {
        $eccService = app(ECCService::class);
        if (base64_decode($value, true) !== false) {
            return $eccService->decrypt($value);
        }
        return $value;
    }

    /**
     * Interaksi dengan model untuk mendekripsi telepon pemesan.
     */
    public function getCustomerPhoneAttribute($value)
    {
        $eccService = app(ECCService::class);
        if (base64_decode($value, true) !== false) {
            return $eccService->decrypt($value);
        }
        return $value;
    }

    /**
     * Interaksi dengan model untuk mendekripsi email pemesan.
     */
    public function getCustomerEmailAttribute($value)
    {
        $eccService = app(ECCService::class);
        if (base64_decode($value, true) !== false) {
            return $eccService->decrypt($value);
        }
        return $value;
    }
    
    /**
     * Atribut yang telah di-dekripsi.
     */
    public function getCustomerPhoneDecryptedAttribute()
    {
        return $this->customer_phone;
    }

    public function getCustomerEmailDecryptedAttribute()
    {
        return $this->customer_email;
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
    
    // --- TAMBAHKAN RELASI INI ---
    public function transactionLog()
    {
        return $this->hasOne(TransactionLog::class);
    }
    // --- SELESAI TAMBAHKAN RELASI ---
}