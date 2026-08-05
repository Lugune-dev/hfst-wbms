<x-filament-widgets::widget>
    @php $student = auth()->user()->student; @endphp
    <div class="rounded-2xl p-6 text-white relative overflow-hidden"
         style="background: linear-gradient(135deg, #13385E 0%, #2E7D32 100%);">
        {{-- Decorative circles --}}
        <div class="absolute -top-10 -right-10 w-48 h-48 rounded-full opacity-10" style="background: #F6B219;"></div>
        <div class="absolute -bottom-8 -left-8 w-32 h-32 rounded-full opacity-10" style="background: #F6B219;"></div>

        <div class="relative z-10 flex flex-col sm:flex-row items-start sm:items-center gap-4">
            {{-- Avatar --}}
            <div class="w-16 h-16 rounded-full border-4 border-white/30 flex items-center justify-center text-3xl font-black flex-shrink-0"
                 style="background: rgba(255,255,255,0.15);">
                {{ $student ? strtoupper(substr($student->first_name, 0, 1)) : '?' }}
            </div>
            <div>
                <p class="text-sm font-medium text-white/70">Karibu tena,</p>
                <h2 class="text-2xl font-black">
                    {{ $student ? $student->first_name . ' ' . $student->last_name : auth()->user()->name }}
                </h2>
                @if($student)
                    <p class="text-sm text-white/80 mt-1">
                        🏫 {{ $student->school }} &nbsp;·&nbsp;
                        📚 {{ $student->education_level }} &nbsp;·&nbsp;
                        <span class="font-semibold {{ $student->status === 'Active' ? 'text-green-300' : 'text-yellow-300' }}">
                            ● {{ $student->status }}
                        </span>
                    </p>
                @endif
            </div>

            <div class="sm:ml-auto flex flex-wrap gap-3 mt-3 sm:mt-0">
                <a href="/student/aid-applications/create"
                   class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg font-bold text-sm transition hover:scale-105"
                   style="background: #F6B219; color: #13385E;">
                    <x-heroicon-m-hand-raised class="w-4 h-4" />
                    Omba Msaada
                </a>
                <a href="/student/my-progress-report-page"
                   class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg font-bold text-sm border border-white/40 text-white transition hover:bg-white/10">
                    <x-heroicon-m-document-arrow-up class="w-4 h-4" />
                    Pakia Ripoti
                </a>
            </div>
        </div>
    </div>
</x-filament-widgets::widget>
