@extends('layouts.app')

@section('title', __('nav.home') . ' — Hope for Students Tanzania')

@section('content')

{{-- ======================================================
     HERO
====================================================== --}}
<div class="relative overflow-hidden" style="background: linear-gradient(135deg, var(--brand-blue-dark) 0%, var(--brand-blue) 55%, var(--brand-blue-light) 100%);">
    <div class="absolute inset-0" style="background: radial-gradient(ellipse at 30% 60%, rgba(46,125,50,0.2) 0%, transparent 55%), radial-gradient(ellipse at 80% 20%, rgba(246,178,25,0.15) 0%, transparent 55%);"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 sm:py-28 lg:py-36 grid lg:grid-cols-2 gap-12 items-center">
        <div class="text-white animate-fade-in-up">
            <span class="inline-block px-3 py-1 rounded-full text-xs font-700 uppercase tracking-widest mb-4"
                  style="background: rgba(246,178,25,0.2); color: var(--brand-yellow); border: 1px solid rgba(246,178,25,0.35);">
                Hope for Students Tanzania
            </span>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black leading-tight tracking-tight">
                {{ __('hero.title_line1') }}<br>
                <span style="color: var(--brand-yellow);">{{ __('hero.title_line2') }}</span>
            </h1>
            <p class="mt-6 text-lg text-blue-100 max-w-xl leading-relaxed">
                {{ __('hero.subtitle') }}
            </p>
            <div class="mt-8 flex flex-wrap gap-4">
                <a href="{{ route('donate') }}" class="btn-yellow">
                    {{ __('hero.cta_donate') }}
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
                <a href="{{ route('about') }}" class="btn-ghost-white">
                    {{ __('hero.cta_learn') }}
                </a>
            </div>
        </div>

        <div class="hidden lg:block relative">
            <div class="relative rounded-3xl overflow-hidden shadow-2xl animate-float hero-slideshow"
                 style="height: 400px; border: 1px solid rgba(255,255,255,0.15);">
                <div class="slideshow-container absolute inset-0 w-full h-full bg-gray-900">
                    <img src="{{ asset('images/hope3.jpeg') }}" alt="Students learning" class="w-full h-full object-cover slide active-slide transition-opacity duration-1000">
                    <img src="{{ asset('images/hope.jpeg') }}" alt="Education" class="w-full h-full object-cover slide absolute inset-0 opacity-0 transition-opacity duration-1000">
                    <img src="{{ asset('images/hope2.jpeg') }}" alt="School" class="w-full h-full object-cover slide absolute inset-0 opacity-0 transition-opacity duration-1000">
                </div>
                <div class="absolute inset-0" style="background: linear-gradient(to bottom right, rgba(19,56,94,0.3), rgba(46,125,50,0.2)); pointer-events: none;"></div>
            </div>
            <div class="absolute -bottom-6 -left-6 glass-card rounded-2xl p-4 shadow-xl" style="background: rgba(255,255,255,0.95);">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center" style="background: linear-gradient(135deg, var(--brand-blue), var(--brand-green));">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zm5.99 7.176A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/></svg>
                    </div>
                    <div>
                        <div class="text-xl font-black" style="color: var(--brand-blue);">{{ number_format($studentsCount ?? 0) }}+</div>
                        <div class="text-xs font-medium" style="color: var(--text-muted);">{{ __('stats.students') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ======================================================
     STATS BAND
====================================================== --}}
<div class="stats-band">
    <div class="relative z-10 max-w-6xl mx-auto grid grid-cols-2 lg:grid-cols-4 gap-8">
        <div class="stats-band-item">
            <div class="stats-band-number">{{ number_format($studentsCount ?? 0) }}+</div>
            <div class="stats-band-label">{{ __('stats.students') }}</div>
        </div>
        <div class="stats-band-item">
            <div class="stats-band-number">{{ number_format($donorsCount ?? 0) }}+</div>
            <div class="stats-band-label">{{ __('stats.donors') }}</div>
        </div>
        <div class="stats-band-item">
            <div class="stats-band-number">{{ number_format($projectsCount ?? 0) }}</div>
            <div class="stats-band-label">{{ __('stats.projects') }}</div>
        </div>
        <div class="stats-band-item">
            <div class="stats-band-number">TZS {{ number_format(($totalRaised ?? 0) / 1000000, 1) }}M+</div>
            <div class="stats-band-label">{{ __('stats.raised') }}</div>
        </div>
    </div>
</div>

{{-- ======================================================
     LATEST NEWS & IMPACT STORIES
====================================================== --}}
<div class="py-16 sm:py-20 section-light">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <span class="section-label">{{ __('nav.news') }}</span>
            <h2 class="section-title">Impact Stories & Updates</h2>
        </div>
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @forelse($latestNews ?? [] as $post)
            <a href="#" class="group hfst-card overflow-hidden flex flex-col">
                <div class="h-48 overflow-hidden relative">
                    <img src="{{ $post->image_url ?? 'https://images.unsplash.com/photo-1497633762265-9d179a990aa6?auto=format&fit=crop&w=800&q=80' }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="{{ $post->title }}">
                    <div class="absolute inset-0" style="background: linear-gradient(to top, rgba(0,0,0,0.7), transparent); pointer-events: none;"></div>
                    <div class="absolute bottom-4 left-4 right-4">
                        <span class="text-xs font-bold text-white px-2 py-1 rounded-md" style="background: var(--brand-blue);">Update</span>
                    </div>
                </div>
                <div class="p-6 flex-1 flex flex-col">
                    <div class="text-xs font-medium mb-2" style="color: var(--text-muted);">{{ $post->published_at ? $post->published_at->format('M d, Y') : '' }}</div>
                    <h3 class="text-lg font-bold mb-3 leading-snug group-hover:text-blue-600 transition-colors" style="color: var(--text-primary);">{{ $post->title }}</h3>
                    <p class="text-sm leading-relaxed flex-1" style="color: var(--text-muted);">{{ Str::limit(strip_tags($post->content), 100) }}</p>
                </div>
            </a>
            @empty
                <div class="col-span-3 text-center py-8" style="color: var(--text-muted);">No news available at the moment.</div>
            @endforelse
        </div>
    </div>
