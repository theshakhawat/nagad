@extends('layouts.admin')

@section('title', 'Edit Website: ' . $website->name . ' - Nagad Pay')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl sm:text-2xl font-bold tracking-tight text-slate-900 dark:text-white">
                Edit Website
            </h2>
            <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mt-0.5">
                Update credentials, URLs and configuration for <span class="font-semibold text-slate-700 dark:text-slate-200">{{ $website->name }}</span>
            </p>
        </div>
        <a href="{{ route('admin.websites.index') }}" class="px-3.5 py-2 rounded-xl bg-white dark:bg-[#121829] border border-slate-200 dark:border-slate-800 text-xs font-semibold text-slate-700 dark:text-slate-200 shadow-sm hover:bg-slate-50 dark:hover:bg-slate-800 transition flex items-center gap-1.5">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            <span>Back to Websites</span>
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white dark:bg-[#121829] rounded-2xl border border-slate-200/80 dark:border-slate-800/80 shadow-sm overflow-hidden">
        <form action="{{ route('admin.websites.update', $website) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <!-- Website Name -->
                <div>
                    <label for="name" class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1.5">
                        Website Name <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name', $website->name) }}" required
                        class="w-full px-4 py-2.5 text-xs sm:text-sm rounded-xl border @error('name') border-rose-500 @else border-slate-200 dark:border-slate-700/80 @enderror bg-slate-50/60 dark:bg-[#0c101d] text-slate-800 dark:text-slate-100 focus:border-blue-500 transition">
                    @error('name')
                        <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Domain -->
                <div>
                    <label for="domain" class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1.5">
                        Domain Name <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="domain" id="domain" value="{{ old('domain', $website->domain) }}" required
                        class="w-full px-4 py-2.5 text-xs sm:text-sm rounded-xl border @error('domain') border-rose-500 @else border-slate-200 dark:border-slate-700/80 @enderror bg-slate-50/60 dark:bg-[#0c101d] text-slate-800 dark:text-slate-100 focus:border-blue-500 transition">
                    @error('domain')
                        <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1.5">
                        Status <span class="text-rose-500">*</span>
                    </label>
                    <select name="status" id="status" required
                        class="w-full px-4 py-2.5 text-xs sm:text-sm rounded-xl border @error('status') border-rose-500 @else border-slate-200 dark:border-slate-700/80 @enderror bg-slate-50/60 dark:bg-[#0c101d] text-slate-800 dark:text-slate-100 focus:border-blue-500 transition">
                        <option value="active" {{ old('status', $website->status) === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status', $website->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                        <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Logo Upload -->
                <div>
                    <label for="logo" class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1.5">
                        Website Logo <span class="text-slate-400 font-normal">(Leave empty to keep existing)</span>
                    </label>
                    <div class="flex items-center gap-3">
                        @if ($website->logo)
                            <div class="w-10 h-10 rounded-xl bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700/60 overflow-hidden shrink-0">
                                <img src="{{ asset('storage/' . $website->logo) }}" alt="{{ $website->name }}" class="w-full h-full object-cover">
                            </div>
                        @endif
                        <input type="file" name="logo" id="logo" accept="image/*"
                            class="w-full text-xs text-slate-500 dark:text-slate-400 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 dark:file:bg-blue-950/40 file:text-blue-600 dark:file:text-blue-400 hover:file:bg-blue-100 transition">
                    </div>
                    @error('logo')
                        <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- API Key Section -->
            <div class="p-4 rounded-2xl bg-slate-50/70 dark:bg-[#0c101d] border border-slate-200/60 dark:border-slate-800/80 space-y-3">
                <div class="flex items-center justify-between">
                    <div>
                        <label for="api_key" class="block text-xs font-bold text-slate-800 dark:text-slate-200">
                            API Key <span class="text-rose-500">*</span>
                        </label>
                        <p class="text-[11px] text-slate-500 dark:text-slate-400">Unique secret key for backend authentication</p>
                    </div>
                    <button type="button" onclick="generateNewApiKey()" class="px-3 py-1.5 rounded-lg border border-blue-600/60 text-blue-600 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-950/30 text-xs font-semibold transition">
                        Regenerate Key
                    </button>
                </div>
                <input type="text" name="api_key" id="api_key" value="{{ old('api_key', $website->api_key) }}" required
                    class="w-full font-mono text-xs px-4 py-2.5 rounded-xl border @error('api_key') border-rose-500 @else border-slate-200 dark:border-slate-700/80 @enderror bg-white dark:bg-[#121829] text-slate-800 dark:text-slate-100 focus:border-blue-500 transition">
                @error('api_key')
                    <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Webhook & Callback Section -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <!-- Webhook Secret -->
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label for="webhook_secret" class="block text-xs font-semibold text-slate-700 dark:text-slate-300">
                            Webhook Secret
                        </label>
                        <button type="button" onclick="generateNewWebhookSecret()" class="text-[10px] text-blue-600 dark:text-blue-400 hover:underline">
                            Regenerate
                        </button>
                    </div>
                    <input type="text" name="webhook_secret" id="webhook_secret" value="{{ old('webhook_secret', $website->webhook_secret) }}"
                        class="w-full font-mono text-xs px-4 py-2.5 rounded-xl border @error('webhook_secret') border-rose-500 @else border-slate-200 dark:border-slate-700/80 @enderror bg-slate-50/60 dark:bg-[#0c101d] text-slate-800 dark:text-slate-100 placeholder-slate-400 focus:border-blue-500 transition">
                    @error('webhook_secret')
                        <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Callback URL -->
                <div>
                    <label for="callback_url" class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1.5">
                        Callback / Return URL
                    </label>
                    <input type="url" name="callback_url" id="callback_url" value="{{ old('callback_url', $website->callback_url) }}"
                        class="w-full text-xs sm:text-sm px-4 py-2.5 rounded-xl border @error('callback_url') border-rose-500 @else border-slate-200 dark:border-slate-700/80 @enderror bg-slate-50/60 dark:bg-[#0c101d] text-slate-800 dark:text-slate-100 placeholder-slate-400 focus:border-blue-500 transition">
                    @error('callback_url')
                        <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="pt-4 border-t border-slate-100 dark:border-slate-800/60 flex items-center justify-between">
                <a href="{{ route('admin.websites.index') }}" class="text-xs font-semibold text-slate-500 hover:text-slate-800 dark:hover:text-slate-200 transition">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-xs sm:text-sm font-semibold shadow-md shadow-blue-600/25 transition">
                    Update Website
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function makeRandomString(length) {
        const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        let result = '';
        for (let i = 0; i < length; i++) {
            result += chars.charAt(Math.floor(Math.random() * chars.length));
        }
        return result;
    }

    function generateNewApiKey() {
        if (confirm('Regenerating this key will break active API integrations until updated on the merchant site. Continue?')) {
            document.getElementById('api_key').value = 'np_live_' + makeRandomString(32);
        }
    }

    function generateNewWebhookSecret() {
        document.getElementById('webhook_secret').value = 'whsec_' + makeRandomString(32);
    }
</script>
@endpush
@endsection
