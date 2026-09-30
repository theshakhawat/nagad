<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Nagad Pay - Central Payment Portal')</title>

    <!-- Google Font: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', '-apple-system', 'BlinkMacSystemFont', 'sans-serif'],
                        mono: ['"JetBrains Mono"', 'monospace'],
                    },
                    colors: {
                        navy: {
                            800: '#141d33',
                            900: '#0d1424',
                            950: '#080d1a',
                        },
                        darkCard: '#121829',
                        darkBg: '#0b0f19',
                    }
                }
            }
        }
    </script>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Dark Mode Init Script (Instant, No-FOUC) -->
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            -webkit-tap-highlight-color: transparent;
        }

        /* Prevent ugly default browser outlines on buttons */
        button, a, input, select {
            outline: none !important;
            -webkit-tap-highlight-color: transparent;
        }
        button:focus, a:focus, input:focus {
            outline: none !important;
            box-shadow: none !important;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 5px;
            height: 5px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        ::-webkit-scrollbar-thumb {
            background: rgba(156, 163, 175, 0.25);
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: rgba(156, 163, 175, 0.45);
        }
    </style>
    @stack('styles')
</head>
<body class="h-full bg-[#f4f7fc] dark:bg-[#0b0f19] text-slate-800 dark:text-slate-100 antialiased flex overflow-hidden">

    <!-- Sidebar Partial -->
    @include('layouts.partials.admin_sidebar')

    <!-- ========================================================================= -->
    <!-- MAIN CONTENT WRAPPER -->
    <!-- ========================================================================= -->
    <div class="flex-1 flex flex-col h-full overflow-hidden">
        
        <!-- Header Partial -->
        @include('layouts.partials.admin_header')

        <!-- Scrollable Dashboard Body -->
        <main class="flex-1 overflow-y-auto p-4 sm:p-6 space-y-6">
            @yield('content')

            <!-- Footer Partial -->
            @include('layouts.partials.admin_footer')
        </main>
    </div>

    <!-- Custom Bottom-Right Toast Notifications Container -->
    <div id="toast-container" class="fixed bottom-5 right-5 z-50 flex flex-col gap-2.5 pointer-events-none max-w-sm w-full"></div>

    <!-- ========================================================================= -->
    <!-- INTERACTIVE SCRIPTS -->
    <!-- ========================================================================= -->
    <script>
        // -------------------------------------------------------------
        // 1. Mobile Sidebar & Dropdown Handlers
        // -------------------------------------------------------------
        const hamburgerBtn = document.getElementById('hamburger-btn');
        const sidebarCloseBtn = document.getElementById('sidebar-close-btn');
        const sidebar = document.getElementById('sidebar');
        const sidebarBackdrop = document.getElementById('sidebar-backdrop');

        function openSidebar() {
            if (sidebar && sidebarBackdrop) {
                sidebar.classList.remove('-translate-x-full');
                sidebarBackdrop.classList.remove('hidden');
            }
        }

        function closeSidebar() {
            if (sidebar && sidebarBackdrop) {
                sidebar.classList.add('-translate-x-full');
                sidebarBackdrop.classList.add('hidden');
            }
        }

        if (hamburgerBtn) hamburgerBtn.addEventListener('click', openSidebar);
        if (sidebarCloseBtn) sidebarCloseBtn.addEventListener('click', closeSidebar);
        if (sidebarBackdrop) sidebarBackdrop.addEventListener('click', closeSidebar);

        // Submenu accordion toggle
        function toggleSubmenu(id, chevronId) {
            const menu = document.getElementById(id);
            const chevron = document.getElementById(chevronId);
            if (menu) {
                menu.classList.toggle('hidden');
            }
            if (chevron) {
                chevron.classList.toggle('rotate-180');
            }
        }

        // Generic dropdown toggle
        function toggleDropdown(id) {
            const menu = document.getElementById(id);
            if (menu) {
                menu.classList.toggle('hidden');
            }
        }

        // Close dropdowns when clicking outside
        document.addEventListener('click', function(e) {
            const dateBtn = document.getElementById('date-range-btn');
            const dateMenu = document.getElementById('date-range-menu');
            if (dateBtn && dateMenu && !dateBtn.contains(e.target) && !dateMenu.contains(e.target)) {
                dateMenu.classList.add('hidden');
            }

            const notifMenu = document.getElementById('notifications-menu');
            if (notifMenu && !e.target.closest('[onclick*="notifications-menu"]') && !notifMenu.contains(e.target)) {
                notifMenu.classList.add('hidden');
            }

            const userMenu = document.getElementById('user-menu');
            if (userMenu && !e.target.closest('#user-menu-btn') && !userMenu.contains(e.target)) {
                userMenu.classList.add('hidden');
            }
        });

        // Mark all notifications as read
        function markAllNotificationsRead() {
            const notifItems = document.querySelectorAll('#notifications-menu a');
            notifItems.forEach(item => {
                item.classList.remove('bg-blue-50/30', 'dark:bg-blue-950/10');
                item.classList.add('opacity-75');
                const dot = item.querySelector('.bg-blue-600');
                if (dot) dot.remove();
            });
            const badge = document.querySelector('#notifications-menu .bg-blue-50');
            if (badge) {
                badge.textContent = '0 New';
            }
            const ping = document.querySelector('#notifications-menu-btn .animate-ping');
            if (ping && ping.parentElement) {
                ping.parentElement.remove();
            }
        }

        // Date range select handler
        function selectDateRange(label) {
            const textEl = document.getElementById('date-range-text');
            if (textEl) textEl.textContent = label;
            const dateMenu = document.getElementById('date-range-menu');
            if (dateMenu) dateMenu.classList.add('hidden');
        }

        // -------------------------------------------------------------
        // 2. Dark / Light Mode Toggle
        // -------------------------------------------------------------
        const themeToggleBtn = document.getElementById('theme-toggle');
        const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

        function updateThemeIcons() {
            const isDark = document.documentElement.classList.contains('dark');
            if (isDark) {
                themeToggleLightIcon.classList.remove('hidden');
                themeToggleDarkIcon.classList.add('hidden');
            } else {
                themeToggleLightIcon.classList.add('hidden');
                themeToggleDarkIcon.classList.remove('hidden');
            }
        }
        updateThemeIcons();

        if (themeToggleBtn) {
            themeToggleBtn.addEventListener('click', function () {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('theme', 'dark');
                }
                updateThemeIcons();
                if (typeof updateChartThemes === 'function') {
                    updateChartThemes();
                }
            });
        }

        // Play notification chime using Web Audio API
        function playNotificationSound(type = 'success') {
            try {
                const AudioCtx = window.AudioContext || window.webkitAudioContext;
                if (!AudioCtx) return;
                const ctx = new AudioCtx();

                if (type === 'success' || type === 'info') {
                    // Pleasant two-tone chime
                    const osc1 = ctx.createOscillator();
                    const gain1 = ctx.createGain();
                    osc1.type = 'sine';
                    osc1.frequency.setValueAtTime(659.25, ctx.currentTime); // E5
                    gain1.gain.setValueAtTime(0.08, ctx.currentTime);
                    gain1.gain.exponentialRampToValueAtTime(0.001, ctx.currentTime + 0.15);
                    osc1.connect(gain1);
                    gain1.connect(ctx.destination);
                    osc1.start(ctx.currentTime);
                    osc1.stop(ctx.currentTime + 0.15);

                    const osc2 = ctx.createOscillator();
                    const gain2 = ctx.createGain();
                    osc2.type = 'sine';
                    osc2.frequency.setValueAtTime(880, ctx.currentTime + 0.08); // A5
                    gain2.gain.setValueAtTime(0.08, ctx.currentTime + 0.08);
                    gain2.gain.exponentialRampToValueAtTime(0.001, ctx.currentTime + 0.35);
                    osc2.connect(gain2);
                    gain2.connect(ctx.destination);
                    osc2.start(ctx.currentTime + 0.08);
                    osc2.stop(ctx.currentTime + 0.35);
                } else if (type === 'error') {
                    // Alert tone
                    const osc = ctx.createOscillator();
                    const gain = ctx.createGain();
                    osc.type = 'triangle';
                    osc.frequency.setValueAtTime(320, ctx.currentTime);
                    gain.gain.setValueAtTime(0.1, ctx.currentTime);
                    gain.gain.exponentialRampToValueAtTime(0.001, ctx.currentTime + 0.25);
                    osc.connect(gain);
                    gain.connect(ctx.destination);
                    osc.start(ctx.currentTime);
                    osc.stop(ctx.currentTime + 0.25);
                }
            } catch (e) {
                // Audio context not allowed or failed silently
            }
        }

        // Global Toast Notification Helper
        window.showToast = function(message, type = 'success') {
            playNotificationSound(type);

            const container = document.getElementById('toast-container');
            if (!container) return;

            const toast = document.createElement('div');
            toast.className = 'pointer-events-auto flex items-center gap-3 p-3.5 px-4 rounded-2xl bg-white dark:bg-[#121829] border border-slate-200/90 dark:border-slate-800 shadow-2xl text-xs font-semibold text-slate-800 dark:text-slate-100 transform translate-y-4 opacity-0 transition-all duration-300';

            let iconHtml = '';
            if (type === 'success') {
                iconHtml = `
                    <div class="w-7 h-7 rounded-xl bg-emerald-50 dark:bg-emerald-950/50 text-emerald-600 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800/40 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>`;
            } else if (type === 'error') {
                iconHtml = `
                    <div class="w-7 h-7 rounded-xl bg-rose-50 dark:bg-rose-950/50 text-rose-600 dark:text-rose-400 border border-rose-200 dark:border-rose-900/40 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>`;
            } else {
                iconHtml = `
                    <div class="w-7 h-7 rounded-xl bg-blue-50 dark:bg-blue-950/50 text-blue-600 dark:text-blue-400 border border-blue-200 dark:border-blue-800/40 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>`;
            }

            toast.innerHTML = `
                ${iconHtml}
                <div class="flex-1">
                    <p class="leading-tight">${message}</p>
                </div>
                <button type="button" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 p-1" onclick="this.parentElement.remove()">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            `;

            container.appendChild(toast);

            requestAnimationFrame(() => {
                toast.classList.remove('translate-y-4', 'opacity-0');
                toast.classList.add('translate-y-0', 'opacity-100');
            });

            setTimeout(() => {
                toast.classList.remove('translate-y-0', 'opacity-100');
                toast.classList.add('translate-y-4', 'opacity-0');
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        };
    </script>
    @stack('scripts')
</body>
</html>
