<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\Product;
use App\Models\TransactionLog; // <--- TAMBAHKAN INI
use App\Services\ECCService;       // <--- TAMBAHKAN INI
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    /**
     * Display checkout page.
     */
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
    
    /**
     * Store a new order.
     */
    public function store(Request $request, ECCService $eccService) // <--- UBAHAN INI: INJECT ECC SERVICE
    {
        Log::info('===== PROSES CHECKOUT DIMULAI =====');
        Log::info('User ID: ' . Auth::id());

        if (!Auth::check()) {
            Log::error('User tidak login.');
            return redirect()->route('login')->with('message', 'Silakan login terlebih dahulu untuk melakukan checkout.');
        }
        
        $request->validate([
            'address' => 'required|string|min:10'
        ]);
        Log::info('Validasi alamat berhasil.');
        
        $carts = Cart::where('user_id', Auth::id())->with('product')->get();
        
        if ($carts->isEmpty()) {
            Log::error('Keranjang kosong saat checkout.');
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja Anda kosong.');
        }
        
        $total = $carts->sum(function($cart) {
            return $cart->product->price * $cart->quantity;
        });
        Log::info('Total harga dihitung: ' . $total);
        
        // Cek stok produk
        foreach ($carts as $cart) {
            if ($cart->product->stock < $cart->quantity) {
                Log::error('Stok tidak mencukupi untuk produk: ' . $cart->product->name);
                return redirect()->route('cart.index')->with('error', "Stok untuk {$cart->product->name} tidak mencukupi. Stok tersisa: {$cart->product->stock}");
            }
        }
        Log::info('Pengecekan stok berhasil.');
        
        // Buat order dengan transaksi database
        DB::beginTransaction();
        try {
            Log::info('Transaksi database dimulai.');

            // Alamat akan dienkripsi otomatis oleh mutator di Model Order
            $order = Order::create([
                'user_id' => Auth::id(),
                'total_price' => $total,
                'address' => $request->address, // Mutator akan mengenkripsi ini
                'payment_status' => 'pending',
                'order_status' => 'pending'
            ]);

            Log::info('Order berhasil dibuat dengan ID: ' . $order->id);
            
            // Buat order items dan kurangi stok
            foreach ($carts as $cart) {
                Log::info('Membuat order item untuk produk ID: ' . $cart->product_id);
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
                Log::info('Stok produk ID ' . $product->id . ' berhasil dikurangi. Stok baru: ' . $product->stock);
            }
            
            Log::info('Semua order item dan stok berhasil diperbarui.');
            
            // Hapus cart setelah checkout
            Cart::where('user_id', Auth::id())->delete();
            Log::info('Keranjang berhasil dihapus.');
            
            DB::commit();
            Log::info('Transaksi berhasil di-commit.');

            // --- AWAL TAMBAHAN: PROSES ENKRIPSI PAYLOAD ---
            Log::info('Memulai proses enkripsi payload transaksi...');
            $payload = [
                'order_id' => $order->id,
                'user_id' => Auth::id(),
                'total' => $total,
                'timestamp' => now()->toDateTimeString(),
            ];
            Log::info('Payload transaksi dibuat: ' . json_encode($payload));

            $encryptedPayload = $eccService->encrypt(json_encode($payload));
            Log::info('Payload berhasil dienkripsi.');

            TransactionLog::create([
                'order_id' => $order->id,
                'encrypted_payload' => $encryptedPayload,
            ]);
            Log::info('Payload terenkripsi berhasil disimpan ke transaction_logs.');
            // --- AKHIR TAMBAHAN: PROSES ENKRIPSI PAYLOAD ---
            
            return redirect()->route('order.success', $order->id)->with('success', 'Pesanan Anda berhasil dibuat.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Transaksi gagal. Error: ' . $e->getMessage());
            
            return redirect()->route('cart.index')->with('error', 'Terjadi kesalahan saat memproses pesanan: ' . $e->getMessage());
        }
    }
    
    /**
     * Display order success page.
     */
    public function success(Order $order)
    {
        // Pastikan user hanya bisa melihat order miliknya sendiri
        if ($order->user_id != Auth::id()) {
            return redirect()->route('home')->with('error', 'Anda tidak memiliki izin untuk melihat halaman ini.');
        }
        
        return view('order.success', compact('order'));
    }
    
    /**
     * Display user's order history.
     */
    public function history()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('message', 'Silakan login terlebih dahulu untuk melihat riwayat pesanan.');
        }
        
        $orders = Order::where('user_id', Auth::id())->with('orderItems.product')->orderBy('created_at', 'desc')->paginate(10);
        
        return view('order.history', compact('orders'));
    }
    
    /**
     * Display details of a specific order.
     */
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