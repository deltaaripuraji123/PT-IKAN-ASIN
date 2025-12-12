@extends('layouts.app')

@section('title', 'Tentang Kami - Ikan Asin Store')

@section('content')
<!-- Hero Section dengan Parallax Effect -->
<div class="relative bg-gradient-to-r from-blue-600 to-teal-500 text-white py-20 overflow-hidden">
    <div class="absolute inset-0 bg-black opacity-20"></div>
    <div class="absolute inset-0">
        <div class="absolute top-0 left-0 w-full h-full bg-pattern opacity-10"></div>
    </div>
    <div class="container mx-auto px-4 text-center relative z-10">
        <h1 class="text-5xl font-bold mb-4 animate-fade-in-down">Tentang Kami</h1>
        <p class="text-xl max-w-2xl mx-auto animate-fade-in-up">Mengenal lebih dekat Ikan Asin Store</p>
        <div class="mt-8 animate-bounce-slow">
            <i class="fas fa-chevron-down text-2xl"></i>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-16">
    <div class="max-w-6xl mx-auto">
        <!-- Sejarah Kami -->
        <div class="mb-16">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold mb-4 relative inline-block">
                    <span class="relative z-10">Sejarah Kami</span>
                    <span class="absolute bottom-0 left-0 w-full h-3 bg-yellow-400 opacity-30 -z-10"></span>
                </h2>
                <div class="w-24 h-1 bg-blue-600 mx-auto rounded"></div>
            </div>
            
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="md:flex">
                    <div class="md:w-1/2 p-8 md:p-12">
                        <div class="mb-6">
                            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-blue-100 text-blue-600 mb-4">
                                <i class="fas fa-history text-2xl"></i>
                            </div>
                            <h3 class="text-2xl font-bold mb-4">Perjalanan Kami</h3>
                        </div>
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
                    <div class="md:w-1/2 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1519708227418-c8fd9a32b7a2?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');">
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Visi & Misi -->
        <div class="mb-16">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold mb-4 relative inline-block">
                    <span class="relative z-10">Visi & Misi</span>
                    <span class="absolute bottom-0 left-0 w-full h-3 bg-yellow-400 opacity-30 -z-10"></span>
                </h2>
                <div class="w-24 h-1 bg-blue-600 mx-auto rounded"></div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-gradient-to-br from-blue-50 to-teal-50 rounded-2xl shadow-lg p-8 transform transition hover:-translate-y-2 hover:shadow-xl">
                    <div class="flex items-center mb-6">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-blue-600 text-white mr-4">
                            <i class="fas fa-eye text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold">Visi</h3>
                    </div>
                    <p class="text-gray-700">
                        Menjadi toko ikan asin online terdepan di Indonesia yang menyediakan produk berkualitas tinggi 
                        dengan harga terjangkau dan pelayanan terbaik.
                    </p>
                </div>
                
                <div class="bg-gradient-to-br from-blue-50 to-teal-50 rounded-2xl shadow-lg p-8 transform transition hover:-translate-y-2 hover:shadow-xl">
                    <div class="flex items-center mb-6">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-teal-600 text-white mr-4">
                            <i class="fas fa-bullseye text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold">Misi</h3>
                    </div>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-teal-600 mt-1 mr-3"></i>
                            <span class="text-gray-700">Menyediakan ikan asin berkualitas tinggi dari sumber terpercaya</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-teal-600 mt-1 mr-3"></i>
                            <span class="text-gray-700">Memberikan pelayanan terbaik kepada pelanggan</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-teal-600 mt-1 mr-3"></i>
                            <span class="text-gray-700">Mendukung nelayan lokal dengan memberikan harga yang adil</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-teal-600 mt-1 mr-3"></i>
                            <span class="text-gray-700">Terus berinovasi dalam pengolahan dan pengemasan ikan asin</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-teal-600 mt-1 mr-3"></i>
                            <span class="text-gray-700">Menjangkau lebih banyak pelanggan di seluruh Indonesia</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Nilai Perusahaan -->
        <div class="mb-16">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold mb-4 relative inline-block">
                    <span class="relative z-10">Nilai Perusahaan</span>
                    <span class="absolute bottom-0 left-0 w-full h-3 bg-yellow-400 opacity-30 -z-10"></span>
                </h2>
                <div class="w-24 h-1 bg-blue-600 mx-auto rounded"></div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white rounded-xl shadow-lg p-6 text-center transform transition hover:-translate-y-2 hover:shadow-xl">
                    <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-blue-100 text-blue-600 mb-4">
                        <i class="fas fa-handshake text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Integritas</h3>
                    <p class="text-gray-600">Kami menjunjung tinggi kejujuran dalam setiap transaksi dan interaksi dengan pelanggan dan mitra.</p>
                </div>
                
                <div class="bg-white rounded-xl shadow-lg p-6 text-center transform transition hover:-translate-y-2 hover:shadow-xl">
                    <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-teal-100 text-teal-600 mb-4">
                        <i class="fas fa-award text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Kualitas</h3>
                    <p class="text-gray-600">Kami hanya menyediakan produk dengan kualitas terbaik yang telah melalui proses seleksi ketat.</p>
                </div>
                
                <div class="bg-white rounded-xl shadow-lg p-6 text-center transform transition hover:-translate-y-2 hover:shadow-xl">
                    <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-yellow-100 text-yellow-600 mb-4">
                        <i class="fas fa-users text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Kepedulian</h3>
                    <p class="text-gray-600">Kami peduli terhadap pelanggan, mitra, dan lingkungan sekitar dalam menjalankan bisnis.</p>
                </div>
            </div>
        </div>
        
        <!-- Tim Kami -->
        <div>
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold mb-4 relative inline-block">
                    <span class="relative z-10">Tim Kami</span>
                    <span class="absolute bottom-0 left-0 w-full h-3 bg-yellow-400 opacity-30 -z-10"></span>
                </h2>
                <div class="w-24 h-1 bg-blue-600 mx-auto rounded"></div>
                <p class="text-gray-600 mt-4 max-w-2xl mx-auto">Tim profesional yang berdedikasi untuk memberikan produk dan layanan terbaik untuk Anda</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden transform transition hover:-translate-y-3 hover:shadow-xl">
                    <div class="relative">
                        <img src="https://ui-avatars.com/api/?name=Ahmad+Rizki&background=0d8abc&color=fff&size=128" alt="Ahmad Rizki" class="w-full h-64 object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-60"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                            <h3 class="text-xl font-bold">Ahmad Rizki</h3>
                            <p class="text-blue-200">Founder & CEO</p>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-4">Dengan pengalaman lebih dari 15 tahun di industri perikanan, Ahmad memimpin perusahaan dengan visi yang jelas.</p>
                        <div class="flex space-x-4">
                            <a href="#" class="text-blue-600 hover:text-blue-800 transition-colors">
                                <i class="fab fa-linkedin text-xl"></i>
                            </a>
                            <a href="#" class="text-blue-600 hover:text-blue-800 transition-colors">
                                <i class="fab fa-twitter text-xl"></i>
                            </a>
                            <a href="#" class="text-blue-600 hover:text-blue-800 transition-colors">
                                <i class="fas fa-envelope text-xl"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden transform transition hover:-translate-y-3 hover:shadow-xl">
                    <div class="relative">
                        <img src="https://ui-avatars.com/api/?name=Siti+Nurhaliza&background=0d8abc&color=fff&size=128" alt="Siti Nurhaliza" class="w-full h-64 object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-60"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                            <h3 class="text-xl font-bold">Siti Nurhaliza</h3>
                            <p class="text-blue-200">Head of Operations</p>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-4">Siti bertanggung jawab atas operasional harian dan memastikan kualitas produk terjaga dengan baik.</p>
                        <div class="flex space-x-4">
                            <a href="#" class="text-blue-600 hover:text-blue-800 transition-colors">
                                <i class="fab fa-linkedin text-xl"></i>
                            </a>
                            <a href="#" class="text-blue-600 hover:text-blue-800 transition-colors">
                                <i class="fab fa-twitter text-xl"></i>
                            </a>
                            <a href="#" class="text-blue-600 hover:text-blue-800 transition-colors">
                                <i class="fas fa-envelope text-xl"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden transform transition hover:-translate-y-3 hover:shadow-xl">
                    <div class="relative">
                        <img src="https://ui-avatars.com/api/?name=Budi+Santoso&background=0d8abc&color=fff&size=128" alt="Budi Santoso" class="w-full h-64 object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-60"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                            <h3 class="text-xl font-bold">Budi Santoso</h3>
                            <p class="text-blue-200">Head of Marketing</p>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-4">Budi memimpin tim marketing untuk memperluas jangkauan pasar dan membangun brand awareness.</p>
                        <div class="flex space-x-4">
                            <a href="#" class="text-blue-600 hover:text-blue-800 transition-colors">
                                <i class="fab fa-linkedin text-xl"></i>
                            </a>
                            <a href="#" class="text-blue-600 hover:text-blue-800 transition-colors">
                                <i class="fab fa-twitter text-xl"></i>
                            </a>
                            <a href="#" class="text-blue-600 hover:text-blue-800 transition-colors">
                                <i class="fas fa-envelope text-xl"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Call to Action -->
<div class="bg-gradient-to-r from-blue-600 to-teal-500 py-16">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold text-white mb-4">Bergabunglah dengan Kami</h2>
        <p class="text-blue-100 max-w-2xl mx-auto mb-8">Jadilah bagian dari pelanggan setia kami dan nikmati produk ikan asin berkualitas tinggi dengan harga terbaik.</p>
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="{{ route('products.index') }}" class="bg-white text-blue-600 font-bold py-3 px-8 rounded-full shadow-lg hover:bg-blue-50 transform hover:-translate-y-1 transition-all duration-300">
                Lihat Produk Kami
            </a>
            <a href="{{ route('contact') }}" class="bg-transparent border-2 border-white text-white font-bold py-3 px-8 rounded-full hover:bg-white hover:text-blue-600 transform hover:-translate-y-1 transition-all duration-300">
                Hubungi Kami
            </a>
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