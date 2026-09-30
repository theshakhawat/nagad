@extends('layouts.admin')

@section('title', 'Websites Management - Nagad Pay')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-xl sm:text-2xl font-bold tracking-tight text-slate-900 dark:text-white">
                Websites
            </h2>
            <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mt-0.5">
                Manage integrated websites, API keys, and webhook credentials
            </p>
        </div>

        <a href="{{ route('admin.websites.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-xs sm:text-sm font-semibold shadow-md shadow-blue-600/25 transition">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            <span>Add New Website</span>
        </a>
    </div>

    <!-- Flash Success Message -->
    @if (session('success'))
        <div class="p-4 rounded-2xl bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800/60 flex items-center justify-between gap-3 text-emerald-800 dark:text-emerald-300 text-xs sm:text-sm">
            <div class="flex items-center gap-2.5">
                <svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="text-emerald-600 hover:text-emerald-900 dark:text-emerald-400 dark:hover:text-white">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
    @endif

    <!-- Search & Filter Card -->
    <div class="bg-white dark:bg-[#121829] p-4 rounded-2xl border border-slate-200/80 dark:border-slate-800/80 shadow-sm flex flex-col sm:flex-row items-center justify-between gap-3">
        <form method="GET" action="{{ route('admin.websites.index') }}" class="w-full sm:w-auto flex-1 flex flex-col sm:flex-row items-center gap-3">
            <div class="relative w-full sm:max-w-xs">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search name, domain, API key..." 
                    class="w-full pl-10 pr-4 py-2 text-xs rounded-xl border border-slate-200 dark:border-slate-700/80 bg-slate-50/60 dark:bg-[#0c101d] text-slate-800 dark:text-slate-100 placeholder-slate-400 focus:border-blue-500 transition">
            </div>

            <select name="status" onchange="this.form.submit()" class="w-full sm:w-auto px-3.5 py-2 text-xs rounded-xl border border-slate-200 dark:border-slate-700/80 bg-slate-50/60 dark:bg-[#0c101d] text-slate-800 dark:text-slate-100 focus:border-blue-500 transition">
                <option value="">All Statuses</option>
                <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>

            <button type="submit" class="px-4 py-2 rounded-xl bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-200 text-xs font-semibold transition">
                Filter
            </button>

            @if (request()->hasAny(['search', 'status']))
                <a href="{{ route('admin.websites.index') }}" class="text-xs text-rose-500 hover:underline">
                    Clear Filters
                </a>
            @endif
        </form>

        <span class="text-xs text-slate-500 dark:text-slate-400 whitespace-nowrap">
            Total Websites: <strong class="text-slate-900 dark:text-white">{{ $websites->total() }}</strong>
        </span>
    </div>

    <!-- Websites Table Card -->
    <div class="bg-white dark:bg-[#121829] rounded-2xl border border-slate-200/80 dark:border-slate-800/80 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[760px] text-left text-xs text-slate-600 dark:text-slate-300">
                <thead class="bg-slate-50/70 dark:bg-slate-800/40 text-[11px] uppercase text-slate-400 border-b border-slate-100 dark:border-slate-800/60 font-semibold">
                    <tr>
                        <th class="py-3.5 px-4 whitespace-nowrap">#</th>
                        <th class="py-3.5 px-4 whitespace-nowrap">Website</th>
                        <th class="py-3.5 px-4 whitespace-nowrap">API Key</th>
                        <th class="py-3.5 px-4 whitespace-nowrap">Endpoints</th>
                        <th class="py-3.5 px-4 whitespace-nowrap text-center">Status</th>
                        <th class="py-3.5 px-4 whitespace-nowrap text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800/60 font-medium">
                    @forelse ($websites as $website)
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/20 transition">
                            <td class="py-3.5 px-4 text-slate-400 whitespace-nowrap">{{ $loop->iteration + ($websites->currentPage() - 1) * $websites->perPage() }}</td>
                            
                            <!-- Website Logo & Domain -->
                            <td class="py-3.5 px-4 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-xl bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700/60 flex items-center justify-center font-bold text-sm text-blue-600 dark:text-blue-400 overflow-hidden shrink-0 shadow-sm">
                                        @if ($website->logo)
                                            <img src="{{ asset('storage/' . $website->logo) }}" alt="{{ $website->name }}" class="w-full h-full object-cover">
                                        @else
                                            <span>{{ strtoupper(substr($website->name, 0, 1)) }}</span>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-900 dark:text-white text-xs leading-tight">{{ $website->name }}</p>
                                        <a href="https://{{ $website->domain }}" target="_blank" class="text-[11px] text-blue-600 dark:text-blue-400 hover:underline flex items-center gap-1 mt-0.5">
                                            <span>{{ $website->domain }}</span>
                                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                        </a>
                                    </div>
                                </div>
                            </td>

                            <!-- API Key -->
                            <td class="py-3.5 px-4 whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    <span class="font-mono text-[11px] bg-slate-100 dark:bg-slate-800/80 px-2.5 py-1 rounded-lg border border-slate-200 dark:border-slate-700/60 text-slate-700 dark:text-slate-300 select-all">
                                        {{ Str::limit($website->api_key, 18, '...') }}
                                    </span>
                                    <button type="button" onclick="copyToClipboard('{{ $website->api_key }}')" title="Copy API Key"
                                        class="p-1.5 rounded-lg text-slate-400 hover:text-blue-600 hover:bg-slate-100 dark:hover:bg-slate-800 transition">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                        </svg>
                                    </button>
                                </div>
                            </td>

                            <!-- Webhook & Callback -->
                            <td class="py-3.5 px-4 whitespace-nowrap">
                                <div class="space-y-1 text-[11px]">
                                    <div class="flex items-center gap-1 text-slate-500 dark:text-slate-400">
                                        <span class="font-semibold text-slate-700 dark:text-slate-300">Callback:</span>
                                        <span class="truncate max-w-[180px]" title="{{ $website->callback_url ?? 'Not set' }}">
                                            {{ $website->callback_url ? Str::limit($website->callback_url, 26) : 'None' }}
                                        </span>
                                    </div>
                                    <div class="flex items-center gap-1 text-slate-500 dark:text-slate-400">
                                        <span class="font-semibold text-slate-700 dark:text-slate-300">Webhook:</span>
                                        <span class="truncate max-w-[180px]">
                                            {{ $website->webhook_secret ? 'Configured' : 'None' }}
                                        </span>
                                    </div>
                                </div>
                            </td>

                            <!-- Status Toggle Button -->
                            <td class="py-3.5 px-4 whitespace-nowrap text-center">
                                <button type="button" onclick="toggleWebsiteStatus(this, '{{ route('admin.websites.toggle-status', $website) }}')"
                                    title="Click to toggle status"
                                    class="group inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-semibold transition-all duration-200 cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500/20 {{ $website->status === 'active' ? 'bg-emerald-50 dark:bg-emerald-950/50 text-emerald-600 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800/50 hover:bg-emerald-100' : 'bg-rose-50 dark:bg-rose-950/50 text-rose-600 dark:text-rose-400 border border-rose-200 dark:border-rose-900/50 hover:bg-rose-100' }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $website->status === 'active' ? 'bg-emerald-500' : 'bg-rose-500' }}"></span>
                                    <span class="status-label">{{ ucfirst($website->status) }}</span>
                                    <svg class="w-3 h-3 text-slate-400 group-hover:text-slate-700 dark:group-hover:text-slate-200 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                                </button>
                            </td>

                            <!-- Actions -->
                            <td class="py-3.5 px-4 whitespace-nowrap text-right">
                                <div class="inline-flex items-center gap-1">
                                    <!-- Edit Link -->
                                    <a href="{{ route('admin.websites.edit', $website) }}" class="p-1.5 rounded-lg text-slate-400 hover:text-blue-600 hover:bg-slate-100 dark:hover:bg-slate-800 transition" title="Edit Website">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>

                                    <!-- Delete Button (triggers custom double confirmation modal) -->
                                    <button type="button" onclick="openDeleteModal('{{ $website->id }}', '{{ addslashes($website->name) }}', '{{ addslashes($website->domain) }}', '{{ route('admin.websites.destroy', $website) }}')"
                                        class="p-1.5 rounded-lg text-slate-400 hover:text-rose-600 hover:bg-rose-50 dark:hover:bg-rose-950/30 transition" title="Delete Website">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center text-slate-400 dark:text-slate-500">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <svg class="w-10 h-10 text-slate-300 dark:text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                    <p class="font-semibold text-sm">No websites found</p>
                                    <a href="{{ route('admin.websites.create') }}" class="text-xs text-blue-600 hover:underline">Add your first website</a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if ($websites->hasPages())
            <div class="p-4 border-t border-slate-100 dark:border-slate-800/60">
                {{ $websites->links() }}
            </div>
        @endif
    </div>
