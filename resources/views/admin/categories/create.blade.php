@extends('layouts.app')

@section('title', 'Tambah Kategori - Admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Tambah Kategori</h1>
    
    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            
            <div class="mb-6">
                <label for="name" class="block text-gray-700 font-medium mb-2">Nama Kategori</label>
                <input type="text" id="name" name="name" class="w-full border rounded-lg px-3 py-2" required>
            </div>
            
            <div class="flex justify-end space-x-4">
                <a href="{{ route('admin.categories.index') }}" class="bg-gray-200 text-gray-800 px-6 py-2 rounded-lg hover:bg-gray-300 transition">
                    Batal
                </a>
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection