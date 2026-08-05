<x-filament-widgets::widget>
    @php $data = $this->getHeroData(); @endphp
    <div class="relative overflow-hidden rounded-2xl shadow-lg"
         style="background: linear-gradient(135deg, #1b5e20 0%, #2E7D32 50%, #13385E 100%);">
        <div class="absolute -top-20 -right-20 w-64 h-64 rounded-full opacity-10" style="background: #F6B219;"></div>
        <div class="absolute -bottom-16 -left-16 w-48 h-48 rounded-full opacity-5" style="background: #F6B219;"></div>

        <div class="relative z-10 p-6 sm:p-8 text-white">
            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-5">
                <div class="flex-shrink-0 w-16 h-16 rounded-2xl flex items-center justify-center text-3xl border border-white/20"
                     style="background: rgba(255,255,255,0.12); backdrop-filter: blur(8px);">
                    🌿
                </div>
                <div class="flex-1">
                    <p class="text-sm font-medium text-white/70">Karibu kwenye Dashibodi ya Wafanyakazi</p>
                    <h2 class="text-2xl sm:text-3xl font-black tracking-tight">Staff Dashboard</h2>
                    <p class="text-sm text-white/80 mt-1">Hope for Students Tanzania — Usimamizi wa Shughuli</p>
                </div>
            </div>

            <div class="mt-6 grid grid-cols-2 lg:grid-cols-4 gap-3">
                <div class="rounded-xl p-3 border border-white/10" style="background: rgba(255,255,255,0.08);">
                    <p class="text-xs font-medium text-white/60 uppercase tracking-wider">Wanafunzi Wote</p>
                    <p class="text-lg font-black text-green-300 mt-0.5">{{ $data['total_students'] }}</p>
                </div>
                <div class="rounded-xl p-3 border border-white/10" style="background: rgba(255,255,255,0.08);">
                    <p class="text-xs font-medium text-white/60 uppercase tracking-wider">Hai</p>
                    <p class="text-lg font-black text-blue-300 mt-0.5">{{ $data['active_students'] }}</p>
                </div>
                <div class="rounded-xl p-3 border border-white/10" style="background: rgba(255,255,255,0.08);">
                    <p class="text-xs font-medium text-white/60 uppercase tracking-wider">Wahitimu</p>
                    <p class="text-lg font-black text-yellow-300 mt-0.5">{{ $data['graduated'] }}</p>
                </div>
                <div class="rounded-xl p-3 border border-white/10" style="background: rgba(255,255,255,0.08);">
                    <p class="text-xs font-medium text-white/60 uppercase tracking-wider">Maombi Yanangoja</p>
                    <p class="text-lg font-black text-orange-300 mt-0.5">{{ $data['pending_aid'] }}</p>
                </div>
            </div>
        </div>
    </div>
</x-filament-widgets::widget>
