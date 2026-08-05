<x-filament-widgets::widget>
    <div class="rounded-2xl overflow-hidden shadow-sm border border-gray-100 dark:border-white/10">
        {{-- Header --}}
        <div class="px-5 py-4 flex items-center justify-between"
             style="background: linear-gradient(135deg, #13385E, #2E7D32);">
            <div class="flex items-center gap-2.5">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center" style="background: rgba(246,178,25,0.2);">
                    <x-heroicon-o-clock class="w-5 h-5 text-yellow-300" />
                </div>
                <div>
                    <h3 class="text-base font-bold text-white">Recent System Activity</h3>
                    <p class="text-xs text-blue-200">Latest actions across the platform</p>
                </div>
            </div>
        </div>

        {{-- Body --}}
        <div class="p-4 bg-white dark:bg-gray-900">
            <div class="space-y-2">
                @forelse($this->getActivities() as $activity)
                    <div class="flex items-start gap-3 rounded-xl p-3 transition-all hover:bg-gray-50 dark:hover:bg-white/5 border border-transparent hover:border-gray-100 dark:hover:border-white/5">
                        <div class="flex-shrink-0 w-9 h-9 rounded-lg {{ $activity['bg'] }} flex items-center justify-center">
                            <x-dynamic-component :component="$activity['icon']" class="w-4 h-4 {{ $activity['color'] }}" />
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 dark:text-white truncate">{{ $activity['title'] }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $activity['sub'] }}</p>
                        </div>
                        <span class="text-xs text-gray-400 whitespace-nowrap flex-shrink-0">{{ $activity['time'] }}</span>
                    </div>
                @empty
                    <div class="text-center py-10 text-gray-400">
                        <x-heroicon-o-inbox class="w-12 h-12 mx-auto mb-3 opacity-30" />
                        <p class="text-sm font-medium">No recent activity yet.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-filament-widgets::widget>
