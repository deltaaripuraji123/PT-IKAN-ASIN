@extends('layouts.app')

@section('title', 'Tentang Kami - Ikan Asin Store')

@section('content')
<div class="bg-blue-600 text-white py-16">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl font-bold mb-4">Tentang Kami</h1>
        <p class="text-xl">Mengenal lebih dekat Ikan Asin Store</p>
    </div>
</div>

<div class="container mx-auto px-4 py-12">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-lg shadow-md p-8 mb-8">
            <h2 class="text-2xl font-bold mb-4">Sejarah Kami</h2>
            <p class="text-gray-700 mb-4">
                Ikan Asin Store didirikan pada tahun 2010 dengan visi untuk menyediakan ikan asin berkualitas tinggi 
                kepada masyarakat Indonesia. Kami berawal dari usaha kecil di pasar tradisional dan kini telah berkembang 
                menjadi toko online terpercaya yang melayani pelanggan di seluruh Indonesia.
            </p>
            <p class="text-gray-700">
                Dengan pengalaman lebih dari 10 tahun, kami telah membangun jaringan dengan nelayan lokal dan produsen 
                ikan asin terbaik untuk memastikan produk yang kami jual memiliki kualitas terbaik dan harga yang kompetitif.
            </p>
        </div>
        
        <div class="bg-white rounded-lg shadow-md p-8 mb-8">
            <h2 class="text-2xl font-bold mb-4">Visi & Misi</h2>
            <div class="mb-6">
                <h3 class="text-xl font-semibold mb-2">Visi</h3>
                <p class="text-gray-700">
                    Menjadi toko ikan asin online terdepan di Indonesia yang menyediakan produk berkualitas tinggi 
                    dengan harga terjangkau dan pelayanan terbaik.
                </p>
            </div>
            <div>
                <h3 class="text-xl font-semibold mb-2">Misi</h3>
                <ul class="list-disc list-inside text-gray-700 space-y-2">
                    <li>Menyediakan ikan asin berkualitas tinggi dari sumber terpercaya</li>
                    <li>Memberikan pelayanan terbaik kepada pelanggan</li>
                    <li>Mendukung nelayan lokal dengan memberikan harga yang adil</li>
                    <li>Terus berinovasi dalam pengolahan dan pengemasan ikan asin</li>
                    <li>Menjangkau lebih banyak pelanggan di seluruh Indonesia</li>
                </ul>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow-md p-8">
            <h2 class="text-2xl font-bold mb-4">Tim Kami</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="text-center">
                    <img src="https://ui-avatars.com/api/?name=Ahmad+Rizki&background=0d8abc&color=fff&size=128" alt="Ahmad Rizki" class="w-32 h-32 rounded-full mx-auto mb-4">
                    <h3 class="text-xl font-semibold">Ahmad Rizki</h3>
                    <p class="text-gray-600">Founder & CEO</p>
                </div>
                <div class="text-center">
                    <img src="https://ui-avatars.com/api/?name=Siti+Nurhaliza&background=0d8abc&color=fff&size=128" alt="Siti Nurhaliza" class="w-32 h-32 rounded-full mx-auto mb-4">
                    <h3 class="text-xl font-semibold">Siti Nurhaliza</h3>
                    <p class="text-gray-600">Head of Operations</p>
                </div>
                <div class="text-center">
                    <img src="https://ui-avatars.com/api/?name=Budi+Santoso&background=0d8abc&color=fff&size=128" alt="Budi Santoso" class="w-32 h-32 rounded-full mx-auto mb-4">
                    <h3 class="text-xl font-semibold">Budi Santoso</h3>
                    <p class="text-gray-600">Head of Marketing</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection