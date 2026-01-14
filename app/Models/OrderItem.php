<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'subtotal_price'
    ];
    
    /**
     * Relasi ke tabel Orders.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    
    /**
     * Relasi ke tabel Products.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}