<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            <div class="flex items-center gap-2">
                <x-heroicon-o-briefcase class="w-5 h-5 text-warning-500" />
                <span>Miradi ya Elimu</span>
            </div>
        </x-slot>
        <x-slot name="headerEnd">
            <a href="/staff/projects/create" class="text-xs font-semibold text-primary-600 hover:underline">+ Mradi Mpya</a>
        </x-slot>

        <div class="space-y-3">
            @forelse($this->getProjects() as $project)
                <div class="rounded-xl border border-gray-100 dark:border-white/10 p-4">
                    <div class="flex items-start justify-between gap-2">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-bold text-gray-900 dark:text-white truncate">{{ $project->name }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">
                                {{ $project->students_count }} wanafunzi · TZS {{ number_format($project->budget) }} bajeti
                            </p>
                        </div>
                        <span class="px-2 py-0.5 rounded-full text-xs font-semibold flex-shrink-0
                            {{ $project->status === 'Active' ? 'bg-green-100 text-green-700 dark:bg-green-900/40 dark:text-green-400' : 'bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-400' }}">
                            {{ $project->status }}
                        </span>
                    </div>
                    {{-- Funding progress --}}
                    @php
                        $pct = $project->budget > 0 ? min(100, ($project->current_funding / $project->budget) * 100) : 0;
                    @endphp
                    <div class="mt-2 w-full bg-gray-100 dark:bg-gray-700 rounded-full h-1.5 overflow-hidden">
                        <div class="h-1.5 rounded-full" style="width: {{ $pct }}%; background: linear-gradient(90deg, #F6B219, #2E7D32);"></div>
                    </div>
                    <p class="text-xs text-gray-400 mt-1">{{ number_format($pct, 0) }}% funded</p>
                </div>
            @empty
                <div class="text-center py-8 text-gray-400">
                    <x-heroicon-o-briefcase class="w-10 h-10 mx-auto mb-2 opacity-40" />
                    <p class="text-sm">Hakuna miradi bado.</p>
                </div>
            @endforelse
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
