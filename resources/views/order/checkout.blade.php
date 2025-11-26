@extends('layouts.app')

@section('title', 'Checkout - Ikan Asin Store')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Checkout</h1>
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h2 class="text-xl font-semibold mb-4">Alamat Pengiriman</h2>
                
                <form action="{{ route('order.store') }}" method="POST">
                    @csrf
                    
                    <!-- BLOK UNTUK MENAMPILKAN PESAN ERROR VALIDASI -->
                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">Oops! Ada yang salah:</strong>
                            <ul class="mt-2 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="mb-4">
                        <label for="address" class="block text-gray-700 font-medium mb-2">Alamat Lengkap</label>
                        <textarea id="address" name="address" rows="4" class="w-full border rounded-lg px-3 py-2" required>{{ old('address', auth()->user()->address ?? '') }}</textarea>
                    </div>
                    
                    <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                        Buat Pesanan
                    </button>
                </form>
            </div>
        </div>
        
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold mb-4">Ringkasan Pesanan</h2>
                
                <div class="space-y-4 mb-4">
                    @foreach($carts as $cart)
                        <div class="flex items-center">
                            <div class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center mr-4">
                                @if($cart->product->image)
                                    <img src="{{ asset('images/products/' . $cart->product->image) }}" alt="{{ $cart->product->name }}" class="w-full h-full object-cover rounded">
                                @else
                                    <i class="fas fa-fish text-2xl text-gray-400"></i>
                                @endif
                            </div>
                            <div class="flex-1">
                                <h3 class="font-semibold">{{ $cart->product->name }}</h3>
                                <p class="text-sm text-gray-500">{{ $cart->quantity }} x Rp. {{ number_format($cart->product->price, 0, ',', '.') }}</p>
                            </div>
                            <div class="text-right">
                                <p class="font-semibold">Rp. {{ number_format($cart->product->price * $cart->quantity, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="border-t pt-4 space-y-2">
                    <div class="flex justify-between">
                        <span>Subtotal:</span>
                        <span>Rp. {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Ongkir:</span>
                        <span>Gratis</span>
                    </div>
                    <div class="border-t pt-2 flex justify-between font-semibold text-lg">
                        <span>Total:</span>
                        <span>Rp. {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection