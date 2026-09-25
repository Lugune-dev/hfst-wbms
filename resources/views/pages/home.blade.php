@extends('layouts.app')

@section('title', (app()->getLocale() === 'sw' ? 'Nyumbani' : 'Home') . ' — Hope for Students Tanzania (HFST)')

@section('content')

{{-- ======================================================
     1. HERO SECTION
====================================================== --}}
<div class="relative overflow-hidden" style="background: linear-gradient(135deg, var(--brand-blue-dark) 0%, var(--brand-blue) 55%, var(--brand-blue-light) 100%);">
    <!-- Mesh gradient overlay -->
    <div class="absolute inset-0" style="background: radial-gradient(ellipse at 25% 55%, rgba(46,125,50,0.22) 0%, transparent 60%), radial-gradient(ellipse at 80% 20%, rgba(246,178,25,0.18) 0%, transparent 60%);"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 sm:py-28 lg:py-32 grid lg:grid-cols-2 gap-12 items-center">
        <div class="text-white animate-fade-in-up">
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider mb-5"
                 style="background: rgba(246,178,25,0.15); color: var(--brand-yellow); border: 1px solid rgba(246,178,25,0.35);">
                <span class="w-2 h-2 rounded-full animate-ping" style="background: var(--brand-yellow);"></span>
                <span>Hope for Students Tanzania · Arusha</span>
            </div>
            
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black leading-tight tracking-tight text-white">
                {{ __('hero.title_line1') }}<br>
                <span style="color: var(--brand-yellow);">{{ __('hero.title_line2') }}</span>
            </h1>
            
            <p class="mt-6 text-lg text-blue-100 max-w-xl leading-relaxed">
                {{ __('hero.subtitle') }}
            </p>

            <div class="mt-8 flex flex-wrap gap-4">
                <a href="{{ route('donate') }}"
                   class="inline-flex items-center gap-2 px-7 py-3.5 rounded-xl font-bold text-base transition-all duration-300 hover:scale-105 shadow-xl"
                   style="background: var(--brand-yellow); color: var(--brand-blue); box-shadow: 0 8px 24px rgba(246,178,25,0.35);">
                    <span>{{ __('hero.cta_donate') }}</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>

                <a href="{{ route('apply') }}"
                   class="inline-flex items-center gap-2 px-7 py-3.5 rounded-xl font-bold text-base transition-all duration-300 hover:scale-105"
                   style="background: rgba(46,125,50,0.85); color: #fff; border: 1px solid rgba(255,255,255,0.25); backdrop-filter: blur(8px); box-shadow: 0 8px 24px rgba(46,125,50,0.3);">
                    <span>{{ app()->getLocale() === 'sw' ? 'Omba Ufadhili wa Masomo' : 'Apply for Student Aid' }}</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </a>
            </div>

            <!-- Official NGO contact badges -->
            <div class="mt-8 pt-6 border-t border-white/10 flex flex-wrap items-center gap-6 text-xs text-blue-200">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                    <span>Kikwakwaru B, Arusha</span>
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-emerald-400" fill="currentColor" viewBox="0 0 20 20"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 4V3z"/></svg>
                    <span>+255 613 005 293 / +255 747 413 379</span>
                </div>
            </div>
        </div>

        <!-- Right: Animated Slideshow & Dynamic floating pill -->
        <div class="relative">
            <div class="relative rounded-3xl overflow-hidden shadow-2xl hero-slideshow border border-white/20"
                 style="height: 420px; background: #071526;">
                <div class="slideshow-container absolute inset-0 w-full h-full">
                    <img src="{{ asset('images/hope3.jpeg') }}" alt="Hope for Students Tanzania in Class" class="w-full h-full object-cover slide active-slide transition-opacity duration-1000">
                    <img src="{{ asset('images/hope.jpeg') }}" alt="Empowering Students" class="w-full h-full object-cover slide absolute inset-0 opacity-0 transition-opacity duration-1000">
                    <img src="{{ asset('images/hope2.jpeg') }}" alt="School Partnership" class="w-full h-full object-cover slide absolute inset-0 opacity-0 transition-opacity duration-1000">
                </div>
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-black/20 pointer-events-none"></div>

                <div class="absolute bottom-4 left-5 right-5 text-white pointer-events-none">
                    <span class="inline-block px-2.5 py-1 rounded-md text-[11px] font-bold uppercase tracking-wider bg-emerald-600 text-white mb-1.5">
                        {{ app()->getLocale() === 'sw' ? 'Elimu Bora kwa Wote' : 'Quality Education for All' }}
                    </span>
                    <p class="text-sm font-semibold text-slate-200">
                        {{ app()->getLocale() === 'sw' ? 'Kubadilisha maisha ya vijana wenye vipaji kupitia fursa za elimu nchini Tanzania.' : 'Transforming vulnerable lives into promising futures through inclusive education.' }}
                    </p>
                </div>
            </div>

            <!-- Floating stat badge -->
            <div class="absolute -bottom-5 -left-4 sm:-left-6 rounded-2xl p-4 shadow-2xl backdrop-blur-md border border-white/30"
                 style="background: rgba(255, 255, 255, 0.95);">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center text-white shadow-md" style="background: linear-gradient(135deg, var(--brand-blue), var(--brand-green));">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zm5.99 7.176A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/></svg>
                    </div>
                    <div>
                        <div class="text-2xl font-black text-slate-900 leading-none">{{ number_format($studentsCount ?? 0) }}+</div>
                        <div class="text-xs font-semibold text-slate-500 mt-1">{{ app()->getLocale() === 'sw' ? 'Wanafunzi Wanaofadhiliwa' : 'Active Beneficiaries' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ======================================================
     2. LIVE REDIS IMPACT STATS COUNTER BAR
====================================================== --}}
<div class="relative z-20 -mt-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="rounded-2xl p-6 sm:p-8 shadow-2xl border border-white/20"
         style="background: linear-gradient(135deg, rgba(255,255,255,0.98), rgba(248,250,252,0.95)); backdrop-filter: blur(12px);">
        
        <div class="flex items-center justify-between mb-4 pb-3 border-b border-slate-200/80">
            <div class="flex items-center gap-2">
                <span class="relative flex h-3 w-3">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
                </span>
                <span class="text-xs font-bold uppercase tracking-wider text-slate-600">
                    {{ app()->getLocale() === 'sw' ? 'Takwimu za Moja kwa Moja (Live Impact Metrics)' : 'Live Impact Metrics (Synced via Redis)' }}
                </span>
            </div>
            <span class="text-[11px] font-semibold text-slate-400">HFST Impact Register</span>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
            <!-- Stat 1 -->
            <div class="p-3 rounded-xl hover:bg-slate-50 transition">
                <div class="text-3xl sm:text-4xl font-black text-blue-900 leading-none">
                    {{ number_format($studentsCount ?? 0) }}+
                </div>
                <div class="text-xs sm:text-sm font-bold text-slate-700 mt-2">
                    {{ app()->getLocale() === 'sw' ? 'Wanafunzi Wanaosaidiwa' : 'Students Sponsored' }}
                </div>
                <p class="text-[11px] text-slate-400 mt-0.5">{{ app()->getLocale() === 'sw' ? 'Msingi, Sekondari & Vyuo' : 'Primary to University' }}</p>
            </div>

            <!-- Stat 2 -->
            <div class="p-3 rounded-xl hover:bg-slate-50 transition">
                <div class="text-3xl sm:text-4xl font-black text-emerald-700 leading-none">
                    {{ number_format($schoolsCount ?? 0) }}
                </div>
                <div class="text-xs sm:text-sm font-bold text-slate-700 mt-2">
                    {{ app()->getLocale() === 'sw' ? 'Shule Washirika' : 'Partner Schools' }}
                </div>
                <p class="text-[11px] text-slate-400 mt-0.5">{{ app()->getLocale() === 'sw' ? 'Arusha & Kanda ya Kaskazini' : 'Northern Zone Tanzania' }}</p>
            </div>

            <!-- Stat 3 -->
            <div class="p-3 rounded-xl hover:bg-slate-50 transition">
                <div class="text-3xl sm:text-4xl font-black text-amber-600 leading-none">
                    {{ number_format($projectsCount ?? 0) }}
                </div>
                <div class="text-xs sm:text-sm font-bold text-slate-700 mt-2">
                    {{ app()->getLocale() === 'sw' ? 'Miradi ya Elimu' : 'Active Projects' }}
                </div>
                <p class="text-[11px] text-slate-400 mt-0.5">{{ app()->getLocale() === 'sw' ? 'Maabara, Vitabu & Miundombinu' : 'Labs, Books & Solar' }}</p>
            </div>

            <!-- Stat 4 -->
            <div class="p-3 rounded-xl hover:bg-slate-50 transition">
                <div class="text-3xl sm:text-4xl font-black text-indigo-900 leading-none">
                    {{ number_format($donorsCount ?? 0) }}+
                </div>
                <div class="text-xs sm:text-sm font-bold text-slate-700 mt-2">
                    {{ app()->getLocale() === 'sw' ? 'Wafadhili Waliosajiliwa' : 'Generous Donors' }}
                </div>
                <p class="text-[11px] text-slate-400 mt-0.5">{{ app()->getLocale() === 'sw' ? 'Watu binafsi & Taasisi' : 'Individuals & Entities' }}</p>
            </div>
        </div>
