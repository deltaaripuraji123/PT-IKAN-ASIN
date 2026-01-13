@extends('layouts.app')

@section('title', $product->name . ' - Ikan Asin Store')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Breadcrumbs -->
    <nav class="text-sm mb-6">
        <a href="{{ route('home') }}" class="text-blue-600 hover:underline">Beranda</a>
        <span class="mx-2 text-gray-400">/</span>
        <a href="{{ route('products.index') }}" class="text-blue-600 hover:underline">Produk</a>
        <span class="mx-2 text-gray-400">/</span>
        <span class="text-gray-500 font-medium">{{ $product->name }}</span>
    </nav>
    
    <!-- Produk Utama -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-12">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-8">
            <!-- Gambar Produk -->
            <div class="flex justify-center items-center bg-gray-50 rounded-lg p-4">
                <div class="h-96 w-full bg-gray-200 rounded-lg flex items-center justify-center overflow-hidden">
                    @if($product->image)
                        <img src="{{ asset('images/products/' . $product->image) }}" alt="{{ $product->name }}" class="h-full w-full object-cover hover:scale-105 transition duration-300">
                    @else
                        <i class="fas fa-fish text-8xl text-gray-300"></i>
                    @endif
                </div>
            </div>
            
            <!-- Detail Produk -->
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $product->name }}</h1>
                
                <div class="mb-4">
                    <span class="inline-block bg-blue-100 text-blue-800 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">
                        {{ $product->category->name }}
                    </span>
                </div>
                
                <div class="mb-6">
                    <p class="text-3xl font-bold text-blue-600">Rp. {{ number_format($product->price, 0, ',', '.') }}</p>
                </div>
                
                <div class="mb-6">
                    <p class="text-gray-600 leading-relaxed">{{ $product->description }}</p>
                </div>
                
                <div class="mb-6 flex items-center">
                    <span class="text-gray-600 mr-2">Stok:</span>
                    <span class="px-3 py-1 rounded-full text-sm font-bold
                        @if($product->stock > 10) bg-green-100 text-green-800
                        @elseif($product->stock > 0) bg-yellow-100 text-yellow-800
                        @else bg-red-100 text-red-800 @endif">
                        {{ $product->stock > 0 ? $product->stock . ' Tersedia' : 'Habis' }}
                    </span>
                </div>
                
                @if($product->stock > 0)
                    <!-- Form Section -->
                    <div class="mb-8 bg-gray-50 p-6 rounded-lg border border-gray-100">
                        <div class="flex items-center space-x-4 mb-6">
                            <label for="quantity" class="text-gray-700 font-medium">Jumlah:</label>
                            <input type="number" id="quantity" name="quantity" min="1" max="{{ $product->stock }}" value="1" class="w-24 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-center">
                        </div>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Tombol Tambah Keranjang -->
                            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="quantity" id="cart_qty" value="1">
                                <button type="submit" onclick="syncQty('cart_qty')" class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition shadow-sm flex items-center justify-center">
                                    <i class="fas fa-cart-plus mr-2"></i> + Keranjang
                                </button>
                            </form>

                            <!-- Tombol Beli Sekarang -->
                            <form action="{{ route('order.buynow', $product->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="quantity" id="buynow_qty" value="1">
                                <button type="submit" onclick="syncQty('buynow_qty')" class="w-full bg-orange-500 text-white py-3 rounded-lg font-semibold hover:bg-orange-600 transition shadow-md flex items-center justify-center">
                                    <i class="fas fa-bolt mr-2"></i> Beli Sekarang
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="mb-8 bg-red-50 p-6 rounded-lg border border-red-100 text-center">
                        <button class="w-full bg-gray-300 text-gray-500 py-3 rounded-lg font-semibold cursor-not-allowed" disabled>
                            <i class="fas fa-times-circle mr-2"></i> Stok Habis
                        </button>
                    </div>
                @endif
                
                <!-- Informasi Tambahan -->
                <div class="border-t pt-6">
                    <h3 class="font-semibold mb-3 text-gray-700">Keunggulan Produk:</h3>
                    <ul class="text-gray-600 space-y-2 text-sm">
                        <li class="flex items-center"><i class="fas fa-check-circle text-green-500 mr-2"></i> Produk asli berkualitas tinggi</li>
                        <li class="flex items-center"><i class="fas fa-check-circle text-green-500 mr-2"></i> Pengemasan aman dan higienis</li>
                        <li class="flex items-center"><i class="fas fa-check-circle text-green-500 mr-2"></i> Pengiriman cepat ke seluruh Indonesia</li>
                        <li class="flex items-center"><i class="fas fa-check-circle text-green-500 mr-2"></i> Garansi kesegaran produk</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Produk Terkait -->
    @php
        // Query untuk mengambil produk terkait berdasarkan kategori yang sama
        $relatedProducts = App\Models\Product::where('category_id', $product->category_id)
                                            ->where('id', '!=', $product->id)
                                            ->inRandomOrder() // Diacak agar selalu tampil beda
                                            ->take(4)
                                            ->get();
    @endphp

    @if($relatedProducts->count() > 0)
    <div class="bg-white rounded-lg shadow-md p-8">
        <h2 class="text-2xl font-bold mb-6 text-gray-800 border-l-4 border-blue-600 pl-3">Produk Terkait</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($relatedProducts as $relatedProduct)
                <div class="border border-gray-100 rounded-lg overflow-hidden hover:shadow-lg transition duration-300 group">
                    <a href="{{ route('products.show', $relatedProduct->id) }}" class="block">
                        <div class="h-48 bg-gray-200 relative overflow-hidden">
                            @if($relatedProduct->image)
                                <img src="{{ asset('images/products/' . $relatedProduct->image) }}" alt="{{ $relatedProduct->name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <i class="fas fa-fish text-4xl text-gray-300"></i>
                                </div>
                            @endif
                        </div>
                    </a>
                    <div class="p-4">
                        <a href="{{ route('products.show', $relatedProduct->id) }}">
                            <h3 class="text-sm font-bold text-gray-800 mb-1 hover:text-blue-600 truncate">{{ $relatedProduct->name }}</h3>
                        </a>
                        <p class="text-blue-600 font-semibold">Rp. {{ number_format($relatedProduct->price, 0, ',', '.') }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @endif
</div>

<!-- Script Javascript untuk Sinkronisasi Quantity -->
<script>
    function syncQty(targetId) {
        // Ambil nilai dari input utama
        const mainQty = document.getElementById('quantity').value;
        
        // Validasi sederhana (opsional, karena sudah ada validasi HTML min/max)
        if(mainQty < 1) {
            alert("Jumlah minimal 1");
            return false; 
        }
        
        // Set nilai ke input hidden pada form yang diklik
        document.getElementById(targetId).value = mainQty;
        return true;
    }
</script>
@endsection