@extends('layouts.admin')

@section('title', 'Admin Dashboard - Nagad Pay')

@section('content')
<!-- Dashboard Page Header & Date Range -->
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
        <h2 class="text-xl sm:text-2xl font-bold tracking-tight text-slate-900 dark:text-white">
            Dashboard
        </h2>
        <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mt-0.5">
            Overview of all payments across 6 websites using single Nagad merchant
        </p>
    </div>

    <!-- Interactive Date Range Selector Dropdown -->
    <div class="relative inline-block text-left">
        <button id="date-range-btn" type="button" onclick="toggleDropdown('date-range-menu')"
            class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white dark:bg-[#121829] border border-slate-200 dark:border-slate-800 text-xs font-semibold text-slate-700 dark:text-slate-200 shadow-sm hover:bg-slate-50 dark:hover:bg-slate-800 transition">
            <svg class="w-4 h-4 text-slate-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <span id="date-range-text">Sep 01, 2026 - Sep 28, 2026</span>
            <svg class="w-3.5 h-3.5 text-slate-400 ml-1 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <!-- Date Range Dropdown Menu -->
        <div id="date-range-menu" class="hidden absolute right-0 mt-2 w-56 rounded-2xl bg-white dark:bg-[#121829] border border-slate-200 dark:border-slate-800 shadow-xl py-2 z-50 text-xs font-medium">
            <button type="button" onclick="selectDateRange('Today')" class="w-full text-left px-4 py-2 hover:bg-slate-50 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-300">Today</button>
            <button type="button" onclick="selectDateRange('Last 7 Days')" class="w-full text-left px-4 py-2 hover:bg-slate-50 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-300">Last 7 Days</button>
            <button type="button" onclick="selectDateRange('Sep 01, 2026 - Sep 28, 2026')" class="w-full text-left px-4 py-2 bg-blue-50 dark:bg-blue-950/40 text-blue-600 dark:text-blue-400 font-semibold flex items-center justify-between">
                <span>Sep 01, 2026 - Sep 28, 2026</span>
                <span>✔</span>
            </button>
            <button type="button" onclick="selectDateRange('This Month (Sep 2026)')" class="w-full text-left px-4 py-2 hover:bg-slate-50 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-300">This Month</button>
            <button type="button" onclick="selectDateRange('Last Month (Aug 2026)')" class="w-full text-left px-4 py-2 hover:bg-slate-50 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-300">Last Month</button>
        </div>
    </div>
</div>

<!-- ========================================================================= -->
<!-- 4 METRIC CARDS -->
<!-- ========================================================================= -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
    
    <!-- Card 1: Total Transactions -->
    <div class="bg-white dark:bg-[#121829] p-5 rounded-2xl border border-slate-200/80 dark:border-slate-800/80 shadow-sm flex items-center gap-4">
        <div class="w-12 h-12 rounded-2xl bg-blue-50 dark:bg-blue-950/40 text-blue-600 dark:text-blue-400 flex items-center justify-center shrink-0">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 7v10c0 2 1 3 3 3h10c2 0 3-1 3-3V7c0-2-1-3-3-3H7C5 4 4 5 4 7z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 11h16M4 15h16" />
            </svg>
        </div>
        <div>
            <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">Total Transactions</p>
            <h3 class="text-xl font-extrabold text-slate-900 dark:text-white mt-0.5">12,458</h3>
            <p class="text-[11px] font-semibold text-emerald-600 dark:text-emerald-400 flex items-center gap-1 mt-0.5">
                <span>↑ 12.5%</span>
                <span class="text-slate-400 dark:text-slate-500 font-normal">vs last month</span>
            </p>
        </div>
    </div>

    <!-- Card 2: Total Amount -->
    <div class="bg-white dark:bg-[#121829] p-5 rounded-2xl border border-slate-200/80 dark:border-slate-800/80 shadow-sm flex items-center gap-4">
        <div class="w-12 h-12 rounded-2xl bg-emerald-50 dark:bg-emerald-950/40 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0">
            <span class="text-2xl font-bold">৳</span>
        </div>
        <div>
            <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">Total Amount</p>
            <h3 class="text-xl font-extrabold text-slate-900 dark:text-white mt-0.5">৳ 12,45,800</h3>
            <p class="text-[11px] font-semibold text-emerald-600 dark:text-emerald-400 flex items-center gap-1 mt-0.5">
                <span>↑ 18.2%</span>
                <span class="text-slate-400 dark:text-slate-500 font-normal">vs last month</span>
            </p>
        </div>
    </div>

    <!-- Card 3: Successful -->
    <div class="bg-white dark:bg-[#121829] p-5 rounded-2xl border border-slate-200/80 dark:border-slate-800/80 shadow-sm flex items-center gap-4">
        <div class="w-12 h-12 rounded-2xl bg-emerald-50 dark:bg-emerald-950/40 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
            </svg>
        </div>
        <div>
            <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">Successful</p>
            <h3 class="text-xl font-extrabold text-slate-900 dark:text-white mt-0.5">11,892</h3>
            <p class="text-[11px] font-semibold text-slate-500 dark:text-slate-400 mt-0.5">
                <span class="text-emerald-600 dark:text-emerald-400 font-bold">95.5%</span> success rate
            </p>
        </div>
    </div>

    <!-- Card 4: Failed -->
    <div class="bg-white dark:bg-[#121829] p-5 rounded-2xl border border-slate-200/80 dark:border-slate-800/80 shadow-sm flex items-center gap-4">
        <div class="w-12 h-12 rounded-2xl bg-rose-50 dark:bg-rose-950/40 text-rose-600 dark:text-rose-400 flex items-center justify-center shrink-0">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </div>
        <div>
            <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">Failed</p>
            <h3 class="text-xl font-extrabold text-slate-900 dark:text-white mt-0.5">566</h3>
            <p class="text-[11px] font-semibold text-rose-600 dark:text-rose-400 mt-0.5">
                <span class="font-bold">4.5%</span> failure rate
            </p>
        </div>
    </div>
</div>

<!-- ========================================================================= -->
<!-- CHARTS & WEBSITE STATUS (MAIN GRID) -->
<!-- ========================================================================= -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    
    <!-- Left 2 Cols: Charts Container -->
    <div class="lg:col-span-2 space-y-6">
        
        <!-- Line & Donut Chart Split -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            <!-- Chart 1: Payment Volume (Last 30 Days) -->
            <div class="bg-white dark:bg-[#121829] p-5 rounded-2xl border border-slate-200/80 dark:border-slate-800/80 shadow-sm flex flex-col justify-between">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="font-bold text-sm text-slate-900 dark:text-white">Payment Volume (Last 30 Days)</h4>
                    <div class="relative">
                        <button type="button" class="text-xs font-medium text-slate-500 dark:text-slate-400 border border-slate-200 dark:border-slate-700 px-2.5 py-1 rounded-lg flex items-center gap-1">
                            <span>Total Amount</span>
                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                    </div>
                </div>
                <!-- Canvas -->
                <div class="h-48 w-full relative">
                    <canvas id="paymentVolumeChart"></canvas>
                </div>
            </div>

            <!-- Chart 2: Transactions by Website (Donut) -->
            <div class="bg-white dark:bg-[#121829] p-5 rounded-2xl border border-slate-200/80 dark:border-slate-800/80 shadow-sm flex flex-col justify-between">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="font-bold text-sm text-slate-900 dark:text-white">Transactions by Website</h4>
                    <div class="relative">
                        <button type="button" class="text-xs font-medium text-slate-500 dark:text-slate-400 border border-slate-200 dark:border-slate-700 px-2.5 py-1 rounded-lg flex items-center gap-1">
                            <span>Last 30 Days</span>
                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <!-- Donut with Center Text -->
                    <div class="w-36 h-36 relative shrink-0">
                        <canvas id="transactionsDonutChart"></canvas>
                        <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                            <span class="text-sm font-extrabold text-slate-900 dark:text-white leading-tight">12,458</span>
                            <span class="text-[9px] text-slate-400 font-medium">Transactions</span>
                        </div>
                    </div>

                    <!-- Legend -->
                    <div class="space-y-1.5 flex-1 text-[11px]">
                        <div class="flex items-center justify-between">
                            <span class="flex items-center gap-1.5 text-slate-600 dark:text-slate-300">
                                <span class="w-2.5 h-2.5 rounded-sm bg-[#2563eb]"></span> mybdsms.com
                            </span>
                            <span class="font-semibold text-slate-900 dark:text-white">28.5%</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="flex items-center gap-1.5 text-slate-600 dark:text-slate-300">
                                <span class="w-2.5 h-2.5 rounded-sm bg-[#10b981]"></span> mybdphone.com
                            </span>
                            <span class="font-semibold text-slate-900 dark:text-white">22.1%</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="flex items-center gap-1.5 text-slate-600 dark:text-slate-300">
                                <span class="w-2.5 h-2.5 rounded-sm bg-[#f59e0b]"></span> dokandigital.com
                            </span>
                            <span class="font-semibold text-slate-900 dark:text-white">15.8%</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="flex items-center gap-1.5 text-slate-600 dark:text-slate-300">
                                <span class="w-2.5 h-2.5 rounded-sm bg-[#8b5cf6]"></span> primevideo.cards
                            </span>
                            <span class="font-semibold text-slate-900 dark:text-white">12.4%</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="flex items-center gap-1.5 text-slate-600 dark:text-slate-300">
                                <span class="w-2.5 h-2.5 rounded-sm bg-[#ec4899]"></span> aiworkspace.center
                            </span>
                            <span class="font-semibold text-slate-900 dark:text-white">11.6%</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="flex items-center gap-1.5 text-slate-600 dark:text-slate-300">
                                <span class="w-2.5 h-2.5 rounded-sm bg-[#06b6d4]"></span> csnbd.com
                            </span>
                            <span class="font-semibold text-slate-900 dark:text-white">9.6%</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Recent Transactions Table Card -->
        <div class="bg-white dark:bg-[#121829] rounded-2xl border border-slate-200/80 dark:border-slate-800/80 shadow-sm overflow-hidden">
            <div class="p-5 flex items-center justify-between border-b border-slate-100 dark:border-slate-800/60">
                <h4 class="font-bold text-sm text-slate-900 dark:text-white">Recent Transactions</h4>
                <a href="#" class="text-xs font-semibold text-blue-600 dark:text-blue-400 hover:underline">View All</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full min-w-[650px] text-left text-xs text-slate-600 dark:text-slate-300">
                    <thead class="bg-slate-50/70 dark:bg-slate-800/40 text-[11px] uppercase text-slate-400 border-b border-slate-100 dark:border-slate-800/60 font-semibold">
                        <tr>
                            <th class="py-3 px-4 whitespace-nowrap">#</th>
                            <th class="py-3 px-4 whitespace-nowrap">Date & Time</th>
                            <th class="py-3 px-4 whitespace-nowrap">Website</th>
                            <th class="py-3 px-4 whitespace-nowrap">Order ID</th>
                            <th class="py-3 px-4 whitespace-nowrap">Amount</th>
                            <th class="py-3 px-4 whitespace-nowrap">Payment Ref</th>
                            <th class="py-3 px-4 whitespace-nowrap">Status</th>
                            <th class="py-3 px-4 whitespace-nowrap">Gateway</th>
                            <th class="py-3 px-4 whitespace-nowrap text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800/60 font-medium">
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/20 transition">
                            <td class="py-3 px-4 text-slate-400 whitespace-nowrap">1</td>
                            <td class="py-3 px-4 whitespace-nowrap">2026-09-28 20:25</td>
                            <td class="py-3 px-4 whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    <span class="w-5 h-5 rounded bg-blue-600 text-white flex items-center justify-center font-bold text-[10px]">W</span>
                                    <span>mybdsms.com</span>
                                </div>
                            </td>
                            <td class="py-3 px-4 font-mono whitespace-nowrap">MBS-10001</td>
                            <td class="py-3 px-4 font-bold text-slate-900 dark:text-white whitespace-nowrap">৳ 500</td>
                            <td class="py-3 px-4 font-mono text-[11px] whitespace-nowrap">NAGAD123456</td>
                            <td class="py-3 px-4 whitespace-nowrap">
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-emerald-50 dark:bg-emerald-950/50 text-emerald-600 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800/50 whitespace-nowrap">
                                    ✔ Success
                                </span>
                            </td>
                            <td class="py-3 px-4 text-slate-500 whitespace-nowrap">Nagad</td>
                            <td class="py-3 px-4 text-center whitespace-nowrap">
                                <button class="p-1 rounded text-slate-400 hover:text-blue-600 transition" type="button">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </button>
                            </td>
                        </tr>
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/20 transition">
                            <td class="py-3 px-4 text-slate-400 whitespace-nowrap">2</td>
                            <td class="py-3 px-4 whitespace-nowrap">2026-09-28 20:18</td>
                            <td class="py-3 px-4 whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    <span class="w-5 h-5 rounded bg-emerald-600 text-white flex items-center justify-center font-bold text-[10px]">D</span>
                                    <span>mybdphone.com</span>
                                </div>
                            </td>
                            <td class="py-3 px-4 font-mono whitespace-nowrap">PHONE-2001</td>
                            <td class="py-3 px-4 font-bold text-slate-900 dark:text-white whitespace-nowrap">৳ 1,200</td>
                            <td class="py-3 px-4 font-mono text-[11px] whitespace-nowrap">NAGAD123457</td>
                            <td class="py-3 px-4 whitespace-nowrap">
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-emerald-50 dark:bg-emerald-950/50 text-emerald-600 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800/50 whitespace-nowrap">
                                    ✔ Success
                                </span>
                            </td>
                            <td class="py-3 px-4 text-slate-500 whitespace-nowrap">Nagad</td>
                            <td class="py-3 px-4 text-center whitespace-nowrap">
                                <button class="p-1 rounded text-slate-400 hover:text-blue-600 transition" type="button">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </button>
                            </td>
                        </tr>
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/20 transition">
                            <td class="py-3 px-4 text-slate-400 whitespace-nowrap">3</td>
                            <td class="py-3 px-4 whitespace-nowrap">2026-09-28 19:55</td>
                            <td class="py-3 px-4 whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    <span class="w-5 h-5 rounded bg-amber-500 text-white flex items-center justify-center font-bold text-[10px]">d</span>
                                    <span>dokandigital.com</span>
                                </div>
                            </td>
                            <td class="py-3 px-4 font-mono whitespace-nowrap">DOKAN-3001</td>
                            <td class="py-3 px-4 font-bold text-slate-900 dark:text-white whitespace-nowrap">৳ 350</td>
                            <td class="py-3 px-4 font-mono text-[11px] whitespace-nowrap">NAGAD123458</td>
                            <td class="py-3 px-4 whitespace-nowrap">
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-rose-50 dark:bg-rose-950/50 text-rose-600 dark:text-rose-400 border border-rose-200 dark:border-rose-900/50 whitespace-nowrap">
                                    ✖ Failed
                                </span>
                            </td>
                            <td class="py-3 px-4 text-slate-500 whitespace-nowrap">Nagad</td>
                            <td class="py-3 px-4 text-center whitespace-nowrap">
                                <button class="p-1 rounded text-slate-400 hover:text-blue-600 transition" type="button">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </button>
                            </td>
                        </tr>
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/20 transition">
                            <td class="py-3 px-4 text-slate-400 whitespace-nowrap">4</td>
                            <td class="py-3 px-4 whitespace-nowrap">2026-09-28 19:40</td>
                            <td class="py-3 px-4 whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    <span class="w-5 h-5 rounded bg-purple-600 text-white flex items-center justify-center font-bold text-[10px]">P</span>
                                    <span>primevideo.cards</span>
                                </div>
                            </td>
                            <td class="py-3 px-4 font-mono whitespace-nowrap">PRIME-4001</td>
                            <td class="py-3 px-4 font-bold text-slate-900 dark:text-white whitespace-nowrap">৳ 800</td>
                            <td class="py-3 px-4 font-mono text-[11px] whitespace-nowrap">NAGAD123459</td>
                            <td class="py-3 px-4 whitespace-nowrap">
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-emerald-50 dark:bg-emerald-950/50 text-emerald-600 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800/50 whitespace-nowrap">
                                    ✔ Success
                                </span>
                            </td>
                            <td class="py-3 px-4 text-slate-500 whitespace-nowrap">Nagad</td>
                            <td class="py-3 px-4 text-center whitespace-nowrap">
                                <button class="p-1 rounded text-slate-400 hover:text-blue-600 transition" type="button">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </button>
                            </td>
                        </tr>
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/20 transition">
                            <td class="py-3 px-4 text-slate-400 whitespace-nowrap">5</td>
                            <td class="py-3 px-4 whitespace-nowrap">2026-09-28 18:12</td>
                            <td class="py-3 px-4 whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    <span class="w-5 h-5 rounded bg-pink-600 text-white flex items-center justify-center font-bold text-[10px]">A</span>
                                    <span>aiworkspace.center</span>
                                </div>
                            </td>
                            <td class="py-3 px-4 font-mono whitespace-nowrap">AI-5001</td>
                            <td class="py-3 px-4 font-bold text-slate-900 dark:text-white whitespace-nowrap">৳ 1,500</td>
                            <td class="py-3 px-4 font-mono text-[11px] whitespace-nowrap">NAGAD123460</td>
                            <td class="py-3 px-4 whitespace-nowrap">
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-emerald-50 dark:bg-emerald-950/50 text-emerald-600 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800/50 whitespace-nowrap">
                                    ✔ Success
                                </span>
                            </td>
                            <td class="py-3 px-4 text-slate-500 whitespace-nowrap">Nagad</td>
                            <td class="py-3 px-4 text-center whitespace-nowrap">
                                <button class="p-1 rounded text-slate-400 hover:text-blue-600 transition" type="button">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </button>
                            </td>
                        </tr>
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/20 transition">
                            <td class="py-3 px-4 text-slate-400 whitespace-nowrap">6</td>
                            <td class="py-3 px-4 whitespace-nowrap">2026-09-28 17:25</td>
                            <td class="py-3 px-4 whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    <span class="w-5 h-5 rounded bg-cyan-600 text-white flex items-center justify-center font-bold text-[10px]">C</span>
                                    <span>csnbd.com</span>
                                </div>
                            </td>
                            <td class="py-3 px-4 font-mono whitespace-nowrap">CSN-6001</td>
                            <td class="py-3 px-4 font-bold text-slate-900 dark:text-white whitespace-nowrap">৳ 600</td>
                            <td class="py-3 px-4 font-mono text-[11px] whitespace-nowrap">NAGAD123461</td>
                            <td class="py-3 px-4 whitespace-nowrap">
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-emerald-50 dark:bg-emerald-950/50 text-emerald-600 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800/50 whitespace-nowrap">
                                    ✔ Success
                                </span>
                            </td>
                            <td class="py-3 px-4 text-slate-500 whitespace-nowrap">Nagad</td>
                            <td class="py-3 px-4 text-center whitespace-nowrap">
                                <button class="p-1 rounded text-slate-400 hover:text-blue-600 transition" type="button">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- Right 1 Col: Website Status & Nagad Integration & Quick Actions -->
    <div class="space-y-6">
        
        <!-- Website Status (6 Websites) -->
        <div class="bg-white dark:bg-[#121829] p-5 rounded-2xl border border-slate-200/80 dark:border-slate-800/80 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <h4 class="font-bold text-sm text-slate-900 dark:text-white">Website Status (6 Websites)</h4>
                <button type="button" class="px-2.5 py-1 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-semibold flex items-center gap-1 shadow-sm transition">
                    <span>+ Add Website</span>
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="text-slate-400 text-[10px] uppercase font-semibold border-b border-slate-100 dark:border-slate-800/60 pb-2">
                        <tr>
                            <th class="pb-2 whitespace-nowrap">#</th>
                            <th class="pb-2 whitespace-nowrap">Website</th>
                            <th class="pb-2 whitespace-nowrap">Status</th>
                            <th class="pb-2 text-right whitespace-nowrap">Total Txn</th>
                            <th class="pb-2 text-right whitespace-nowrap">Success Rate</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800/60">
                        <tr>
                            <td class="py-2 text-slate-400 whitespace-nowrap">1</td>
                            <td class="py-2 font-medium text-slate-700 dark:text-slate-200 whitespace-nowrap">
                                <span class="inline-flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-blue-600"></span>mybdsms.com</span>
                            </td>
                            <td class="py-2 whitespace-nowrap"><span class="px-1.5 py-0.5 rounded text-[10px] bg-emerald-50 dark:bg-emerald-950/40 text-emerald-600 dark:text-emerald-400 font-semibold whitespace-nowrap">● Active</span></td>
                            <td class="py-2 text-right font-semibold whitespace-nowrap">3,548</td>
                            <td class="py-2 text-right font-bold text-emerald-600 whitespace-nowrap">96.2%</td>
                        </tr>
                        <tr>
                            <td class="py-2 text-slate-400 whitespace-nowrap">2</td>
                            <td class="py-2 font-medium text-slate-700 dark:text-slate-200 whitespace-nowrap">
                                <span class="inline-flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-emerald-600"></span>mybdphone.com</span>
                            </td>
                            <td class="py-2 whitespace-nowrap"><span class="px-1.5 py-0.5 rounded text-[10px] bg-emerald-50 dark:bg-emerald-950/40 text-emerald-600 dark:text-emerald-400 font-semibold whitespace-nowrap">● Active</span></td>
                            <td class="py-2 text-right font-semibold whitespace-nowrap">2,754</td>
                            <td class="py-2 text-right font-bold text-emerald-600 whitespace-nowrap">95.1%</td>
                        </tr>
                        <tr>
                            <td class="py-2 text-slate-400 whitespace-nowrap">3</td>
                            <td class="py-2 font-medium text-slate-700 dark:text-slate-200 whitespace-nowrap">
                                <span class="inline-flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-amber-500"></span>dokandigital.com</span>
                            </td>
                            <td class="py-2 whitespace-nowrap"><span class="px-1.5 py-0.5 rounded text-[10px] bg-emerald-50 dark:bg-emerald-950/40 text-emerald-600 dark:text-emerald-400 font-semibold whitespace-nowrap">● Active</span></td>
                            <td class="py-2 text-right font-semibold whitespace-nowrap">1,957</td>
                            <td class="py-2 text-right font-bold text-emerald-600 whitespace-nowrap">94.8%</td>
                        </tr>
                        <tr>
                            <td class="py-2 text-slate-400 whitespace-nowrap">4</td>
                            <td class="py-2 font-medium text-slate-700 dark:text-slate-200 whitespace-nowrap">
                                <span class="inline-flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-purple-600"></span>primevideo.cards</span>
                            </td>
                            <td class="py-2 whitespace-nowrap"><span class="px-1.5 py-0.5 rounded text-[10px] bg-emerald-50 dark:bg-emerald-950/40 text-emerald-600 dark:text-emerald-400 font-semibold whitespace-nowrap">● Active</span></td>
                            <td class="py-2 text-right font-semibold whitespace-nowrap">1,547</td>
                            <td class="py-2 text-right font-bold text-emerald-600 whitespace-nowrap">95.9%</td>
                        </tr>
                        <tr>
                            <td class="py-2 text-slate-400 whitespace-nowrap">5</td>
                            <td class="py-2 font-medium text-slate-700 dark:text-slate-200 whitespace-nowrap">
                                <span class="inline-flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-pink-600"></span>aiworkspace.center</span>
                            </td>
                            <td class="py-2 whitespace-nowrap"><span class="px-1.5 py-0.5 rounded text-[10px] bg-emerald-50 dark:bg-emerald-950/40 text-emerald-600 dark:text-emerald-400 font-semibold whitespace-nowrap">● Active</span></td>
                            <td class="py-2 text-right font-semibold whitespace-nowrap">1,441</td>
                            <td class="py-2 text-right font-bold text-emerald-600 whitespace-nowrap">93.4%</td>
                        </tr>
                        <tr>
                            <td class="py-2 text-slate-400 whitespace-nowrap">6</td>
                            <td class="py-2 font-medium text-slate-700 dark:text-slate-200 whitespace-nowrap">
                                <span class="inline-flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-cyan-600"></span>csnbd.com</span>
                            </td>
                            <td class="py-2 whitespace-nowrap"><span class="px-1.5 py-0.5 rounded text-[10px] bg-emerald-50 dark:bg-emerald-950/40 text-emerald-600 dark:text-emerald-400 font-semibold whitespace-nowrap">● Active</span></td>
                            <td class="py-2 text-right font-semibold whitespace-nowrap">1,201</td>
                            <td class="py-2 text-right font-bold text-emerald-600 whitespace-nowrap">97.1%</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-3 text-center pt-2 border-t border-slate-100 dark:border-slate-800/60">
                <a href="#" class="text-xs font-semibold text-blue-600 dark:text-blue-400 hover:underline inline-flex items-center gap-1">
                    View All Websites <span>→</span>
                </a>
            </div>
        </div>

        <!-- Nagad Integration Status Card -->
        <div class="bg-white dark:bg-[#121829] p-5 rounded-2xl border border-slate-200/80 dark:border-slate-800/80 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <h4 class="font-bold text-sm text-slate-900 dark:text-white">Nagad Integration</h4>
            </div>

            <div class="flex items-center justify-between pb-3 mb-3 border-b border-slate-100 dark:border-slate-800/60">
                <div class="flex items-center gap-2">
                    <img src="{{ asset('assets/img/Nagad-Logo.wine.svg') }}" alt="Nagad" class="h-7 w-auto">
                    <span class="font-bold text-base text-slate-900 dark:text-white">নগদ</span>
                </div>
                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-emerald-50 dark:bg-emerald-950/50 text-emerald-600 dark:text-emerald-400 text-xs font-semibold border border-emerald-200 dark:border-emerald-800/40 whitespace-nowrap">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Connected
                </span>
            </div>

            <div class="space-y-2 text-xs mb-4">
                <div class="flex justify-between items-center">
                    <span class="text-slate-500 dark:text-slate-400">Merchant ID</span>
                    <span class="font-mono font-semibold text-slate-800 dark:text-slate-200">10001XXXX</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-slate-500 dark:text-slate-400">Environment</span>
                    <span class="px-2 py-0.5 rounded bg-emerald-100 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 font-bold text-[11px]">Live</span>
                </div>
                <div>
                    <span class="text-slate-500 dark:text-slate-400 block mb-0.5">Callback URL</span>
                    <span class="font-mono text-[11px] text-slate-700 dark:text-slate-300 break-all">https://nagad.banglaqr.online/api/nagad/callback</span>
                </div>
                <div class="flex justify-between items-center pt-1">
                    <span class="text-slate-500 dark:text-slate-400">Last Checked</span>
                    <span class="font-medium text-slate-700 dark:text-slate-300">2026-09-28 20:30:15</span>
                </div>
            </div>

            <button type="button" class="w-full py-2 px-3 rounded-xl border border-blue-600 text-blue-600 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-950/30 text-xs font-semibold text-center transition">
                Test Connection
            </button>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white dark:bg-[#121829] p-5 rounded-2xl border border-slate-200/80 dark:border-slate-800/80 shadow-sm">
            <h4 class="font-bold text-sm text-slate-900 dark:text-white mb-3">Quick Actions</h4>
            
            <div class="grid grid-cols-4 gap-2.5 text-center">
                <!-- Action 1 -->
                <a href="#" class="p-3 rounded-xl bg-blue-50 dark:bg-blue-950/40 hover:bg-blue-100 dark:hover:bg-blue-900/40 text-blue-600 dark:text-blue-400 flex flex-col items-center justify-center gap-1.5 transition">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span class="text-[10px] font-semibold leading-tight">View Transactions</span>
                </a>

                <!-- Action 2 -->
                <a href="#" class="p-3 rounded-xl bg-emerald-50 dark:bg-emerald-950/40 hover:bg-emerald-100 dark:hover:bg-emerald-900/40 text-emerald-600 dark:text-emerald-400 flex flex-col items-center justify-center gap-1.5 transition">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    <span class="text-[10px] font-semibold leading-tight">Add Website</span>
                </a>

                <!-- Action 3 -->
                <a href="#" class="p-3 rounded-xl bg-amber-50 dark:bg-amber-950/40 hover:bg-amber-100 dark:hover:bg-amber-900/40 text-amber-600 dark:text-amber-400 flex flex-col items-center justify-center gap-1.5 transition">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span class="text-[10px] font-semibold leading-tight">Nagad Settings</span>
                </a>

                <!-- Action 4 -->
                <a href="#" class="p-3 rounded-xl bg-purple-50 dark:bg-purple-950/40 hover:bg-purple-100 dark:hover:bg-purple-900/40 text-purple-600 dark:text-purple-400 flex flex-col items-center justify-center gap-1.5 transition">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                    </svg>
                    <span class="text-[10px] font-semibold leading-tight">View Webhooks</span>
                </a>
            </div>
        </div>

    </div>

</div>

<!-- ========================================================================= -->
<!-- BOTTOM 2 TABLES (WEBHOOK DELIVERIES & API REQUESTS) -->
<!-- ========================================================================= -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    
    <!-- Table 1: Recent Webhook Deliveries -->
    <div class="bg-white dark:bg-[#121829] rounded-2xl border border-slate-200/80 dark:border-slate-800/80 shadow-sm overflow-hidden">
        <div class="p-5 flex items-center justify-between border-b border-slate-100 dark:border-slate-800/60">
            <h4 class="font-bold text-sm text-slate-900 dark:text-white">Recent Webhook Deliveries</h4>
            <a href="#" class="text-xs font-semibold text-blue-600 dark:text-blue-400 hover:underline">View All</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full min-w-[480px] text-left text-xs text-slate-600 dark:text-slate-300">
                <thead class="bg-slate-50/70 dark:bg-slate-800/40 text-[11px] uppercase text-slate-400 border-b border-slate-100 dark:border-slate-800/60 font-semibold">
                    <tr>
                        <th class="py-3 px-3.5 whitespace-nowrap">#</th>
                        <th class="py-3 px-3.5 whitespace-nowrap">Time</th>
                        <th class="py-3 px-3.5 whitespace-nowrap">Website</th>
                        <th class="py-3 px-3.5 whitespace-nowrap">Transaction ID</th>
                        <th class="py-3 px-3.5 whitespace-nowrap">Status</th>
                        <th class="py-3 px-3.5 text-center whitespace-nowrap">HTTP Code</th>
                        <th class="py-3 px-3.5 text-center whitespace-nowrap">Attempts</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800/60 font-medium">
                    <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/20 transition">
                        <td class="py-3 px-3.5 text-slate-400 whitespace-nowrap">1</td>
                        <td class="py-3 px-3.5 whitespace-nowrap text-slate-700 dark:text-slate-300">2026-09-28 20:25</td>
                        <td class="py-3 px-3.5 whitespace-nowrap">
                            <div class="flex items-center gap-1.5">
                                <span class="w-4 h-4 rounded bg-blue-600 text-white flex items-center justify-center text-[9px] font-bold shrink-0">W</span>
                                <span>mybdsms.com</span>
                            </div>
                        </td>
                        <td class="py-3 px-3.5 font-mono whitespace-nowrap text-slate-700 dark:text-slate-200">10001</td>
                        <td class="py-3 px-3.5 whitespace-nowrap">
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] bg-emerald-50 dark:bg-emerald-950/50 text-emerald-600 dark:text-emerald-400 font-semibold whitespace-nowrap">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Success
                            </span>
                        </td>
                        <td class="py-3 px-3.5 text-center font-mono whitespace-nowrap">200</td>
                        <td class="py-3 px-3.5 text-center whitespace-nowrap">1</td>
                    </tr>
                    <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/20 transition">
                        <td class="py-3 px-3.5 text-slate-400 whitespace-nowrap">2</td>
                        <td class="py-3 px-3.5 whitespace-nowrap text-slate-700 dark:text-slate-300">2026-09-28 20:18</td>
                        <td class="py-3 px-3.5 whitespace-nowrap">
                            <div class="flex items-center gap-1.5">
                                <span class="w-4 h-4 rounded bg-emerald-600 text-white flex items-center justify-center text-[9px] font-bold shrink-0">D</span>
                                <span>mybdphone.com</span>
                            </div>
                        </td>
                        <td class="py-3 px-3.5 font-mono whitespace-nowrap text-slate-700 dark:text-slate-200">10002</td>
                        <td class="py-3 px-3.5 whitespace-nowrap">
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] bg-emerald-50 dark:bg-emerald-950/50 text-emerald-600 dark:text-emerald-400 font-semibold whitespace-nowrap">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Success
                            </span>
                        </td>
                        <td class="py-3 px-3.5 text-center font-mono whitespace-nowrap">200</td>
                        <td class="py-3 px-3.5 text-center whitespace-nowrap">1</td>
                    </tr>
                    <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/20 transition">
                        <td class="py-3 px-3.5 text-slate-400 whitespace-nowrap">3</td>
                        <td class="py-3 px-3.5 whitespace-nowrap text-slate-700 dark:text-slate-300">2026-09-28 19:40</td>
                        <td class="py-3 px-3.5 whitespace-nowrap">
                            <div class="flex items-center gap-1.5">
                                <span class="w-4 h-4 rounded bg-purple-600 text-white flex items-center justify-center text-[9px] font-bold shrink-0">P</span>
                                <span>primevideo.cards</span>
                            </div>
                        </td>
                        <td class="py-3 px-3.5 font-mono whitespace-nowrap text-slate-700 dark:text-slate-200">10004</td>
                        <td class="py-3 px-3.5 whitespace-nowrap">
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] bg-emerald-50 dark:bg-emerald-950/50 text-emerald-600 dark:text-emerald-400 font-semibold whitespace-nowrap">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Success
                            </span>
                        </td>
                        <td class="py-3 px-3.5 text-center font-mono whitespace-nowrap">200</td>
                        <td class="py-3 px-3.5 text-center whitespace-nowrap">1</td>
                    </tr>
                    <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/20 transition">
                        <td class="py-3 px-3.5 text-slate-400 whitespace-nowrap">4</td>
                        <td class="py-3 px-3.5 whitespace-nowrap text-slate-700 dark:text-slate-300">2026-09-28 18:15</td>
                        <td class="py-3 px-3.5 whitespace-nowrap">
                            <div class="flex items-center gap-1.5">
                                <span class="w-4 h-4 rounded bg-pink-600 text-white flex items-center justify-center text-[9px] font-bold shrink-0">A</span>
                                <span>aiworkspace.center</span>
                            </div>
                        </td>
                        <td class="py-3 px-3.5 font-mono whitespace-nowrap text-slate-700 dark:text-slate-200">10005</td>
                        <td class="py-3 px-3.5 whitespace-nowrap">
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] bg-rose-50 dark:bg-rose-950/50 text-rose-600 dark:text-rose-400 font-semibold whitespace-nowrap">
                                Failed
                            </span>
                        </td>
                        <td class="py-3 px-3.5 text-center font-mono whitespace-nowrap text-rose-500 font-semibold">500</td>
                        <td class="py-3 px-3.5 text-center whitespace-nowrap">3</td>
                    </tr>
                    <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/20 transition">
                        <td class="py-3 px-3.5 text-slate-400 whitespace-nowrap">5</td>
                        <td class="py-3 px-3.5 whitespace-nowrap text-slate-700 dark:text-slate-300">2026-09-28 17:25</td>
                        <td class="py-3 px-3.5 whitespace-nowrap">
                            <div class="flex items-center gap-1.5">
                                <span class="w-4 h-4 rounded bg-cyan-600 text-white flex items-center justify-center text-[9px] font-bold shrink-0">C</span>
                                <span>csnbd.com</span>
                            </div>
                        </td>
                        <td class="py-3 px-3.5 font-mono whitespace-nowrap text-slate-700 dark:text-slate-200">10006</td>
                        <td class="py-3 px-3.5 whitespace-nowrap">
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] bg-emerald-50 dark:bg-emerald-950/50 text-emerald-600 dark:text-emerald-400 font-semibold whitespace-nowrap">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Success
                            </span>
                        </td>
                        <td class="py-3 px-3.5 text-center font-mono whitespace-nowrap">200</td>
                        <td class="py-3 px-3.5 text-center whitespace-nowrap">1</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Table 2: Recent API Requests (From Websites) -->
    <div class="bg-white dark:bg-[#121829] rounded-2xl border border-slate-200/80 dark:border-slate-800/80 shadow-sm overflow-hidden">
        <div class="p-5 flex items-center justify-between border-b border-slate-100 dark:border-slate-800/60">
            <h4 class="font-bold text-sm text-slate-900 dark:text-white">Recent API Requests (From Websites)</h4>
            <a href="#" class="text-xs font-semibold text-blue-600 dark:text-blue-400 hover:underline">View All</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full min-w-[480px] text-left text-xs text-slate-600 dark:text-slate-300">
                <thead class="bg-slate-50/70 dark:bg-slate-800/40 text-[11px] uppercase text-slate-400 border-b border-slate-100 dark:border-slate-800/60 font-semibold">
                    <tr>
                        <th class="py-3 px-3.5 whitespace-nowrap">#</th>
                        <th class="py-3 px-3.5 whitespace-nowrap">Time</th>
                        <th class="py-3 px-3.5 whitespace-nowrap">Website</th>
                        <th class="py-3 px-3.5 whitespace-nowrap">Endpoint</th>
                        <th class="py-3 px-3.5 text-center whitespace-nowrap">Status</th>
                        <th class="py-3 px-3.5 whitespace-nowrap">IP Address</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800/60 font-medium">
                    <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/20 transition">
                        <td class="py-3 px-3.5 text-slate-400 whitespace-nowrap">1</td>
                        <td class="py-3 px-3.5 whitespace-nowrap text-slate-700 dark:text-slate-300">2026-09-28 20:25</td>
                        <td class="py-3 px-3.5 whitespace-nowrap">
                            <div class="flex items-center gap-1.5">
                                <span class="w-4 h-4 rounded bg-blue-600 text-white flex items-center justify-center text-[9px] font-bold shrink-0">W</span>
                                <span>mybdsms.com</span>
                            </div>
                        </td>
                        <td class="py-3 px-3.5 font-mono text-[11px] whitespace-nowrap text-slate-700 dark:text-slate-300">/api/v1/payment/create</td>
                        <td class="py-3 px-3.5 text-center font-mono whitespace-nowrap">200</td>
                        <td class="py-3 px-3.5 font-mono text-[11px] whitespace-nowrap text-slate-500">103.12.45.10</td>
                    </tr>
                    <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/20 transition">
                        <td class="py-3 px-3.5 text-slate-400 whitespace-nowrap">2</td>
                        <td class="py-3 px-3.5 whitespace-nowrap text-slate-700 dark:text-slate-300">2026-09-28 20:18</td>
                        <td class="py-3 px-3.5 whitespace-nowrap">
                            <div class="flex items-center gap-1.5">
                                <span class="w-4 h-4 rounded bg-emerald-600 text-white flex items-center justify-center text-[9px] font-bold shrink-0">D</span>
                                <span>mybdphone.com</span>
                            </div>
                        </td>
                        <td class="py-3 px-3.5 font-mono text-[11px] whitespace-nowrap text-slate-700 dark:text-slate-300">/api/v1/payment/create</td>
                        <td class="py-3 px-3.5 text-center font-mono whitespace-nowrap">200</td>
                        <td class="py-3 px-3.5 font-mono text-[11px] whitespace-nowrap text-slate-500">103.21.11.90</td>
                    </tr>
                    <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/20 transition">
                        <td class="py-3 px-3.5 text-slate-400 whitespace-nowrap">3</td>
                        <td class="py-3 px-3.5 whitespace-nowrap text-slate-700 dark:text-slate-300">2026-09-28 19:55</td>
                        <td class="py-3 px-3.5 whitespace-nowrap">
                            <div class="flex items-center gap-1.5">
                                <span class="w-4 h-4 rounded bg-amber-500 text-white flex items-center justify-center text-[9px] font-bold shrink-0">d</span>
                                <span>dokandigital.com</span>
                            </div>
                        </td>
                        <td class="py-3 px-3.5 font-mono text-[11px] whitespace-nowrap text-slate-700 dark:text-slate-300">/api/v1/payment/status</td>
                        <td class="py-3 px-3.5 text-center font-mono whitespace-nowrap">200</td>
                        <td class="py-3 px-3.5 font-mono text-[11px] whitespace-nowrap text-slate-500">103.9.44.21</td>
                    </tr>
                    <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/20 transition">
                        <td class="py-3 px-3.5 text-slate-400 whitespace-nowrap">4</td>
                        <td class="py-3 px-3.5 whitespace-nowrap text-slate-700 dark:text-slate-300">2026-09-28 19:40</td>
                        <td class="py-3 px-3.5 whitespace-nowrap">
                            <div class="flex items-center gap-1.5">
                                <span class="w-4 h-4 rounded bg-purple-600 text-white flex items-center justify-center text-[9px] font-bold shrink-0">P</span>
                                <span>primevideo.cards</span>
                            </div>
                        </td>
                        <td class="py-3 px-3.5 font-mono text-[11px] whitespace-nowrap text-slate-700 dark:text-slate-300">/api/v1/payment/create</td>
                        <td class="py-3 px-3.5 text-center font-mono whitespace-nowrap">200</td>
                        <td class="py-3 px-3.5 font-mono text-[11px] whitespace-nowrap text-slate-500">103.75.61.14</td>
                    </tr>
                    <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/20 transition">
                        <td class="py-3 px-3.5 text-slate-400 whitespace-nowrap">5</td>
                        <td class="py-3 px-3.5 whitespace-nowrap text-slate-700 dark:text-slate-300">2026-09-28 18:12</td>
                        <td class="py-3 px-3.5 whitespace-nowrap">
                            <div class="flex items-center gap-1.5">
                                <span class="w-4 h-4 rounded bg-pink-600 text-white flex items-center justify-center text-[9px] font-bold shrink-0">A</span>
                                <span>aiworkspace.center</span>
                            </div>
                        </td>
                        <td class="py-3 px-3.5 font-mono text-[11px] whitespace-nowrap text-slate-700 dark:text-slate-300">/api/v1/payment/create</td>
                        <td class="py-3 px-3.5 text-center font-mono whitespace-nowrap">200</td>
                        <td class="py-3 px-3.5 font-mono text-[11px] whitespace-nowrap text-slate-500">103.60.23.89</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    // -------------------------------------------------------------
    // Chart.js Initialization
    // -------------------------------------------------------------
    let paymentChart, donutChart;

    function getChartColors() {
        const isDark = document.documentElement.classList.contains('dark');
        return {
            gridColor: isDark ? 'rgba(255, 255, 255, 0.06)' : 'rgba(0, 0, 0, 0.05)',
            textColor: isDark ? '#94a3b8' : '#64748b',
            lineColor: '#2563eb',
            fillColor: isDark ? 'rgba(37, 99, 235, 0.18)' : 'rgba(37, 99, 235, 0.08)'
        };
    }

    function initCharts() {
        const colors = getChartColors();

        // Line Chart: Payment Volume
        const ctxVolume = document.getElementById('paymentVolumeChart');
        if (ctxVolume) {
            paymentChart = new Chart(ctxVolume, {
                type: 'line',
                data: {
                    labels: ['Sep 01', 'Sep 05', 'Sep 10', 'Sep 15', 'Sep 20', 'Sep 25', 'Sep 28'],
                    datasets: [{
                        label: 'Volume (৳)',
                        data: [10000, 24000, 18000, 26000, 22000, 38000, 31000, 42000, 39000, 56000],
                        borderColor: colors.lineColor,
                        backgroundColor: colors.fillColor,
                        tension: 0.35,
                        fill: true,
                        pointBackgroundColor: colors.lineColor,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        borderWidth: 2.5
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return ' ৳ ' + context.parsed.y.toLocaleString();
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            min: 0,
                            max: 60000,
                            ticks: {
                                stepSize: 20000,
                                color: colors.textColor,
                                callback: function(value) {
                                    return '৳ ' + value.toLocaleString();
                                },
                                font: { size: 10 }
                            },
                            grid: { color: colors.gridColor }
                        },
                        x: {
                            ticks: {
                                color: colors.textColor,
                                font: { size: 10 }
                            },
                            grid: { display: false }
                        }
                    }
                }
            });
        }

        // Donut Chart: Transactions by Website
        const ctxDonut = document.getElementById('transactionsDonutChart');
        if (ctxDonut) {
            donutChart = new Chart(ctxDonut, {
                type: 'doughnut',
                data: {
                    labels: ['mybdsms.com', 'mybdphone.com', 'dokandigital.com', 'primevideo.cards', 'aiworkspace.center', 'csnbd.com'],
                    datasets: [{
                        data: [28.5, 22.1, 15.8, 12.4, 11.6, 9.6],
                        backgroundColor: [
                            '#2563eb', // Blue
                            '#10b981', // Emerald
                            '#f59e0b', // Amber/Orange
                            '#8b5cf6', // Purple
                            '#ec4899', // Pink
                            '#06b6d4'  // Cyan
                        ],
                        borderWidth: 0,
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '76%',
                    plugins: {
                        legend: { display: false }
                    }
                }
            });
        }
    }

    function updateChartThemes() {
        if (!paymentChart) return;
        const colors = getChartColors();
        paymentChart.options.scales.y.grid.color = colors.gridColor;
        paymentChart.options.scales.y.ticks.color = colors.textColor;
        paymentChart.options.scales.x.ticks.color = colors.textColor;
        paymentChart.data.datasets[0].backgroundColor = colors.fillColor;
        paymentChart.update();
    }

    document.addEventListener('DOMContentLoaded', initCharts);
</script>
@endpush