</div>

{{-- ======================================================
     3. PILLARS OF IMPACT (NGO CORE MODULES)
====================================================== --}}
<section class="py-24 sm:py-28 relative overflow-hidden" style="background: var(--surface-bg);">
    <!-- Ambient mesh lighting effect in background -->
    <div class="absolute top-1/3 left-1/2 -translate-x-1/2 w-full max-w-7xl h-96 bg-gradient-to-r from-blue-500/5 via-emerald-500/5 to-amber-500/5 blur-3xl pointer-events-none rounded-full"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-3xl mx-auto mb-16 sm:mb-20">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider text-blue-700 dark:text-blue-300 bg-blue-50/90 dark:bg-blue-900/40 border border-blue-200/70 dark:border-blue-700/40 shadow-xs mb-4 backdrop-blur-sm">
                <span class="w-2 h-2 rounded-full bg-blue-600 dark:bg-blue-400 animate-pulse"></span>
                <span>{{ app()->getLocale() === 'sw' ? 'Nguzo Zetu za Utendaji' : 'Our Strategic Pillars' }}</span>
            </div>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 dark:text-white tracking-tight leading-tight">
                {{ app()->getLocale() === 'sw' ? 'Jinsi HFST Inavyobadilisha Elimu Tanzania' : 'How HFST Transforms Education in Tanzania' }}
            </h2>
            <p class="mt-4 text-base sm:text-lg text-slate-600 dark:text-slate-300 leading-relaxed font-normal">
                {{ app()->getLocale() === 'sw' 
                    ? 'Tunachanganya mifumo ya kisasa ya kidijitali, usimamizi wa uwazi wa fedha, na ushirikiano wa dhati na walimu kuondoa vikwazo vya kielimu.' 
                    : 'We unite digital management, real-time financial transparency, and genuine teacher collaboration to remove barriers to education.' }}
            </p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">
            <!-- Pillar 01 -->
            <div class="pillar-card flex flex-col justify-between group">
                <div class="pillar-watermark">01</div>
                <div>
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-emerald-600 bg-emerald-500/10 border border-emerald-500/20 shadow-xs group-hover:scale-110 group-hover:bg-emerald-600 group-hover:text-white transition-all duration-300 mb-6">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </div>
                    <div class="inline-flex items-center gap-1.5 text-[11px] font-bold uppercase tracking-wider text-emerald-600 dark:text-emerald-400 mb-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        <span>{{ app()->getLocale() === 'sw' ? 'Msaada wa Moja kwa Moja' : '100% Direct Aid' }}</span>
                    </div>
                    <h3 class="text-xl font-extrabold text-slate-900 dark:text-white mb-3 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">
                        {{ app()->getLocale() === 'sw' ? 'Ufadhili wa Karo & Sare' : 'Tuition & Uniform Aid' }}
                    </h3>
                    <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                        {{ app()->getLocale() === 'sw' 
                            ? 'Kulipia ada za shule, sare rasmi, na vifaa vya darasani kwa wanafunzi wasiojiweza ili wasikose darasa hata siku moja.' 
                            : 'Covering essential tuition fees, uniforms, and learning stationery for underprivileged youth so they never miss school.' }}
                    </p>
                </div>
                <div class="mt-8 pt-4 border-t border-slate-100 dark:border-white/5 flex items-center justify-between text-xs font-semibold text-emerald-700 dark:text-emerald-300">
                    <span>{{ app()->getLocale() === 'sw' ? 'Usaidizi wa Papo kwa Papo' : 'Zero Delay Support' }}</span>
                    <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </div>
            </div>

            <!-- Pillar 02 -->
            <div class="pillar-card flex flex-col justify-between group">
                <div class="pillar-watermark">02</div>
                <div>
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-blue-600 bg-blue-500/10 border border-blue-500/20 shadow-xs group-hover:scale-110 group-hover:bg-blue-600 group-hover:text-white transition-all duration-300 mb-6">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    </div>
                    <div class="inline-flex items-center gap-1.5 text-[11px] font-bold uppercase tracking-wider text-blue-600 dark:text-blue-400 mb-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                        <span>{{ app()->getLocale() === 'sw' ? 'Miundombinu ya Sayansi' : 'STEM & Infrastructure' }}</span>
                    </div>
                    <h3 class="text-xl font-extrabold text-slate-900 dark:text-white mb-3 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                        {{ app()->getLocale() === 'sw' ? 'Maabara & Maktaba' : 'STEM Labs & Libraries' }}
                    </h3>
                    <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                        {{ app()->getLocale() === 'sw' 
                            ? 'Kuwezesha shule washirika kujenga maabara za sayansi, kompyuta, na maktaba zilizo na vitabu vya mtaala wa NECTA.' 
                            : 'Equipping partner schools with modern science labs, computers, and comprehensive NECTA curriculum textbooks.' }}
                    </p>
                </div>
                <div class="mt-8 pt-4 border-t border-slate-100 dark:border-white/5 flex items-center justify-between text-xs font-semibold text-blue-700 dark:text-blue-300">
                    <span>{{ app()->getLocale() === 'sw' ? 'Mtaala wa NECTA' : 'NECTA Standard' }}</span>
                    <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </div>
            </div>

            <!-- Pillar 03 -->
            <div class="pillar-card flex flex-col justify-between group">
                <div class="pillar-watermark">03</div>
                <div>
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-amber-600 bg-amber-500/10 border border-amber-500/20 shadow-xs group-hover:scale-110 group-hover:bg-amber-500 group-hover:text-white transition-all duration-300 mb-6">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <div class="inline-flex items-center gap-1.5 text-[11px] font-bold uppercase tracking-wider text-amber-600 dark:text-amber-400 mb-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                        <span>{{ app()->getLocale() === 'sw' ? 'Ustawi & Maadili' : 'Wellbeing & Growth' }}</span>
                    </div>
                    <h3 class="text-xl font-extrabold text-slate-900 dark:text-white mb-3 group-hover:text-amber-600 dark:group-hover:text-amber-400 transition-colors">
                        {{ app()->getLocale() === 'sw' ? 'Malezi & Ushauri wa Kitaalamu' : 'Mentorship & Guidance' }}
                    </h3>
                    <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                        {{ app()->getLocale() === 'sw' 
                            ? 'Kutoa mafunzo ya kimaadili, afya ya akili, na mwongozo wa taaluma kutoka kwa walimu na wataalamu waliobobea.' 
                            : 'Providing career guidance, mental wellbeing support, and life skills mentorship from certified teachers and mentors.' }}
                    </p>
                </div>
                <div class="mt-8 pt-4 border-t border-slate-100 dark:border-white/5 flex items-center justify-between text-xs font-semibold text-amber-700 dark:text-amber-300">
                    <span>{{ app()->getLocale() === 'sw' ? 'Mwongozo wa Walimu' : 'Teacher-Led Mentoring' }}</span>
                    <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </div>
            </div>

            <!-- Pillar 04 -->
            <div class="pillar-card flex flex-col justify-between group">
                <div class="pillar-watermark">04</div>
                <div>
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-purple-600 bg-purple-500/10 border border-purple-500/20 shadow-xs group-hover:scale-110 group-hover:bg-purple-600 group-hover:text-white transition-all duration-300 mb-6">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <div class="inline-flex items-center gap-1.5 text-[11px] font-bold uppercase tracking-wider text-purple-600 dark:text-purple-400 mb-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-purple-500"></span>
                        <span>{{ app()->getLocale() === 'sw' ? 'Uwazi wa 100%' : '100% Transparency' }}</span>
                    </div>
                    <h3 class="text-xl font-extrabold text-slate-900 dark:text-white mb-3 group-hover:text-purple-600 dark:group-hover:text-purple-400 transition-colors">
                        {{ app()->getLocale() === 'sw' ? 'Uwazi & Risiti za Kidijitali' : 'Audited Digital Receipts' }}
                    </h3>
                    <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                        {{ app()->getLocale() === 'sw' 
                            ? 'Kila mchango unatambuliwa papo hapo na risiti rasmi ya kielektroniki inatolewa yenye rekodi ya moja kwa moja ya fedha.' 
                            : 'Every shilling donated generates an instant official receipt with real-time audit logs and student progress reports.' }}
                    </p>
                </div>
                <div class="mt-8 pt-4 border-t border-slate-100 dark:border-white/5 flex items-center justify-between text-xs font-semibold text-purple-700 dark:text-purple-300">
                    <span>{{ app()->getLocale() === 'sw' ? 'Rekodi za Moja kwa Moja' : 'Live Audit Trail' }}</span>
                    <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ======================================================
     4. FEATURED EDUCATIONAL PROJECTS & PROGRAMS
