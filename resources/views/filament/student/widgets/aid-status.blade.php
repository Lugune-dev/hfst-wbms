<x-filament-widgets::widget>
    <div class="rounded-2xl overflow-hidden shadow-sm border border-gray-100 dark:border-white/10">
        {{-- Header --}}
        <div class="px-5 py-4 flex items-center gap-2.5"
             style="background: linear-gradient(135deg, #13385E, #2E7D32);">
            <div class="w-9 h-9 rounded-xl flex items-center justify-center" style="background: rgba(246,178,25,0.2);">
                <x-heroicon-o-hand-raised class="w-5 h-5 text-yellow-300" />
            </div>
            <div>
                <h3 class="text-base font-bold text-white">Hali ya Maombi Yangu ya Msaada</h3>
                <p class="text-xs text-blue-200">Maombi yako ya hivi karibuni</p>
            </div>
            <a href="/student/aid-applications/create" class="ml-auto text-xs font-bold px-3 py-1.5 rounded-lg transition-all hover:scale-105" style="background: #F6B219; color: #13385E;">
                + Ombi Jipya
            </a>
        </div>

        {{-- Body --}}
        <div class="p-4 bg-white dark:bg-gray-900">
            @php $applications = $this->getApplications(); @endphp

            @if($applications->isEmpty())
                <div class="text-center py-10 text-gray-400">
                    <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-gray-100 dark:bg-gray-800 mb-3">
                        <x-heroicon-o-inbox class="w-7 h-7 text-gray-300 dark:text-gray-500" />
                    </div>
                    <p class="text-sm font-semibold text-gray-600 dark:text-gray-300">Bado hujatuma ombi la msaada.</p>
                    <p class="text-xs text-gray-400 dark:text-gray-500 mt-0.5 mb-4">Maombi yako yataonekana hapa baada ya kutuma.</p>
                    <a href="/student/aid-applications/create"
                       class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg text-sm font-bold text-white transition hover:opacity-90"
                       style="background: #13385E;">
                        <x-heroicon-m-plus class="w-3.5 h-3.5" /> Tuma Ombi la Kwanza
                    </a>
                </div>
            @else
                <div class="space-y-3">
                    @foreach($applications as $app)
                        <div class="flex items-center gap-4 rounded-xl border border-gray-100 dark:border-white/10 p-4 hover:shadow-md transition-all hover:-translate-y-0.5">
                            <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0
                                {{ $app->status === 'Approved' ? 'bg-green-100 dark:bg-green-900/30' : ($app->status === 'Rejected' ? 'bg-red-100 dark:bg-red-900/30' : 'bg-yellow-100 dark:bg-yellow-900/30') }}">
                                @if($app->status === 'Approved')
                                    <x-heroicon-m-check-badge class="w-5 h-5 text-green-600 dark:text-green-400" />
                                @elseif($app->status === 'Rejected')
                                    <x-heroicon-m-x-circle class="w-5 h-5 text-red-600 dark:text-red-400" />
                                @else
                                    <x-heroicon-m-clock class="w-5 h-5 text-yellow-600 dark:text-yellow-400" />
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                    {{ is_array($app->types) ? implode(', ', array_map('ucfirst', $app->types)) : $app->types }}
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Ilitumwa: {{ $app->created_at->format('d M Y') }}</p>
                                @if($app->reviewer_notes)
                                    <p class="text-xs text-blue-600 dark:text-blue-400 mt-0.5 italic truncate">"{{ $app->reviewer_notes }}"</p>
                                @endif
                            </div>
                            <span class="px-2.5 py-1 rounded-full text-xs font-bold flex-shrink-0
                                {{ $app->status === 'Approved' ? 'bg-green-100 text-green-700 dark:bg-green-900/40 dark:text-green-300' : ($app->status === 'Rejected' ? 'bg-red-100 text-red-700 dark:bg-red-900/40 dark:text-red-300' : 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/40 dark:text-yellow-300') }}">
                                {{ $app->status }}
                            </span>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-filament-widgets::widget>
