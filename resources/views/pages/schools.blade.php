@extends('layouts.app')

@section('title', (app()->getLocale() === 'sw' ? 'Shule Washirika' : 'Partner Schools') . ' — Hope for Students Tanzania')
@section('description', 'Discover our network of partner primary, secondary, and vocational schools across Tanzania where we support vulnerable children.')

@section('content')

{{-- Hero --}}
<div class="relative overflow-hidden" style="background: linear-gradient(135deg, var(--brand-blue-dark) 0%, var(--brand-blue) 55%, var(--brand-blue-light) 100%);">
    <div class="absolute inset-0" style="background: radial-gradient(ellipse at 80% 20%, rgba(246,178,25,0.15) 0%, transparent 55%), radial-gradient(ellipse at 20% 80%, rgba(46,125,50,0.2) 0%, transparent 55%);"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24 text-center text-white">
        <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider mb-4"
              style="background: rgba(246,178,25,0.2); color: var(--brand-yellow); border: 1px solid rgba(246,178,25,0.35);">
            🏫 {{ app()->getLocale() === 'sw' ? 'Mtandao wa Elimu Tanzania' : 'Tanzania Educational Network' }}
        </span>
        <h1 class="text-3xl sm:text-5xl font-black tracking-tight leading-tight">
            {{ app()->getLocale() === 'sw' ? 'Shule Zinazoshirikiana Nasi' : 'Our Partner Schools' }}
        </h1>
        <p class="mt-4 text-base sm:text-lg text-blue-100 max-w-2xl mx-auto leading-relaxed">
            {{ app()->getLocale() === 'sw' 
                ? 'Tunashirikiana kwa karibu na shule za msingi, sekondari, na vyuo vya ufundi kuhakikisha wanafunzi wenye uhitaji wanapata mazingira bora ya kujifunzia.' 
                : 'We collaborate directly with primary, secondary, and vocational institutions across Tanzania to monitor student attendance, grades, and welfare.' }}
        </p>
    </div>
</div>

