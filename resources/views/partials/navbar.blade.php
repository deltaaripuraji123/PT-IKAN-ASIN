<header class="bg-white shadow" x-data="{ userMenuOpen: false, mobileMenuOpen: false }">
    <nav class="container mx-auto px-4 py-4 flex justify-between items-center">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="flex items-center space-x-2">
            <i class="fas fa-fish text-blue-600 text-2xl"></i>
            <span class="text-xl font-bold text-gray-800">Ikan Asin Store</span>
        </a>

        <!-- Desktop Menu -->
        <div class="hidden md:flex space-x-6">
            <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600 transition-colors">Beranda</a>
            <a href="{{ route('products.index') }}"
                class="text-gray-700 hover:text-blue-600 transition-colors">Produk</a>
            <a href="{{ route('about') }}" class="text-gray-700 hover:text-blue-600 transition-colors">Tentang Kami</a>
            <a href="{{ route('contact') }}" class="text-gray-700 hover:text-blue-600 transition-colors">Kontak</a>
        </div>

        <!-- Right Section -->
        <div class="flex items-center space-x-4">
            <!-- Cart -->
            <a href="{{ route('cart.index') }}" class="relative text-gray-700 hover:text-blue-600 transition-colors">
                <i class="fas fa-shopping-cart text-xl"></i>
                @auth
                    @php
                        $cartCount = \App\Models\Cart::where('user_id', auth()->id())->sum('quantity');
                    @endphp
                    @if ($cartCount > 0)
                        <span
                            class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">{{ $cartCount }}</span>
                    @endif
                @endauth
            </a>

            <!-- Auth Section -->
            @guest
                <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 transition-colors">Masuk</a>
                <a href="{{ route('register') }}"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Daftar</a>
            @else
                <!-- User Dropdown -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = ! open" @click.away="open = false"
                        class="flex items-center space-x-3 text-gray-700 hover:text-blue-600 transition-colors">
                        <!-- User Avatar -->
                        <img class="w-8 h-8 rounded-full object-cover border-2 border-gray-200"
                            src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=0d8abc&color=fff&size=128"
                            alt="{{ auth()->user()->name }}">
                        <span class="hidden md:block text-sm font-medium">{{ auth()->user()->name }}</span>
                        <i class="fas fa-chevron-down text-xs"></i>
                    </button>

                    <!-- Dropdown Menu -->
                    <div x-show="open" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 transform scale-95"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="opacity-100 transform scale-100"
                        x-transition:leave-end="opacity-0 transform scale-95"
                        class="absolute right-0 mt-3 w-56 bg-white rounded-md shadow-lg z-20 border border-gray-200 overflow-hidden">

                        <!-- Dropdown Header -->
                        <div class="px-4 py-3 border-b border-gray-200">
                            <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</p>
                            <p class="text-sm text-gray-500 truncate">{{ auth()->user()->email }}</p>
                        </div>

                        <!-- Dropdown Body -->
                        <div class="py-2">
                            @if (auth()->user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}"
                                    class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-tachometer-alt w-4"></i>
                                    Admin Dashboard
                                </a>
                            @endif
                            <a href="{{ route('order.history') }}"
                                class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-clipboard-list w-4"></i>
                                Riwayat Pesanan
                            </a>

                            <hr class="my-2 border-gray-200">

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="flex items-center gap-3 w-full px-4 py-2 text-sm text-left text-red-600 hover:bg-gray-100">
                                    <i class="fas fa-sign-out-alt w-4"></i>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endguest
        </div>

        <!-- Mobile Menu Button -->
        <div class="md:hidden">
            <button @click="mobileMenuOpen = !mobileMenuOpen"
                class="text-gray-700 hover:text-blue-600 transition-colors">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </div>
    </nav>

   <!-- Mobile Menu -->
<div x-show="mobileMenuOpen"
     x-transition:enter="transition ease-out duration-200"
     x-transition:enter-start="opacity-0 transform scale-95"
     x-transition:enter-end="opacity-100 transform scale-100"
     x-transition:leave="transition ease-in duration-75"
     x-transition:leave-start="opacity-100 transform scale-100"
     x-transition:leave-end="opacity-0 transform scale-95"
     class="md:hidden bg-white border-t">
    <div class="px-2 pt-2 pb-3 space-y-1">
        <a href="{{ route('home') }}" class="block px-3 py-2 text-gray-700 hover:text-blue-600 transition-colors">Beranda</a>
        <a href="{{ route('products.index') }}" class="block px-3 py-2 text-gray-700 hover:text-blue-600 transition-colors">Produk</a>
        <a href="{{ route('about') }}" class="block px-3 py-2 text-gray-700 hover:text-blue-600 transition-colors">Tentang Kami</a>
        <a href="{{ route('contact') }}" class="block px-3 py-2 text-gray-700 hover:text-blue-600 transition-colors">Kontak</a>
    </div>
</div>
</header>
