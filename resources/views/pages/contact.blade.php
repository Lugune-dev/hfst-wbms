@extends('layouts.app')

@section('title', __('contact.title') . ' — HFST')

@section('content')

<div class="page-hero">
    <div class="page-hero-inner">
        <h1>{{ __('contact.title') }}</h1>
        <p>{{ __('contact.subtitle') }}</p>
    </div>
</div>

<div class="py-16 sm:py-24" style="background: var(--surface-bg);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">

            <!-- Contact Info -->
            <div>
                <h2 class="text-3xl font-extrabold mb-4" style="color: var(--text-primary);">
                    {{ __('contact.get_in_touch') }}
                </h2>
                <p class="text-lg leading-relaxed mb-10" style="color: var(--text-muted);">
                    {{ __('contact.description') }}
                </p>

                <dl class="space-y-6">
                    @foreach([
                        [
                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>',
                            'text' => __('contact.phone'),
                        ],
                        [
                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>',
                            'text' => __('contact.email'),
                        ],
                        [
                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>',
                            'text' => __('contact.address'),
                        ],
                    ] as $item)
                    <div class="flex items-start gap-4">
                        <div class="w-11 h-11 rounded-xl flex items-center justify-center flex-shrink-0"
                             style="background: rgba(19,56,94,0.1);">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                 style="color: var(--brand-blue);">
                                {!! $item['icon'] !!}
                            </svg>
                        </div>
                        <div class="pt-2 font-medium" style="color: var(--text-primary);">{{ $item['text'] }}</div>
                    </div>
                    @endforeach
                </dl>

                <!-- Social links -->
                <div class="mt-10">
                    <p class="text-sm font-bold uppercase tracking-widest mb-4" style="color: var(--brand-blue);">
                        {{ __('social.follow_us') }}
                    </p>
                    <div class="flex gap-3">
                        @foreach([
                            ['url' => 'https://facebook.com',    'label' => 'Facebook',   'path' => 'M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z'],
                            ['url' => 'https://instagram.com',   'label' => 'Instagram',  'path' => 'M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z'],
                            ['url' => 'https://youtube.com',     'label' => 'YouTube',    'path' => 'M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z'],
                            ['url' => 'mailto:info@hfst.co.tz', 'label' => 'Email',      'path' => 'M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z'],
                        ] as $s)
                        <a href="{{ $s['url'] }}" target="_blank" rel="noopener" aria-label="{{ $s['label'] }}"
                           class="w-10 h-10 rounded-xl flex items-center justify-center transition-all duration-300 hover:scale-110"
                           style="background: rgba(19,56,94,0.1); color: var(--brand-blue);"
                           onmouseover="this.style.background='var(--brand-blue)';this.style.color='#fff';"
                           onmouseout="this.style.background='rgba(19,56,94,0.1)';this.style.color='var(--brand-blue)';">
                            <svg viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                <path d="{{ $s['path'] }}"/>
                            </svg>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="glass-card rounded-2xl p-8 shadow-sm" style="background: var(--surface-card);">
                @livewire('contact-form')
            </div>
        </div>
    </div>
</div>

@endsection
