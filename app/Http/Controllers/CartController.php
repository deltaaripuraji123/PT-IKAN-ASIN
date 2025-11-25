<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('message', 'Silakan login terlebih dahulu untuk melihat keranjang belanja Anda.');
        }
        
        $carts = Cart::where('user_id', Auth::id())->with('product')->get();
        $total = $carts->sum(function($cart) {
            return $cart->product->price * $cart->quantity;
        });
        
        return view('cart.index', compact('carts', 'total'));
    }
    
    public function add(Request $request, Product $product)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('message', 'Silakan login terlebih dahulu untuk menambahkan produk ke keranjang.');
        }
        
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);
        
        $cartItem = Cart::where('user_id', Auth::id())
                        ->where('product_id', $product->id)
                        ->first();
        
        if ($cartItem) {
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => $request->quantity
            ]);
        }
        
        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }
    
    public function update(Request $request, Cart $cart)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);
        
        // Pastikan user hanya bisa mengupdate cart miliknya sendiri
        if ($cart->user_id != Auth::id()) {
            return redirect()->route('cart.index')->with('error', 'Anda tidak memiliki izin untuk melakukan aksi ini.');
        }
        
        $cart->quantity = $request->quantity;
        $cart->save();
        
        return redirect()->route('cart.index')->with('success', 'Keranjang berhasil diperbarui.');
    }
    
    public function remove(Cart $cart)
    {
        // Pastikan user hanya bisa menghapus cart miliknya sendiri
        if ($cart->user_id != Auth::id()) {
            return redirect()->route('cart.index')->with('error', 'Anda tidak memiliki izin untuk melakukan aksi ini.');
        }
        
        $cart->delete();
        
        return redirect()->route('cart.index')->with('success', 'Produk berhasil dihapus dari keranjang.');
    }
}