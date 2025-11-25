@extends('layouts.app')

@section('title', 'Produk - Ikan Asin Store')

@section('content')
<div class="bg-gray-100 py-8">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold mb-8">Produk Kami</h1>
        
        <div class="flex flex-col md:flex-row gap-8">
            <!-- Filter Sidebar -->
            <div class="md:w-1/4">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-4">Filter</h2>
                    
                    <div class="mb-6">
                        <h3 class="font-medium mb-2">Kategori</h3>
                        <ul class="space-y-2">
                            <li>
                                <a href="{{ route('products.index') }}" class="{{ !request('category') ? 'text-blue-600 font-medium' : 'text-gray-700 hover:text-blue-600' }}">
                                    Semua Kategori
                                </a>
                            </li>
                            @foreach($categories as $category)
                                <li>
                                    <a href="{{ route('products.index', ['category' => $category->name]) }}" class="{{ request('category') == $category->name ? 'text-blue-600 font-medium' : 'text-gray-700 hover:text-blue-600' }}">
                                        {{ $category->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            
            <!-- Product Grid -->
            <div class="md:w-3/4">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex justify-between items-center mb-6">
                        <p class="text-gray-600">Menampilkan {{ $products->count() }} produk</p>
                        <div class="flex items-center space-x-2">
                            <label for="sort" class="text-gray-600">Urutkan:</label>
                            <select id="sort" class="border rounded px-3 py-1">
                                <option value="name">Nama</option>
                                <option value="price-low">Harga Terendah</option>
                                <option value="price-high">Harga Tertinggi</option>
                            </select>
                        </div>
                    </div>
                    
                    @if($products->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($products as $product)
                                <div class="border rounded-lg overflow-hidden hover:shadow-lg transition">
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
                                        <div class="flex justify-between items-center mb-3">
                                            <span class="text-sm text-gray-500">Stok: {{ $product->stock }}</span>
                                            <span class="text-sm text-gray-500">{{ $product->category->name }}</span>
                                        </div>
                                        <div class="flex space-x-2">
                                            <a href="{{ route('products.show', $product->id) }}" class="flex-1 bg-gray-200 text-gray-800 py-2 rounded text-center hover:bg-gray-300 transition">Detail</a>
                                            @if($product->stock > 0)
                                                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="flex-1">
                                                    @csrf
                                                    <input type="hidden" name="quantity" value="1">
                                                    <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">+ Keranjang</button>
                                                </form>
                                            @else
                                                <button class="flex-1 bg-gray-300 text-gray-500 py-2 rounded cursor-not-allowed" disabled>Habis</button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="mt-8">
                            {{ $products->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <i class="fas fa-fish text-6xl text-gray-300 mb-4"></i>
                            <p class="text-gray-500">Tidak ada produk yang ditemukan.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('sort').addEventListener('change', function() {
        const url = new URL(window.location);
        const sortValue = this.value;
        
        if (sortValue === 'name') {
            url.searchParams.delete('sort');
        } else {
            url.searchParams.set('sort', sortValue);
        }
        
        window.location.href = url.toString();
    });
</script>
@endsection