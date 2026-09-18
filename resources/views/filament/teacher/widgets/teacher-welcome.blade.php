<x-filament-widgets::widget>
    <div class="rounded-2xl p-6 text-white relative overflow-hidden"
         style="background: linear-gradient(135deg, #1e5080 0%, #13385E 55%, #2E7D32 100%);">
        {{-- Decorative circles --}}
        <div class="absolute -top-10 -right-10 w-48 h-48 rounded-full opacity-10" style="background: #F6B219;"></div>
        <div class="absolute -bottom-8 -left-8 w-32 h-32 rounded-full opacity-10" style="background: #F6B219;"></div>

        <div class="relative z-10 flex flex-col sm:flex-row items-start sm:items-center gap-4">
            <div class="w-16 h-16 rounded-full border-4 border-white/30 flex items-center justify-center text-2xl font-black flex-shrink-0"
                 style="background: rgba(255,255,255,0.15);">
                📘
            </div>
            <div>
                <p class="text-sm font-medium text-white/70">Karibu tena, Mwalimu</p>
                <h2 class="text-2xl font-black">{{ auth()->user()->name }}</h2>
                <p class="text-sm text-white/80 mt-1">
                    Fuatilia maendeleo ya wanafunzi na simamia taarifa zao kwa urahisi.
                </p>
            </div>

            <div class="sm:ml-auto flex flex-wrap gap-3 mt-3 sm:mt-0">
                <a href="/teacher/students/create"
                   class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg font-bold text-sm transition hover:scale-105"
                   style="background: #F6B219; color: #13385E;">
                    <x-heroicon-m-user-plus class="w-4 h-4" />
                    Ongeza Mwanafunzi
                </a>
                <a href="/teacher/students"
                   class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg font-bold text-sm border border-white/40 text-white transition hover:bg-white/10">
                    <x-heroicon-m-academic-cap class="w-4 h-4" />
                    Wanafunzi Wote
                </a>
            </div>
        </div>
    </div>
</x-filament-widgets::widget>
