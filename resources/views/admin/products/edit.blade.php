@extends('layouts.app')

@section('title', 'Edit Produk - Admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Edit Produk</h1>
    
    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-gray-700 font-medium mb-2">Nama Produk</label>
                    <input type="text" id="name" name="name" value="{{ $product->name }}" class="w-full border rounded-lg px-3 py-2" required>
                </div>
                
                <div>
                    <label for="category_id" class="block text-gray-700 font-medium mb-2">Kategori</label>
                    <select id="category_id" name="category_id" class="w-full border rounded-lg px-3 py-2" required>
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div>
                    <label for="price" class="block text-gray-700 font-medium mb-2">Harga</label>
                    <input type="number" id="price" name="price" step="0.01" min="0" value="{{ $product->price }}" class="w-full border rounded-lg px-3 py-2" required>
                </div>
                
                <div>
                    <label for="stock" class="block text-gray-700 font-medium mb-2">Stok</label>
                    <input type="number" id="stock" name="stock" min="0" value="{{ $product->stock }}" class="w-full border rounded-lg px-3 py-2" required>
                </div>
                
                <div class="md:col-span-2">
                    <label for="description" class="block text-gray-700 font-medium mb-2">Deskripsi</label>
                    <textarea id="description" name="description" rows="4" class="w-full border rounded-lg px-3 py-2" required>{{ $product->description }}</textarea>
                </div>
                
                <div class="md:col-span-2">
                    <label for="image" class="block text-gray-700 font-medium mb-2">Gambar Produk</label>
                    <input type="file" id="image" name="image" class="w-full border rounded-lg px-3 py-2" accept="image/*">
                    <p class="text-sm text-gray-500 mt-1">Format: JPEG, PNG, JPG, GIF (Maks. 2MB). Kosongkan jika tidak ingin mengubah gambar.</p>
                    
                    @if($product->image)
                        <div class="mt-4">
                            <p class="text-sm text-gray-600 mb-2">Gambar Saat Ini:</p>
                            <img src="{{ asset('images/products/' . $product->image) }}" alt="{{ $product->name }}" class="w-32 h-32 object-cover rounded">
                        </div>
                    @endif
                </div>
            </div>
            
            <div class="flex justify-end space-x-4 mt-6">
                <a href="{{ route('admin.products.index') }}" class="bg-gray-200 text-gray-800 px-6 py-2 rounded-lg hover:bg-gray-300 transition">
                    Batal
                </a>
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection