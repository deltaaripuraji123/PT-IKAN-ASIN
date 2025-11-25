@extends('layouts.app')

@section('title', 'Kelola Kategori - Admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold">Kelola Kategori</h1>
        <a href="{{ route('admin.categories.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
            <i class="fas fa-plus mr-2"></i>
            Tambah Kategori
        </a>
    </div>
    
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="text-left p-4">Nama Kategori</th>
                        <th class="text-left p-4">Jumlah Produk</th>
                        <th class="text-center p-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-4">{{ $category->name }}</td>
                            <td class="p-4">{{ $category->products_count }}</td>
                            <td class="p-4 text-center">
                                <a href="{{ route('admin.categories.edit', $category->id) }}" class="text-blue-600 hover:underline mr-2">Edit</a>
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="p-4">
            {{ $categories->links() }}
        </div>
    </div>
</div>
@endsection