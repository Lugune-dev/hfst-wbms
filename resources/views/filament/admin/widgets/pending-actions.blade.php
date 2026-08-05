<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            <div class="flex items-center gap-2">
                <x-heroicon-o-exclamation-triangle class="w-5 h-5 text-warning-500" />
                <span>Pending Actions</span>
            </div>
        </x-slot>
        <x-slot name="description">Items requiring your immediate attention</x-slot>

        <div class="space-y-3">
            @foreach($this->getPendingData() as $item)
                <a href="{{ $item['url'] }}" class="flex items-center gap-4 rounded-xl border border-gray-100 dark:border-white/10 p-4 transition hover:border-primary-500 hover:shadow-sm group">
                    <div class="w-10 h-10 rounded-full {{ $item['color'] }} flex items-center justify-center flex-shrink-0">
                        <x-dynamic-component :component="$item['icon']" class="w-5 h-5 text-white" />
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-gray-800 dark:text-gray-100 group-hover:text-primary-600">{{ $item['label'] }}</p>
                    </div>
                    <span class="text-2xl font-black {{ $item['count'] > 0 ? 'text-danger-600' : 'text-success-600' }}">
                        {{ $item['count'] }}
                    </span>
                </a>
            @endforeach
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