====================================================== --}}
<section class="py-24 sm:py-28 relative border-t border-slate-200/60 dark:border-white/5" style="background: var(--surface-card);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
            <div class="max-w-2xl">
                <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider text-blue-700 dark:text-blue-300 bg-blue-50 dark:bg-blue-900/30 border border-blue-200/60 dark:border-blue-700/30 mb-3">
                    <span>{{ __('projects.heading_label') }}</span>
                </div>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 dark:text-white tracking-tight leading-tight">
                    {{ __('projects.heading') }}
                </h2>
                <p class="mt-3 text-base text-slate-600 dark:text-slate-400">
                    {{ app()->getLocale() === 'sw' 
                        ? 'Mipango na miradi inayounda mazingira salama na wezeshi ya elimu bora kwa watoto na vijana.' 
                        : 'Active initiatives creating lasting academic impact and equal opportunities across Tanzanian schools.' }}
                </p>
            </div>
            <div>
                <a href="{{ route('projects') }}" 
                   class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl font-bold text-sm text-blue-700 dark:text-blue-300 bg-blue-50/80 dark:bg-blue-900/30 border border-blue-200/70 dark:border-blue-700/30 hover:bg-blue-100/80 dark:hover:bg-blue-900/50 transition-all shadow-xs group">
                    <span>{{ app()->getLocale() === 'sw' ? 'Tazama Miradi Yote' : 'View All Projects' }}</span>
                    <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>
        </div>

        <!-- Core Program Highlights (Vivutio vya Miradi na Mazingira ya Asili) -->
        @if(!empty($highlights) && $highlights->count())
        <div class="mb-20">
            <div class="flex items-center gap-2.5 mb-6">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                <h3 class="text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                    {{ app()->getLocale() === 'sw' ? 'Vivutio vya Miradi ya Jamii' : 'Core Initiative Highlights' }}
                </h3>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($highlights as $h)
                <div class="group relative rounded-3xl overflow-hidden flex flex-col border border-slate-200/80 dark:border-white/10 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500"
                     style="background: var(--surface-bg);">
                    <div class="h-48 sm:h-52 w-full overflow-hidden relative">
                        @if($h->image_url || $h->image)
                            <img src="{{ $h->thumb ?? $h->image_url ?? asset('images/' . ($loop->iteration == 1 ? 'hope1.jpeg' : ($loop->iteration == 2 ? 'hope.jpeg' : ($loop->iteration == 3 ? 'meet.jpeg' : 'new.jpeg')))) }}" 
                                 alt="{{ $h->title }}" 
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                 onerror="this.onerror=null; this.src='{{ asset('images/' . ($loop->iteration == 1 ? 'hope1.jpeg' : ($loop->iteration == 2 ? 'hope.jpeg' : ($loop->iteration == 3 ? 'meet.jpeg' : 'new.jpeg')))) }}';">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-slate-950/20 to-transparent"></div>
                        @else
                            <div class="w-full h-full flex items-center justify-center text-5xl"
                                 style="background: linear-gradient(135deg, var(--brand-blue), var(--brand-green));">📚</div>
                        @endif

                        <div class="absolute top-3.5 left-3.5">
                            <span class="px-2.5 py-1 rounded-lg text-[11px] font-bold text-white bg-slate-950/60 backdrop-blur-md border border-white/20">
                                Programu #0{{ $loop->iteration }}
                            </span>
                        </div>
                    </div>
                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div>
                            <h4 class="font-extrabold text-base sm:text-lg mb-2 text-slate-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">{{ $h->title }}</h4>
                            <p class="text-xs sm:text-sm leading-relaxed text-slate-600 dark:text-slate-400">{{ $h->description }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif


    </div>
</section>

{{-- ======================================================
     5. STUDENT AID INTAKE CALL-TO-ACTION BANNER
====================================================== --}}
<section class="py-20 sm:py-24 relative overflow-hidden" style="background: var(--surface-bg);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="rounded-[2.5rem] overflow-hidden p-8 sm:p-12 lg:p-16 relative shadow-2xl border border-emerald-500/20"
             style="background: linear-gradient(135deg, #064e3b 0%, #065f46 45%, #0f172a 100%);">
            
            <!-- Ambient lighting effect inside banner -->
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-emerald-400/20 blur-3xl rounded-full pointer-events-none"></div>
            <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-amber-400/15 blur-3xl rounded-full pointer-events-none"></div>

            <div class="relative z-10 grid lg:grid-cols-12 gap-10 lg:gap-12 items-center">
                <!-- Left Column: Copy & Micro-Process -->
                <div class="lg:col-span-8 text-white">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-emerald-500/20 text-emerald-300 border border-emerald-400/30 mb-5">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        <span>{{ app()->getLocale() === 'sw' ? 'Maombi ya Ufadhili Yamefunguliwa 2024/2025' : 'Student Aid Sponsorship Intake Open' }}</span>
                    </div>

                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight leading-tight">
                        {{ app()->getLocale() === 'sw' 
                            ? 'Je, Wewe ni Mwanafunzi au Mzazi Unayehitaji Ufadhili wa Masomo?' 
                            : 'Are You a Deserving Student or Guardian Seeking Educational Support?' }}
                    </h2>

                    <p class="mt-4 text-base sm:text-lg text-emerald-100/90 max-w-2xl leading-relaxed">
                        {{ app()->getLocale() === 'sw'
                            ? 'Hope for Students Tanzania inatoa ufadhili wa ada ya shule, vitabu na sare kwa wanafunzi wenye nia ya dhati kutoka shule za msingi, sekondari na vyuo vya ufundi nchini.'
                            : 'Hope for Students Tanzania covers official tuition, textbooks, and academic uniforms for vulnerable students across primary, secondary, and vocational schools.' }}
                    </p>

                    <!-- 3-Step Simple Roadmap Chips -->
                    <div class="mt-8 grid sm:grid-cols-3 gap-3 pt-6 border-t border-emerald-500/30">
                        <div class="flex items-center gap-2.5 bg-white/5 rounded-xl p-2.5 border border-white/10">
                            <span class="w-6 h-6 rounded-lg bg-amber-400 text-slate-950 font-black text-xs flex items-center justify-center flex-shrink-0">1</span>
                            <span class="text-xs font-semibold text-emerald-100">{{ app()->getLocale() === 'sw' ? 'Jaza Fomu Mtandaoni' : 'Apply Online' }}</span>
                        </div>
                        <div class="flex items-center gap-2.5 bg-white/5 rounded-xl p-2.5 border border-white/10">
                            <span class="w-6 h-6 rounded-lg bg-emerald-400 text-slate-950 font-black text-xs flex items-center justify-center flex-shrink-0">2</span>
                            <span class="text-xs font-semibold text-emerald-100">{{ app()->getLocale() === 'sw' ? 'Uhakiki na Shule' : 'School Verification' }}</span>
                        </div>
                        <div class="flex items-center gap-2.5 bg-white/5 rounded-xl p-2.5 border border-white/10">
                            <span class="w-6 h-6 rounded-lg bg-teal-400 text-slate-950 font-black text-xs flex items-center justify-center flex-shrink-0">3</span>
                            <span class="text-xs font-semibold text-emerald-100">{{ app()->getLocale() === 'sw' ? 'Ufadhili Rasmi' : 'Direct Aid Granted' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Glassmorphic Action Box -->
                <div class="lg:col-span-4">
                    <div class="bg-white/10 backdrop-blur-xl rounded-2xl p-6 sm:p-8 border border-white/20 shadow-2xl flex flex-col gap-4 text-center">
                        <div class="w-12 h-12 rounded-xl bg-amber-400 text-slate-950 flex items-center justify-center mx-auto shadow-md">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        
                        <h3 class="text-lg font-bold text-white">
                            {{ app()->getLocale() === 'sw' ? 'Anza Maombi Yako Sasa' : 'Start Application Online' }}
                        </h3>
                        
                        <p class="text-xs text-emerald-100/80">
                            {{ app()->getLocale() === 'sw' ? 'Mchakato ni mwepesi na hauchukui zaidi ya dakika 5 kukamilika.' : 'Simple process taking less than 5 minutes to submit.' }}
                        </p>

                        <a href="{{ route('apply') }}" 
                           class="inline-flex items-center justify-center gap-2.5 w-full px-6 py-4 rounded-xl text-base font-black transition-all duration-300 shadow-xl bg-amber-400 text-slate-950 hover:bg-amber-300 hover:scale-102">
                            <span>{{ app()->getLocale() === 'sw' ? 'Tuma Maombi ya Msaada' : 'Apply for Student Aid' }}</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>

                        <a href="{{ route('contact') }}" 
                           class="inline-flex items-center justify-center gap-2 w-full px-6 py-3 rounded-xl text-xs font-bold transition-all duration-300 bg-white/10 hover:bg-white/20 text-white border border-white/20">
                            <span>{{ app()->getLocale() === 'sw' ? 'Wasiliana na Afisa wa HFST' : 'Contact HFST Officer' }}</span>
                        </a>

                        <div class="pt-2 text-[11px] text-emerald-200/80 flex items-center justify-center gap-1.5">
                            <svg class="w-3.5 h-3.5 text-amber-300" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            <span>{{ app()->getLocale() === 'sw' ? 'Huduma hii ni bure kwa 100%' : '100% Free Service — Zero Fees' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ======================================================
{{-- ======================================================
     6. PARTNER SCHOOLS CAROUSEL (Moves Right to Left)
====================================================== --}}
@php
    $schoolsCount = $partnerSchools->count();
@endphp
<section class="py-24 sm:py-28 relative overflow-hidden" 
         style="background: var(--surface-bg);"
         x-data="{
             current: 0,
             perPage: 3,
             total: {{ $schoolsCount }},
             autoplayTimer: null,
             isHovered: false,
             touchStartX: 0,
             touchEndX: 0,

             init() {
                 this.updatePerPage();
                 window.addEventListener('resize', () => this.updatePerPage());
                 this.startAutoplay();
             },

             updatePerPage() {
                 if (window.innerWidth < 640) {
                     this.perPage = 1;
                 } else if (window.innerWidth < 1024) {
                     this.perPage = 2;
                 } else {
                     this.perPage = 3;
                 }
                 if (this.current > this.maxIndex()) {
                     this.current = this.maxIndex();
                 }
             },

             maxIndex() {
                 return Math.max(0, this.total - this.perPage);
             },

             next() {
                 if (this.current >= this.maxIndex()) {
                     this.current = 0;
                 } else {
                     this.current++;
                 }
             },

             prev() {
                 if (this.current <= 0) {
                     this.current = this.maxIndex();
                 } else {
                     this.current--;
                 }
             },

             goTo(idx) {
                 this.current = Math.min(Math.max(0, idx), this.maxIndex());
             },

             startAutoplay() {
                 this.stopAutoplay();
                 this.autoplayTimer = setInterval(() => {
                     if (!this.isHovered && this.maxIndex() > 0) {
                         this.next();
                     }
                 }, 4000);
             },

             stopAutoplay() {
                 if (this.autoplayTimer) {
                     clearInterval(this.autoplayTimer);
                 }
             },

             handleTouchStart(e) {
                 this.touchStartX = e.changedTouches[0].screenX;
             },

             handleTouchEnd(e) {
                 this.touchEndX = e.changedTouches[0].screenX;
                 if (this.touchStartX - this.touchEndX > 45) {
                     this.next();
                 } else if (this.touchEndX - this.touchStartX > 45) {
                     this.prev();
                 }
             }
         }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Section Header & Navigation Controls --}}
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
            <div class="max-w-3xl">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider text-emerald-700 dark:text-emerald-300 bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200/70 dark:border-emerald-700/30 mb-3">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span>{{ app()->getLocale() === 'sw' ? 'Mtandao wa Shule Washirika' : 'Partner Schools Network' }}</span>
                </div>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 dark:text-white tracking-tight leading-tight">
                    {{ app()->getLocale() === 'sw' ? 'Shule Zinazoshirikiana na HFST' : 'Schools Supported by HFST' }}
                </h2>
                <p class="mt-3 text-base text-slate-600 dark:text-slate-400">
                    {{ app()->getLocale() === 'sw' 
                        ? 'Tunafanya kazi bega kwa bega na walimu na uongozi wa shule kufuatilia ufaulu wa kitaaluma na ustawi wa wanafunzi.' 
                        : 'Collaborating directly with teachers and school heads to track student attendance, academic excellence, and welfare.' }}
                </p>
            </div>

            {{-- Action & Slider Controls --}}
            <div class="flex items-center gap-3">
                <a href="{{ route('schools') }}" 
                   class="hidden sm:inline-flex items-center gap-2 px-4 py-2.5 rounded-2xl font-bold text-xs text-emerald-700 dark:text-emerald-300 bg-emerald-50/80 dark:bg-emerald-900/30 border border-emerald-200/70 dark:border-emerald-700/30 hover:bg-emerald-100/80 dark:hover:bg-emerald-900/50 transition-all shadow-xs group">
                    <span>{{ app()->getLocale() === 'sw' ? 'Shule Zote' : 'Browse All' }}</span>
                    <svg class="w-3.5 h-3.5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>

                {{-- Prev / Next Carousel Arrows --}}
                <div class="flex items-center gap-2" x-show="maxIndex() > 0">
                    <button @click="prev()" 
                            aria-label="Previous School" 
                            class="w-11 h-11 rounded-2xl flex items-center justify-center bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-200 border border-slate-200/80 dark:border-white/10 hover:bg-emerald-600 hover:text-white hover:border-emerald-600 transition-all shadow-xs active:scale-95">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                    </button>
                    <button @click="next()" 
                            aria-label="Next School" 
                            class="w-11 h-11 rounded-2xl flex items-center justify-center bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-200 border border-slate-200/80 dark:border-white/10 hover:bg-emerald-600 hover:text-white hover:border-emerald-600 transition-all shadow-xs active:scale-95">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                    </button>
                </div>
            </div>
        </div>

        @if($schoolsCount > 0)
            {{-- Carousel Track (Smoothly moves from right to left) --}}
            <div class="overflow-hidden py-3 -my-3 px-1 -mx-1"
                 @mouseenter="isHovered = true"
                 @mouseleave="isHovered = false"
                 @touchstart.passive="handleTouchStart($event)"
                 @touchend.passive="handleTouchEnd($event)">
                <div class="flex transition-transform duration-700 ease-out"
                     :style="`transform: translateX(-${current * (100 / perPage)}%);`">
                    @foreach($partnerSchools as $school)
                    @php
                        $schoolImages = ['hope2.jpeg', 'meet.jpeg', 'hope.jpeg', 'new.jpeg', 'hope1.jpeg'];
                        $schoolImg = $schoolImages[$loop->index % count($schoolImages)];
                        $activeCount = $school->students_count ?? $school->students()->where('status', 'Active')->count();
                    @endphp
                    <div class="flex-shrink-0 px-3 sm:px-3.5"
                         :style="`width: ${100 / perPage}%;`">
                        <div class="rounded-3xl overflow-hidden flex flex-col justify-between border border-slate-200/80 dark:border-white/10 transition-all duration-500 hover:shadow-2xl hover:-translate-y-2 group h-full shadow-sm"
                             style="background: var(--surface-card);">
                            
                            <!-- School Banner Photo -->
                            <div class="h-44 w-full overflow-hidden relative">
                                <img src="{{ $school->image_url ?? asset('images/' . $schoolImg) }}" 
                                     alt="{{ $school->name }}" 
                                     onerror="this.onerror=null; this.src='{{ asset('images/' . $schoolImg) }}';"
                                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/85 via-slate-950/20 to-transparent"></div>
                                
                                <div class="absolute top-3.5 left-3.5">
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold text-white bg-emerald-600/90 backdrop-blur-md flex items-center gap-1 shadow-xs">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                        <span>{{ app()->getLocale() === 'sw' ? 'Mshirika Rasmi' : 'Verified Partner' }}</span>
                                    </span>
                                </div>

                                <div class="absolute top-3.5 right-3.5">
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold text-slate-900 bg-amber-400 shadow-xs">
                                        {{ $school->education_level ?? 'Secondary' }}
                                    </span>
                                </div>

                                <div class="absolute bottom-3 left-3.5 right-3.5 text-white">
                                    <p class="text-[11px] font-semibold text-slate-200 flex items-center gap-1">
                                        <span>📍</span>
                                        <span>{{ $school->region ?? 'Arusha' }} · {{ $school->district ?? 'Tanzania' }}</span>
                                    </p>
                                </div>
                            </div>

                            <!-- Card Body -->
                            <div class="p-5 sm:p-6 flex-1 flex flex-col justify-between">
                                <div>
                                    <h3 class="font-black text-base sm:text-lg text-slate-900 dark:text-white mb-2 leading-snug group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors line-clamp-1">
                                        {{ $school->name }}
                                    </h3>
                                    <p class="text-xs text-slate-500 dark:text-slate-400 line-clamp-2 leading-relaxed">
                                        {{ $school->address ?? ($school->ward ? $school->ward . ', ' . $school->district : 'Shule mshirika inayosaidia wanafunzi wa mazingira magumu.') }}
                                    </p>
                                </div>

                                <div class="mt-5 pt-4 border-t border-slate-100 dark:border-white/5 flex items-center justify-between text-xs">
                                    <div class="flex items-center gap-1.5 font-bold {{ $activeCount > 0 ? 'text-emerald-600 dark:text-emerald-400' : 'text-slate-500' }}">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/></svg>
                                        <span>{{ $activeCount }} {{ app()->getLocale() === 'sw' ? 'Wanafunzi' : 'Students' }}</span>
                                    </div>
                                    <a href="{{ route('schools') }}" class="font-bold text-emerald-600 dark:text-emerald-400 flex items-center gap-1 group-hover:gap-1.5 transition-all text-xs">
                                        <span>{{ app()->getLocale() === 'sw' ? 'Tazama' : 'View' }}</span>
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Slider Dot Indicators --}}
            <div class="flex items-center justify-center gap-2 mt-8" x-show="maxIndex() > 0">
                <template x-for="i in (maxIndex() + 1)" :key="i">
                    <button @click="goTo(i - 1)" 
                            :class="current === (i - 1) ? 'w-8 bg-emerald-600 dark:bg-emerald-400' : 'w-2.5 bg-slate-300 dark:bg-slate-700 hover:bg-emerald-500/50'"
                            class="h-2.5 rounded-full transition-all duration-300 focus:outline-none"
                            :aria-label="'Nenda ukurasa wa ' + i">
                    </button>
                </template>
            </div>
        @else
            <div class="text-center text-slate-400 py-12">No partner schools listed.</div>
        @endif

        <div class="text-center mt-10">
            <a href="{{ route('schools') }}" 
               class="inline-flex items-center gap-2 px-7 py-3.5 rounded-xl font-bold text-sm text-slate-900 dark:text-white bg-slate-100 dark:bg-white/5 border border-slate-200 dark:border-white/10 hover:bg-slate-200 dark:hover:bg-white/10 transition-all shadow-xs">
                <span>{{ app()->getLocale() === 'sw' ? 'Gundua Mtandao Kamili wa Shule Washirika' : 'Explore All Partner Schools' }}</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
        </div>
    </div>
