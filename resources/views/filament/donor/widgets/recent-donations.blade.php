<x-filament-widgets::widget>
    <div class="rounded-2xl overflow-hidden shadow-sm border border-gray-100 dark:border-white/10">
        {{-- Header --}}
        <div class="px-5 py-4 flex items-center justify-between"
             style="background: linear-gradient(135deg, #13385E, #2E7D32);">
            <div class="flex items-center gap-2.5">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center" style="background: rgba(246,178,25,0.2);">
                    <x-heroicon-o-currency-dollar class="w-5 h-5 text-yellow-300" />
                </div>
                <div>
                    <h3 class="text-base font-bold text-white">Historia ya Michango Yangu</h3>
                    <p class="text-xs text-blue-200">Michango ya hivi karibuni</p>
                </div>
            </div>
            <a href="/donor/donation-histories" class="text-xs font-bold px-3 py-1.5 rounded-lg transition-all hover:scale-105" style="background: #F6B219; color: #13385E;">
                Ona Yote →
            </a>
        </div>

        {{-- Body --}}
        <div class="p-4 bg-white dark:bg-gray-900">
            @php $donations = $this->getRecentDonations(); @endphp

            @if($donations->isEmpty())
                <div class="text-center py-10 text-gray-400">
                    <x-heroicon-o-heart class="w-12 h-12 mx-auto mb-3 opacity-30" />
                    <p class="text-sm font-medium">Bado hujatoa mchango wowote.</p>
                    <a href="/donor/make-donation-page"
                       class="mt-3 inline-flex items-center gap-1.5 px-4 py-2 rounded-lg text-sm font-bold text-white transition hover:opacity-90"
                       style="background: #2E7D32;">
                        <x-heroicon-m-plus class="w-4 h-4" /> Toa Mchango Wako wa Kwanza
                    </a>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="text-left text-xs font-bold text-gray-400 uppercase tracking-wider border-b border-gray-100 dark:border-white/10">
                                <th class="pb-2">Kiasi</th>
                                <th class="pb-2">Mradi / Mwanafunzi</th>
                                <th class="pb-2">Njia</th>
                                <th class="pb-2">Hali</th>
                                <th class="pb-2">Tarehe</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50 dark:divide-white/5">
                            @foreach($donations as $d)
                                <tr class="hover:bg-gray-50 dark:hover:bg-white/5 transition">
                                    <td class="py-3 font-bold text-gray-900 dark:text-white">
                                        TZS {{ number_format($d->amount, 0) }}
                                    </td>
                                    <td class="py-3 text-gray-600 dark:text-gray-300">
                                        {{ $d->project?->name ?? ($d->student ? $d->student->first_name . ' ' . $d->student->last_name : 'General') }}
                                    </td>
                                    <td class="py-3 text-gray-500 dark:text-gray-400">{{ $d->payment_method ?? '—' }}</td>
                                    <td class="py-3">
                                        <span class="px-2.5 py-1 rounded-full text-xs font-bold
                                            {{ $d->status === 'Confirmed' ? 'bg-green-100 text-green-700 dark:bg-green-900/40 dark:text-green-300' : ($d->status === 'Failed' ? 'bg-red-100 text-red-700 dark:bg-red-900/40 dark:text-red-300' : 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/40 dark:text-yellow-300') }}">
                                            {{ $d->status }}
                                        </span>
                                    </td>
                                    <td class="py-3 text-xs text-gray-400">{{ $d->created_at->format('d M Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</x-filament-widgets::widget>
