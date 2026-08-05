<x-filament-widgets::widget>
    <div class="rounded-2xl overflow-hidden shadow-sm border border-gray-100 dark:border-white/10">
        {{-- Header --}}
        <div class="px-5 py-4 flex items-center justify-between"
             style="background: linear-gradient(135deg, #13385E, #1e5080);">
            <div class="flex items-center gap-2.5">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center" style="background: rgba(246,178,25,0.2);">
                    <x-heroicon-o-briefcase class="w-5 h-5 text-yellow-300" />
                </div>
                <div>
                    <h3 class="text-base font-bold text-white">Miradi ya Elimu</h3>
                    <p class="text-xs text-blue-200">Miradi inayoendelea sasa</p>
                </div>
            </div>
            <a href="/staff/projects/create" class="text-xs font-bold px-3 py-1.5 rounded-lg transition-all hover:scale-105" style="background: #F6B219; color: #13385E;">
                + Mradi Mpya
            </a>
        </div>

        {{-- Body --}}
        <div class="p-4 bg-white dark:bg-gray-900">
            <div class="space-y-3">
                @forelse($this->getProjects() as $project)
                    @php
                        $pct = $project->budget > 0 ? min(100, ($project->current_funding / $project->budget) * 100) : 0;
                    @endphp
                    <div class="rounded-xl border border-gray-100 dark:border-white/10 p-4 hover:shadow-md transition-all hover:-translate-y-0.5">
                        <div class="flex items-start justify-between gap-2 mb-3">
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-bold text-gray-900 dark:text-white truncate">{{ $project->name }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">
                                    {{ $project->students_count }} wanafunzi · TZS {{ number_format($project->budget) }} bajeti
                                </p>
                            </div>
                            <span class="px-2.5 py-1 rounded-full text-xs font-bold flex-shrink-0
                                {{ $project->status === 'Active' ? 'bg-green-100 text-green-700 dark:bg-green-900/40 dark:text-green-400' : 'bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-400' }}">
                                {{ $project->status }}
                            </span>
                        </div>
                        {{-- Funding progress --}}
                        <div class="w-full bg-gray-100 dark:bg-gray-700 rounded-full h-2 overflow-hidden">
                            <div class="h-2 rounded-full transition-all duration-1000" style="width: {{ $pct }}%; background: linear-gradient(90deg, #F6B219, #2E7D32);"></div>
                        </div>
                        <p class="text-xs text-gray-400 mt-1.5">{{ number_format($pct, 0) }}% funded · TZS {{ number_format($project->current_funding) }} / TZS {{ number_format($project->budget) }}</p>
                    </div>
                @empty
                    <div class="text-center py-10 text-gray-400">
                        <x-heroicon-o-briefcase class="w-12 h-12 mx-auto mb-3 opacity-30" />
                        <p class="text-sm font-medium">Hakuna miradi bado.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-filament-widgets::widget>
