@extends('layouts.app')

@section('title', __('donate.title') . ' — HFST')

@section('content')

{{-- ======================================================
     HERO
====================================================== --}}
<div class="page-hero">
    <div class="page-hero-inner">
        <h1>{{ __('donate.title') }}</h1>
        <p>{{ __('donate.subtitle') }}</p>
    </div>
</div>

{{-- ======================================================
     MAIN CONTENT
====================================================== --}}
<div class="py-16 sm:py-24" style="background: var(--surface-bg);">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Central CTA card -->
        <div class="rounded-3xl overflow-hidden shadow-2xl mb-16"
             style="background: linear-gradient(135deg, var(--brand-blue-dark), var(--brand-blue)); border: 1px solid rgba(255,255,255,0.1);">
            <div class="p-10 sm:p-14 text-center text-white">
                <div class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-6 text-3xl"
                     style="background: rgba(246,178,25,0.2); border: 1px solid rgba(246,178,25,0.4);">
                    💛
                </div>
                <h2 class="text-3xl sm:text-4xl font-black mb-4">{{ __('donate.heading') }}</h2>
                <p class="text-lg text-blue-100 max-w-2xl mx-auto mb-8 leading-relaxed">
                    {{ __('donate.description') }}
                </p>
                <a href="/donor"
                   class="inline-flex items-center gap-2 px-8 py-4 rounded-xl font-bold text-lg transition-all duration-300 hover:scale-105"
                   style="background: var(--brand-yellow); color: var(--brand-blue); box-shadow: 0 6px 24px rgba(246,178,25,0.4);">
                    {{ __('donate.cta') }}
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Why Donate -->
        <div class="text-center mb-10">
            <h2 class="text-2xl sm:text-3xl font-extrabold" style="color: var(--text-primary);">{{ __('donate.why_title') }}</h2>
        </div>
        <div class="grid gap-6 sm:grid-cols-3">
            @foreach([
                ['emoji' => '📊', 'title' => __('donate.why_1_title'), 'desc' => __('donate.why_1_desc'), 'color' => 'var(--brand-blue)'],
                ['emoji' => '🎯', 'title' => __('donate.why_2_title'), 'desc' => __('donate.why_2_desc'), 'color' => 'var(--brand-green)'],
                ['emoji' => '✅', 'title' => __('donate.why_3_title'), 'desc' => __('donate.why_3_desc'), 'color' => 'var(--brand-yellow)'],
            ] as $card)
            <div class="glass-card rounded-2xl p-7 text-center transition-all duration-300 hover:-translate-y-2 hover:shadow-xl"
                 style="background: var(--surface-card);">
                <div class="text-4xl mb-4">{{ $card['emoji'] }}</div>
                <h3 class="text-lg font-bold mb-2" style="color: {{ $card['color'] }};">{{ $card['title'] }}</h3>
                <p class="text-sm leading-relaxed" style="color: var(--text-muted);">{{ $card['desc'] }}</p>
            </div>
            @endforeach
        </div>

        <!-- Divider CTA -->
        <div class="mt-16 text-center">
            <p class="text-lg mb-4" style="color: var(--text-muted);">
                Ready to make a difference?
            </p>
            <a href="/donor"
               class="inline-flex items-center gap-2 px-8 py-3.5 rounded-xl font-bold text-white transition-all duration-300 hover:scale-105"
               style="background: var(--brand-blue); box-shadow: 0 4px 16px rgba(19,56,94,0.35);">
                {{ __('donate.cta') }}
            </a>
        </div>

    </div>
</div>

@endsection
