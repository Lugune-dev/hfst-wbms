<x-filament-panels::page>
    @php
        $financial = $this->getFinancialSummary();
        $students  = $this->getStudentSummary();
        $donors    = $this->getDonorSummary();
        $projects  = $this->getProjectSummary();
    @endphp

    <div class="space-y-6">
        {{-- Header --}}
        <div class="rounded-2xl p-6 text-white relative overflow-hidden"
             style="background: linear-gradient(135deg, #13385E 0%, #1e5080 55%, #2E7D32 100%);">
            <h2 class="text-xl font-black">📊 Ripoti za Mfumo (System Reports)</h2>
            <p class="mt-1 text-white/80">Muhtasari wa fedha, wanafunzi, wafadhili na miradi. Pakua ripoti kwa PDF au Excel kutoka vitufe hapo juu.</p>
        </div>

        {{-- Financial Summary --}}
        <div class="rounded-xl border border-gray-200 dark:border-white/10 bg-white dark:bg-gray-900 p-6 shadow-sm">
            <h3 class="mb-4 text-base font-bold text-gray-900 dark:text-white">💰 Muhtasari wa Fedha (Financial Summary)</h3>
            <div class="grid grid-cols-2 gap-4 sm:grid-cols-4">
                <div class="rounded-lg bg-green-50 dark:bg-green-900/20 p-4 text-center">
                    <p class="text-2xl font-black text-green-700 dark:text-green-300">TZS {{ number_format($financial['total_confirmed'], 0) }}</p>
                    <p class="text-sm text-green-600 dark:text-green-400">Jumla Iliyothibitishwa</p>
                </div>
                <div class="rounded-lg bg-yellow-50 dark:bg-yellow-900/20 p-4 text-center">
                    <p class="text-2xl font-black text-yellow-700 dark:text-yellow-300">TZS {{ number_format($financial['total_pending'], 0) }}</p>
                    <p class="text-sm text-yellow-600 dark:text-yellow-400">Inayosubiri Uthibitisho</p>
                </div>
                <div class="rounded-lg bg-blue-50 dark:bg-blue-900/20 p-4 text-center">
                    <p class="text-2xl font-black text-blue-700 dark:text-blue-300">TZS {{ number_format($financial['this_month'], 0) }}</p>
                    <p class="text-sm text-blue-600 dark:text-blue-400">Mwezi Huu</p>
                </div>
                <div class="rounded-lg bg-purple-50 dark:bg-purple-900/20 p-4 text-center">
                    <p class="text-2xl font-black text-purple-700 dark:text-purple-300">TZS {{ number_format($financial['this_year'], 0) }}</p>
                    <p class="text-sm text-purple-600 dark:text-purple-400">Mwaka Huu</p>
                </div>
            </div>
        </div>

        {{-- Students / Donors / Projects Summary --}}
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            <div class="rounded-xl border border-gray-200 dark:border-white/10 bg-white dark:bg-gray-900 p-6 shadow-sm">
                <h3 class="mb-4 text-base font-bold text-gray-900 dark:text-white">🎓 Wanafunzi</h3>
                <dl class="space-y-2 text-sm">
                    <div class="flex justify-between"><dt class="text-gray-500">Wote</dt><dd class="font-bold text-gray-900 dark:text-white">{{ $students['total'] }}</dd></div>
                    <div class="flex justify-between"><dt class="text-gray-500">Hai</dt><dd class="font-bold text-green-600">{{ $students['active'] }}</dd></div>
                    <div class="flex justify-between"><dt class="text-gray-500">Wahitimu</dt><dd class="font-bold text-blue-600">{{ $students['graduated'] }}</dd></div>
                    <div class="flex justify-between"><dt class="text-gray-500">Walioacha</dt><dd class="font-bold text-red-600">{{ $students['dropped'] }}</dd></div>
                </dl>
            </div>

            <div class="rounded-xl border border-gray-200 dark:border-white/10 bg-white dark:bg-gray-900 p-6 shadow-sm">
                <h3 class="mb-4 text-base font-bold text-gray-900 dark:text-white">💚 Wafadhili Bora (Top Donors)</h3>
                <ul class="space-y-2 text-sm">
                    @forelse($donors['top_donors'] as $donor)
                        <li class="flex justify-between">
                            <span class="text-gray-700 dark:text-gray-300">{{ $donor->user?->name ?? 'N/A' }}</span>
                            <span class="font-bold text-green-600">TZS {{ number_format($donor->confirmed_total ?? 0, 0) }}</span>
                        </li>
                    @empty
                        <li class="text-gray-400">Hakuna data bado.</li>
                    @endforelse
                </ul>
            </div>

            <div class="rounded-xl border border-gray-200 dark:border-white/10 bg-white dark:bg-gray-900 p-6 shadow-sm">
                <h3 class="mb-4 text-base font-bold text-gray-900 dark:text-white">📁 Miradi</h3>
                <dl class="space-y-2 text-sm">
                    <div class="flex justify-between"><dt class="text-gray-500">Miradi Yote</dt><dd class="font-bold text-gray-900 dark:text-white">{{ $projects['total'] }}</dd></div>
                    <div class="flex justify-between"><dt class="text-gray-500">Hai</dt><dd class="font-bold text-green-600">{{ $projects['active'] }}</dd></div>
                    <div class="flex justify-between"><dt class="text-gray-500">Bajeti Jumla</dt><dd class="font-bold text-gray-900 dark:text-white">TZS {{ number_format($projects['budget'], 0) }}</dd></div>
                    <div class="flex justify-between"><dt class="text-gray-500">Kiasi Kilichopatikana</dt><dd class="font-bold text-blue-600">TZS {{ number_format($projects['funded'], 0) }}</dd></div>
                </dl>
            </div>
        </div>

        {{-- Recent Donations Table --}}
        <div class="rounded-xl border border-gray-200 dark:border-white/10 bg-white dark:bg-gray-900 p-6 shadow-sm">
            <h3 class="mb-4 text-base font-bold text-gray-900 dark:text-white">🧾 Michango ya Hivi Karibuni</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase border-b border-gray-100 dark:border-white/10">
                            <th class="pb-2">Mfadhili</th>
                            <th class="pb-2">Kiasi</th>
                            <th class="pb-2">Njia</th>
                            <th class="pb-2">Hali</th>
                            <th class="pb-2">Tarehe</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 dark:divide-white/5">
                        @forelse($this->getRecentDonations() as $donation)
                            <tr>
                                <td class="py-2">{{ $donation->donor?->user?->name ?? 'N/A' }}</td>
                                <td class="py-2 font-bold">TZS {{ number_format($donation->amount, 0) }}</td>
                                <td class="py-2">{{ $donation->payment_method }}</td>
                                <td class="py-2">
                                    <span class="px-2 py-0.5 rounded-full text-xs font-semibold
                                        {{ $donation->status === 'Confirmed' ? 'bg-green-100 text-green-700' : ($donation->status === 'Failed' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">
                                        {{ $donation->status }}
                                    </span>
                                </td>
                                <td class="py-2 text-xs text-gray-400">{{ $donation->created_at?->format('d M Y') }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="py-6 text-center text-gray-400">Hakuna michango bado.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-filament-panels::page>
