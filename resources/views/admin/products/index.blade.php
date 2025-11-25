@extends('layouts.app')

@section('title', 'Kelola Produk - Admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold">Kelola Produk</h1>
        <a href="{{ route('admin.products.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
            <i class="fas fa-plus mr-2"></i>
            Tambah Produk
        </a>
    </div>
    
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="text-left p-4">Gambar</th>
                        <th class="text-left p-4">Nama</th>
                        <th class="text-left p-4">Kategori</th>
                        <th class="text-left p-4">Harga</th>
                        <th class="text-left p-4">Stok</th>
                        <th class="text-center p-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-4">
                                <div class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center">
                                    @if($product->image)
                                        <img src="{{ asset('images/products/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover rounded">
                                    @else
                                        <i class="fas fa-fish text-2xl text-gray-400"></i>
                                    @endif
                                </div>
                            </td>
                            <td class="p-4">{{ $product->name }}</td>
                            <td class="p-4">{{ $product->category->name }}</td>
                            <td class="p-4">Rp. {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td class="p-4">{{ $product->stock }}</td>
                            <td class="p-4 text-center">
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="text-blue-600 hover:underline mr-2">Edit</a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="p-4">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection