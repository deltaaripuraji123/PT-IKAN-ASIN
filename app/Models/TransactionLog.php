<?php

namespace App\Models;

use App\Services\ECCService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'encrypted_payload',
    ];

    /**
     * Relasi ke model Order.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Accessor untuk mendekripsi payload secara on-the-fly.
     * Diakses dengan: $log->decrypted_payload
     */
    public function getDecryptedPayloadAttribute()
    {
        $eccService = app(ECCService::class);
        $payload = $eccService->decrypt($this->encrypted_payload);
        return json_decode($payload, true);
    }
}