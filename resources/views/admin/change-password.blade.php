@extends('layouts.admin')

@section('title', 'Change Password - Nagad Pay')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl sm:text-2xl font-bold tracking-tight text-slate-900 dark:text-white">
                Change Password
            </h2>
            <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mt-0.5">
                Ensure your account is using a secure password to stay protected
            </p>
        </div>
        <a href="{{ route('dashboard') }}" class="px-3.5 py-2 rounded-xl bg-white dark:bg-[#121829] border border-slate-200 dark:border-slate-800 text-xs font-semibold text-slate-700 dark:text-slate-200 shadow-sm hover:bg-slate-50 dark:hover:bg-slate-800 transition flex items-center gap-1.5">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            <span>Back to Dashboard</span>
        </a>
    </div>

    <!-- Alert / Flash Message -->
    @if (session('success'))
        <div class="p-4 rounded-2xl bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800/60 flex items-center gap-3 text-emerald-800 dark:text-emerald-300 text-sm">
            <svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Password Card -->
    <div class="bg-white dark:bg-[#121829] rounded-2xl border border-slate-200/80 dark:border-slate-800/80 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-slate-100 dark:border-slate-800/60 flex items-center gap-4">
            <div class="w-12 h-12 rounded-2xl bg-amber-50 dark:bg-amber-950/40 text-amber-600 dark:text-amber-400 flex items-center justify-center font-bold">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-bold text-slate-900 dark:text-white">
                    Update Account Password
                </h3>
                <p class="text-xs text-slate-500 dark:text-slate-400">
                    Your password must be at least 6 characters long
                </p>
            </div>
        </div>

        <form action="{{ route('admin.password.update') }}" method="POST" class="p-6 space-y-5">
            @csrf
            @method('PUT')

            <!-- Current Password -->
            <div>
                <label for="current_password" class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1.5">
                    Current Password <span class="text-rose-500">*</span>
                </label>
                <input type="password" name="current_password" id="current_password" required placeholder="Enter current password"
                    class="w-full max-w-lg px-4 py-2.5 text-sm rounded-xl border @error('current_password') border-rose-500 @else border-slate-200 dark:border-slate-700/80 @enderror bg-slate-50/60 dark:bg-[#0c101d] text-slate-800 dark:text-slate-100 placeholder-slate-400 dark:placeholder-slate-500 focus:border-blue-500 transition">
                @error('current_password')
                    <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- New Password -->
            <div>
                <label for="password" class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1.5">
                    New Password <span class="text-rose-500">*</span>
                </label>
                <input type="password" name="password" id="password" required placeholder="Enter new password (min. 6 characters)"
                    class="w-full max-w-lg px-4 py-2.5 text-sm rounded-xl border @error('password') border-rose-500 @else border-slate-200 dark:border-slate-700/80 @enderror bg-slate-50/60 dark:bg-[#0c101d] text-slate-800 dark:text-slate-100 placeholder-slate-400 dark:placeholder-slate-500 focus:border-blue-500 transition">
                @error('password')
                    <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1.5">
                    Confirm New Password <span class="text-rose-500">*</span>
                </label>
                <input type="password" name="password_confirmation" id="password_confirmation" required placeholder="Confirm new password"
                    class="w-full max-w-lg px-4 py-2.5 text-sm rounded-xl border border-slate-200 dark:border-slate-700/80 bg-slate-50/60 dark:bg-[#0c101d] text-slate-800 dark:text-slate-100 placeholder-slate-400 dark:placeholder-slate-500 focus:border-blue-500 transition">
            </div>

            <div class="pt-4 border-t border-slate-100 dark:border-slate-800/60 flex items-center justify-between">
                <a href="{{ route('admin.profile') }}" class="text-xs font-semibold text-blue-600 dark:text-blue-400 hover:underline">
                    Edit Profile Details
                </a>
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-xs sm:text-sm font-semibold shadow-md shadow-blue-600/25 transition">
                    Update Password
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
