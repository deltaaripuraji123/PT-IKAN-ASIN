@extends('layouts.app')

@section('title', 'Kontak Kami - Ikan Asin Store')

@section('content')
<!-- Hero Section dengan Parallax Effect -->
<div class="relative bg-gradient-to-r from-blue-600 to-teal-500 text-white py-20 overflow-hidden">
    <div class="absolute inset-0 bg-black opacity-20"></div>
    <div class="absolute inset-0">
        <div class="absolute top-0 left-0 w-full h-full bg-pattern opacity-10"></div>
    </div>
    <div class="container mx-auto px-4 text-center relative z-10">
        <h1 class="text-5xl font-bold mb-4 animate-fade-in-down">Kontak Kami</h1>
        <p class="text-xl max-w-2xl mx-auto animate-fade-in-up">Hubungi kami untuk informasi lebih lanjut atau kunjungi toko kami langsung</p>
        <div class="mt-8 animate-bounce-slow">
            <i class="fas fa-chevron-down text-2xl"></i>
        </div>
    </div>
    <div class="absolute bottom-0 left-0 right-0">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 120">
            <path fill="#f9fafb" fill-opacity="1" d="M0,64L48,80C96,96,192,128,288,128C384,128,480,96,576,85.3C672,75,768,85,864,90.7C960,96,1056,96,1152,90.7C1248,85,1344,75,1392,69.3L1440,64L1440,120L1392,120C1344,120,1248,120,1152,120C1056,120,960,120,864,120C768,120,672,120,576,120C480,120,384,120,288,120C192,120,96,120,48,120L0,120Z"></path>
        </svg>
    </div>
</div>

