@extends('layouts.app')

@section('title', (app()->getLocale() === 'sw' ? 'Chagua Lango la Kuingia' : 'Select Portal Login') . ' — Hope for Students Tanzania')

@section('content')
<div class="min-h-screen flex items-center justify-center py-16 px-4 sm:px-6 lg:px-8" style="background: var(--surface-bg);">
    <div class="max-w-5xl w-full space-y-10 glass-card p-8 sm:p-14 rounded-3xl"
         style="background: var(--surface-card); box-shadow: 0 24px 48px rgba(0,0,0,0.08); border: 1px solid var(--border-light);">
        
        <div class="text-center max-w-2xl mx-auto">
            <span class="inline-block px-3.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider mb-3"
                  style="background: rgba(19,56,94,0.1); color: var(--brand-blue);">
                HFST-WBMS Portals
            </span>
            <h2 class="text-3xl sm:text-4xl font-black" style="color: var(--brand-blue);">
                {{ app()->getLocale() === 'sw' ? 'Karibu Kwenye Mfumo wa HFST' : 'Welcome to HFST Management' }}
            </h2>
            <p class="mt-2 text-sm sm:text-base leading-relaxed" style="color: var(--text-muted);">
                {{ app()->getLocale() === 'sw' 
                    ? 'Tafadhali chagua lango (portal) linalolingana na jukumu lako kuendelea.' 
                    : 'Please choose your designated stakeholder portal to sign in securely.' }}
            </p>
        </div>
        
        {{-- Grid of 4 Public Stakeholder Portals (Admin is private/restricted to /admin/login) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            {{-- 1. Student / Beneficiary Portal --}}
            <a href="/student/login" class="flex flex-col justify-between p-8 rounded-3xl transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl group border"
               style="background: var(--surface-bg); border-color: var(--border-light);">
                <div>
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center mb-4 transition-transform group-hover:scale-110 shadow-sm"
                         style="background: rgba(147,51,234,0.15); color: #9333ea;">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
                    </div>
                    <span class="inline-block px-2.5 py-0.5 rounded-full text-[11px] font-bold uppercase tracking-wider mb-1"
                          style="background: rgba(147,51,234,0.12); color: #9333ea;">
                        {{ app()->getLocale() === 'sw' ? 'Wanafunzi & Wanufaika' : 'Beneficiaries' }}
                    </span>
                    <h3 class="text-xl font-black mt-1" style="color: var(--text-primary);">Student Portal</h3>
                    <p class="text-xs sm:text-sm mt-2 leading-relaxed" style="color: var(--text-muted);">
                        {{ app()->getLocale() === 'sw'
                            ? 'Fuatilia hali ya ada zilizolipwa, wasilisha maombi mapya ya msaada (sare, vitabu, n.k.), na ripoti za matokeo.'
                            : 'Track sponsored fees status, submit new scholastic aid requests (books, uniforms), and view academic reports.' }}
                    </p>
                </div>
                <div class="mt-6 pt-4 border-t flex items-center justify-between text-xs font-bold" style="border-color: var(--border-light);">
                    <span class="text-purple-600 dark:text-purple-400 group-hover:translate-x-1 transition-transform flex items-center gap-1.5">
                        {{ app()->getLocale() === 'sw' ? 'Ingia Kama Mwanafunzi' : 'Sign In as Student' }} &rarr;
                    </span>
                    <span class="text-[11px] px-2 py-0.5 rounded-md bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300">Live Access</span>
                </div>
            </a>

            {{-- 2. Donor Portal --}}
            <a href="/donor/login" class="flex flex-col justify-between p-8 rounded-3xl transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl group border"
               style="background: var(--surface-bg); border-color: var(--border-light);">
                <div>
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center mb-4 transition-transform group-hover:scale-110 shadow-sm"
                         style="background: rgba(246,178,25,0.18); color: var(--brand-yellow);">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    </div>
                    <span class="inline-block px-2.5 py-0.5 rounded-full text-[11px] font-bold uppercase tracking-wider mb-1"
                          style="background: rgba(246,178,25,0.15); color: #b45309;">
                        {{ app()->getLocale() === 'sw' ? 'Wafadhili & Washirika' : 'Partners & Donors' }}
                    </span>
                    <h3 class="text-xl font-black mt-1" style="color: var(--text-primary);">Donor Portal</h3>
                    <p class="text-xs sm:text-sm mt-2 leading-relaxed" style="color: var(--text-muted);">
                        {{ app()->getLocale() === 'sw'
                            ? 'Ona orodha ya wanafunzi unaowafadhili, pakua risiti rasmi za PDF zenye mhuri, na pima athari za michango yako.'
                            : 'View sponsored students, download verified stamp-signed PDF receipts, and track educational impact.' }}
                    </p>
                </div>
                <div class="mt-6 pt-4 border-t flex items-center justify-between text-xs font-bold" style="border-color: var(--border-light);">
                    <span class="text-amber-600 dark:text-amber-400 group-hover:translate-x-1 transition-transform flex items-center gap-1.5">
                        {{ app()->getLocale() === 'sw' ? 'Ingia Kama Mfadhili' : 'Sign In as Donor' }} &rarr;
                    </span>
                    <span class="text-[11px] px-2 py-0.5 rounded-md bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-300">Audited</span>
                </div>
            </a>

            {{-- 3. Teacher Portal (Multi-School Tenancy) --}}
            <a href="/teacher/login" class="flex flex-col justify-between p-8 rounded-3xl transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl group border"
               style="background: var(--surface-bg); border-color: var(--border-light);">
                <div>
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center mb-4 transition-transform group-hover:scale-110 shadow-sm"
                         style="background: rgba(30,80,128,0.15); color: #1e5080;">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    </div>
                    <span class="inline-block px-2.5 py-0.5 rounded-full text-[11px] font-bold uppercase tracking-wider mb-1"
                          style="background: rgba(30,80,128,0.12); color: #1e5080;">
                        {{ app()->getLocale() === 'sw' ? 'Walimu & Shule Washirika' : 'Teachers & Coordinators' }}
                    </span>
                    <h3 class="text-xl font-black mt-1" style="color: var(--text-primary);">Teacher Portal</h3>
                    <p class="text-xs sm:text-sm mt-2 leading-relaxed" style="color: var(--text-muted);">
                        {{ app()->getLocale() === 'sw'
                            ? 'Fikia shule yako iliyosajiliwa, thibitisha mahudhurio ya wanafunzi, na wasilisha ripoti za kitaaluma.'
                            : 'Access assigned school tenant, record student attendance, and submit verified academic progress.' }}
                    </p>
                </div>
                <div class="mt-6 pt-4 border-t flex items-center justify-between text-xs font-bold" style="border-color: var(--border-light);">
                    <span class="text-cyan-700 dark:text-cyan-400 group-hover:translate-x-1 transition-transform flex items-center gap-1.5">
                        {{ app()->getLocale() === 'sw' ? 'Ingia Kama Mwalimu' : 'Sign In as Teacher' }} &rarr;
                    </span>
                    <span class="text-[11px] px-2 py-0.5 rounded-md bg-cyan-100 dark:bg-cyan-900/30 text-cyan-700 dark:text-cyan-300">Multi-Tenant</span>
                </div>
            </a>

            {{-- 4. Staff Portal --}}
            <a href="/staff/login" class="flex flex-col justify-between p-8 rounded-3xl transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl group border"
               style="background: var(--surface-bg); border-color: var(--border-light);">
                <div>
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center mb-4 transition-transform group-hover:scale-110 shadow-sm"
                         style="background: rgba(46,125,50,0.15); color: var(--brand-green);">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                    <span class="inline-block px-2.5 py-0.5 rounded-full text-[11px] font-bold uppercase tracking-wider mb-1"
                          style="background: rgba(46,125,50,0.12); color: var(--brand-green);">
                        {{ app()->getLocale() === 'sw' ? 'Wafanyakazi wa HFST' : 'Operations & Staff' }}
                    </span>
                    <h3 class="text-xl font-black mt-1" style="color: var(--text-primary);">Staff Portal</h3>
                    <p class="text-xs sm:text-sm mt-2 leading-relaxed" style="color: var(--text-muted);">
                        {{ app()->getLocale() === 'sw'
                            ? 'Simamia wanafunzi, kagua maombi ya misaada, na fuatilia miradi ya kijamii na elimu maeneo mbalimbali.'
                            : 'Manage beneficiaries, review incoming aid applications, and oversee field educational projects.' }}
                    </p>
                </div>
                <div class="mt-6 pt-4 border-t flex items-center justify-between text-xs font-bold" style="border-color: var(--border-light);">
                    <span class="text-emerald-700 dark:text-emerald-400 group-hover:translate-x-1 transition-transform flex items-center gap-1.5">
                        {{ app()->getLocale() === 'sw' ? 'Ingia Kama Mfanyakazi' : 'Sign In as Staff' }} &rarr;
                    </span>
                    <span class="text-[11px] px-2 py-0.5 rounded-md bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300">Staff Ops</span>
                </div>
            </a>
        </div>

        {{-- Back link --}}
        <div class="text-center mt-8 animate-fade-in" style="animation-delay: 0.3s;">
            <a href="{{ route('home') }}" class="text-sm font-semibold hover:underline" style="color: var(--brand-blue);">&larr; Back to Home</a>
        </div>

        {{-- Footer quick links --}}
        <div class="pt-6 border-t flex flex-col sm:flex-row justify-between items-center gap-4 text-xs" style="border-color: var(--border-light); color: var(--text-muted);">
            <div>
                {{ app()->getLocale() === 'sw' ? 'Wewe ni mfadhili mpya?' : 'Are you a new supporter?' }}
                <a href="{{ route('donor.register') }}" class="font-bold underline ml-1" style="color: var(--brand-green);">
                    {{ app()->getLocale() === 'sw' ? 'Jisajili Kama Mfadhili (Register Here)' : 'Register as Donor' }} &rarr;
                </a>
            </div>
            <div>
                {{ app()->getLocale() === 'sw' ? 'Unahitaji msaada wa masomo?' : 'In need of scholarship support?' }}
                <a href="{{ route('apply') }}" class="font-bold underline ml-1" style="color: var(--brand-blue);">
                    {{ app()->getLocale() === 'sw' ? 'Tuma Maombi Hapa (Apply for Aid)' : 'Submit Aid Application' }} &rarr;
                </a>
            </div>
        </div>

    </div>
</div>

@endsection
