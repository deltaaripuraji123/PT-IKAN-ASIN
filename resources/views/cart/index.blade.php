@extends('layouts.app')

@section('title', 'Keranjang Belanja - Ikan Asin Store')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Keranjang Belanja</h1>
    
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            {{ session('error') }}
        </div>
    @endif
    
    @if($carts->count() > 0)
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b">
                                    <th class="text-left pb-3">Produk</th>
                                    <th class="text-center pb-3">Harga</th>
                                    <th class="text-center pb-3">Jumlah</th>
                                    <th class="text-center pb-3">Subtotal</th>
                                    <th class="text-center pb-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($carts as $cart)
                                    <tr class="border-b">
                                        <td class="py-4">
                                            <div class="flex items-center">
                                                <div class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center mr-4">
                                                    @if($cart->product->image)
                                                        <img src="{{ asset('images/products/' . $cart->product->image) }}" alt="{{ $cart->product->name }}" class="w-full h-full object-cover rounded">
                                                    @else
                                                        <i class="fas fa-fish text-2xl text-gray-400"></i>
                                                    @endif
                                                </div>
                                                <div>
                                                    <h3 class="font-semibold">{{ $cart->product->name }}</h3>
                                                    <p class="text-sm text-gray-500">{{ $cart->product->category->name }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center py-4">Rp. {{ number_format($cart->product->price, 0, ',', '.') }}</td>
                                        <td class="text-center py-4">
                                            <form action="{{ route('cart.update', $cart->id) }}" method="POST" class="flex items-center justify-center">
                                                @csrf
                                                <input type="number" name="quantity" min="1" max="{{ $cart->product->stock }}" value="{{ $cart->quantity }}" class="w-16 border rounded px-2 py-1 text-center">
                                                <button type="submit" class="ml-2 text-blue-600 hover:text-blue-800">
                                                    <i class="fas fa-sync-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                        <td class="text-center py-4">Rp. {{ number_format($cart->product->price * $cart->quantity, 0, ',', '.') }}</td>
                                        <td class="text-center py-4">
                                            <form action="{{ route('cart.remove', $cart->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800"></button>
                                                                                            <button type="submit" class="text-red-600 hover:text-red-800">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-4">Ringkasan Belanja</h2>
                    
                    <div class="space-y-2 mb-4">
                        <div class="flex justify-between">
                            <span>Subtotal:</span>
                            <span>Rp. {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Ongkir:</span>
                            <span>Gratis</span>
                        </div>
                        <div class="border-t pt-2 flex justify-between font-semibold">
                            <span>Total:</span>
                            <span>Rp. {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    
                    <a href="{{ route('order.checkout') }}" class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition text-center block">
                        Checkout
                    </a>
                    
                    <a href="{{ route('products.index') }}" class="w-full bg-gray-200 text-gray-800 py-3 rounded-lg font-semibold hover:bg-gray-300 transition text-center block mt-2">
                        Lanjut Belanja
                    </a>
                </div>
            </div>
        </div>
    @else
        <div class="bg-white rounded-lg shadow-md p-12 text-center">
            <i class="fas fa-shopping-cart text-6xl text-gray-300 mb-4"></i>
            <h2 class="text-2xl font-semibold mb-4">Keranjang Belanja Kosong</h2>
            <p class="text-gray-600 mb-6">Sepertinya Anda belum menambahkan produk ke keranjang.</p>
            <a href="{{ route('products.index') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                Mulai Belanja
            </a>
        </div>
    @endif
</div>
@endsection