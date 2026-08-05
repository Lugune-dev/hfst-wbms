@extends('layouts.app')

@section('title', __('news.title') . ' — HFST')

@section('content')

{{-- HERO --}}
<div class="page-hero">
    <div class="page-hero-inner">
        <span class="page-hero-badge">{{ __('news.title') }}</span>
        <h1>{{ __('news.subtitle') }}</h1>
    </div>
</div>

{{-- MAIN --}}
<div class="py-16 sm:py-24 section-light">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            @forelse($posts as $post)
            <article class="group hfst-card overflow-hidden flex flex-col">
                {{-- Thumbnail --}}
                <div class="h-52 overflow-hidden relative">
                    @if($post->image)
                        <img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}"
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-5xl"
                             style="background: linear-gradient(135deg, rgba(19,56,94,0.08), rgba(46,125,50,0.08));">📰</div>
                    @endif
                    <div class="absolute inset-0" style="background: linear-gradient(to top, rgba(0,0,0,0.5), transparent); pointer-events: none;"></div>
                    <span class="absolute top-3 left-3 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider backdrop-blur-md"
                          style="background: rgba(19,56,94,0.85); color: var(--brand-yellow); border: 1px solid rgba(246,178,25,0.3);">
                        {{ $post->type }}
                    </span>
                </div>

                {{-- Body --}}
                <div class="p-6 flex-1 flex flex-col">
                    <h2 class="text-lg font-bold mb-2 leading-snug group-hover:text-blue-600 transition-colors" style="color: var(--text-primary);">
                        {{ $post->title }}
                    </h2>
                    <p class="text-sm leading-relaxed flex-1 line-clamp-3" style="color: var(--text-muted);">
                        {!! strip_tags($post->content) !!}
                    </p>
                    <div class="mt-5 flex items-center gap-3 pt-4" style="border-top: 1px solid var(--border-light);">
                        <div class="w-9 h-9 rounded-full flex items-center justify-center font-bold text-sm text-white flex-shrink-0"
                             style="background: linear-gradient(135deg, var(--brand-blue), var(--brand-green));">
                            {{ substr($post->author->name ?? 'H', 0, 1) }}
                        </div>
                        <div>
                            <p class="text-sm font-semibold" style="color: var(--text-primary);">{{ $post->author->name ?? 'HFST Team' }}</p>
                            <time class="text-xs" style="color: var(--text-muted);" datetime="{{ $post->published_at }}">
                                {{ $post->published_at->format('M d, Y') }}
                            </time>
                        </div>
                    </div>
                </div>
            </article>
            @empty
            <div class="col-span-3 text-center py-16" style="color: var(--text-muted);">
                <div class="text-5xl mb-4">📢</div>
                <p>{{ __('news.empty') }}</p>
            </div>
            @endforelse
        </div>

        @if($posts->hasPages())
        <div class="mt-12">{{ $posts->links() }}</div>
        @endif
    </div>
</div>

@endsection
