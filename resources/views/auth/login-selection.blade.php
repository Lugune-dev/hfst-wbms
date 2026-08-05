@extends('layouts.app')

@section('title', __('nav.login') . ' — Hope for Students Tanzania')

@section('content')

<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8" style="background: var(--surface-bg);">
    <div class="max-w-4xl w-full">
        {{-- Header --}}
        <div class="text-center mb-10 animate-fade-in-up">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-3xl mb-6 shadow-lg"
                 style="background: linear-gradient(135deg, var(--brand-blue), var(--brand-green)); border: 3px solid rgba(246,178,25,0.3);">
                <img src="{{ asset('images/logo.png') }}" alt="HFST" class="w-12 h-12 object-contain" style="filter: brightness(0) invert(1);">
            </div>
            <h2 class="text-3xl font-black" style="color: var(--brand-blue);">{{ __('Welcome Back') }}</h2>
            <p class="mt-2 text-base" style="color: var(--text-muted);">{{ __('Please select your portal to continue.') }}</p>
        </div>

        {{-- Portal Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 animate-fade-in-up" style="animation-delay: 0.1s;">

            {{-- Student --}}
            <a href="/student/login" class="portal-card" style="--pc-color1: var(--brand-blue); --pc-color2: var(--brand-blue-light);">
                <div class="portal-card-icon" style="background: rgba(19,56,94,0.1); color: var(--brand-blue);">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/></svg>
                </div>
                <h3 class="portal-card-title">Student Portal</h3>
                <p class="portal-card-desc">Access your courses, grades, and materials.</p>
                <span class="portal-card-arrow">Login &rarr;</span>
            </a>

            {{-- Staff --}}
            <a href="/staff/login" class="portal-card" style="--pc-color1: var(--brand-green); --pc-color2: var(--brand-green-light);">
                <div class="portal-card-icon" style="background: rgba(46,125,50,0.1); color: var(--brand-green);">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
                <h3 class="portal-card-title">Staff Portal</h3>
                <p class="portal-card-desc">Manage operations and view student reports.</p>
                <span class="portal-card-arrow">Login &rarr;</span>
            </a>

            {{-- Donor --}}
            <a href="/donor/login" class="portal-card" style="--pc-color1: var(--brand-yellow); --pc-color2: var(--brand-yellow-dark);">
                <div class="portal-card-icon" style="background: rgba(246,178,25,0.12); color: var(--brand-yellow-dark);">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                </div>
                <h3 class="portal-card-title">Donor Portal</h3>
                <p class="portal-card-desc">Track your donations and sponsored students.</p>
                <span class="portal-card-arrow">Login &rarr;</span>
            </a>
        </div>

        {{-- Back link --}}
        <div class="text-center mt-8 animate-fade-in" style="animation-delay: 0.3s;">
            <a href="{{ route('home') }}" class="text-sm font-semibold hover:underline" style="color: var(--brand-blue);">&larr; Back to Home</a>
        </div>
    </div>
</div>

@endsection
