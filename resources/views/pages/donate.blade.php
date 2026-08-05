@extends('layouts.app')

@section('title', __('donate.title') . ' — HFST')

@section('content')

{{-- HERO --}}
<div class="page-hero">
    <div class="page-hero-inner">
        <span class="page-hero-badge">{{ __('donate.title') }}</span>
        <h1>{{ __('donate.subtitle') }}</h1>
    </div>
</div>

{{-- MAIN --}}
<div class="py-16 sm:py-24 section-light">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Central CTA --}}
        <div class="hfst-card-featured rounded-3xl overflow-hidden shadow-2xl mb-16 animate-scale-in">
            <div class="p-10 sm:p-14 text-center">
                <div class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-6 text-3xl"
                     style="background: rgba(246,178,25,0.2); border: 1px solid rgba(246,178,25,0.4);">💛</div>
                <h2 class="text-3xl sm:text-4xl font-black mb-4">{{ __('donate.heading') }}</h2>
                <p class="text-lg max-w-2xl mx-auto mb-8 leading-relaxed" style="color: rgba(255,255,255,0.85);">{{ __('donate.description') }}</p>
                <a href="/donor" class="btn-yellow text-lg">
                    {{ __('donate.cta') }}
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>
        </div>

        {{-- Why Donate --}}
        <div class="text-center mb-10">
            <span class="section-label">{{ __('donate.why_title') }}</span>
            <h2 class="section-title">{{ __('donate.why_title') }}</h2>
        </div>
        <div class="grid gap-6 sm:grid-cols-3">
            @foreach([
                ['emoji' => '📊', 'title' => __('donate.why_1_title'), 'desc' => __('donate.why_1_desc'), 'color' => 'var(--brand-blue)'],
                ['emoji' => '🎯', 'title' => __('donate.why_2_title'), 'desc' => __('donate.why_2_desc'), 'color' => 'var(--brand-green)'],
                ['emoji' => '✅', 'title' => __('donate.why_3_title'), 'desc' => __('donate.why_3_desc'), 'color' => 'var(--brand-yellow)'],
            ] as $card)
            <div class="hfst-card p-8 text-center group">
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center mx-auto mb-5 text-2xl transition-transform duration-300 group-hover:scale-110"
                     style="background: {{ $card['color'] }}15;">{{ $card['emoji'] }}</div>
                <h3 class="text-lg font-bold mb-2" style="color: {{ $card['color'] }};">{{ $card['title'] }}</h3>
                <p class="text-sm leading-relaxed" style="color: var(--text-muted);">{{ $card['desc'] }}</p>
            </div>
            @endforeach
        </div>

        {{-- Divider CTA --}}
        <div class="mt-16 text-center">
            <p class="text-lg mb-4" style="color: var(--text-muted);">Ready to make a difference?</p>
            <a href="/donor" class="btn-primary">
                {{ __('donate.cta') }}
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
        </div>
    </div>
</div>

@endsection