</div>

<!-- ========================================================================= -->
<!-- CUSTOM DOUBLE CONFIRMATION DELETE MODAL -->
<!-- ========================================================================= -->
<div id="delete-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 bg-black/70 backdrop-blur-sm transition-opacity">
    <div class="bg-white dark:bg-[#121829] border border-slate-200 dark:border-slate-800 rounded-3xl max-w-md w-full p-6 shadow-2xl space-y-5 transform transition-transform animate-in fade-in zoom-in duration-150">
        
        <!-- Modal Header -->
        <div class="flex items-center gap-3.5">
            <div class="w-12 h-12 rounded-2xl bg-rose-50 dark:bg-rose-950/50 border border-rose-200 dark:border-rose-900/60 text-rose-600 dark:text-rose-400 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
            <div>
                <h3 class="font-bold text-slate-900 dark:text-white text-base">Delete Website</h3>
                <p class="text-xs text-rose-500 font-medium">Warning: Permanent & Irreversible action</p>
            </div>
        </div>

        <!-- Modal Body & Explanation -->
        <div class="space-y-3 text-xs text-slate-600 dark:text-slate-300">
            <p>
                You are about to delete <strong id="delete-modal-site-name" class="text-slate-900 dark:text-white"></strong> (<span id="delete-modal-domain" class="font-mono text-blue-600 dark:text-blue-400"></span>).
            </p>
            <p class="p-3 rounded-xl bg-rose-50/70 dark:bg-rose-950/30 border border-rose-200/60 dark:border-rose-900/40 text-rose-700 dark:text-rose-300 text-[11px] leading-relaxed">
                Deleting this website will revoke its <strong>API Key</strong> immediately. Any incoming payment requests from this domain will fail.
            </p>

            <!-- Double Confirmation Step -->
            <div class="pt-2">
                <label class="block font-semibold text-slate-700 dark:text-slate-200 mb-1.5 text-[11px]">
                    Type <span id="delete-match-text" class="font-mono text-rose-600 dark:text-rose-400 font-bold select-all"></span> below to confirm:
                </label>
                <input type="text" id="delete-confirm-input" onkeyup="checkDeleteConfirmation()" placeholder="Type domain name to confirm"
                    class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-[#0c101d] text-slate-900 dark:text-white font-mono focus:border-rose-500 transition">
            </div>

            <div class="flex items-center gap-2 pt-1">
                <input type="checkbox" id="delete-checkbox" onchange="checkDeleteConfirmation()" class="rounded border-slate-300 text-rose-600 focus:ring-rose-500">
                <label for="delete-checkbox" class="text-[11px] text-slate-600 dark:text-slate-400 cursor-pointer select-none">
                    I understand the risks and want to delete this website.
                </label>
            </div>
        </div>

        <!-- Modal Action Buttons -->
        <div class="flex items-center justify-end gap-3 pt-3 border-t border-slate-100 dark:border-slate-800/80">
            <button type="button" onclick="closeDeleteModal()" class="px-4 py-2 rounded-xl border border-slate-200 dark:border-slate-700 hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-300 text-xs font-semibold transition">
                Cancel
            </button>
            
            <form id="delete-form" action="" method="POST">
                @csrf
                @method('DELETE')
                <button id="delete-confirm-btn" type="submit" disabled
                    class="px-4 py-2 rounded-xl bg-rose-600 disabled:bg-rose-400 disabled:cursor-not-allowed hover:bg-rose-700 text-white text-xs font-semibold shadow-md shadow-rose-600/20 transition flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    <span>Confirm Delete</span>
                </button>
            </form>
        </div>

    </div>
</div>

@push('scripts')
<script>
    let currentTargetDomain = '';

    function openDeleteModal(id, name, domain, formAction) {
        currentTargetDomain = domain.toLowerCase().trim();
        document.getElementById('delete-modal-site-name').textContent = name;
        document.getElementById('delete-modal-domain').textContent = domain;
        document.getElementById('delete-match-text').textContent = domain;
        document.getElementById('delete-form').action = formAction;
        
        // Reset inputs
        const input = document.getElementById('delete-confirm-input');
        input.value = '';
        document.getElementById('delete-checkbox').checked = false;
        document.getElementById('delete-confirm-btn').disabled = true;

        document.getElementById('delete-modal').classList.remove('hidden');
        setTimeout(() => input.focus(), 100);
    }

    function closeDeleteModal() {
        document.getElementById('delete-modal').classList.add('hidden');
    }

    function checkDeleteConfirmation() {
        const inputVal = document.getElementById('delete-confirm-input').value.toLowerCase().trim();
        const checkboxChecked = document.getElementById('delete-checkbox').checked;
        const confirmBtn = document.getElementById('delete-confirm-btn');

        if (inputVal === currentTargetDomain && checkboxChecked) {
            confirmBtn.disabled = false;
            confirmBtn.classList.remove('opacity-50', 'cursor-not-allowed');
        } else {
            confirmBtn.disabled = true;
        }
    }

    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => {
            if (window.showToast) {
                window.showToast('API Key copied to clipboard!', 'success');
            }
        });
    }

    function toggleWebsiteStatus(button, toggleUrl) {
        button.disabled = true;
        button.classList.add('opacity-50', 'pointer-events-none');

        fetch(toggleUrl, {
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                const isNowActive = data.status === 'active';
                const label = button.querySelector('.status-label');
                const dot = button.querySelector('span:first-child');
                
                label.textContent = isNowActive ? 'Active' : 'Inactive';

                if (isNowActive) {
                    button.className = 'group inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-semibold transition-all duration-200 cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500/20 bg-emerald-50 dark:bg-emerald-950/50 text-emerald-600 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800/50 hover:bg-emerald-100';
                    dot.className = 'w-1.5 h-1.5 rounded-full bg-emerald-500';
                } else {
                    button.className = 'group inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-semibold transition-all duration-200 cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500/20 bg-rose-50 dark:bg-rose-950/50 text-rose-600 dark:text-rose-400 border border-rose-200 dark:border-rose-900/50 hover:bg-rose-100';
                    dot.className = 'w-1.5 h-1.5 rounded-full bg-rose-500';
                }

                if (window.showToast) {
                    window.showToast(data.message, 'success');
                }
            } else {
                if (window.showToast) {
                    window.showToast('Failed to update status', 'error');
                }
            }
        })
        .catch(err => {
            console.error(err);
            if (window.showToast) {
                window.showToast('Error communicating with server', 'error');
            }
        })
        .finally(() => {
            button.disabled = false;
            button.classList.remove('opacity-50', 'pointer-events-none');
        });
    }

    // Close modal on Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeDeleteModal();
    });
</script>
@endpush
@endsection
