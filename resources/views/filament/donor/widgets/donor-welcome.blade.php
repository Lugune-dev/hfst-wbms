<x-filament-widgets::widget>
    @php
        $donor = auth()->user()->donor;
        $name  = auth()->user()->name;
        $totalDonated = $donor ? \App\Models\Donation::where('donor_id', $donor->id)->where('status','Confirmed')->sum('amount') : 0;
    @endphp
    <div class="rounded-2xl p-6 text-white relative overflow-hidden"
         style="background: linear-gradient(135deg, #13385E 0%, #1e5080 60%, #2E7D32 100%);">
        <div class="absolute -top-8 -right-8 w-40 h-40 rounded-full opacity-10" style="background: #F6B219;"></div>
        <div class="absolute bottom-0 left-0 w-24 h-24 rounded-full opacity-5" style="background: #F6B219;"></div>

        <div class="relative z-10 flex flex-col sm:flex-row items-start sm:items-center gap-4">
            <div class="w-16 h-16 rounded-full border-4 border-white/30 flex items-center justify-center text-2xl font-black flex-shrink-0"
                 style="background: rgba(255,255,255,0.15);">
                💚
            </div>
            <div>
                <p class="text-sm font-medium text-white/70">Welcome back, generous supporter!</p>
                <h2 class="text-2xl font-black">{{ $name }}</h2>
                <p class="text-sm text-white/80 mt-1">
                    Your total impact: <span class="font-black text-yellow-300">TZS {{ number_format($totalDonated, 0) }}</span> donated
                </p>
            </div>

            <div class="sm:ml-auto flex flex-wrap gap-3 mt-3 sm:mt-0">
                <a href="/donor/make-donation-page"
                   class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg font-bold text-sm transition hover:scale-105"
                   style="background: #F6B219; color: #13385E;">
                    <x-heroicon-m-currency-dollar class="w-4 h-4" />
                    Toa Mchango
                </a>
                <a href="/donor/sponsored-students-page"
                   class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg font-bold text-sm border border-white/40 text-white transition hover:bg-white/10">
                    <x-heroicon-m-academic-cap class="w-4 h-4" />
                    Wanafunzi Wangu
                </a>
            </div>
        </div>
    </div>
</x-filament-widgets::widget>
