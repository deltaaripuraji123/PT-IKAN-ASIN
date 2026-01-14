<?php

namespace App\Models;

use App\Services\ECCService;
use App\Models\User;
use App\Models\OrderItem;
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
        'address', 
        'payment_status',
        'order_status',
        'customer_name', 
        'customer_phone', 
        'customer_email', 
    ];
    
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'address',        // Sembunyikan versi terenkripsi asli
        'customer_name',  // Sembunyikan versi terenkripsi asli
        'customer_phone', // Sembunyikan versi terenkripsi asli
        'customer_email', // Sembunyikan versi terenkripsi asli
    ];

    /**
     * Tambahkan atribut yang telah di-dekripsi ke array model.
     */
    protected $appends = [
        'address_decrypted',
        'customer_name_decrypted',
        'customer_phone_decrypted',
        'customer_email_decrypted',
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

    // --- ACCESSOR (DEKRIPSI) ---

    /**
     * Interaksi dengan model untuk mendekripsi alamat.
     */
    public function getAddressAttribute($value)
    {
        $eccService = app(ECCService::class);
        // Cek apakah value kosong atau null sebelum didekripsi
        if (empty($value)) {
            return $value;
        }
        
        try {
            if (base64_decode($value, true) !== false) {
                return $eccService->decrypt($value);
            }
        } catch (\Exception $e) {
            // Jika gagal dekripsi (misal data lama belum terenkripsi), kembalikan nilai asli
            return $value;
        }
        return $value;
    }

    /**
     * Interaksi dengan model untuk mendekripsi nama pemesan.
     */
    public function getCustomerNameAttribute($value)
    {
        $eccService = app(ECCService::class);
        if (empty($value)) return $value;

        try {
            if (base64_decode($value, true) !== false) {
                return $eccService->decrypt($value);
            }
        } catch (\Exception $e) {
            return $value;
        }
        return $value;
    }

    /**
     * Interaksi dengan model untuk mendekripsi telepon pemesan.
     */
    public function getCustomerPhoneAttribute($value)
    {
        $eccService = app(ECCService::class);
        if (empty($value)) return $value;

        try {
            if (base64_decode($value, true) !== false) {
                return $eccService->decrypt($value);
            }
        } catch (\Exception $e) {
            return $value;
        }
        return $value;
    }

    /**
     * Interaksi dengan model untuk mendekripsi email pemesan.
     */
    public function getCustomerEmailAttribute($value)
    {
        $eccService = app(ECCService::class);
        if (empty($value)) return $value;

        try {
            if (base64_decode($value, true) !== false) {
                return $eccService->decrypt($value);
            }
        } catch (\Exception $e) {
            return $value;
        }
        return $value;
    }
    
    // --- APPENDS (ALIAS UNTUK VIEW/API) ---

    public function getAddressDecryptedAttribute()
    {
        return $this->address;
    }

    public function getCustomerNameDecryptedAttribute()
    {
        return $this->customer_name;
    }

    public function getCustomerPhoneDecryptedAttribute()
    {
        return $this->customer_phone;
    }

    public function getCustomerEmailDecryptedAttribute()
    {
        return $this->customer_email;
    }

    // --- RELATIONSHIPS ---

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}