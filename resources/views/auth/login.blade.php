<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Sign In - {{ config('app.name', 'Nagad') }}</title>

    <!-- Google Font: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <!-- Instant Dark Mode Script -->
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
        }
    </style>
</head>
<body class="h-full bg-zinc-50 dark:bg-[#09090b] text-zinc-800 dark:text-zinc-100 antialiased transition-colors duration-200 selection:bg-orange-500 selection:text-white">
    <div class="min-h-full flex flex-col justify-between p-4 sm:p-8 relative overflow-hidden">
        
        <!-- Subtle Ambient Background Glow -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[600px] h-[350px] bg-gradient-to-b from-orange-400/15 to-transparent dark:from-orange-500/10 dark:to-transparent blur-3xl pointer-events-none -z-10"></div>

        <!-- Top Header: Logo & Theme Switcher -->
        <header class="w-full max-w-sm sm:max-w-md mx-auto flex items-center justify-between">
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="inline-block transition-transform hover:scale-105">
                    <img src="{{ asset('assets/img/Nagad-Horizontal-Logo.wine.svg') }}" 
                         alt="Nagad Logo" 
                         class="h-10 w-auto dark:brightness-110">
                </a>
            </div>

            <!-- Theme Toggle -->
            <button id="theme-toggle" type="button" aria-label="Toggle theme"
                class="w-9 h-9 rounded-xl border border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-900 flex items-center justify-center text-zinc-500 dark:text-zinc-400 hover:text-orange-500 dark:hover:text-orange-400 hover:border-orange-200 dark:hover:border-orange-900/50 shadow-sm transition-all">
                <!-- Sun icon (dark mode active) -->
                <svg id="theme-toggle-light-icon" class="hidden w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="4" />
                    <path stroke-linecap="round" d="M12 2v2m0 16v2M4.93 4.93l1.41 1.41m11.32 11.32l1.41 1.41M2 12h2m16 0h2M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41 1.41" />
                </svg>
                <!-- Moon icon (light mode active) -->
                <svg id="theme-toggle-dark-icon" class="hidden w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z" />
                </svg>
            </button>
        </header>

        <!-- Main Card Container -->
        <main class="w-full max-w-sm sm:max-w-md mx-auto my-auto py-6">
            <div class="bg-white dark:bg-zinc-900/90 rounded-2xl border border-zinc-200/80 dark:border-zinc-800 p-6 sm:p-8 shadow-xl shadow-zinc-200/40 dark:shadow-none backdrop-blur-sm">
                
                <!-- Center Logo / Title Header -->
                <div class="mb-6 text-center sm:text-left flex flex-col items-center sm:items-start">
                    <div class="mb-4 inline-flex items-center justify-center p-2 rounded-2xl bg-orange-50 dark:bg-zinc-800/80 border border-orange-100 dark:border-zinc-700/50">
                        <img src="{{ asset('assets/img/Nagad-Logo.wine.svg') }}" 
                             alt="Nagad Icon" 
                             class="h-8 w-auto">
                    </div>
                    <h1 class="text-xl sm:text-2xl font-bold tracking-tight text-zinc-900 dark:text-white">
                        Welcome back
                    </h1>
                    <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                        Sign in to access your Nagad account.
                    </p>
                </div>

                <!-- Session Flash Status -->
                @if (session('status'))
                    <div class="mb-5 p-3 rounded-xl bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800 text-xs font-medium text-emerald-700 dark:text-emerald-300 flex items-center gap-2">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>{{ session('status') }}</span>
                    </div>
                @endif

                <!-- Auth Error Alert -->
                @if ($errors->has('email') && !$errors->has('password') && $errors->first('email') !== 'The email field is required.' && !str_contains($errors->first('email'), 'valid email'))
                    <div class="mb-5 p-3 rounded-xl bg-red-50 dark:bg-red-950/30 border border-red-200 dark:border-red-900/50 text-xs font-medium text-red-600 dark:text-red-400 flex items-center gap-2">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <span>{{ $errors->first('email') }}</span>
                    </div>
                @endif

                <!-- Form -->
                <form action="{{ route('authenticate') }}" method="POST" class="space-y-4" novalidate>
                    @csrf

                    <!-- Email Input -->
                    <div>
                        <label for="email" class="block text-xs font-semibold text-zinc-700 dark:text-zinc-300 uppercase tracking-wider mb-1.5">
                            Email Address
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-zinc-400 dark:text-zinc-500">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                </svg>
                            </div>
                            <input id="email" name="email" type="email" autocomplete="email" required
                                value="{{ old('email') }}"
                                placeholder="name@example.com"
                                class="w-full pl-10 pr-3.5 py-2.5 text-sm rounded-xl border bg-zinc-50/60 dark:bg-zinc-950/60 text-zinc-900 dark:text-zinc-100 placeholder-zinc-400 dark:placeholder-zinc-600 transition-all focus:outline-none focus:bg-white dark:focus:bg-zinc-950 {{ $errors->has('email') ? 'border-red-400 focus:border-red-500 focus:ring-2 focus:ring-red-500/20' : 'border-zinc-200 dark:border-zinc-800 focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20' }}"
                                autofocus>
                        </div>
                        @if ($errors->has('email') && (str_contains($errors->first('email'), 'required') || str_contains($errors->first('email'), 'valid email')))
                            <p class="text-xs text-red-500 dark:text-red-400 mt-1.5 flex items-center gap-1 font-medium">
                                {{ $errors->first('email') }}
                            </p>
                        @endif
                    </div>

                    <!-- Password Input -->
                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <label for="password" class="block text-xs font-semibold text-zinc-700 dark:text-zinc-300 uppercase tracking-wider">
                                Password
                            </label>
                        </div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-zinc-400 dark:text-zinc-500">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input id="password" name="password" type="password" autocomplete="current-password" required
                                placeholder="••••••••"
                                class="w-full pl-10 pr-10 py-2.5 text-sm rounded-xl border bg-zinc-50/60 dark:bg-zinc-950/60 text-zinc-900 dark:text-zinc-100 placeholder-zinc-400 dark:placeholder-zinc-600 transition-all focus:outline-none focus:bg-white dark:focus:bg-zinc-950 {{ $errors->has('password') ? 'border-red-400 focus:border-red-500 focus:ring-2 focus:ring-red-500/20' : 'border-zinc-200 dark:border-zinc-800 focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20' }}">
                            
                            <!-- Toggle Password Button -->
                            <button type="button" id="toggle-password" aria-label="Toggle password visibility"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-200 focus:outline-none">
                                <svg id="eye-icon" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <svg id="eye-slash-icon" class="hidden w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                                </svg>
                            </button>
                        </div>
                        @if ($errors->has('password'))
                            <p class="text-xs text-red-500 dark:text-red-400 mt-1.5 flex items-center gap-1 font-medium">
                                {{ $errors->first('password') }}
                            </p>
                        @endif
                    </div>

                    <!-- Remember Me Option -->
                    <div class="flex items-center justify-between pt-1">
                        <label class="flex items-center gap-2 cursor-pointer select-none">
                            <input id="remember" name="remember" type="checkbox"
                                class="w-4 h-4 rounded border-zinc-300 dark:border-zinc-700 text-orange-500 focus:ring-orange-500/30 dark:bg-zinc-950 dark:checked:bg-orange-500 transition">
                            <span class="text-xs font-medium text-zinc-600 dark:text-zinc-400">
                                Remember me
                            </span>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-2">
                        <button type="submit"
                            class="w-full py-2.5 px-4 text-sm font-semibold rounded-xl text-white bg-orange-500 hover:bg-orange-600 active:scale-[0.99] shadow-md shadow-orange-500/25 transition-all focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 dark:focus:ring-offset-zinc-900">
                            Sign In
                        </button>
                    </div>
                </form>
            </div>
        </main>

        <!-- Footer -->
        <footer class="w-full max-w-sm sm:max-w-md mx-auto text-center">
            <p class="text-xs text-zinc-400 dark:text-zinc-600">
                &copy; {{ date('Y') }} {{ config('app.name', 'Nagad') }}. All rights reserved.
            </p>
        </footer>
    </div>

    <!-- Interactive Scripts -->
    <script>
        // Password Visibility Toggle
        const togglePasswordBtn = document.getElementById('toggle-password');
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eye-icon');
        const eyeSlashIcon = document.getElementById('eye-slash-icon');

        if (togglePasswordBtn && passwordInput) {
            togglePasswordBtn.addEventListener('click', function () {
                const isPassword = passwordInput.getAttribute('type') === 'password';
                passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
                eyeIcon.classList.toggle('hidden', isPassword);
                eyeSlashIcon.classList.toggle('hidden', !isPassword);
            });
        }

        // Dark / Light Theme Toggle
        const themeToggleBtn = document.getElementById('theme-toggle');
        const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

        function updateIcons() {
            if (document.documentElement.classList.contains('dark')) {
                themeToggleLightIcon.classList.remove('hidden');
                themeToggleDarkIcon.classList.add('hidden');
            } else {
                themeToggleLightIcon.classList.add('hidden');
                themeToggleDarkIcon.classList.remove('hidden');
            }
        }

        updateIcons();

        if (themeToggleBtn) {
            themeToggleBtn.addEventListener('click', function () {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('theme', 'dark');
                }
                updateIcons();
            });
        }
    </script>
</body>
</html>
