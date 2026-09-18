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
</div>

{{-- ======================================================
     3. PILLARS OF IMPACT (NGO CORE MODULES)
====================================================== --}}
<div class="py-20 sm:py-24" style="background: var(--surface-bg);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="inline-block px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider text-blue-700 bg-blue-50 dark:bg-blue-900/30 mb-3">
                {{ app()->getLocale() === 'sw' ? 'Nguzo Zetu za Utendaji' : 'Our Strategic Pillars' }}
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                {{ app()->getLocale() === 'sw' ? 'Jinsi HFST Inavyobadilisha Elimu Tanzania' : 'How HFST Transforms Education in Tanzania' }}
            </h2>
            <p class="mt-4 text-base text-slate-600 dark:text-slate-300 leading-relaxed">
                {{ app()->getLocale() === 'sw' 
                    ? 'Tunachanganya mifumo ya kisasa ya kidijitali, usimamizi wa uwazi wa fedha, na ushirikiano wa dhati na walimu kuondoa vikwazo vya kielimu.' 
                    : 'We unite digital management, real-time financial transparency, and genuine teacher collaboration to remove barriers to education.' }}
            </p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Pillar 1 -->
            <div class="rounded-2xl p-7 flex flex-col transition-all duration-300 hover:-translate-y-2 hover:shadow-xl border border-slate-100 dark:border-white/5"
                 style="background: var(--surface-card);">
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-emerald-600 bg-emerald-50 dark:bg-emerald-900/20 mb-6">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
                <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">
                    {{ app()->getLocale() === 'sw' ? '1. Ufadhili wa Karo & Sare' : '1. Tuition & Uniform Aid' }}
                </h3>
                <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed flex-1">
                    {{ app()->getLocale() === 'sw' 
                        ? 'Kulipia ada za shule, sare rasmi, na vifaa vya darasani kwa wanafunzi wasiojiweza ili wasikose darasa hata siku moja.' 
                        : 'Covering essential tuition fees, uniforms, and learning stationery for underprivileged youth so they never miss school.' }}
                </p>
            </div>

            <!-- Pillar 2 -->
            <div class="rounded-2xl p-7 flex flex-col transition-all duration-300 hover:-translate-y-2 hover:shadow-xl border border-slate-100 dark:border-white/5"
                 style="background: var(--surface-card);">
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-blue-600 bg-blue-50 dark:bg-blue-900/20 mb-6">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                </div>
                <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">
                    {{ app()->getLocale() === 'sw' ? '2. Maabara & Vitabu' : '2. STEM Labs & Libraries' }}
                </h3>
                <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed flex-1">
                    {{ app()->getLocale() === 'sw' 
                        ? 'Kuwezesha shule washirika kujenga maabara za sayansi, kompyuta, na maktaba zilizo na vitabu vya mtaala wa NECTA.' 
                        : 'Equipping partner schools with modern science labs, computers, and comprehensive NECTA curriculum textbooks.' }}
                </p>
            </div>

            <!-- Pillar 3 -->
            <div class="rounded-2xl p-7 flex flex-col transition-all duration-300 hover:-translate-y-2 hover:shadow-xl border border-slate-100 dark:border-white/5"
                 style="background: var(--surface-card);">
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-amber-600 bg-amber-50 dark:bg-amber-900/20 mb-6">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
                <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">
                    {{ app()->getLocale() === 'sw' ? '3. Malezi & Ushauri' : '3. Mentorship & Guidance' }}
                </h3>
                <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed flex-1">
                    {{ app()->getLocale() === 'sw' 
                        ? 'Kutoa mafunzo ya kimaadili, afya ya akili, na mwongozo wa taaluma kutoka kwa walimu na wataalamu waliobobea.' 
                        : 'Providing career guidance, mental wellbeing support, and life skills mentorship from certified teachers and mentors.' }}
                </p>
            </div>

            <!-- Pillar 4 -->
            <div class="rounded-2xl p-7 flex flex-col transition-all duration-300 hover:-translate-y-2 hover:shadow-xl border border-slate-100 dark:border-white/5"
                 style="background: var(--surface-card);">
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-indigo-600 bg-indigo-50 dark:bg-indigo-900/20 mb-6">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">
                    {{ app()->getLocale() === 'sw' ? '4. Uwazi & Risiti za Kidijitali' : '4. Transparency & Receipts' }}
                </h3>
                <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed flex-1">
                    {{ app()->getLocale() === 'sw' 
                        ? 'Kila mchango unatambuliwa papo hapo na risiti rasmi ya kielektroniki inatolewa yenye rekodi ya moja kwa moja ya fedha.' 
                        : 'Every shilling donated generates an instant official receipt with real-time audit logs and student progress reports.' }}
                </p>
            </div>
        </div>
    </div>
