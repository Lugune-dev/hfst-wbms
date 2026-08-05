<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            <div class="flex items-center gap-2">
                <x-heroicon-o-currency-dollar class="w-5 h-5 text-success-500" />
                <span>Historia ya Michango Yangu</span>
            </div>
        </x-slot>
        <x-slot name="headerEnd">
            <a href="/donor/donation-histories" class="text-xs font-semibold text-primary-600 hover:underline">Ona Yote →</a>
        </x-slot>

        @php $donations = $this->getRecentDonations(); @endphp

        @if($donations->isEmpty())
            <div class="text-center py-10 text-gray-400">
                <x-heroicon-o-heart class="w-12 h-12 mx-auto mb-3 opacity-40" />
                <p class="text-sm font-medium">Bado hujatoa mchango wowote.</p>
                <a href="/donor/make-donation-page"
                   class="mt-3 inline-flex items-center gap-1 px-4 py-2 rounded-lg text-sm font-bold text-white transition hover:opacity-90"
                   style="background: #2E7D32;">
                    <x-heroicon-m-plus class="w-4 h-4" /> Toa Mchango Wako wa Kwanza
                </a>
            </div>
        @else
            <div class="overflow-x-auto -mx-4 sm:mx-0">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider border-b border-gray-100 dark:border-white/10">
                            <th class="pb-2 pl-4 sm:pl-0">Kiasi</th>
                            <th class="pb-2">Mradi / Mwanafunzi</th>
                            <th class="pb-2">Njia</th>
                            <th class="pb-2">Hali</th>
                            <th class="pb-2">Tarehe</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 dark:divide-white/5">
                        @foreach($donations as $d)
                            <tr class="hover:bg-gray-50 dark:hover:bg-white/5 transition">
                                <td class="py-3 pl-4 sm:pl-0 font-bold text-gray-900 dark:text-white">
                                    TZS {{ number_format($d->amount, 0) }}
                                </td>
                                <td class="py-3 text-gray-600 dark:text-gray-300">
                                    {{ $d->project?->name ?? ($d->student ? $d->student->first_name . ' ' . $d->student->last_name : 'General') }}
                                </td>
                                <td class="py-3 text-gray-500 dark:text-gray-400">{{ $d->payment_method ?? '—' }}</td>
                                <td class="py-3">
                                    <span class="px-2 py-0.5 rounded-full text-xs font-semibold
                                        {{ $d->status === 'Confirmed' ? 'bg-green-100 text-green-700 dark:bg-green-900/40 dark:text-green-300' : ($d->status === 'Failed' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">
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
    </x-filament::section>
</x-filament-widgets::widget>
