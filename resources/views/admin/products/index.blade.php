@extends('admin.layouts.dashboard')

@section('title', 'Kelola Produk - Admin')

@section('content')
<div class="container mx-auto">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Kelola Produk</h1>
        <a href="{{ route('admin.products.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition flex items-center justify-center sm:justify-start">
            <i class="fas fa-plus mr-2"></i>
            Tambah Produk
        </a>
    </div>
    
    <!-- Table Card -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50 dark:bg-gray-700 border-b dark:border-gray-600">
                        <th class="text-left p-4 font-medium text-gray-700 dark:text-gray-300">Gambar</th>
                        <th class="text-left p-4 font-medium text-gray-700 dark:text-gray-300">Nama</th>
                        <th class="text-left p-4 font-medium text-gray-700 dark:text-gray-300">Kategori</th>
                        <th class="text-left p-4 font-medium text-gray-700 dark:text-gray-300">Harga</th>
                        <th class="text-left p-4 font-medium text-gray-700 dark:text-gray-300">Stok</th>
                        <th class="text-center p-4 font-medium text-gray-700 dark:text-gray-300">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            <td class="p-4">
                                <div class="w-16 h-16 bg-gray-200 dark:bg-gray-600 rounded-lg flex items-center justify-center overflow-hidden">
                                    @if($product->image)
                                        <img src="{{ asset('images/products/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                    @else
                                        <i class="fas fa-fish text-2xl text-gray-400 dark:text-gray-500"></i>
                                    @endif
                                </div>
                            </td>
                            <td class="p-4 font-medium text-gray-900 dark:text-white">{{ $product->name }}</td>
                            <td class="p-4 text-gray-600 dark:text-gray-300">{{ $product->category->name }}</td>
                            <td class="p-4 text-gray-900 dark:text-white">Rp. {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td class="p-4 text-gray-900 dark:text-white">{{ $product->stock }}</td>
                            <td class="p-4 text-center">
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="text-blue-600 dark:text-blue-400 hover:underline mr-3">Edit</a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 dark:text-red-400 hover:underline" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-8 text-center text-gray-500 dark:text-gray-400">
                                Belum ada produk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($products->hasPages())
            <div class="p-4 border-t dark:border-gray-700">
                {{ $products->links() }}
            </div>
        @endif
    </div>
</div>
@endsection