</div>

{{-- ======================================================
     FEATURED PROJECTS
====================================================== --}}
<div class="py-16 sm:py-20 section-light" style="border-top: 1px solid var(--border-light);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <span class="section-label">{{ __('projects.heading_label') }}</span>
            <h2 class="section-title">{{ __('projects.heading') }}</h2>
        </div>

        @if(!empty($highlights) && $highlights->count())
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
            @foreach($highlights as $h)
            <div class="group hfst-card overflow-hidden flex flex-col">
                <div class="h-40 sm:h-48 w-full overflow-hidden relative">
                    @if($h->image_url || $h->image)
                        <img src="{{ $h->image_url ?? \Illuminate\Support\Facades\Storage::disk('public')->url($h->image) }}" alt="{{ $h->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0" style="background: linear-gradient(to top, rgba(0,0,0,0.4), transparent);"></div>
                    @else
                        <div class="w-full h-full flex items-center justify-center text-5xl" style="background: linear-gradient(135deg, var(--brand-blue), var(--brand-green));">📚</div>
                    @endif
                </div>
                <div class="p-5 flex-1 flex flex-col text-center">
                    <h4 class="font-bold text-lg mb-2" style="color: var(--text-primary);">{{ $h->title }}</h4>
                    <p class="text-sm leading-relaxed" style="color: var(--text-muted);">{{ $h->description }}</p>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            @forelse($featuredProjects as $project)
            <div class="group relative rounded-[2rem] overflow-hidden transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl flex flex-col"
                 style="background: var(--surface-card); border: 1px solid var(--border-light); min-height: 480px;">
                <div class="relative h-64 sm:h-72 w-full overflow-hidden">
                    <img src="{{ $project->thumb_url ?? 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?auto=format&fit=crop&w=800&q=80' }}"
                         alt="{{ $project->name }}"
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 transition-opacity duration-300" style="background: linear-gradient(to top, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.3) 50%, transparent 100%);"></div>
                    <div class="absolute top-4 right-4 flex gap-2">
                        <span class="px-3 py-1 rounded-full text-xs font-bold shadow-sm flex items-center backdrop-blur-md"
                              style="background: rgba(46,125,50,0.25); color: #86efac; border: 1px solid rgba(46,125,50,0.4);">
                            <span class="inline-block w-2 h-2 rounded-full mr-2 animate-pulse" style="background: #4ade80;"></span>
                            {{ __('projects.active') }}
                        </span>
                    </div>
                    <div class="absolute bottom-4 left-5 right-5 text-white z-10">
                        <h3 class="text-xl font-bold mb-1 leading-tight drop-shadow-lg">{{ $project->name }}</h3>
                        <p class="text-sm line-clamp-2 drop-shadow-md" style="color: rgba(255,255,255,0.85);">{{ Str::limit(strip_tags($project->description), 100) }}</p>
                    </div>
                </div>
                <div class="p-6 flex-1 flex flex-col justify-between relative z-10">
                    <div>
                        <div class="flex justify-between items-end mb-2">
                            <span class="text-xs font-semibold uppercase tracking-wider" style="color: var(--text-muted);">{{ __('projects.progress') }}</span>
                            <span class="text-xl font-black" style="color: var(--brand-green);">{{ $project->funding_percentage }}%</span>
                        </div>
                        <div class="w-full rounded-full h-3 overflow-hidden shadow-inner" style="background: var(--border-light);">
                            <div class="h-3 rounded-full transition-all duration-1000 ease-out relative"
                                 style="width: {{ min(100, $project->funding_percentage) }}%; background: linear-gradient(90deg, var(--brand-yellow), var(--brand-green));">
                                <div class="absolute inset-0 w-full animate-[pulse_2s_infinite]" style="background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);"></div>
                            </div>
                        </div>
                        <div class="flex justify-between text-xs mt-3 font-semibold">
                            <span style="color: var(--text-primary);">TZS {{ number_format($project->current_funding) }} raised</span>
                            <span style="color: var(--text-muted);">Goal: TZS {{ number_format($project->budget) }}</span>
                        </div>
                    </div>
                    <a href="{{ route('donate') }}" class="mt-6 w-full btn-primary justify-center text-sm">
                        {{ __('projects.donate_btn') }}
                        <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>
            @empty
                <div class="col-span-3 text-center py-12" style="color: var(--text-muted);">{{ __('projects.empty') }}</div>
            @endforelse
        </div>
    </div>
</div>

{{-- ======================================================
     CTA BAND
====================================================== --}}
<div class="cta-band">
    <div class="relative z-10 max-w-3xl mx-auto text-center text-white">
        <h2 class="text-3xl sm:text-4xl font-black mb-4">{{ __('hero.cta_donate') }}</h2>
        <p class="text-lg text-white/85 mb-8 leading-relaxed">
            Your generosity transforms lives. Every contribution brings a student closer to their dream.
        </p>
        <a href="{{ route('donate') }}" class="btn-yellow text-base">
            {{ __('donate.cta') }}
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </a>
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
