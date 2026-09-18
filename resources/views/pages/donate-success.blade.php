@extends('layouts.app')

@section('title', (app()->getLocale() === 'sw' ? 'Mchango Umethibitishwa' : 'Donation Confirmed') . ' — Hope for Students Tanzania')

@section('content')
<div class="py-16 sm:py-24" style="background: var(--surface-bg);">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="glass-card rounded-3xl p-8 sm:p-12 shadow-2xl text-center relative overflow-hidden"
             style="background: var(--surface-card); border: 1px solid var(--border-light);">
            
            {{-- Success Icon --}}
            <div class="w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 text-4xl shadow-lg animate-bounce"
                 style="background: linear-gradient(135deg, var(--brand-green), #1b5e20); color: white;">
                ✓
            </div>

            <span class="inline-block px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider mb-2"
                  style="background: rgba(46,125,50,0.15); color: var(--brand-green);">
                {{ app()->getLocale() === 'sw' ? 'Muamala Umekamilika' : 'Transaction Completed' }}
            </span>

            <h1 class="text-3xl sm:text-4xl font-black mb-2" style="color: var(--brand-blue);">
                {{ app()->getLocale() === 'sw' ? 'Asante Sana kwa Mchango Wako!' : 'Thank You for Your Generous Support!' }}
            </h1>
            
            <p class="text-sm sm:text-base mb-8 max-w-lg mx-auto" style="color: var(--text-muted);">
                {{ app()->getLocale() === 'sw' 
                    ? 'Mchango wako umepokelewa na kumbukumbu yake imehifadhiwa kwa uaminifu. Risiti yako rasmi iko tayari hapa chini.' 
                    : 'Your donation has been confirmed and logged into our system. Your official tax-deductible receipt is ready below.' }}
            </p>

            {{-- Summary Card --}}
            <div class="rounded-2xl p-6 mb-8 text-left space-y-3" style="background: var(--surface-bg); border: 1px solid var(--border-light);">
                <div class="flex justify-between items-center pb-3 border-b" style="border-color: var(--border-light);">
                    <span class="text-xs uppercase font-bold text-gray-400">{{ app()->getLocale() === 'sw' ? 'Kiasi Kilichochangwa' : 'Total Amount' }}</span>
                    <span class="text-xl sm:text-2xl font-black text-emerald-600">TZS {{ number_format($donation->amount, 0) }}</span>
                </div>

                <div class="flex justify-between items-center text-xs sm:text-sm">
                    <span style="color: var(--text-muted);">{{ app()->getLocale() === 'sw' ? 'Namba ya Kumbukumbu' : 'Reference Number' }}:</span>
                    <span class="font-mono font-bold" style="color: var(--brand-blue);">{{ $donation->transaction_id }}</span>
                </div>

                <div class="flex justify-between items-center text-xs sm:text-sm">
                    <span style="color: var(--text-muted);">{{ app()->getLocale() === 'sw' ? 'Njia ya Malipo' : 'Payment Method' }}:</span>
                    <span class="font-semibold" style="color: var(--text-primary);">{{ $donation->payment_method }}</span>
                </div>

                <div class="flex justify-between items-center text-xs sm:text-sm">
                    <span style="color: var(--text-muted);">{{ app()->getLocale() === 'sw' ? 'Jina la Mfadhili' : 'Donor Name' }}:</span>
                    <span class="font-semibold" style="color: var(--text-primary);">{{ $donation->donor->user->name ?? 'Generous Supporter' }}</span>
                </div>

                @if($donation->project)
                <div class="flex justify-between items-center text-xs sm:text-sm">
                    <span style="color: var(--text-muted);">{{ app()->getLocale() === 'sw' ? 'Mradi Uliofadhiliwa' : 'Allocated Project' }}:</span>
                    <span class="font-semibold text-blue-600">{{ $donation->project->name }}</span>
                </div>
                @endif

                @if($donation->student)
                <div class="flex justify-between items-center text-xs sm:text-sm">
                    <span style="color: var(--text-muted);">{{ app()->getLocale() === 'sw' ? 'Mwanafunzi Uliyemfadhili' : 'Sponsored Student' }}:</span>
                    <span class="font-semibold text-emerald-600">{{ $donation->student->first_name }} {{ $donation->student->last_name }}</span>
                </div>
                @endif

                <div class="flex justify-between items-center text-xs sm:text-sm">
                    <span style="color: var(--text-muted);">{{ app()->getLocale() === 'sw' ? 'Tarehe & Saa' : 'Date & Time' }}:</span>
                    <span style="color: var(--text-primary);">{{ $donation->created_at->format('d M Y, H:i') }}</span>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="{{ route('donor.receipt', ['donation' => $donation->id, 'pdf' => 1]) }}"
                   class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-4 rounded-xl font-bold text-white transition-all duration-300 shadow-xl hover:scale-105"
                   style="background: var(--brand-blue); box-shadow: 0 6px 20px rgba(19,56,94,0.35);">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    <span>{{ app()->getLocale() === 'sw' ? 'Pakua Risiti Rasmi (PDF)' : 'Download Official PDF Receipt' }}</span>
                </a>

                <a href="{{ route('home') }}"
                   class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-4 rounded-xl font-bold transition-all duration-300 border hover:bg-gray-100 dark:hover:bg-gray-800"
                   style="border-color: var(--border-light); color: var(--text-primary);">
                    <span>{{ app()->getLocale() === 'sw' ? 'Rudi Nyumbani' : 'Return to Home' }}</span>
                </a>
            </div>

            <div class="mt-8 text-xs" style="color: var(--text-muted);">
                {{ app()->getLocale() === 'sw' 
                    ? 'Kwa maswali yoyote kuhusu mchango wako, wasiliana na Afisa TEHAMA (ICT Officer) kupitia +255613005293 au hopeforstudentsTanzania25@gmail.com' 
                    : 'For any inquiries regarding this donation, contact the ICT Officer via +255613005293 or hopeforstudentsTanzania25@gmail.com' }}
            </div>

        </div>

    </div>
</div>
@endsection