<div class="container mx-auto px-4 py-16">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
        <!-- Informasi Kontak -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden transform transition hover:-translate-y-2 hover:shadow-2xl">
            <div class="bg-gradient-to-r from-blue-600 to-teal-500 p-6">
                <h2 class="text-2xl font-bold text-white">Informasi Kontak</h2>
                <p class="text-blue-100">Jangan ragu untuk menghubungi kami</p>
            </div>
            <div class="p-8">
                <div class="space-y-6">
                    <div class="flex items-start group">
                        <div class="flex-shrink-0 flex items-center justify-center h-14 w-14 rounded-full bg-blue-100 text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-all duration-300">
                            <i class="fas fa-map-marker-alt text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900">Alamat</h3>
                            <p class="text-gray-600 mt-1">Pulau Pasaran, Bandar Lampung</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start group">
                        <div class="flex-shrink-0 flex items-center justify-center h-14 w-14 rounded-full bg-green-100 text-green-600 group-hover:bg-green-600 group-hover:text-white transition-all duration-300">
                            <i class="fas fa-phone text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900">Telepon</h3>
                            <p class="text-gray-600 mt-1">(021) 1234-5678</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start group">
                        <div class="flex-shrink-0 flex items-center justify-center h-14 w-14 rounded-full bg-yellow-100 text-yellow-600 group-hover:bg-yellow-600 group-hover:text-white transition-all duration-300">
                            <i class="fas fa-envelope text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900">Email</h3>
                            <p class="text-gray-600 mt-1">info@ikanasinstore.com</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start group">
                        <div class="flex-shrink-0 flex items-center justify-center h-14 w-14 rounded-full bg-purple-100 text-purple-600 group-hover:bg-purple-600 group-hover:text-white transition-all duration-300">
                            <i class="fas fa-clock text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900">Jam Operasional</h3>
                            <p class="text-gray-600 mt-1">Senin - Sabtu: 08.00 - 20.00 WIB</p>
                            <p class="text-gray-600">Minggu: 09.00 - 17.00 WIB</p>
                        </div>
                    </div>
                </div>
                
                <div class="mt-10">
                    <h3 class="text-xl font-semibold mb-4">Ikuti Kami</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="flex items-center justify-center h-12 w-12 rounded-full bg-blue-600 text-white hover:bg-blue-700 transition-colors transform hover:scale-110">
                            <i class="fab fa-facebook-f text-xl"></i>
                        </a>
                        <a href="#" class="flex items-center justify-center h-12 w-12 rounded-full bg-blue-400 text-white hover:bg-blue-500 transition-colors transform hover:scale-110">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                        <a href="#" class="flex items-center justify-center h-12 w-12 rounded-full bg-gradient-to-r from-purple-500 to-pink-500 text-white hover:from-purple-600 hover:to-pink-600 transition-colors transform hover:scale-110">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                        <a href="#" class="flex items-center justify-center h-12 w-12 rounded-full bg-red-600 text-white hover:bg-red-700 transition-colors transform hover:scale-110">
                            <i class="fab fa-youtube text-xl"></i>
                        </a>
                        <a href="#" class="flex items-center justify-center h-12 w-12 rounded-full bg-green-500 text-white hover:bg-green-600 transition-colors transform hover:scale-110">
                            <i class="fab fa-whatsapp text-xl"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Form Kontak -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden transform transition hover:-translate-y-2 hover:shadow-2xl">
            <div class="bg-gradient-to-r from-blue-600 to-teal-500 p-6">
                <h2 class="text-2xl font-bold text-white">Kirim Pesan</h2>
                <p class="text-blue-100">Kami akan merespons pesan Anda secepatnya</p>
            </div>
            <div class="p-8">
                <form action="#" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="name" class="block text-gray-700 font-medium mb-2">Nama Lengkap</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                            <input type="text" id="name" name="name" class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" placeholder="John Doe" required>
                        </div>
                    </div>
                    
                    <div>
                        <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </div>
                            <input type="email" id="email" name="email" class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" placeholder="john@example.com" required>
                        </div>
                    </div>
                    
                    <div>
                        <label for="subject" class="block text-gray-700 font-medium mb-2">Subjek</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-tag text-gray-400"></i>
                            </div>
                            <input type="text" id="subject" name="subject" class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" placeholder="Pertanyaan tentang produk" required>
                        </div>
                    </div>
                    
                    <div>
                        <label for="message" class="block text-gray-700 font-medium mb-2">Pesan</label>
                        <div class="relative">
                            <div class="absolute top-3 left-3 flex items-start pointer-events-none">
                                <i class="fas fa-comment-alt text-gray-400 mt-1"></i>
                            </div>
                            <textarea id="message" name="message" rows="4" class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" placeholder="Tulis pesan Anda di sini..." required></textarea>
                        </div>
                    </div>
                    
                    <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-teal-500 text-white py-3 px-4 rounded-lg font-semibold hover:from-blue-700 hover:to-teal-600 transition-all duration-300 transform hover:-translate-y-1 shadow-lg">
                        <i class="fas fa-paper-plane mr-2"></i> Kirim Pesan
                    </button>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Peta -->
    <div class="mt-16">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold mb-4 relative inline-block">
                <span class="relative z-10">Lokasi Kami</span>
                <span class="absolute bottom-0 left-0 w-full h-3 bg-yellow-400 opacity-30 -z-10"></span>
            </h2>
            <div class="w-24 h-1 bg-blue-600 mx-auto rounded"></div>
        </div>
        
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden transform transition hover:-translate-y-2 hover:shadow-2xl">
            <div class="h-96">
                <!-- Embed Google Maps untuk Pulau Pasaran -->
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3972.534838423916!2d105.2646643!3d-5.4638889!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e40d99e13088eab%3A0x78d7d27d658f41b7!2sPulau%20Pasaran!5e0!3m2!1sen!2sid!4v1638360000000!5m2!1sen!2sid" 
                    width="100%" 
                    height="100%" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy"
                    class="w-full h-full">
                </iframe>
            </div>
            
            <div class="p-6 bg-gray-50">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div>
                        <h3 class="text-lg font-semibold">Pulau Pasaran, Bandar Lampung</h3>
                    </div>
                    <a href="https://maps.google.com/?q=Pulau+Pasaran,+Bandar+Lampung" target="_blank" class="mt-4 md:mt-0 inline-flex items-center text-blue-600 font-semibold hover:text-blue-800 transition-colors">
                        <i class="fas fa-directions mr-2"></i> Petunjuk Arah
                    </a>
                </div>
            </div>
        </div>
    </div>
    
<style>
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes bounceSlow {
        0%, 20%, 50%, 80%, 100% {
            transform: translateY(0);
        }
        40% {
            transform: translateY(-10px);
        }
        60% {
            transform: translateY(-5px);
        }
    }
    
    .animate-fade-in-down {
        animation: fadeInDown 1s ease-out;
    }
    
    .animate-fade-in-up {
        animation: fadeInUp 1s ease-out;
    }
    
    .animate-bounce-slow {
        animation: bounceSlow 2s infinite;
    }
    
    .bg-pattern {
        background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }
</style>
@endsection