@extends('layouts.app')

@section('title', $product->name . ' - Ikan Asin Store')

@section('content')
<div class="container mx-auto px-4 py-8">
    <nav class="text-sm mb-4">
        <a href="{{ route('home') }}" class="text-blue-600 hover:underline">Beranda</a>
        <span class="mx-2">/</span>
        <a href="{{ route('products.index') }}" class="text-blue-600 hover:underline">Produk</a>
        <span class="mx-2">/</span>
        <span class="text-gray-500">{{ $product->name }}</span>
    </nav>
    
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-8">
            <div>
                <div class="h-96 bg-gray-200 rounded-lg flex items-center justify-center">
                    @if($product->image)
                        <img src="{{ asset('images/products/' . $product->image) }}" alt="{{ $product->name }}" class="h-full w-full object-cover rounded-lg">
                    @else
                        <i class="fas fa-fish text-8xl text-gray-400"></i>
                    @endif
                </div>
            </div>
            
            <div>
                <h1 class="text-3xl font-bold mb-4">{{ $product->name }}</h1>
                
                <div class="mb-4">
                    <span class="inline-block bg-blue-100 text-blue-800 text-sm px-3 py-1 rounded-full">
                        {{ $product->category->name }}
                    </span>
                </div>
                
                <div class="mb-6">
                    <p class="text-2xl font-bold text-blue-600">Rp. {{ number_format($product->price, 0, ',', '.') }}</p>
                </div>
                
                <div class="mb-6">
                    <p class="text-gray-600">{{ $product->description }}</p>
                </div>
                
                <div class="mb-6">
                    <p class="text-gray-600">Stok: <span class="font-semibold {{ $product->stock > 10 ? 'text-green-600' : ($product->stock > 0 ? 'text-yellow-600' : 'text-red-600') }}">{{ $product->stock }}</span></p>
                </div>
                
                @if($product->stock > 0)
                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mb-6">
                        @csrf
                        <div class="flex items-center space-x-4 mb-4">
                            <label for="quantity" class="text-gray-700">Jumlah:</label>
                            <input type="number" id="quantity" name="quantity" min="1" max="{{ $product->stock }}" value="1" class="w-20 border rounded px-3 py-2">
                        </div>
                        
                        <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                            <i class="fas fa-shopping-cart mr-2"></i>
                            Tambah ke Keranjang
                        </button>
                    </form>
                @else
                    <button class="w-full bg-gray-300 text-gray-500 py-3 rounded-lg font-semibold cursor-not-allowed" disabled>
                        <i class="fas fa-times-circle mr-2"></i>
                        Stok Habis
                    </button>
                @endif
                
                <div class="border-t pt-6">
                    <h3 class="font-semibold mb-2">Informasi Tambahan:</h3>
                    <ul class="text-gray-600 space-y-1">
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Produk berkualitas tinggi</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Pengemasan yang aman dan higienis</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Pengiriman cepat</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <div class="mt-8 bg-white rounded-lg shadow-md p-8">
        <h2 class="text-2xl font-bold mb-4">Produk Terkait</h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            @php
                $relatedProducts = App\Models\Product::where('category_id', $product->category_id)
                                                    ->where('id', '!=', $product->id)
                                                    ->take(4)
                                                    ->get();
            @endphp
            @foreach($relatedProducts as $relatedProduct)
                <div class="border rounded-lg overflow-hidden hover:shadow-lg transition">
                    <a href="{{ route('products.show', $relatedProduct->id) }}">
                        <div class="h-32 bg-gray-200 flex items-center justify-center">
                            @if($relatedProduct->image)
                                <img src="{{ asset('images/products/' . $relatedProduct->image) }}" alt="{{ $relatedProduct->name }}" class="h-full w-full object-cover">
                            @else
                                <i class="fas fa-fish text-4xl text-gray-400"></i>
                            @endif
                        </div>
                    </a>
                    <div class="p-3">
                        <h3 class="text-sm font-semibold mb-1">{{ $relatedProduct->name }}</h3>
                        <p class="text-gray-600 text-sm">Rp. {{ number_format($relatedProduct->price, 0, ',', '.') }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection