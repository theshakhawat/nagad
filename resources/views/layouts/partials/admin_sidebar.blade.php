<!-- Mobile Sidebar Backdrop -->
<div id="sidebar-backdrop" class="fixed inset-0 bg-black/60 z-40 lg:hidden hidden transition-opacity"></div>

<!-- ========================================================================= -->
<!-- SIDEBAR -->
<!-- ========================================================================= -->
<aside id="sidebar" class="fixed lg:static inset-y-0 left-0 z-50 w-64 bg-[#0d1424] dark:bg-[#080d1a] text-slate-300 flex flex-col justify-between transition-transform duration-300 transform -translate-x-full lg:translate-x-0 border-r border-slate-800/80 shrink-0">
    
    <!-- Top Section -->
    <div class="flex flex-col h-full overflow-hidden">
        <!-- Brand Logo Header -->
        <div class="p-4 px-5 flex items-center justify-between border-b border-slate-800/60">
            <a href="{{ route('dashboard') }}" class="flex items-center">
                <img src="{{ asset('assets/img/Nagad-Logo.wine.svg') }}" alt="Nagad" class="h-9 w-auto">
                <span class="ml-2 text-lg font-semibold text-white">Nagad</span>
            </a>

            <!-- Close button for mobile -->
            <button id="sidebar-close-btn" class="lg:hidden text-slate-400 hover:text-white p-1" type="button">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- Navigation Links -->
        <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-1 text-sm font-medium">
            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white shadow-md shadow-blue-600/25 font-semibold' : 'text-slate-300 hover:text-white hover:bg-slate-800/60' }} transition-all">
                <svg class="w-5 h-5 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-slate-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span>Dashboard</span>
            </a>

            <!-- Transactions -->
            <a href="#" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/60 transition-colors">
                <svg class="w-5 h-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <span>Transactions</span>
            </a>

            <!-- Websites -->
            <a href="{{ route('admin.websites.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl {{ request()->routeIs('admin.websites.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-600/25 font-semibold' : 'text-slate-300 hover:text-white hover:bg-slate-800/60' }} transition-all">
                <svg class="w-5 h-5 {{ request()->routeIs('admin.websites.*') ? 'text-white' : 'text-slate-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                </svg>
                <span>Websites</span>
            </a>

            <!-- Merchants -->
            <a href="#" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/60 transition-colors">
                <svg class="w-5 h-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
                <span>Merchants</span>
            </a>

            <!-- Nagad Integration -->
            <a href="#" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/60 transition-colors">
                <svg class="w-5 h-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Nagad Integration</span>
            </a>

            <!-- Webhook Deliveries -->
            <a href="#" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/60 transition-colors">
                <svg class="w-5 h-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                </svg>
                <span>Webhook Deliveries</span>
            </a>

            <!-- API Logs -->
            <a href="#" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/60 transition-colors">
                <svg class="w-5 h-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                </svg>
                <span>API Logs</span>
            </a>

            <!-- Refunds -->
            <a href="#" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/60 transition-colors">
                <svg class="w-5 h-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                </svg>
                <span>Refunds</span>
            </a>

            <!-- Reports (Accordion) -->
            <div class="space-y-1">
                <button type="button" onclick="toggleSubmenu('reports-submenu', 'reports-chevron')"
                    class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/60 transition-colors">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        <span>Reports</span>
                    </div>
                    <svg id="reports-chevron" class="w-4 h-4 text-slate-500 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div id="reports-submenu" class="hidden pl-11 pr-3 py-1 space-y-1 text-xs text-slate-400">
                    <a href="#" class="block py-1.5 hover:text-white transition-colors">Daily Volume</a>
                    <a href="#" class="block py-1.5 hover:text-white transition-colors">Merchant Analytics</a>
                    <a href="#" class="block py-1.5 hover:text-white transition-colors">Settlements</a>
                </div>
            </div>

            <!-- Profile (Accordion) -->
            <div class="space-y-1">
                <button type="button" onclick="toggleSubmenu('profile-submenu', 'profile-chevron')"
                    class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl {{ request()->routeIs('admin.profile*') || request()->routeIs('admin.change-password*') ? 'bg-slate-800/80 text-white font-semibold' : 'text-slate-300 hover:text-white hover:bg-slate-800/60' }} transition-colors">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 {{ request()->routeIs('admin.profile*') || request()->routeIs('admin.change-password*') ? 'text-blue-400' : 'text-slate-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span>Profile</span>
                    </div>
                    <svg id="profile-chevron" class="w-4 h-4 text-slate-500 transition-transform duration-200 {{ request()->routeIs('admin.profile*') || request()->routeIs('admin.change-password*') ? 'rotate-180' : '' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div id="profile-submenu" class="{{ request()->routeIs('admin.profile*') || request()->routeIs('admin.change-password*') ? '' : 'hidden' }} pl-11 pr-3 py-1 space-y-1 text-xs text-slate-400">
                    <a href="{{ route('admin.profile') }}" class="block py-1.5 {{ request()->routeIs('admin.profile') ? 'text-blue-400 font-semibold' : 'hover:text-white' }} transition-colors">Profile</a>
                    <a href="{{ route('admin.change-password') }}" class="block py-1.5 {{ request()->routeIs('admin.change-password') ? 'text-blue-400 font-semibold' : 'hover:text-white' }} transition-colors">Change Password</a>
                </div>
            </div>

            <!-- Settings (Accordion) -->
            <div class="space-y-1">
                <button type="button" onclick="toggleSubmenu('settings-submenu', 'settings-chevron')"
                    class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/60 transition-colors">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>Settings</span>
                    </div>
                    <svg id="settings-chevron" class="w-4 h-4 text-slate-500 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div id="settings-submenu" class="hidden pl-11 pr-3 py-1 space-y-1 text-xs text-slate-400">
                    <a href="#" class="block py-1.5 hover:text-white transition-colors">General Settings</a>
                    <a href="#" class="block py-1.5 hover:text-white transition-colors">API Credentials</a>
                    <a href="#" class="block py-1.5 hover:text-white transition-colors">Webhook Secrets</a>
                </div>
            </div>

            <!-- Users (Accordion) -->
            <div class="space-y-1">
                <button type="button" onclick="toggleSubmenu('users-submenu', 'users-chevron')"
                    class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/60 transition-colors">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <span>Users</span>
                    </div>
                    <svg id="users-chevron" class="w-4 h-4 text-slate-500 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div id="users-submenu" class="hidden pl-11 pr-3 py-1 space-y-1 text-xs text-slate-400">
                    <a href="#" class="block py-1.5 hover:text-white transition-colors">All Admins</a>
                    <a href="#" class="block py-1.5 hover:text-white transition-colors">Role Management</a>
                </div>
            </div>

            <!-- System Logs -->
            <a href="#" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/60 transition-colors">
                <svg class="w-5 h-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                </svg>
                <span>System Logs</span>
            </a>

            <!-- Documentation -->
            <a href="#" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/60 transition-colors">
                <svg class="w-5 h-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
                <span>Documentation</span>
            </a>
        </nav>
    </div>
</aside>
