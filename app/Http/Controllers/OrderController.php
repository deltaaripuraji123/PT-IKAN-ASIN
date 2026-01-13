<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\Product;
use App\Models\TransactionLog;
use App\Services\ECCService;
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
        
        $carts = collect(); // Default kosong
        $total = 0;

        // CEK: Apakah user sedang melakukan "Beli Sekarang" ?
        if (session()->has('buy_now_item')) {
            $buyNowData = session('buy_now_item');
            $product = Product::find($buyNowData['product_id']);

            if ($product) {
                // Buat collection palsu agar formatnya sama seperti Cart
                $carts = collect([
                    (object)[
                        'product_id' => $product->id,
                        'quantity'   => $buyNowData['quantity'],
                        'product'    => $product
                    ]
                ]);
                $total = $product->price * $buyNowData['quantity'];
            }
        } else {
            // LOGIKA BIASA: Ambil dari Keranjang (Cart)
            $carts = Cart::where('user_id', Auth::id())->with('product')->get();
            
            if ($carts->isEmpty()) {
                return redirect()->route('cart.index')->with('error', 'Keranjang belanja Anda kosong.');
            }
            
            $total = $carts->sum(function($cart) {
                return $cart->product->price * $cart->quantity;
            });
        }
        
        return view('order.checkout', compact('carts', 'total'));
    }
    
    /**
     * Handle "Beli Sekarang" request.
     */
<<<<<<< HEAD
    public function buyNow(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        // Cek Stok
        if ($product->stock < $request->quantity) {
            return redirect()->back()->with('error', "Stok untuk {$product->name} tidak mencukupi. Stok tersisa: {$product->stock}");
        }

        // Simpan data beli langsung ke session
        session()->put('buy_now_item', [
            'product_id' => $product->id,
            'quantity'   => $request->quantity,
        ]);

        // Redirect ke halaman checkout
        return redirect()->route('order.checkout');
    }
    
    /**
     * Store a new order (DIPERBAIKI: Mendukung Cart & BuyNow).
     */
=======
>>>>>>> 5483df7122c92ad80bf6d823bab8bf49bcfd3b68
    public function store(Request $request, ECCService $eccService)
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
        
        // --- PERUBAHAN LOGIC UTAMA DISINI ---
        
        // Tentukan sumber data: Apakah dari Session (Beli Sekarang) atau dari Tabel Cart?
        $items = collect();
        $isBuyNow = false;

        if (session()->has('buy_now_item')) {
            // MODE 1: BELI SEKARANG (Tanpa Keranjang)
            $isBuyNow = true;
            $buyNowData = session('buy_now_item');
            $product = Product::find($buyNowData['product_id']);
            
            if ($product) {
                // Buat object standar agar bisa diproses loop dengan cara yang sama seperti Cart
                $items->push((object)[
                    'product_id' => $product->id,
                    'quantity'   => $buyNowData['quantity'],
                    'product'    => $product
                ]);
            }
        } else {
            // MODE 2: CHECKOUT KERANJANG BIASA
            $items = Cart::where('user_id', Auth::id())->with('product')->get();
            
            if ($items->isEmpty()) {
                Log::error('Keranjang kosong saat checkout.');
                return redirect()->route('cart.index')->with('error', 'Keranjang belanja Anda kosong.');
            }
        }
        // -------------------------------------

        // Hitung Total & Cek Stok (Universal untuk kedua mode)
        $total = 0;
        foreach ($items as $item) {
            $total += $item->product->price * $item->quantity;
            
            // Cek stok produk
            if ($item->product->stock < $item->quantity) {
                $redirectTarget = $isBuyNow ? route('home') : route('cart.index');
                Log::error('Stok tidak mencukupi untuk produk: ' . $item->product->name);
                return redirect($redirectTarget)->with('error', "Stok untuk {$item->product->name} tidak mencukupi. Stok tersisa: {$item->product->stock}");
            }
        }
        Log::info('Total harga dihitung: ' . $total);
        
        // Buat order dengan transaksi database
        DB::beginTransaction();
        try {
            Log::info('Transaksi database dimulai.');

            // --- AWAL TAMBAHAN: AMBIL DATA USER YANG SEDANG LOGIN ---
            $loggedInUser = Auth::user();
            Log::info('Data pemesan diambil untuk User ID: ' . $loggedInUser->id);
            // --- AKHIR TAMBAHAN ---

            // Alamat akan dienkripsi otomatis oleh mutator di Model Order
            $order = Order::create([
                'user_id' => Auth::id(),
                'total_price' => $total,
                'address' => $request->address, // Mutator akan mengenkripsi ini
                'payment_status' => 'pending',
                'order_status' => 'pending',
                // --- AWAL TAMBAHAN: SIMPAN DATA PESANAN ---
                'customer_name' => $loggedInUser->name,
                'customer_phone' => $loggedInUser->phone,
                'customer_email' => $loggedInUser->email,
                // --- AKHIR TAMBAHAN ---
            ]);

            Log::info('Order berhasil dibuat dengan ID: ' . $order->id);
            
            // Buat order items dan kurangi stok
            foreach ($items as $item) {
                Log::info('Membuat order item untuk produk ID: ' . $item->product_id);
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'subtotal_price' => $item->product->price * $item->quantity
                ]);
                
                // Kurangi stok produk
                $product = Product::find($item->product_id);
                $product->stock -= $item->quantity;
                $product->save();
                Log::info('Stok produk ID ' . $product->id . ' berhasil dikurangi. Stok baru: ' . $product->stock);
            }
            
            Log::info('Semua order item dan stok berhasil diperbarui.');
            
            // --- CLEANUP: Hapus data sementara ---
            if ($isBuyNow) {
                // Hapus session jika mode Beli Sekarang
                session()->forget('buy_now_item');
                Log::info('Session buy_now_item berhasil dihapus.');
            } else {
                // Hapus cart jika mode Keranjang Biasa
                Cart::where('user_id', Auth::id())->delete();
                Log::info('Keranjang berhasil dihapus.');
            }
            // ------------------------------------
            
            DB::commit();
            Log::info('Transaksi berhasil di-commit.');

            // --- PROSES ENKRIPSI PAYLOAD ---
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
            // -----------------------------------
            
            return redirect()->route('order.success', $order->id)->with('success', 'Pesanan Anda berhasil dibuat.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Transaksi gagal. Error: ' . $e->getMessage());
            
            // Jika error saat buy now, redirect ke home. Jika cart, redirect ke cart.
            $redirectError = $isBuyNow ? route('home') : route('cart.index');
            return redirect($redirectError)->with('error', 'Terjadi kesalahan saat memproses pesanan: ' . $e->getMessage());
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
        
        // --- AWAL TAMBAHAN: LOAD RELASI UNTUK ADMIN ---
        $order->load('orderItems.product', 'user', 'transactionLog');
        // --- AKHIR TAMBAHAN ---
        
        return view('order.detail', compact('order'));
    }
}