</div>

{{-- ======================================================
     4. FEATURED EDUCATIONAL PROJECTS
====================================================== --}}
<div class="py-20 sm:py-24" style="background: var(--surface-card); border-top: 1px solid var(--border-light); border-bottom: 1px solid var(--border-light);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-14 gap-4">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-blue-600 dark:text-blue-400">
                    {{ __('projects.heading_label') }}
                </span>
                <h2 class="mt-2 text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white">
                    {{ __('projects.heading') }}
                </h2>
                <p class="text-sm text-slate-500 mt-2 max-w-xl">
                    {{ app()->getLocale() === 'sw' ? 'Miradi inayoendelea kuboresha mazingira ya shule na kutoa msaada wa moja kwa moja.' : 'Active initiatives creating lasting academic impact in public and community schools.' }}
                </p>
            </div>
            <a href="{{ route('projects') }}" 
               class="inline-flex items-center gap-1.5 text-sm font-bold text-blue-700 dark:text-blue-400 hover:underline">
                <span>{{ app()->getLocale() === 'sw' ? 'Tazama Miradi Yote' : 'View All Projects' }}</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

        <!-- Core Program Highlights / Vivutio vya Miradi (Picha Halisi za Asili) -->
        @if(!empty($highlights) && $highlights->count())
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
            @foreach($highlights as $h)
            <div class="group relative rounded-[1.5rem] overflow-hidden transition-all duration-500 hover:shadow-xl hover:-translate-y-2 flex flex-col border border-slate-200/80 dark:border-white/10"
                 style="background: var(--surface-card);">
                <div class="h-44 sm:h-52 w-full overflow-hidden relative">
                    @if($h->image_url || $h->image)
                        <img src="{{ $h->image_url ?? \Illuminate\Support\Facades\Storage::disk('public')->url($h->image) }}" 
                             alt="{{ $h->title }}" 
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                             onerror="this.onerror=null; this.src='{{ asset('images/' . ($loop->iteration == 1 ? 'hope1.jpeg' : ($loop->iteration == 2 ? 'hope.jpeg' : ($loop->iteration == 3 ? 'meet.jpeg' : 'new.jpeg')))) }}';">
                        <div class="absolute inset-0" style="background: linear-gradient(to top, rgba(0,0,0,0.5), transparent);"></div>
                    @else
                        <div class="w-full h-full flex items-center justify-center text-5xl"
                             style="background: linear-gradient(135deg, var(--brand-blue), var(--brand-green));">📚</div>
                    @endif
                </div>
                <div class="p-5 flex-1 flex flex-col text-center relative">
                    <h4 class="font-bold text-base sm:text-lg mb-2 text-slate-900 dark:text-white">{{ $h->title }}</h4>
                    <p class="text-xs sm:text-sm leading-relaxed text-slate-600 dark:text-slate-400">{{ $h->description }}</p>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        <!-- Active Educational Fundraising Projects Header -->
        <div class="flex items-center gap-2 mb-6">
            <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span>
            <span class="text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                {{ app()->getLocale() === 'sw' ? 'Michango ya Miradi Inayoendelea' : 'Active Projects Seeking Funding' }}
            </span>
        </div>

        <!-- Project Cards Grid -->
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            @forelse($featuredProjects as $project)
            <div class="group relative rounded-3xl overflow-hidden transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl flex flex-col border border-slate-200/80 dark:border-white/10"
                 style="background: var(--surface-bg);">
                
                <!-- Image Header -->
                <div class="relative h-60 w-full overflow-hidden">
                    <img src="{{ $project->thumb_url ?? 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?auto=format&fit=crop&w=800&q=80' }}"
                         alt="{{ $project->name }}"
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-slate-950/40 to-transparent"></div>

                    <div class="absolute top-4 right-4">
                        <span class="px-3 py-1 rounded-full text-xs font-bold shadow-sm flex items-center backdrop-blur-md bg-emerald-600/90 text-white">
                            <span class="w-2 h-2 rounded-full mr-2 animate-pulse bg-white"></span>
                            {{ __('projects.active') }}
                        </span>
                    </div>

                    <div class="absolute bottom-4 left-5 right-5 text-white z-10">
                        <h3 class="text-xl font-bold mb-1 leading-tight">{{ $project->name }}</h3>
                        <p class="text-xs text-slate-300 line-clamp-2">{{ Str::limit(strip_tags($project->description), 90) }}</p>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="p-6 flex-1 flex flex-col justify-between">
                    <div>
                        <!-- Progress Bar -->
                        <div class="flex justify-between items-end mb-2 text-xs font-semibold">
                            <span class="text-slate-500">{{ __('projects.progress') }}</span>
                            <span class="text-base font-black text-emerald-600">{{ $project->funding_percentage }}%</span>
                        </div>
                        <div class="w-full rounded-full h-2.5 overflow-hidden bg-slate-200 dark:bg-slate-700">
                            <div class="h-2.5 rounded-full transition-all duration-1000 ease-out"
                                 style="width: {{ min(100, $project->funding_percentage) }}%; background: linear-gradient(90deg, var(--brand-yellow), var(--brand-green));">
                            </div>
                        </div>
                        <div class="flex justify-between text-xs mt-3 font-semibold text-slate-700 dark:text-slate-300">
                            <span>TZS {{ number_format($project->current_funding) }}</span>
                            <span class="text-slate-400">Lengo: TZS {{ number_format($project->budget) }}</span>
                        </div>
                    </div>
                    
                    <a href="{{ route('donate') }}?project={{ $project->id }}" 
                       class="mt-6 w-full inline-flex items-center justify-center gap-2 px-6 py-3 text-sm font-bold transition-all duration-300 rounded-xl shadow-md hover:shadow-lg hover:-translate-y-0.5"
                       style="background: var(--brand-blue); color: white;">
                        <span>{{ __('projects.donate_btn') }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>
            @empty
                <div class="col-span-3 text-center py-12 text-slate-400">{{ __('projects.empty') }}</div>
            @endforelse
        </div>
    </div>
</div>

{{-- ======================================================
     5. STUDENT AID INTAKE CALL-TO-ACTION BANNER
====================================================== --}}
<div class="py-16 sm:py-20 bg-gradient-to-r from-emerald-800 via-teal-900 to-slate-900 text-white relative overflow-hidden">
    <div class="absolute inset-0 opacity-15 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px]"></div>
    
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-12 gap-8 items-center">
            <div class="lg:col-span-8">
                <span class="inline-block px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-emerald-500/20 text-emerald-300 border border-emerald-400/30 mb-3">
                    {{ app()->getLocale() === 'sw' ? 'Msaada wa Masomo kwa Wanafunzi' : 'Student Aid Sponsorship Intake' }}
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold leading-tight">
                    {{ app()->getLocale() === 'sw' 
                        ? 'Je, Wewe ni Mwanafunzi au Mzazi Unayehitaji Ufadhili wa Masomo?' 
                        : 'Are You a Student or Guardian in Need of Educational Support?' }}
                </h2>
                <p class="mt-4 text-base text-emerald-100 max-w-2xl leading-relaxed">
                    {{ app()->getLocale() === 'sw'
                        ? 'Hope for Students Tanzania inatoa ufadhili wa karo, vitabu na vifaa vya kujifunzia kwa wanafunzi wenye uhitaji kutoka shule za msingi, sekondari na vyuo. Tuma maombi yako moja kwa moja mtandaoni.'
                        : 'Hope for Students Tanzania offers tuition aid, textbooks, and scholastic supplies for deserving students. Submit your beneficiary application online today.' }}
                </p>
            </div>
            <div class="lg:col-span-4 flex flex-col sm:flex-row lg:flex-col gap-4">
                <a href="{{ route('apply') }}" 
                   class="inline-flex items-center justify-center gap-2 px-8 py-4 rounded-xl text-base font-extrabold transition-all duration-300 hover:scale-105 shadow-2xl bg-amber-400 text-slate-950 hover:bg-amber-300">
                    <svg class="w-5 h-5 text-slate-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    <span>{{ app()->getLocale() === 'sw' ? 'Tuma Maombi ya Msaada' : 'Apply for Student Aid' }}</span>
                </a>
                <a href="{{ route('contact') }}" 
                   class="inline-flex items-center justify-center gap-2 px-8 py-3.5 rounded-xl text-sm font-bold transition-all duration-300 bg-white/10 hover:bg-white/20 text-white border border-white/20 backdrop-blur-sm">
                    <span>{{ app()->getLocale() === 'sw' ? 'Wasiliana na Afisa wa HFST' : 'Contact HFST Officer' }}</span>
                </a>
            </div>
        </div>
    </div>
</div>

{{-- ======================================================
     6. PARTNER SCHOOLS SHOWCASE
====================================================== --}}
<div class="py-20 sm:py-24" style="background: var(--surface-bg);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-14">
            <span class="text-xs font-bold uppercase tracking-wider text-emerald-700 bg-emerald-50 dark:bg-emerald-950/30 px-3 py-1 rounded-full">
                {{ app()->getLocale() === 'sw' ? 'Mtandao wa Shule' : 'Partner Schools Network' }}
            </span>
            <h2 class="mt-3 text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white">
                {{ app()->getLocale() === 'sw' ? 'Shule Washirika Wetu' : 'Schools Supported by HFST' }}
            </h2>
            <p class="mt-3 text-sm text-slate-600 dark:text-slate-400">
                {{ app()->getLocale() === 'sw' ? 'Tunafanya kazi bega kwa bega na walimu na uongozi wa shule kufuatilia ufaulu wa wanafunzi.' : 'Collaborating closely with school administrations to track student attendance and academic excellence.' }}
            </p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($partnerSchools as $school)
            <div class="rounded-2xl p-6 flex flex-col border border-slate-100 dark:border-white/5 transition-all duration-300 hover:shadow-lg hover:-translate-y-1"
                 style="background: var(--surface-card);">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center text-blue-700 bg-blue-50 dark:bg-blue-900/30 mb-4 font-bold text-xl">
                    🏫
                </div>
                <h3 class="font-bold text-base text-slate-900 dark:text-white mb-1">
                    {{ $school->name }}
                </h3>
                <p class="text-xs text-slate-500 mb-4">
                    📍 {{ $school->region ?? 'Arusha' }} · {{ $school->district ?? 'Tanzania' }}
                </p>
                <div class="mt-auto pt-3 border-t border-slate-100 dark:border-white/5 flex items-center justify-between text-xs">
                    <span class="font-semibold text-emerald-600">
                        {{ $school->students()->where('status', 'Active')->count() }} {{ app()->getLocale() === 'sw' ? 'Wanafunzi' : 'Students' }}
                    </span>
                    <span class="text-slate-400">
                        {{ $school->level ?? 'Secondary' }}
                    </span>
                </div>
            </div>
            @empty
                <div class="col-span-4 text-center text-slate-400 py-8">No partner schools listed.</div>
            @endforelse
        </div>

        <div class="text-center mt-10">
            <a href="{{ route('schools') }}" class="inline-flex items-center gap-1.5 text-sm font-bold text-blue-600 hover:underline">
                <span>{{ app()->getLocale() === 'sw' ? 'Tazama Orodha Kamili ya Shule Washirika' : 'Explore All Partner Schools' }}</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
        </div>
    </div>
</div>

{{-- ======================================================
     7. STORIES OF HOPE & TESTIMONIALS
====================================================== --}}
<div class="py-20 sm:py-24" style="background: var(--surface-card); border-top: 1px solid var(--border-light);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-14">
            <span class="text-xs font-bold uppercase tracking-wider text-amber-600">
                {{ __('testimonials.heading') }}
            </span>
            <h2 class="mt-2 text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white">
                {{ __('testimonials.sub') }}
            </h2>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            @forelse($testimonials as $item)
            <div class="rounded-3xl p-7 flex flex-col justify-between border border-slate-100 dark:border-white/5 transition-all duration-300 hover:shadow-xl"
                 style="background: var(--surface-bg);">
                <div>
                    <!-- Star Rating -->
                    <div class="flex items-center gap-1 text-amber-400 mb-4">
                        @for($i=0; $i<5; $i++)
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        @endfor
                    </div>
                    <p class="text-sm text-slate-600 dark:text-slate-300 leading-relaxed italic mb-6">
                        "{{ $item->message }}"
                    </p>
                </div>
                <div class="flex items-center gap-3 pt-4 border-t border-slate-100 dark:border-white/5">
                    <div class="w-10 h-10 rounded-full overflow-hidden bg-slate-200 flex-shrink-0">
                        @if($item->photo)
                            <img src="{{ asset($item->photo) }}" alt="{{ $item->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center font-bold text-slate-600">
                                {{ substr($item->name, 0, 1) }}
                            </div>
                        @endif
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-slate-900 dark:text-white">{{ $item->name }}</h4>
                        <p class="text-xs text-slate-400">{{ $item->role }}</p>
                    </div>
                </div>
            </div>
            @empty
                <div class="col-span-3 text-center py-8 text-slate-400">{{ __('testimonials.empty') }}</div>
            @endforelse
        </div>
    </div>
</div>

{{-- ======================================================
     8. LATEST NEWS & IMPACT STORIES
====================================================== --}}
<div class="py-20 sm:py-24" style="background: var(--surface-bg);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-14 gap-4">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-blue-600">
                    {{ __('nav.news') }}
                </span>
                <h2 class="mt-2 text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white">
                    {{ app()->getLocale() === 'sw' ? 'Habari & Matukio ya Karibuni' : 'Latest News & Impact Updates' }}
                </h2>
            </div>
            <a href="{{ route('news') }}" class="inline-flex items-center gap-1.5 text-sm font-bold text-blue-600 hover:underline">
                <span>{{ app()->getLocale() === 'sw' ? 'Soma Makala Zote' : 'Browse All Articles' }}</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            @forelse($latestNews ?? [] as $post)
            <div class="group rounded-3xl overflow-hidden flex flex-col transition-all duration-300 hover:-translate-y-2 hover:shadow-xl border border-slate-100 dark:border-white/5" 
                 style="background: var(--surface-card);">
                <div class="h-48 overflow-hidden relative">
                    <img src="{{ $post->image_url ?? 'https://images.unsplash.com/photo-1497633762265-9d179a990aa6?auto=format&fit=crop&w=800&q=80' }}" 
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" 
                         alt="{{ $post->title }}">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent pointer-events-none"></div>
                    <div class="absolute bottom-3 left-4">
                        <span class="text-[11px] font-bold text-white px-2.5 py-1 rounded-md bg-blue-600">
                            {{ $post->category ?? 'Impact' }}
                        </span>
                    </div>
                </div>
                <div class="p-6 flex-1 flex flex-col justify-between">
                    <div>
                        <div class="text-xs text-slate-400 mb-2">
                            {{ $post->published_at ? $post->published_at->format('d M Y') : '' }}
                        </div>
                        <h3 class="text-base font-bold text-slate-900 dark:text-white mb-2 group-hover:text-blue-600 transition-colors leading-snug">
                            {{ $post->title }}
                        </h3>
                        <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed line-clamp-3">
                            {{ Str::limit(strip_tags($post->content), 120) }}
                        </p>
                    </div>
                    <div class="mt-4 pt-4 border-t border-slate-100 dark:border-white/5">
                        <span class="text-xs font-semibold text-blue-600 flex items-center gap-1 group-hover:gap-2 transition-all">
                            <span>{{ app()->getLocale() === 'sw' ? 'Soma zaidi' : 'Read more' }}</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </span>
                    </div>
                </div>
            </div>
            @empty
                <div class="col-span-3 text-center py-8 text-slate-400">{{ __('news.empty') }}</div>
            @endforelse
        </div>
    </div>
</div>

{{-- ======================================================
     9. NEWSLETTER SUBSCRIPTION
====================================================== --}}
<div class="py-16 bg-slate-900 text-white relative overflow-hidden border-t border-slate-800">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <span class="text-xs font-bold uppercase tracking-widest text-amber-400 mb-2 inline-block">
            {{ app()->getLocale() === 'sw' ? 'Jarida la HFST' : 'HFST Newsletter' }}
        </span>
        <h2 class="text-2xl sm:text-3xl font-extrabold text-white">
            {{ app()->getLocale() === 'sw' ? 'Pata Taarifa za Maendeleo ya Wanafunzi Moja kwa Moja' : 'Stay Connected with Our Student Progress Updates' }}
        </h2>
        <p class="mt-3 text-sm text-slate-400 max-w-xl mx-auto">
            {{ app()->getLocale() === 'sw' 
                ? 'Jiunge na mamia ya wafadhili wanaopokea ripoti zetu za robo mwaka kuhusu miradi ya elimu na athari zetu.' 
                : 'Join hundreds of donors who receive quarterly reports detailing our educational projects and student outcomes.' }}
        </p>

        <form action="{{ route('subscribe') }}" method="POST" class="mt-8 max-w-md mx-auto flex flex-col sm:flex-row gap-3">
            @csrf
            <input type="email" 
                   name="email" 
                   required
                   placeholder="{{ __('stats.subscribe_placeholder') }}" 
                   class="flex-1 px-4 py-3 rounded-xl text-sm bg-slate-800 border border-slate-700 text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-amber-400">
            <button type="submit" 
                    class="px-6 py-3 rounded-xl text-sm font-bold bg-amber-400 text-slate-950 hover:bg-amber-300 transition shadow-lg flex-shrink-0">
                {{ __('stats.subscribe_btn') }}
            </button>
        </form>
        <p class="text-[11px] text-slate-500 mt-3">
            {{ app()->getLocale() === 'sw' ? 'Hatutumi barua taka. Unalindwa chini ya Sheria ya Ulinzi wa Taarifa Binafsi 2022.' : 'No spam. Protected under Tanzania Personal Data Protection Act 2022.' }}
        </p>
    </div>
</div>

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
