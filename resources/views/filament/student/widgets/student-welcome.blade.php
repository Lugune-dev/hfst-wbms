<x-filament-widgets::widget>
    @php $student = auth()->user()->student; @endphp
    <div class="relative overflow-hidden rounded-2xl shadow-lg"
         style="background: linear-gradient(135deg, #13385E 0%, #1e5080 50%, #2E7D32 100%);">
        {{-- Decorative blobs --}}
        <div class="absolute -top-20 -right-20 w-64 h-64 rounded-full opacity-10" style="background: #F6B219;"></div>
        <div class="absolute -bottom-16 -left-16 w-48 h-48 rounded-full opacity-5" style="background: #F6B219;"></div>

        <div class="relative z-10 p-6 sm:p-8 text-white">
            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-5">
                {{-- Avatar --}}
                <div class="flex-shrink-0 w-16 h-16 rounded-2xl flex items-center justify-center text-3xl font-black border border-white/20"
                     style="background: rgba(255,255,255,0.12); backdrop-filter: blur(8px);">
                    {{ $student ? strtoupper(substr($student->first_name, 0, 1)) : '?' }}
                </div>
                <div class="flex-1">
                    <p class="text-sm font-medium text-white/70">Karibu tena,</p>
                    <h2 class="text-2xl sm:text-3xl font-black tracking-tight">
                        {{ $student ? $student->first_name . ' ' . $student->last_name : auth()->user()->name }}
                    </h2>
                    @if($student)
                        <p class="text-sm text-white/80 mt-1.5 flex flex-wrap gap-x-3 gap-y-1">
                            <span>🏫 {{ $student->school }}</span>
                            <span>📚 {{ $student->education_level }}</span>
                            <span class="font-semibold {{ $student->status === 'Active' ? 'text-green-300' : 'text-yellow-300' }}">● {{ $student->status }}</span>
                        </p>
                    @endif
                </div>
            </div>

            {{-- CTA buttons --}}
            <div class="mt-6 flex flex-wrap gap-3">
                <a href="/student/aid-applications/create"
                   class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl font-bold text-sm transition-all hover:scale-105 shadow-md"
                   style="background: #F6B219; color: #13385E;">
                    <x-heroicon-m-hand-raised class="w-4 h-4" />
                    Omba Msaada
                </a>
                <a href="/student/my-progress-report-page"
                   class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl font-bold text-sm border border-white/40 text-white transition hover:bg-white/10">
                    <x-heroicon-m-document-arrow-up class="w-4 h-4" />
                    Pakia Ripoti
                </a>
            </div>
        </div>
    </div>
</x-filament-widgets::widget>
