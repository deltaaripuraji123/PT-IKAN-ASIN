@extends('layouts.app')

@section('title', 'Beranda - Ikan Asin Store')

@section('content')
<div class="bg-blue-600 text-white py-16">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl font-bold mb-4">Selamat Datang di Ikan Asin Store</h1>
        <p class="text-xl mb-8">Temukan berbagai jenis ikan asin berkualitas tinggi</p>
        <a href="{{ route('products.index') }}" class="bg-white text-blue-600 px-6 py-3 rounded-full font-semibold hover:bg-gray-100 transition">Lihat Produk</a>
    </div>
</div>

<div class="container mx-auto px-4 py-12">
    <h2 class="text-3xl font-bold text-center mb-8">Kategori Produk</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
        @foreach($categories as $category)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                <div class="h-48 bg-gray-200 flex items-center justify-center">
                    <i class="fas fa-fish text-6xl text-gray-400"></i>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2">{{ $category->name }}</h3>
                    <a href="{{ route('products.index', ['category' => $category->name]) }}" class="text-blue-600 hover:underline">Lihat Produk →</a>
                </div>
            </div>
        @endforeach
    </div>
    
    <h2 class="text-3xl font-bold text-center mb-8">Produk Unggulan</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($featuredProducts as $product)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                <a href="{{ route('products.show', $product->id) }}">
                    <div class="h-48 bg-gray-200 flex items-center justify-center">
                        @if($product->image)
                            <img src="{{ asset('images/products/' . $product->image) }}" alt="{{ $product->name }}" class="h-full w-full object-cover">
                        @else
                            <i class="fas fa-fish text-6xl text-gray-400"></i>
                        @endif
                    </div>
                </a>
                <div class="p-4">
                    <h3 class="text-lg font-semibold mb-2">{{ $product->name }}</h3>
                    <p class="text-gray-600 mb-2">Rp. {{ number_format($product->price, 0, ',', '.') }}</p>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">Stok: {{ $product->stock }}</span>
                        <a href="{{ route('products.show', $product->id) }}" class="text-blue-600 hover:underline">Detail</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
    <div class="text-center mt-8">
        <a href="{{ route('products.index') }}" class="bg-blue-600 text-white px-6 py-3 rounded-full font-semibold hover:bg-blue-700 transition">Lihat Semua Produk</a>
    </div>
</div>
@endsection