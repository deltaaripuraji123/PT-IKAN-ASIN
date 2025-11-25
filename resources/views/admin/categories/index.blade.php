@extends('admin.layouts.dashboard')

@section('title', 'Kelola Kategori - Admin')

@section('content')
<div class="container mx-auto">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Kelola Kategori</h1>
        <a href="{{ route('admin.categories.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition flex items-center justify-center sm:justify-start">
            <i class="fas fa-plus mr-2"></i>
            Tambah Kategori
        </a>
    </div>
    
    <!-- Table Card -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50 dark:bg-gray-700 border-b dark:border-gray-600">
                        <th class="text-left p-4 font-medium text-gray-700 dark:text-gray-300">Nama Kategori</th>
                        <th class="text-left p-4 font-medium text-gray-700 dark:text-gray-300">Jumlah Produk</th>
                        <th class="text-center p-4 font-medium text-gray-700 dark:text-gray-300">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            <td class="p-4 font-medium text-gray-900 dark:text-white">{{ $category->name }}</td>
                            <td class="p-4 text-gray-600 dark:text-gray-300">{{ $category->products_count ?? 0 }}</td>
                            <td class="p-4 text-center">
                                <a href="{{ route('admin.categories.edit', $category->id) }}" class="text-blue-600 dark:text-blue-400 hover:underline mr-3">Edit</a>
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 dark:text-red-400 hover:underline" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="p-8 text-center text-gray-500 dark:text-gray-400">
                                Belum ada kategori.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($categories->hasPages())
            <div class="p-4 border-t dark:border-gray-700">
                {{ $categories->links() }}
            </div>
        @endif
    </div>
</div>
@endsection