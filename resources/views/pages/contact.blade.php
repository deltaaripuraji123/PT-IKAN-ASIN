@extends('layouts.app')

@section('title', 'Kontak Kami - Ikan Asin Store')

@section('content')
<div class="bg-blue-600 text-white py-16">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl font-bold mb-4">Kontak Kami</h1>
        <p class="text-xl">Hubungi kami untuk informasi lebih lanjut</p>
    </div>
</div>

<div class="container mx-auto px-4 py-12">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="bg-white rounded-lg shadow-md p-8">
            <h2 class="text-2xl font-bold mb-6">Informasi Kontak</h2>
            <div class="space-y-4">
                <div class="flex items-start">
                    <i class="fas fa-map-marker-alt text-blue-600 mt-1 mr-4 w-5"></i>
                    <div>
                        <h3 class="font-semibold">Alamat</h3>
                        <p class="text-gray-700">Pulau Pasaran, Bandar Lampung</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <i class="fas fa-phone text-blue-600 mt-1 mr-4 w-5"></i>
                    <div>
                        <h3 class="font-semibold">Telepon</h3>
                        <p class="text-gray-700">(021) 1234-5678</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <i class="fas fa-envelope text-blue-600 mt-1 mr-4 w-5"></i>
                    <div>
                        <h3 class="font-semibold">Email</h3>
                        <p class="text-gray-700">info@ikanasinstore.com</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <i class="fas fa-clock text-blue-600 mt-1 mr-4 w-5"></i>
                    <div>
                        <h3 class="font-semibold">Jam Operasional</h3>
                        <p class="text-gray-700">Senin - Sabtu: 08.00 - 20.00 WIB</p>
                        <p class="text-gray-700">Minggu: 09.00 - 17.00 WIB</p>
                    </div>
                </div>
            </div>
            
            <div class="mt-8">
                <h3 class="text-xl font-semibold mb-4">Ikuti Kami</h3>
                <div class="flex space-x-4">
                    <a href="#" class="text-blue-600 hover:text-blue-800 transition-colors">
                        <i class="fab fa-facebook-f text-2xl"></i>
                    </a>
                    <a href="#" class="text-blue-400 hover:text-blue-600 transition-colors">
                        <i class="fab fa-twitter text-2xl"></i>
                    </a>
                    <a href="#" class="text-pink-600 hover:text-pink-800 transition-colors">
                        <i class="fab fa-instagram text-2xl"></i>
                    </a>
                    <a href="#" class="text-red-600 hover:text-red-800 transition-colors">
                        <i class="fab fa-youtube text-2xl"></i>
                    </a>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow-md p-8">
            <h2 class="text-2xl font-bold mb-6">Kirim Pesan</h2>
            <form action="#" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-medium mb-2">Nama Lengkap</label>
                    <input type="text" id="name" name="name" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                    <input type="email" id="email" name="email" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="mb-4">
                    <label for="subject" class="block text-gray-700 font-medium mb-2">Subjek</label>
                    <input type="text" id="subject" name="subject" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="mb-4">
                    <label for="message" class="block text-gray-700 font-medium mb-2">Pesan</label>
                    <textarea id="message" name="message" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
                </div>
                <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">Kirim Pesan</button>
            </form>
        </div>
    </div>
    
    <div class="mt-12 bg-white rounded-lg shadow-md overflow-hidden">
        <div class="h-96">
            <!-- Embed Google Maps untuk Pulau Pasaran -->
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3972.534838423916!2d105.2646643!3d-5.4638889!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e40d99e13088eab%3A0x78d7d27d658f41b7!2sPulau%20Pasaran!5e0!3m2!1sen!2sid!4v1638360000000!5m2!1sen!2sid" 
                width="100%" 
                height="100%" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy">
            </iframe>
        </div>
    </div>
</div>
@endsection