</section>

{{-- ======================================================
     7. STORIES OF HOPE & TESTIMONIALS
====================================================== --}}
<section class="py-24 sm:py-28 relative border-t border-slate-200/60 dark:border-white/5" style="background: var(--surface-card);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider text-amber-700 dark:text-amber-300 bg-amber-50 dark:bg-amber-950/40 border border-amber-200/70 dark:border-amber-700/30 mb-3">
                <span>{{ __('testimonials.heading') }}</span>
            </div>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 dark:text-white tracking-tight leading-tight">
                {{ __('testimonials.sub') }}
            </h2>
            <p class="mt-3 text-base text-slate-600 dark:text-slate-400">
                {{ app()->getLocale() === 'sw' ? 'Ushuhuda wa kweli kutoka kwa wanafunzi, walimu na wafadhili wetu.' : 'Real accounts of life-changing educational opportunities and community trust.' }}
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            @forelse($testimonials as $item)
            <div class="pillar-card flex flex-col justify-between group">
                <div class="quote-watermark text-amber-500">“</div>
                <div>
                    <!-- Star Rating -->
                    <div class="flex items-center gap-1 text-amber-400 mb-5">
                        @for($i=0; $i<5; $i++)
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        @endfor
                        <span class="text-xs font-bold text-slate-500 ml-1.5">5.0</span>
                    </div>

                    <p class="text-sm sm:text-base text-slate-700 dark:text-slate-300 leading-relaxed italic mb-8 relative z-10">
                        "{{ $item->message }}"
                    </p>
                </div>

                <div class="flex items-center gap-3.5 pt-5 border-t border-slate-100 dark:border-white/5">
                    <div class="w-12 h-12 rounded-full overflow-hidden bg-slate-200 dark:bg-slate-700 flex-shrink-0 ring-2 ring-amber-400/40">
                        @if($item->photo)
                            <img src="{{ $item->photo_url ?? asset($item->photo) }}" alt="{{ $item->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center font-black text-slate-700 dark:text-slate-200 text-base"
                                 style="background: linear-gradient(135deg, #fef3c7, #fde68a);">
                                {{ substr($item->name, 0, 1) }}
                            </div>
                        @endif
                    </div>
                    <div>
                        <h4 class="text-sm font-extrabold text-slate-900 dark:text-white flex items-center gap-1.5">
                            <span>{{ $item->name }}</span>
                            <svg class="w-3.5 h-3.5 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        </h4>
                        <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">{{ $item->role }}</p>
                    </div>
                </div>
            </div>
            @empty
                <div class="col-span-3 text-center py-12 text-slate-400">{{ __('testimonials.empty') }}</div>
            @endforelse
        </div>
    </div>
