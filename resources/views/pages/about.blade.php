@extends('layouts.app')

@section('title', __('about.title') . ' — HFST')

@section('content')

{{-- HERO --}}
<div class="page-hero">
    <div class="page-hero-inner">
        <span class="page-hero-badge">{{ __('about.title') }}</span>
        <h1>{{ __('about.subtitle') }}</h1>
    </div>
</div>

{{-- MISSION --}}
<div class="py-16 sm:py-24 section-light">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div class="animate-fade-in-up">
                <span class="section-label" style="color: var(--brand-green);">Our Purpose</span>
                <h2 class="section-title mb-6">{{ __('about.mission_title') }}</h2>
                <p class="text-lg leading-relaxed mb-4" style="color: var(--text-muted);">{{ __('about.mission_p1') }}</p>
                <p class="text-lg leading-relaxed mb-8" style="color: var(--text-muted);">{{ __('about.mission_p2') }}</p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('donate') }}" class="btn-yellow">
                        {{ __('nav.donate') }}
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                    <a href="{{ route('contact') }}" class="btn-outline">{{ __('nav.contact') }}</a>
                </div>
            </div>
            <div class="relative animate-scale-in">
                <div class="rounded-3xl overflow-hidden shadow-2xl" style="height: 400px; border: 1px solid var(--border-light);">
                    <img src="{{ asset('images/hope1.jpeg') }}" alt="Students in Tanzania" class="w-full h-full object-cover">
                    <div class="absolute inset-0 rounded-3xl" style="background: linear-gradient(to top right, rgba(19,56,94,0.25), transparent);"></div>
                </div>
                <div class="absolute -top-5 -right-5 w-28 h-28 rounded-2xl -z-10 animate-float" style="background: linear-gradient(135deg, var(--brand-yellow), var(--brand-green)); opacity: 0.25;"></div>
                <div class="absolute -bottom-5 -left-5 w-20 h-20 rounded-full -z-10 animate-float" style="background: var(--brand-blue); opacity: 0.15; animation-delay: 1s;"></div>
            </div>
        </div>
    </div>
</div>

{{-- CORE VALUES --}}
<div class="py-16 sm:py-24 section-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14">
            <span class="section-label">What We Stand For</span>
            <h2 class="section-title">{{ __('about.values_title') }}</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach([
                ['icon' => '🛡️', 'color' => 'var(--brand-blue)',   'title' => __('about.integrity_title'),    'desc' => __('about.integrity_desc')],
                ['icon' => '💪', 'color' => 'var(--brand-green)',  'title' => __('about.empowerment_title'), 'desc' => __('about.empowerment_desc')],
                ['icon' => '⚡', 'color' => 'var(--brand-yellow)', 'title' => __('about.impact_title'),      'desc' => __('about.impact_desc')],
            ] as $value)
            <div class="hfst-card p-8 text-center group">
                <div class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-6 text-3xl transition-transform duration-300 group-hover:scale-110 group-hover:-rotate-3"
                     style="background: linear-gradient(135deg, {{ $value['color'] }}, {{ $value['color'] }}dd); box-shadow: 0 8px 24px {{ $value['color'] }}40;">
                    <span>{{ $value['icon'] }}</span>
                </div>
                <h3 class="text-xl font-bold mb-3" style="color: var(--text-primary);">{{ $value['title'] }}</h3>
                <p class="leading-relaxed" style="color: var(--text-muted);">{{ $value['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- CTA --}}
<div class="cta-band">
    <div class="relative z-10 max-w-3xl mx-auto text-center text-white">
        <h2 class="text-3xl sm:text-4xl font-black mb-4">{{ __('about.mission_title') }}</h2>
        <p class="text-lg text-white/85 mb-8 leading-relaxed">{{ __('about.mission_p1') }}</p>
        <a href="{{ route('donate') }}" class="btn-yellow">
            {{ __('donate.cta') }}
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </a>
    </div>
</div>

@endsection
