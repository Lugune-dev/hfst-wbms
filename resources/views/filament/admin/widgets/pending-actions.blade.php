<x-filament-widgets::widget>
    <div class="rounded-2xl overflow-hidden shadow-sm border border-gray-100 dark:border-white/10">
        {{-- Header --}}
        <div class="px-5 py-4 flex items-center justify-between"
             style="background: linear-gradient(135deg, #13385E, #1e5080);">
            <div class="flex items-center gap-2.5">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center" style="background: rgba(246,178,25,0.2);">
                    <x-heroicon-o-exclamation-triangle class="w-5 h-5 text-yellow-300" />
                </div>
                <div>
                    <h3 class="text-base font-bold text-white">Pending Actions</h3>
                    <p class="text-xs text-blue-200">Items requiring your immediate attention</p>
                </div>
            </div>
        </div>

        {{-- Body --}}
        <div class="p-4 space-y-3 bg-white dark:bg-gray-900">
            @foreach($this->getPendingData() as $item)
                <a href="{{ $item['url'] }}" class="flex items-center gap-4 rounded-xl p-3 transition-all hover:shadow-md hover:-translate-y-0.5 group border border-gray-100 dark:border-white/5">
                    <div class="w-11 h-11 rounded-xl {{ $item['color'] }} flex items-center justify-center flex-shrink-0 shadow-sm">
                        <x-dynamic-component :component="$item['icon']" class="w-5 h-5 text-white" />
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-gray-800 dark:text-gray-100 group-hover:text-primary-600 transition-colors">{{ $item['label'] }}</p>
                        <p class="text-xs text-gray-400 mt-0.5">Click to view details</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-2xl font-black {{ $item['count'] > 0 ? 'text-danger-600 dark:text-danger-400' : 'text-success-600 dark:text-success-400' }}">
                            {{ $item['count'] }}
                        </span>
                        <svg class="w-4 h-4 text-gray-300 group-hover:text-primary-500 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</x-filament-widgets::widget>