{{-- Content --}}
<div class="py-16 sm:py-20" style="background: var(--surface-bg);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Stats bar --}}
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-12">
            <div class="glass-card rounded-2xl p-5 text-center" style="background: var(--surface-card); border: 1px solid var(--border-light);">
                <div class="text-2xl sm:text-3xl font-black text-blue-600">{{ $schools->count() }}</div>
                <div class="text-xs font-semibold mt-1" style="color: var(--text-muted);">{{ app()->getLocale() === 'sw' ? 'Shule Washirika' : 'Partner Schools' }}</div>
            </div>
            <div class="glass-card rounded-2xl p-5 text-center" style="background: var(--surface-card); border: 1px solid var(--border-light);">
                <div class="text-2xl sm:text-3xl font-black text-emerald-600">{{ $schools->sum('students_count') }}</div>
                <div class="text-xs font-semibold mt-1" style="color: var(--text-muted);">{{ app()->getLocale() === 'sw' ? 'Wanafunzi Wanaosaidiwa' : 'Sponsored Students' }}</div>
            </div>
            <div class="glass-card rounded-2xl p-5 text-center" style="background: var(--surface-card); border: 1px solid var(--border-light);">
                <div class="text-2xl sm:text-3xl font-black text-amber-500">4+</div>
                <div class="text-xs font-semibold mt-1" style="color: var(--text-muted);">{{ app()->getLocale() === 'sw' ? 'Ngazi za Elimu' : 'Education Levels' }}</div>
            </div>
            <div class="glass-card rounded-2xl p-5 text-center" style="background: var(--surface-card); border: 1px solid var(--border-light);">
                <div class="text-2xl sm:text-3xl font-black text-purple-600">100%</div>
                <div class="text-xs font-semibold mt-1" style="color: var(--text-muted);">{{ app()->getLocale() === 'sw' ? 'Uwazi & Ufuatiliaji' : 'Monitored Progress' }}</div>
            </div>
        </div>

        {{-- Schools Grid --}}
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-2">
            @forelse($schools as $school)
            <div class="glass-card rounded-3xl p-6 sm:p-8 flex flex-col justify-between transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl"
                 style="background: var(--surface-card); border: 1px solid var(--border-light);">
                <div>
                    <div class="flex items-start justify-between gap-4 mb-3">
                        <div>
                            <span class="inline-block px-2.5 py-0.5 rounded-full text-[11px] font-mono font-bold tracking-wider mb-2"
                                  style="background: rgba(19,56,94,0.1); color: var(--brand-blue);">
                                {{ $school->code }}
                            </span>
                            <h3 class="text-xl sm:text-2xl font-bold leading-tight" style="color: var(--text-primary);">
                                {{ $school->name }}
                            </h3>
                        </div>
                        <span class="px-3 py-1 rounded-full text-xs font-bold"
                              style="background: rgba(46,125,50,0.15); color: var(--brand-green);">
                            {{ $school->education_level }}
                        </span>
                    </div>

                    <p class="text-xs sm:text-sm mb-6 leading-relaxed" style="color: var(--text-muted);">
                        {{ $school->notes ?? 'Shule washirika inayosaidiwa na Hope for Students Tanzania.' }}
                    </p>

                    <div class="space-y-2.5 text-xs sm:text-sm py-4 border-y" style="border-color: var(--border-light); color: var(--text-primary);">
                        <div class="flex items-center gap-2">
                            <span class="text-base">📍</span>
                            <span><strong>{{ app()->getLocale() === 'sw' ? 'Eneo' : 'Location' }}:</strong> {{ $school->district ?? $school->region }}, {{ $school->region }}</span>
                        </div>
                        @if($school->contact_person)
                        <div class="flex items-center gap-2">
                            <span class="text-base">👤</span>
                            <span><strong>{{ app()->getLocale() === 'sw' ? 'Mkuu wa Shule' : 'Headteacher' }}:</strong> {{ $school->contact_person }}</span>
                        </div>
                        @endif
                        @if($school->contact_phone)
                        <div class="flex items-center gap-2">
                            <span class="text-base">📞</span>
                            <span><strong>{{ app()->getLocale() === 'sw' ? 'Mawasiliano' : 'Contact' }}:</strong> {{ $school->contact_phone }}</span>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="mt-6 pt-2 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-xs bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-300">
                            {{ $school->students_count }}
                        </div>
                        <span class="text-xs font-medium" style="color: var(--text-muted);">
                            {{ app()->getLocale() === 'sw' ? 'Wanafunzi Wanaosaidiwa' : 'Sponsored Students' }}
                        </span>
                    </div>

                    <a href="{{ route('donate') }}"
                       class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-bold text-white transition-transform hover:scale-105"
                       style="background: var(--brand-blue);">
                        <span>{{ app()->getLocale() === 'sw' ? 'Fadhili Shule Hii' : 'Support School' }} &rarr;</span>
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-2 text-center py-12" style="color: var(--text-muted);">
                {{ app()->getLocale() === 'sw' ? 'Hakuna shule zilizoorodheshwa kwa sasa.' : 'No partner schools listed at the moment.' }}
            </div>
            @endforelse
        </div>

        {{-- Bottom CTA --}}
        <div class="mt-16 rounded-3xl p-8 sm:p-12 text-center text-white relative overflow-hidden shadow-2xl"
             style="background: linear-gradient(135deg, var(--brand-blue-dark), var(--brand-green));">
            <h2 class="text-2xl sm:text-3xl font-black mb-3">
                {{ app()->getLocale() === 'sw' ? 'Je, ungependa shule yako iwe mshirika wetu?' : 'Would you like your school to partner with HFST?' }}
            </h2>
            <p class="text-sm sm:text-base text-blue-100 max-w-xl mx-auto mb-6">
                {{ app()->getLocale() === 'sw' 
                    ? 'Wasiliana na timu yetu ya TEHAMA na usimamizi wa miradi kwa maelezo zaidi ya kujiunga.' 
                    : 'Get in touch with our programs and ICT team to learn about joining our educational partnership.' }}
            </p>
            <a href="{{ route('contact') }}"
               class="inline-flex items-center gap-2 px-8 py-3.5 rounded-xl font-bold text-sm transition-all duration-300 hover:scale-105"
               style="background: var(--brand-yellow); color: var(--brand-blue);">
                {{ app()->getLocale() === 'sw' ? 'Wasiliana Nasi (Contact Us)' : 'Contact Us Today' }}
            </a>
        </div>

    </div>
</div>

@endsection
