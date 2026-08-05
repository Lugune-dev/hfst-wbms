@extends('layouts.app')

@section('title', __('about.title') . ' — HFST')

@section('content')

<div class="page-hero">
    <div class="page-hero-inner">
        <h1>{{ __('about.title') }}</h1>
        <p>{{ __('about.subtitle') }}</p>
    </div>
</div>

<div class="py-16 sm:py-24" style="background: var(--surface-bg);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Mission -->
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div>
                <span class="text-xs font-bold uppercase tracking-widest" style="color: var(--brand-green);">Our Purpose</span>
                <h2 class="mt-3 text-3xl sm:text-4xl font-extrabold tracking-tight" style="color: var(--text-primary);">
                    {{ __('about.mission_title') }}
                </h2>
                <p class="mt-4 text-lg leading-relaxed" style="color: var(--text-muted);">
                    {{ __('about.mission_p1') }}
                </p>
                <p class="mt-4 text-lg leading-relaxed" style="color: var(--text-muted);">
                    {{ __('about.mission_p2') }}
                </p>
                <div class="mt-8 flex gap-4">
                    <a href="{{ route('donate') }}"
                       class="inline-flex items-center px-6 py-3 rounded-xl font-bold text-white transition-all hover:scale-105"
                       style="background: var(--brand-blue); box-shadow: 0 4px 14px rgba(19,56,94,0.35);">
                        {{ __('nav.donate') }}
                    </a>
                    <a href="{{ route('contact') }}"
                       class="inline-flex items-center px-6 py-3 rounded-xl font-bold transition-all hover:scale-105"
                       style="border: 1.5px solid var(--brand-blue); color: var(--brand-blue);">
                        {{ __('nav.contact') }}
                    </a>
                </div>
            </div>
            <div class="relative">
                <div class="rounded-3xl overflow-hidden shadow-2xl" style="height: 380px; border: 1px solid var(--border-light);">
                    <img src="{{ assets('images/') }}"
                         alt="Students in Tanzania"
                         class="w-full h-full object-cover">
                    <div class="absolute inset-0 rounded-3xl" style="background: linear-gradient(to top right, rgba(19,56,94,0.3), transparent);"></div>
                </div>
                <!-- Accent -->
                <div class="absolute -top-4 -right-4 w-24 h-24 rounded-2xl -z-10"
                     style="background: linear-gradient(135deg, var(--brand-yellow), var(--brand-green)); opacity: 0.3;"></div>
            </div>
        </div>

        <!-- Core Values -->
        <div class="mt-24">
            <div class="text-center mb-12">
                <span class="text-xs font-bold uppercase tracking-widest" style="color: var(--brand-blue);">What We Stand For</span>
                <h2 class="mt-2 text-3xl sm:text-4xl font-extrabold" style="color: var(--text-primary);">{{ __('about.values_title') }}</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach([
                    ['icon' => '🛡️', 'gradient' => 'var(--brand-blue)', 'title' => __('about.integrity_title'), 'desc' => __('about.integrity_desc')],
                    ['icon' => '💪', 'gradient' => 'var(--brand-green)', 'title' => __('about.empowerment_title'), 'desc' => __('about.empowerment_desc')],
                    ['icon' => '⚡', 'gradient' => 'var(--brand-yellow)', 'title' => __('about.impact_title'), 'desc' => __('about.impact_desc')],
                ] as $value)
                <div class="glass-card rounded-2xl p-8 text-center transition-all duration-300 hover:-translate-y-2 hover:shadow-xl"
                     style="background: var(--surface-card);">
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center mx-auto mb-5 text-2xl"
                         style="background: linear-gradient(135deg, {{ $value['gradient'] }}, transparent 200%); background-color: {{ $value['gradient'] }}; opacity: 0.9;">
                        <span>{{ $value['icon'] }}</span>
                    </div>
                    <h3 class="text-xl font-bold mb-3" style="color: var(--text-primary);">{{ $value['title'] }}</h3>
                    <p class="leading-relaxed" style="color: var(--text-muted);">{{ $value['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</div>

@endsection
