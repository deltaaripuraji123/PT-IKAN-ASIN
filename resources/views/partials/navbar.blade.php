<header class="bg-white shadow">
    <nav class="container mx-auto px-4 py-4 flex justify-between items-center">
        <a href="{{ route('home') }}" class="flex items-center space-x-2">
            <i class="fas fa-fish text-blue-600 text-2xl"></i>
            <span class="text-xl font-bold text-gray-800">Ikan Asin Store</span>
        </a>
        
        <div class="hidden md:flex space-x-6">
            <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600">Beranda</a>
            <a href="{{ route('products.index') }}" class="text-gray-700 hover:text-blue-600">Produk</a>
        </div>
        
        <div class="flex items-center space-x-4">
            <a href="{{ route('cart.index') }}" class="relative text-gray-700 hover:text-blue-600">
                <i class="fas fa-shopping-cart text-xl"></i>
                @if (auth()->check())
                    @php
                        $cartCount = \App\Models\Cart::where('user_id', auth()->id())->sum('quantity');
                    @endphp
                    @if ($cartCount > 0)
                        <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">{{ $cartCount }}</span>
                    @endif
                @endif
            </a>
            
            @guest
                <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600">Masuk</a>
                <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Daftar</a>
            @else
                <div class="relative">
                    <button id="user-menu-button" class="flex items-center space-x-1 text-gray-700 hover:text-blue-600">
                        <i class="fas fa-user-circle text-xl"></i>
                        <span>{{ auth()->user()->name }}</span>
                        <i class="fas fa-chevron-down text-xs"></i>
                    </button>
                    
                    <div id="user-menu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10">
                        <div class="py-1">
                            @if (auth()->user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Admin Dashboard</a>
                            @endif
                            <a href="{{ route('order.history') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Riwayat Pesanan</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endguest
        </div>
        
        <div class="md:hidden">
            <button id="mobile-menu-button" class="text-gray-700 hover:text-blue-600">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </div>
    </nav>
    
    <div id="mobile-menu" class="hidden md:hidden bg-white border-t">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="{{ route('home') }}" class="block px-3 py-2 text-gray-700 hover:text-blue-600">Beranda</a>
            <a href="{{ route('products.index') }}" class="block px-3 py-2 text-gray-700 hover:text-blue-600">Produk</a>
        </div>
    </div>
</header>
