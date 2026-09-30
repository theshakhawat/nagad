<!-- Top Header / Search / Profile -->
<header class="h-16 bg-white dark:bg-[#121829] border-b border-slate-200/80 dark:border-slate-800/80 px-4 sm:px-6 flex items-center justify-between shrink-0 z-30">
    <!-- Left: Toggle & Search -->
    <div class="flex items-center gap-4 flex-1 max-w-2xl">
        <!-- Hamburger Button (Mobile) -->
        <button id="hamburger-btn" type="button" class="p-2 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 lg:hidden transition">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <!-- Search Input Bar -->
        <div class="relative w-full max-w-md hidden sm:block">
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <input type="text" placeholder="Search transactions, orders, websites..." 
                class="w-full pl-10 pr-4 py-2 text-xs sm:text-sm rounded-xl border border-slate-200 dark:border-slate-700/80 bg-slate-50/60 dark:bg-[#0c101d] text-slate-800 dark:text-slate-100 placeholder-slate-400 dark:placeholder-slate-500 focus:border-blue-500 transition">
        </div>
    </div>

    <!-- Right: Dark Mode, Notification, Profile Dropdown -->
    <div class="flex items-center gap-3">
        <!-- Theme Toggle Button -->
        <button id="theme-toggle" type="button" aria-label="Toggle theme"
            class="w-9 h-9 rounded-xl border border-slate-200 dark:border-slate-700/80 bg-slate-50 dark:bg-slate-800/80 flex items-center justify-center text-slate-600 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-slate-100 dark:hover:bg-slate-700/60 transition">
            <svg id="theme-toggle-light-icon" class="hidden w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="4" />
                <path stroke-linecap="round" d="M12 2v2m0 16v2M4.93 4.93l1.41 1.41m11.32 11.32l1.41 1.41M2 12h2m16 0h2M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41 1.41" />
            </svg>
            <svg id="theme-toggle-dark-icon" class="hidden w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z" />
            </svg>
        </button>

        <!-- Notification Bell -->
        <div class="relative">
            <button type="button" onclick="toggleDropdown('notifications-menu')" class="relative w-9 h-9 rounded-xl text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800/80 flex items-center justify-center transition">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
                <span class="absolute top-1 right-1 w-4 h-4 rounded-full bg-rose-500 text-white text-[9px] font-bold flex items-center justify-center">
                    12
                </span>
            </button>
            <!-- Notifications Dropdown -->
            <div id="notifications-menu" class="hidden absolute right-0 mt-2 w-72 bg-white dark:bg-[#121829] border border-slate-200 dark:border-slate-800 rounded-2xl shadow-xl p-3 z-50 text-xs">
                <div class="flex items-center justify-between pb-2 border-b border-slate-100 dark:border-slate-800">
                    <span class="font-bold text-slate-900 dark:text-white">Notifications</span>
                    <span class="text-[10px] text-blue-600 font-semibold">12 new</span>
                </div>
                <div class="py-2 space-y-2 max-h-56 overflow-y-auto">
                    <div class="p-2 rounded-lg bg-slate-50 dark:bg-slate-800/50">
                        <p class="font-semibold text-slate-800 dark:text-slate-200">Payment received</p>
                        <p class="text-[10px] text-slate-500">৳ 1,200 via mybdphone.com</p>
                    </div>
                    <div class="p-2 rounded-lg bg-slate-50 dark:bg-slate-800/50">
                        <p class="font-semibold text-rose-600 dark:text-rose-400">Webhook delivery failed</p>
                        <p class="text-[10px] text-slate-500">aiworkspace.center (500)</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- User Profile -->
        <div class="flex items-center gap-3 pl-2 border-l border-slate-200 dark:border-slate-800">
            <div class="w-9 h-9 rounded-full bg-slate-200 dark:bg-slate-700/80 flex items-center justify-center text-slate-600 dark:text-slate-200 font-bold overflow-hidden border border-slate-200 dark:border-slate-600 shrink-0">
                <svg class="w-5 h-5 text-slate-500 dark:text-slate-300" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                </svg>
            </div>
            <div class="hidden sm:block text-left">
                <p class="text-xs font-bold text-slate-900 dark:text-white leading-tight">
                    {{ Auth::user()->name ?? 'Admin' }}
                </p>
                <p class="text-[10px] text-slate-500 dark:text-slate-400 font-medium">
                    Super Admin
                </p>
            </div>
            <!-- Logout Form -->
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" title="Sign Out" class="p-2 rounded-lg text-slate-400 hover:text-rose-500 hover:bg-slate-100 dark:hover:bg-slate-800/80 transition">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </button>
            </form>
        </div>
    </div>
</header>
