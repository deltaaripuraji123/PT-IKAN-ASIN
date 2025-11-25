<aside class="fixed inset-y-0 left-0 z-50 w-64 flex-shrink-0 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 transform transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0" :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
    <div class="flex h-full flex-col p-4 ">

        <!-- Logo/Brand -->
        <div class="flex items-center mb-10">
            <h1 class="text-xl font-bold text-gray-900 dark:text-white">Ikan Asin Admin</h1>
        </div>

        <div class="flex flex-col gap-3">

            <!-- User Profile Section -->
            <div class="flex gap-3 items-center">
                <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10" data-alt="Admin avatar" style='background-image: url("https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=0d8abc&color=fff");'></div>
                <div class="flex flex-col">
                    <h1 class="text-gray-900 dark:text-white text-base font-medium leading-normal">{{ Auth::user()->name }}</h1>
                    <p class="text-gray-500 dark:text-gray-400 text-sm font-normal leading-normal">{{ Auth::user()->email }}</p>
                </div>
            </div>

            <!-- Navigation Menu -->
            <nav class="flex flex-col gap-2 mt-2">

                <!-- Dashboard -->
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium leading-normal transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-400' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                    <span class="material-symbols-outlined">dashboard</span>
                    Dashboard
                </a>

                <!-- Products -->
                <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium leading-normal transition-colors {{ request()->routeIs('admin.products.*') ? 'bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-400' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">inventory_2</span>
                    Produk
                </a>

                <!-- Categories -->
                <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium leading-normal transition-colors {{ request()->routeIs('admin.categories.*') ? 'bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-400' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                    <span class="material-symbols-outlined">category</span>
                    Kategori
                </a>

                <!-- Orders -->
                <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium leading-normal transition-colors {{ request()->routeIs('admin.orders.*') ? 'bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-400' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                    <span class="material-symbols-outlined">receipt_long</span>
                    Pesanan
                </a>
            </nav>
        </div>

        <div class="flex flex-col gap-1">

            <!-- Logout -->
            <form action="{{ route('logout') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin keluar?');">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium leading-normal text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800">
                    <span class="material-symbols-outlined">logout</span>
                    Keluar
                </button>
            </form>

        </div>
    </div>
</aside>
