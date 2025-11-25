<header class="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700 lg:pl-0">
    <div class="flex items-center justify-between h-16 px-4 sm:px-6 lg:px-8">
        <!-- Left side: Hamburger menu -->
        <button @click="$dispatch('toggle-sidebar')" class="text-gray-500 hover:text-gray-700 focus:outline-none lg:hidden">
            <span class="material-symbols-outlined text-2xl">menu</span>
        </button>

        <!-- Right side: Search, Notifications, User menu -->
        <div class="flex items-center gap-4">
            <!-- Search Bar (Optional) -->
            <div class="hidden md:block">
                <input type="text" placeholder="Search..." class="bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white px-4 py-2 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary">
            </div>

            <!-- User Dropdown -->
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="flex items-center gap-2 text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white focus:outline-none">
                    <span class="material-symbols-outlined">account_circle</span>
                    <span class="hidden md:block text-sm font-medium">Admin User</span>
                    <span class="material-symbols-outlined text-sm">expand_more</span>
                </button>

                <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-md shadow-lg py-1 z-50">
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">Profile</a>
                    <hr class="my-1 border-gray-200 dark:border-gray-700">
                    <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">Logout</a>
                </div>
            </div>
        </div>
    </div>
</header>