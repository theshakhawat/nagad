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
        });

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
    </script>
    @stack('scripts')
</body>
</html>
