@extends('layouts.app')

@section('title', __('programs.title') . ' — HFST')

@section('content')

{{-- HERO --}}
<div class="page-hero">
    <div class="page-hero-inner">
        <span class="page-hero-badge">{{ __('programs.title') }}</span>
        <h1>{{ __('programs.subtitle') }}</h1>
    </div>
</div>

{{-- MAIN --}}
<div class="py-16 sm:py-24 section-light">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid gap-8 lg:grid-cols-2">
            @forelse($programs as $program)
            <div class="group hfst-card overflow-hidden flex flex-col md:flex-row">
                {{-- Icon panel --}}
                <div class="md:w-1/3 flex items-center justify-center p-8 relative overflow-hidden"
                     style="background: linear-gradient(135deg, rgba(19,56,94,0.08), rgba(46,125,50,0.08));">
                    <div class="w-16 h-16 rounded-2xl flex items-center justify-center text-2xl transition-transform duration-300 group-hover:scale-110 group-hover:-rotate-6"
                         style="background: linear-gradient(135deg, var(--brand-blue), var(--brand-green)); box-shadow: 0 8px 24px rgba(19,56,94,0.25);">
                        📋
                    </div>
                </div>
                {{-- Content --}}
                <div class="p-8 md:w-2/3 flex flex-col justify-center">
                    <span class="text-xs font-bold uppercase tracking-widest mb-2" style="color: var(--brand-green);">{{ $program->status }}</span>
                    <h3 class="text-xl font-bold mb-3" style="color: var(--text-primary);">{{ $program->name }}</h3>
                    <p class="leading-relaxed mb-5" style="color: var(--text-muted);">{{ $program->description }}</p>
                    <a href="{{ route('donate') }}" class="inline-flex items-center font-semibold transition-all hover:gap-2" style="color: var(--brand-blue);">
                        {{ __('programs.donate_link') }}
                        <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-2 text-center py-16" style="color: var(--text-muted);">
                <div class="text-5xl mb-4">🔧</div>
                <p>{{ __('programs.empty') }}</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

@endsection