</section>

{{-- ======================================================
     8. LATEST NEWS & FIELD IMPACT JOURNAL
====================================================== --}}
<section class="py-24 sm:py-28 relative overflow-hidden" style="background: var(--surface-bg);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- ======================================================
             NEWS & REPORTS MODERN RESPONSIVE CAROUSEL
        ====================================================== --}}
        @php
            $newsCount = !empty($latestNews) ? $latestNews->count() : 0;
        @endphp

        <div x-data="{
            current: 0,
            total: {{ $newsCount }},
            perPage: 3,
            autoplayTimer: null,
            isHovered: false,
            touchStartX: 0,
            touchEndX: 0,

            init() {
                this.updatePerPage();
                window.addEventListener('resize', () => this.updatePerPage());
                this.startAutoplay();
            },

            updatePerPage() {
                if (window.innerWidth < 640) {
                    this.perPage = 1;
                } else if (window.innerWidth < 1024) {
                    this.perPage = 2;
                } else {
                    this.perPage = 3;
                }
                if (this.current > this.maxIndex()) {
                    this.current = this.maxIndex();
                }
            },

            maxIndex() {
                return Math.max(0, this.total - this.perPage);
            },

            next() {
                if (this.current >= this.maxIndex()) {
                    this.current = 0;
                } else {
                    this.current++;
                }
            },

            prev() {
                if (this.current <= 0) {
                    this.current = this.maxIndex();
                } else {
                    this.current--;
                }
            },

            goTo(idx) {
                this.current = Math.min(Math.max(0, idx), this.maxIndex());
            },

            startAutoplay() {
                this.stopAutoplay();
                this.autoplayTimer = setInterval(() => {
                    if (!this.isHovered && this.maxIndex() > 0) {
                        this.next();
                    }
                }, 4500);
            },

            stopAutoplay() {
                if (this.autoplayTimer) {
                    clearInterval(this.autoplayTimer);
                }
            },

            handleTouchStart(e) {
                this.touchStartX = e.changedTouches[0].screenX;
            },

            handleTouchEnd(e) {
                this.touchEndX = e.changedTouches[0].screenX;
                if (this.touchStartX - this.touchEndX > 45) {
                    this.next();
                } else if (this.touchEndX - this.touchStartX > 45) {
                    this.prev();
                }
            }
        }"
        class="relative">

            {{-- Section Header & Navigation Controls --}}
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
                <div>
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider text-blue-700 dark:text-blue-300 bg-blue-50 dark:bg-blue-900/30 border border-blue-200/60 dark:border-blue-700/30 mb-3">
                        <span class="w-2 h-2 rounded-full bg-blue-600 dark:bg-blue-400 animate-pulse"></span>
                        <span>{{ __('nav.news') }}</span>
                    </div>
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 dark:text-white tracking-tight leading-tight">
                        {{ app()->getLocale() === 'sw' ? 'Habari & Ripoti za Uwazi' : 'Latest News & Impact Updates' }}
                    </h2>
                    <p class="mt-3 text-base text-slate-600 dark:text-slate-400 max-w-2xl">
                        {{ app()->getLocale() === 'sw' 
                            ? 'Fuatilia taarifa za maendeleo ya wanafunzi na ripoti za matukio yetu ya kijamii.' 
                            : 'Stay updated with field activities, student progress stories, and quarterly impact reports.' }}
                    </p>
                </div>

                {{-- Action & Slider Controls --}}
                <div class="flex items-center gap-3">
                    <a href="{{ route('news') }}" 
                       class="hidden sm:inline-flex items-center gap-2 px-4 py-2.5 rounded-2xl font-bold text-xs text-blue-700 dark:text-blue-300 bg-blue-50/80 dark:bg-blue-900/30 border border-blue-200/70 dark:border-blue-700/30 hover:bg-blue-100/80 dark:hover:bg-blue-900/50 transition-all shadow-xs group">
                        <span>{{ app()->getLocale() === 'sw' ? 'Soma Zote' : 'Browse All' }}</span>
                        <svg class="w-3.5 h-3.5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>

                    {{-- Prev / Next Carousel Arrows --}}
                    <div class="flex items-center gap-2" x-show="maxIndex() > 0">
                        <button @click="prev()" 
                                aria-label="Previous Slide" 
                                class="w-11 h-11 rounded-2xl flex items-center justify-center bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-200 border border-slate-200/80 dark:border-white/10 hover:bg-blue-600 hover:text-white hover:border-blue-600 transition-all shadow-xs active:scale-95">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                        </button>
                        <button @click="next()" 
                                aria-label="Next Slide" 
                                class="w-11 h-11 rounded-2xl flex items-center justify-center bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-200 border border-slate-200/80 dark:border-white/10 hover:bg-blue-600 hover:text-white hover:border-blue-600 transition-all shadow-xs active:scale-95">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                        </button>
                    </div>
                </div>
            </div>

            @if($newsCount > 0)
                {{-- Carousel Track (Smoothly moves from right to left) --}}
                <div class="overflow-hidden py-3 -my-3 px-1 -mx-1"
                     @mouseenter="isHovered = true"
                     @mouseleave="isHovered = false"
                     @touchstart.passive="handleTouchStart($event)"
                     @touchend.passive="handleTouchEnd($event)">
                    <div class="flex transition-transform duration-700 ease-out"
                         :style="`transform: translateX(-${current * (100 / perPage)}%);`">
                        @foreach($latestNews as $post)
                        @php
                            $badgeColor = match($post->type) {
                                'report' => 'bg-emerald-600 text-white',
                                'event'  => 'bg-amber-400 text-slate-950 font-black',
                                'blog'   => 'bg-purple-600 text-white',
                                default  => 'bg-blue-600 text-white',
                            };
                            $badgeTitle = match($post->type) {
                                'report' => app()->getLocale() === 'sw' ? 'Ripoti ya Uwazi' : 'Transparency Report',
                                'event'  => app()->getLocale() === 'sw' ? 'Tukio la Kijamii' : 'Community Event',
                                'blog'   => app()->getLocale() === 'sw' ? 'Makala ya Elimu' : 'Educational Story',
                                default  => app()->getLocale() === 'sw' ? 'Habari za HFST' : 'HFST News',
                            };
                        @endphp
                        <div class="flex-shrink-0 px-3.5"
                             :style="`width: ${100 / perPage}%;`">
                            <div class="rounded-3xl overflow-hidden flex flex-col justify-between group p-0 border border-slate-200/80 dark:border-white/10 transition-all duration-500 hover:shadow-2xl hover:-translate-y-2 h-full shadow-sm"
                                 style="background: var(--surface-card);">
                                
                                {{-- Card Media --}}
                                <div class="h-52 overflow-hidden relative">
                                    <img src="{{ $post->image_url ?? asset('images/hope1.jpeg') }}" 
                                         onerror="this.onerror=null; this.src='{{ asset('images/hope1.jpeg') }}';"
                                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" 
                                         alt="{{ $post->title }}">
                                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/85 via-slate-950/20 to-transparent"></div>
                                    
                                    {{-- Type Badge --}}
                                    <div class="absolute top-3.5 left-4">
                                        <span class="text-[11px] font-bold px-3 py-1 rounded-full shadow-xs tracking-wide {{ $badgeColor }}">
                                            {{ $badgeTitle }}
                                        </span>
                                    </div>

                                    {{-- Published Date --}}
                                    <div class="absolute bottom-3 left-4 text-xs font-semibold text-slate-200 flex items-center gap-1.5">
                                        <span>📅</span>
                                        <span>{{ $post->published_at ? $post->published_at->format('d M Y') : 'Hivi Karibuni' }}</span>
                                    </div>
                                </div>

                                {{-- Card Body --}}
                                <div class="p-6 flex-1 flex flex-col justify-between">
                                    <div>
                                        <h3 class="text-lg font-black text-slate-900 dark:text-white mb-2 leading-snug group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors line-clamp-2">
                                            <a href="{{ route('news') }}">{{ $post->title }}</a>
                                        </h3>
                                        <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 leading-relaxed line-clamp-3">
                                            {{ Str::limit(strip_tags($post->content), 130) }}
                                        </p>
                                    </div>

                                    <div class="mt-6 pt-4 border-t border-slate-100 dark:border-white/5 flex items-center justify-between">
                                        <a href="{{ route('news') }}" class="text-xs font-bold text-blue-600 dark:text-blue-400 flex items-center gap-1 group-hover:gap-2 transition-all">
                                            <span>{{ app()->getLocale() === 'sw' ? 'Soma Ripoti Kamili' : 'Read Full Report' }}</span>
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                        </a>
                                        <span class="text-[11px] font-semibold text-slate-400">HFST Media</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Interactive Pagination Dots --}}
                <div class="flex items-center justify-center gap-2 mt-8">
                    <template x-for="idx in (maxIndex() + 1)" :key="idx">
                        <button @click="goTo(idx - 1)" 
                                :class="current === (idx - 1) 
                                    ? 'w-8 bg-blue-600 dark:bg-blue-400' 
                                    : 'w-2.5 bg-slate-300 dark:bg-slate-700 hover:bg-slate-400'"
                                class="h-2.5 rounded-full transition-all duration-300"
                                :aria-label="`Slide ${idx}`">
                        </button>
                    </template>
                </div>
            @else
                {{-- Empty state fallback --}}
                <div class="text-center py-16 text-slate-400">
                    <div class="text-5xl mb-3">📢</div>
                    <p class="text-base font-bold">{{ app()->getLocale() === 'sw' ? 'Hakuna makala au ripoti zilizochapishwa kwa sasa.' : 'No published news articles or reports available.' }}</p>
                </div>
            @endif

        </div>

    </div>
