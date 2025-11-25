<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function checkout()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('message', 'Silakan login terlebih dahulu untuk melakukan checkout.');
        }
        
        $carts = Cart::where('user_id', Auth::id())->with('product')->get();
        
        if ($carts->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja Anda kosong.');
        }
        
        $total = $carts->sum(function($cart) {
            return $cart->product->price * $cart->quantity;
        });
        
        return view('order.checkout', compact('carts', 'total'));
    }
    
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('message', 'Silakan login terlebih dahulu untuk melakukan checkout.');
        }
        
        $request->validate([
            'address' => 'required|string|min:10'
        ]);
        
        $carts = Cart::where('user_id', Auth::id())->with('product')->get();
        
        if ($carts->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja Anda kosong.');
        }
        
        $total = $carts->sum(function($cart) {
            return $cart->product->price * $cart->quantity;
        });
        
        // Cek stok produk
        foreach ($carts as $cart) {
            if ($cart->product->stock < $cart->quantity) {
                return redirect()->route('cart.index')->with('error', "Stok untuk {$cart->product->name} tidak mencukupi.");
            }
        }
        
        // Buat order dengan transaksi database
        DB::beginTransaction();
        try {
            $order = Order::create([
                'user_id' => Auth::id(),
                'total_price' => $total,
                'address' => $request->address,
                'payment_status' => 'pending',
                'order_status' => 'pending'
            ]);
            
            // Buat order items dan kurangi stok
            foreach ($carts as $cart) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cart->product_id,
                    'quantity' => $cart->quantity,
                    'subtotal_price' => $cart->product->price * $cart->quantity
                ]);
                
                // Kurangi stok produk
                $product = Product::find($cart->product_id);
                $product->stock -= $cart->quantity;
                $product->save();
            }
            
            // Hapus cart setelah checkout
            Cart::where('user_id', Auth::id())->delete();
            
            DB::commit();
            
            return redirect()->route('order.success', $order->id)->with('success', 'Pesanan Anda berhasil dibuat.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('cart.index')->with('error', 'Terjadi kesalahan saat memproses pesanan. Silakan coba lagi.');
        }
    }
    
    public function success(Order $order)
    {
        // Pastikan user hanya bisa melihat order miliknya sendiri
        if ($order->user_id != Auth::id()) {
            return redirect()->route('home')->with('error', 'Anda tidak memiliki izin untuk melihat halaman ini.');
        }
        
        return view('order.success', compact('order'));
    }
    
    public function history()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('message', 'Silakan login terlebih dahulu untuk melihat riwayat pesanan.');
        }
        
        $orders = Order::where('user_id', Auth::id())->with('orderItems.product')->orderBy('created_at', 'desc')->paginate(10);
        
        return view('order.history', compact('orders'));
    }
    
    public function detail(Order $order)
    {
        // Pastikan user hanya bisa melihat order miliknya sendiri
        if ($order->user_id != Auth::id()) {
            return redirect()->route('order.history')->with('error', 'Anda tidak memiliki izin untuk melihat pesanan ini.');
        }
        
        $order->load('orderItems.product');
        
        return view('order.detail', compact('order'));
    }
}