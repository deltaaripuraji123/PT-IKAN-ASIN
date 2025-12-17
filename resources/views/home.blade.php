@extends('layouts.app')

@section('title', 'Beranda - Ikan Asin Store')

@section('content')
<!-- Hero Section dengan Gradient Baru -->
<div class="bg-gradient-to-r from-teal-500 to-blue-700 text-white py-20 shadow-lg">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-5xl font-bold mb-6 tracking-wide">Selamat Datang di Ikan Asin Store</h1>
        <p class="text-xl mb-10 max-w-2xl mx-auto">Temukan berbagai jenis ikan asin berkualitas tinggi langsung dari nelayan terpercaya</p>
        <a href="{{ route('products.index') }}" class="bg-white text-teal-600 px-8 py-4 rounded-full font-bold text-lg hover:bg-teal-50 transition-all transform hover:scale-105 shadow-lg">
            Lihat Produk Kami
        </a>
    </div>
</div>

<!-- Container Utama -->
<div class="container mx-auto px-4 py-16 max-w-7xl">
    <!-- Section Kategori -->
    <div class="mb-20">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">Kategori Produk</h2>
            <div class="w-24 h-1 bg-teal-500 mx-auto rounded-full"></div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($categories as $category)
            <div class="group bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100">
                <div class="h-56 bg-gradient-to-br from-teal-50 to-blue-50 flex items-center justify-center relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <i class="fas fa-fish text-7xl text-teal-500 group-hover:text-teal-600 transition-colors"></i>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-3 text-gray-800">{{ $category->name }}</h3>
                    <a href="{{ route('products.index', ['category' => $category->name]) }}" class="inline-flex items-center text-teal-600 font-medium hover:text-teal-700 group-hover:translate-x-1 transition-transform">
                        Lihat Produk 
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    
    <!-- Section Produk Unggulan -->
    <div>
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">Produk Unggulan</h2>
            <div class="w-24 h-1 bg-teal-500 mx-auto rounded-full"></div>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($featuredProducts as $product)
            <div class="group bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100">
                <a href="{{ route('products.show', $product->id) }}" class="block relative overflow-hidden">
                    <div class="h-56 bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center">
                        @if($product->image)
                            <img src="{{ asset('images/products/' . $product->image) }}" alt="{{ $product->name }}" class="h-full w-full object-cover group-hover:scale-110 transition-transform duration-500">
                        @else
                            <div class="text-center">
                                <i class="fas fa-fish text-6xl text-gray-300 group-hover:text-gray-400 transition-colors"></i>
                                <p class="mt-2 text-gray-500">Gambar tidak tersedia</p>
                            </div>
                        @endif
                    </div>
                    <div class="absolute top-4 right-4 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full opacity-0 group-hover:opacity-100 transition-opacity">
                        Hot Deal
                    </div>
                </a>
                <div class="p-5">
                    <h3 class="text-lg font-bold mb-2 text-gray-800 group-hover:text-teal-600 transition-colors">{{ $product->name }}</h3>
                    <p class="text-xl font-bold text-teal-600 mb-3">Rp. {{ number_format($product->price, 0, ',', '.') }}</p>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500 bg-gray-100 px-3 py-1 rounded-full">
                            <i class="fas fa-box mr-1"></i> Stok: {{ $product->stock }}
                        </span>
                        <a href="{{ route('products.show', $product->id) }}" class="text-teal-600 hover:text-teal-700 font-medium flex items-center group-hover:translate-x-1 transition-transform">
                            Detail
                            <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-14">
            <a href="{{ route('products.index') }}" class="inline-flex items-center bg-gradient-to-r from-teal-500 to-blue-600 text-white px-8 py-4 rounded-full font-bold text-lg hover:from-teal-600 hover:to-blue-700 transition-all transform hover:scale-105 shadow-lg">
                Lihat Semua Produk
                <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</div>
@endsection