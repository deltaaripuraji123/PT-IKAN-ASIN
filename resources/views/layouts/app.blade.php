<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Ikan Asin E-Commerce')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-100">

    <!-- NAVBAR -->
    <header class="bg-white shadow">
        <nav class="container mx-auto px-4 py-4 flex justify-between items-center">

            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center space-x-2">
                <i class="fas fa-fish text-blue-600 text-2xl"></i>
                <span class="text-xl font-bold text-gray-800">Ikan Asin Store</span>
            </a>

            <!-- Menu (Desktop) -->
            <div class="hidden md:flex space-x-6">
                <a href="{{ route('home') }}" class="nav-link">Beranda</a>
                <a href="{{ route('products.index') }}" class="nav-link">Produk</a>
            </div>

            <!-- Right Section -->
            <div class="flex items-center space-x-4">

                <!-- Cart -->
                <a href="{{ route('cart.index') }}" class="relative text-gray-700 hover:text-blue-600">
                    <i class="fas fa-shopping-cart text-xl"></i>

                    @auth
                        @php
                            $cartCount = \App\Models\Cart::where('user_id', auth()->id())->sum('quantity');
                        @endphp

                        @if ($cartCount > 0)
                            <span class="cart-badge">{{ $cartCount }}</span>
                        @endif
                    @endauth
                </a>

                <!-- Auth -->
                @guest
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600">Masuk</a>
                    <a href="{{ route('register') }}" class="btn-primary">Daftar</a>

                @else
                    <div class="relative">
                        <button id="userMenuBtn" class="profile-btn">
                            <i class="fas fa-user-circle text-xl"></i>
                            <span>{{ auth()->user()->name }}</span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </button>

                        <!-- Dropdown -->
                        <div id="userMenu"
                             class="dropdown hidden">
                            <div class="py-1">
                                @if (auth()->user()->isAdmin())
                                    <a href="{{ route('admin.dashboard') }}" class="dropdown-item">Admin Dashboard</a>
                                @endif

                                <a href="{{ route('order.history') }}" class="dropdown-item">Riwayat Pesanan</a>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item w-full text-left">Logout</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endguest
            </div>

            <!-- Mobile Button -->
            <button id="mobileBtn" class="md:hidden text-gray-700 hover:text-blue-600">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </nav>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="hidden md:hidden bg-white border-t">
            <a href="{{ route('home') }}" class="mobile-link">Beranda</a>
            <a href="{{ route('products.index') }}" class="mobile-link">Produk</a>
        </div>
    </header>
    <!-- END NAVBAR -->

    <!-- CONTENT -->
    <main>
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="bg-gray-800 text-white py-10 mt-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <div>
                    <h3 class="footer-title">Ikan Asin Store</h3>
                    <p class="footer-text">Menyediakan berbagai jenis ikan asin berkualitas tinggi.</p>
                </div>

                <div>
                    <h3 class="footer-title">Kontak</h3>
                    <p class="footer-text">Email: info@ikanasin.com</p>
                    <p class="footer-text">Telepon: (021) 12345678</p>
                </div>

                <div>
                    <h3 class="footer-title">Ikuti Kami</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="footer-icon"><i class="fab fa-facebook text-xl"></i></a>
                        <a href="#" class="footer-icon"><i class="fab fa-instagram text-xl"></i></a>
                        <a href="#" class="footer-icon"><i class="fab fa-twitter text-xl"></i></a>
                    </div>
                </div>

            </div>

            <div class="text-center border-t border-gray-700 mt-8 pt-6 text-gray-400">
                © {{ date('Y') }} Ikan Asin Store. All rights reserved.
            </div>
        </div>
    </footer>

    <!-- SCRIPT -->
    <script>
        const userBtn = document.getElementById("userMenuBtn");
        const userMenu = document.getElementById("userMenu");
        const mobileBtn = document.getElementById("mobileBtn");
        const mobileMenu = document.getElementById("mobileMenu");

        if (userBtn) {
            userBtn.addEventListener("click", () => {
                userMenu.classList.toggle("hidden");
            });

            document.addEventListener("click", (e) => {
                if (userBtn.contains(e.target)) return;
                userMenu.classList.add("hidden");
            });
        }

        mobileBtn.addEventListener("click", () => {
            mobileMenu.classList.toggle("hidden");
        });
    </script>

    <!-- Tailwind Component Styles -->
    <style>
        .nav-link { @apply text-gray-700 hover:text-blue-600; }
        .mobile-link { @apply block px-4 py-3 text-gray-700 hover:bg-gray-100; }
        .btn-primary { @apply bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700; }
        .profile-btn { @apply flex items-center space-x-1 text-gray-700 hover:text-blue-600; }
        .dropdown { @apply absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-20 border border-gray-100; }
        .dropdown-item { @apply block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100; }
        .cart-badge { @apply absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center; }
        .footer-title { @apply text-lg font-semibold mb-4; }
        .footer-text { @apply text-gray-300; }
        .footer-icon { @apply text-gray-300 hover:text-white; }
    </style>

</body>
</html>