</section>

{{-- ======================================================
     9. NEWSLETTER & STUDENT PROGRESS UPDATES
====================================================== --}}
<section class="py-20 sm:py-24 relative overflow-hidden" style="background: var(--surface-bg);">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="rounded-[2.5rem] overflow-hidden p-8 sm:p-12 lg:p-16 relative shadow-2xl border border-blue-500/20 text-white"
             style="background: linear-gradient(135deg, #071526 0%, #0d213a 60%, #081525 100%);">
            
            <!-- Ambient glowing orbs -->
            <div class="absolute -top-24 -right-24 w-80 h-80 bg-amber-500/10 blur-3xl rounded-full pointer-events-none"></div>
            <div class="absolute -bottom-24 -left-24 w-80 h-80 bg-blue-500/15 blur-3xl rounded-full pointer-events-none"></div>

            <div class="relative z-10 grid lg:grid-cols-12 gap-10 lg:gap-12 items-center">
                <!-- Left Column -->
                <div class="lg:col-span-7">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-amber-400/15 text-amber-300 border border-amber-400/30 mb-4">
                        <svg class="w-4 h-4 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/></svg>
                        <span>{{ app()->getLocale() === 'sw' ? 'Jarida Rasmi la HFST' : 'Official HFST Newsletter' }}</span>
                    </div>

                    <h2 class="text-3xl sm:text-4xl font-black tracking-tight leading-tight">
                        {{ app()->getLocale() === 'sw' ? 'Pata Taarifa za Maendeleo ya Wanafunzi Moja kwa Moja' : 'Stay Connected with Our Student Progress Updates' }}
                    </h2>

                    <p class="mt-4 text-sm sm:text-base text-slate-300 leading-relaxed">
                        {{ app()->getLocale() === 'sw' 
                            ? 'Jiunge na mamia ya wafadhili wanaopokea ripoti zetu za uwazi za kila robo mwaka kuhusu ufaulu wa shule na matumizi ya michango.' 
                            : 'Join hundreds of donors who receive our quarterly transparency reports detailing academic milestones and verified expenditures.' }}
                    </p>

                    <!-- Trust Bullet Points -->
                    <div class="mt-6 space-y-2.5 text-xs sm:text-sm text-slate-200">
                        <div class="flex items-center gap-2.5">
                            <span class="w-5 h-5 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-xs font-bold">✓</span>
                            <span>{{ app()->getLocale() === 'sw' ? 'Ripoti za robo mwaka za ufaulu wa wanafunzi' : 'Quarterly student academic progress audits' }}</span>
                        </div>
                        <div class="flex items-center gap-2.5">
                            <span class="w-5 h-5 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-xs font-bold">✓</span>
                            <span>{{ app()->getLocale() === 'sw' ? 'Uwazi wa 100% wa mapato na matumizi ya michango' : '100% financial transparency & audit trails' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Subscription Form Card -->
                <div class="lg:col-span-5">
                    <div class="bg-white/5 backdrop-blur-xl rounded-2xl p-6 sm:p-8 border border-white/10 shadow-2xl">
                        <form action="{{ route('subscribe') }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label for="newsletter-email" class="block text-xs font-bold text-slate-200 mb-2 uppercase tracking-wider">
                                    {{ app()->getLocale() === 'sw' ? 'Barua Pepe Yako' : 'Your Email Address' }}
                                </label>
                                <input type="email" 
                                       id="newsletter-email"
                                       name="email" 
                                       required
                                       placeholder="{{ __('stats.subscribe_placeholder') }}" 
                                       class="w-full px-4 py-3.5 rounded-xl text-sm bg-slate-900/80 border border-slate-700 text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-amber-400 transition shadow-inner">
                            </div>

                            <button type="submit" 
                                    class="w-full py-4 px-6 rounded-xl text-sm font-black bg-amber-400 text-slate-950 hover:bg-amber-300 transition-all shadow-lg hover:shadow-amber-400/20 flex items-center justify-center gap-2">
                                <span>{{ __('stats.subscribe_btn') }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </button>
                        </form>

                        <div class="mt-4 pt-4 border-t border-white/10 flex items-center gap-2 text-[11px] text-slate-400">
                            <svg class="w-4 h-4 text-emerald-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            <span>{{ app()->getLocale() === 'sw' ? 'Hatutumi barua taka. Sheria ya Ulinzi wa Taarifa Binafsi 2022.' : 'Zero spam. Protected under Tanzania Data Protection Act 2022.' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const slides = document.querySelectorAll('.hero-slideshow .slide');
    if(slides.length > 1) {
        let currentSlide = 0;
        setInterval(() => {
            slides[currentSlide].classList.remove('active-slide');
            slides[currentSlide].classList.add('opacity-0');
            currentSlide = (currentSlide + 1) % slides.length;
            slides[currentSlide].classList.remove('opacity-0');
            slides[currentSlide].classList.add('active-slide');
        }, 4000);
    }
});
</script>
@endpush
