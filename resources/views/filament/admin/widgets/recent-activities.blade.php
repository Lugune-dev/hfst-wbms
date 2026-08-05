<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            <div class="flex items-center gap-2">
                <x-heroicon-o-clock class="w-5 h-5 text-primary-500" />
                <span>Recent System Activity</span>
            </div>
        </x-slot>

        <div class="space-y-3">
            @forelse($this->getActivities() as $activity)
                <div class="flex items-start gap-3 rounded-lg p-3 transition hover:bg-gray-50 dark:hover:bg-white/5">
                    <div class="flex-shrink-0 w-9 h-9 rounded-full {{ $activity['bg'] }} flex items-center justify-center">
                        <x-dynamic-component :component="$activity['icon']" class="w-4 h-4 {{ $activity['color'] }}" />
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 dark:text-white truncate">{{ $activity['title'] }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $activity['sub'] }}</p>
                    </div>
                    <span class="text-xs text-gray-400 whitespace-nowrap">{{ $activity['time'] }}</span>
                </div>
            @empty
                <div class="text-center py-8 text-gray-400">
                    <x-heroicon-o-inbox class="w-10 h-10 mx-auto mb-2 opacity-50" />
                    <p>No recent activity yet.</p>
                </div>
            @endforelse
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
