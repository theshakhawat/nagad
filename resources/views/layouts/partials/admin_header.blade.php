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

        <!-- Notification Bell Dropdown -->
        <div class="relative">
            <button id="notifications-menu-btn" type="button" onclick="toggleDropdown('notifications-menu')" class="relative w-9 h-9 rounded-xl text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800/80 flex items-center justify-center transition focus:ring-2 focus:ring-blue-500/20">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
                <!-- Notification Ping Badge -->
                <span class="absolute top-1.5 right-1.5 flex h-2.5 w-2.5">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rose-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-rose-500 border border-white dark:border-[#121829]"></span>
                </span>
            </button>

            <!-- Professional Notifications Dropdown Card -->
            <div id="notifications-menu" class="hidden absolute right-0 mt-2 w-80 sm:w-96 bg-white dark:bg-[#121829] border border-slate-200/90 dark:border-slate-800 rounded-2xl shadow-2xl z-50 overflow-hidden text-xs">
                <!-- Dropdown Header -->
                <div class="p-4 border-b border-slate-100 dark:border-slate-800/80 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <h4 class="font-bold text-slate-900 dark:text-white text-sm">Notifications</h4>
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-50 dark:bg-blue-950/60 text-blue-600 dark:text-blue-400 border border-blue-200 dark:border-blue-800/40">
                            4 New
                        </span>
                    </div>
                    <button type="button" onclick="markAllNotificationsRead()" class="text-[11px] font-medium text-slate-500 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 transition">
                        Mark all as read
                    </button>
                </div>

                <!-- Notification Items List -->
                <div class="divide-y divide-slate-100 dark:divide-slate-800/60 max-h-[360px] overflow-y-auto">
                    
                    <!-- Item 1: Payment Received (Success) -->
                    <a href="#" class="p-3.5 flex items-start gap-3 bg-blue-50/30 dark:bg-blue-950/10 hover:bg-slate-50 dark:hover:bg-slate-800/50 transition group">
                        <div class="w-8 h-8 rounded-xl bg-emerald-50 dark:bg-emerald-950/50 text-emerald-600 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800/40 flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between gap-1">
                                <p class="font-semibold text-slate-800 dark:text-slate-200 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition truncate">
                                    Payment Received &bull; ৳ 1,200
                                </p>
                                <span class="w-2 h-2 rounded-full bg-blue-600 shrink-0"></span>
                            </div>
                            <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-0.5 truncate">
                                Order #MBS-10001 from <span class="font-mono text-slate-700 dark:text-slate-300">mybdsms.com</span>
                            </p>
                            <span class="text-[10px] text-slate-400 dark:text-slate-500 mt-1 block">2 mins ago</span>
                        </div>
                    </a>

                    <!-- Item 2: Webhook Failed (Error) -->
                    <a href="#" class="p-3.5 flex items-start gap-3 bg-blue-50/30 dark:bg-blue-950/10 hover:bg-slate-50 dark:hover:bg-slate-800/50 transition group">
                        <div class="w-8 h-8 rounded-xl bg-rose-50 dark:bg-rose-950/50 text-rose-600 dark:text-rose-400 border border-rose-200 dark:border-rose-800/40 flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between gap-1">
                                <p class="font-semibold text-rose-600 dark:text-rose-400 group-hover:underline transition truncate">
                                    Webhook Delivery Failed
                                </p>
                                <span class="w-2 h-2 rounded-full bg-blue-600 shrink-0"></span>
                            </div>
                            <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-0.5 truncate">
                                HTTP 500 error on <span class="font-mono text-slate-700 dark:text-slate-300">aiworkspace.center</span>
                            </p>
                            <span class="text-[10px] text-slate-400 dark:text-slate-500 mt-1 block">15 mins ago</span>
                        </div>
                    </a>

                    <!-- Item 3: Refund Request (Warning) -->
                    <a href="#" class="p-3.5 flex items-start gap-3 bg-blue-50/30 dark:bg-blue-950/10 hover:bg-slate-50 dark:hover:bg-slate-800/50 transition group">
                        <div class="w-8 h-8 rounded-xl bg-amber-50 dark:bg-amber-950/50 text-amber-600 dark:text-amber-400 border border-amber-200 dark:border-amber-800/40 flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between gap-1">
                                <p class="font-semibold text-slate-800 dark:text-slate-200 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition truncate">
                                    Refund Request &bull; ৳ 350
                                </p>
                                <span class="w-2 h-2 rounded-full bg-blue-600 shrink-0"></span>
                            </div>
                            <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-0.5 truncate">
                                Trx #NAGAD123458 &bull; <span class="font-mono text-slate-700 dark:text-slate-300">dokandigital.com</span>
                            </p>
                            <span class="text-[10px] text-slate-400 dark:text-slate-500 mt-1 block">42 mins ago</span>
                        </div>
                    </a>

                    <!-- Item 4: Merchant Added (Info) -->
                    <a href="#" class="p-3.5 flex items-start gap-3 bg-blue-50/30 dark:bg-blue-950/10 hover:bg-slate-50 dark:hover:bg-slate-800/50 transition group">
                        <div class="w-8 h-8 rounded-xl bg-blue-50 dark:bg-blue-950/50 text-blue-600 dark:text-blue-400 border border-blue-200 dark:border-blue-800/40 flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between gap-1">
                                <p class="font-semibold text-slate-800 dark:text-slate-200 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition truncate">
                                    New API Key Generated
                                </p>
                                <span class="w-2 h-2 rounded-full bg-blue-600 shrink-0"></span>
                            </div>
                            <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-0.5 truncate">
                                Live credentials created for <span class="font-mono text-slate-700 dark:text-slate-300">primevideo.cards</span>
                            </p>
                            <span class="text-[10px] text-slate-400 dark:text-slate-500 mt-1 block">2 hours ago</span>
                        </div>
                    </a>

                    <!-- Item 5: Daily Settlement (Read) -->
                    <a href="#" class="p-3.5 flex items-start gap-3 hover:bg-slate-50 dark:hover:bg-slate-800/50 transition group opacity-75">
                        <div class="w-8 h-8 rounded-xl bg-purple-50 dark:bg-purple-950/50 text-purple-600 dark:text-purple-400 border border-purple-200 dark:border-purple-800/40 flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-semibold text-slate-800 dark:text-slate-200 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition truncate">
                                Daily Settlement Reconciled
                            </p>
                            <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-0.5 truncate">
                                Total ৳ 12,45,800 synced with Nagad Central
                            </p>
                            <span class="text-[10px] text-slate-400 dark:text-slate-500 mt-1 block">Yesterday, 11:30 PM</span>
                        </div>
                    </a>

                </div>

                <!-- Dropdown Footer -->
                <div class="p-3 bg-slate-50/70 dark:bg-[#0c101d] border-t border-slate-100 dark:border-slate-800/80 text-center">
                    <a href="#" class="text-xs font-semibold text-blue-600 dark:text-blue-400 hover:underline inline-flex items-center gap-1">
                        <span>View all notifications</span>
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- User Profile Dropdown -->
        <div class="relative pl-2 border-l border-slate-200 dark:border-slate-800">
            <button id="user-menu-btn" type="button" onclick="toggleDropdown('user-menu')" class="flex items-center gap-2.5 p-1 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800/60 transition text-left">
                <div class="w-9 h-9 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-sm overflow-hidden shadow-sm shrink-0">
                    {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                </div>
                <div class="hidden sm:block text-left pr-1">
                    <p class="text-xs font-bold text-slate-900 dark:text-white leading-tight">
                        {{ Auth::user()->name ?? 'Admin' }}
                    </p>
                    <p class="text-[10px] text-slate-500 dark:text-slate-400 font-medium">
                        Super Admin
                    </p>
                </div>
                <svg class="w-3.5 h-3.5 text-slate-400 hidden sm:block" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <!-- User Dropdown Menu -->
            <div id="user-menu" class="hidden absolute right-0 mt-2 w-56 bg-white dark:bg-[#121829] border border-slate-200 dark:border-slate-800 rounded-2xl shadow-xl p-2 z-50 text-xs">
                <div class="px-3 py-2 border-b border-slate-100 dark:border-slate-800/80 mb-1">
                    <p class="font-bold text-slate-900 dark:text-white text-xs truncate">{{ Auth::user()->name ?? 'Admin' }}</p>
                    <p class="text-[11px] text-slate-500 dark:text-slate-400 truncate">{{ Auth::user()->email ?? 'admin@example.com' }}</p>
                </div>

                <a href="{{ route('admin.profile') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800 transition font-medium">
                    <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span>Profile</span>
                </a>

                <a href="{{ route('admin.change-password') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800 transition font-medium">
                    <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    <span>Change Password</span>
                </a>

                <div class="border-t border-slate-100 dark:border-slate-800/80 my-1"></div>

                <form action="{{ route('logout') }}" method="POST" class="w-full">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl text-rose-600 dark:text-rose-400 hover:bg-rose-50 dark:hover:bg-rose-950/30 transition font-medium">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        <span>Sign Out</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>
