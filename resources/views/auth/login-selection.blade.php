@extends('layouts.app')

@section('title', __('nav.login') . ' — Hope for Students Tanzania')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8" style="background: var(--surface-bg);">
    <div class="max-w-3xl w-full space-y-8 glass-card p-8 sm:p-12 rounded-3xl" style="background: var(--surface-card); box-shadow: 0 20px 40px rgba(0,0,0,0.08);">
        <div class="text-center">
            <h2 class="text-3xl font-extrabold" style="color: var(--brand-blue);">{{ __('Welcome Back') }}</h2>
            <p class="mt-2 text-sm" style="color: var(--text-muted);">{{ __('Please select your portal to continue.') }}</p>
        </div>
        
        <div class="mt-10 grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <!-- Student Portal -->
            <a href="/student/login" class="flex flex-col items-center justify-center p-8 rounded-2xl transition-all duration-300 hover:-translate-y-2 hover:shadow-xl group" style="background: var(--surface-bg); border: 1px solid var(--border-light);">
                <div class="w-16 h-16 rounded-full flex items-center justify-center mb-4 transition-colors" style="background: rgba(19,56,94,0.1); color: var(--brand-blue);">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"></path></svg>
                </div>
                <h3 class="text-lg font-bold" style="color: var(--text-primary);">Student Portal</h3>
                <p class="text-xs text-center mt-2" style="color: var(--text-muted);">Access your courses, grades, and materials.</p>
                <span class="mt-4 text-sm font-semibold opacity-0 group-hover:opacity-100 transition-opacity" style="color: var(--brand-yellow);">Login &rarr;</span>
            </a>

            <!-- Staff Portal -->
            <a href="/staff/login" class="flex flex-col items-center justify-center p-8 rounded-2xl transition-all duration-300 hover:-translate-y-2 hover:shadow-xl group" style="background: var(--surface-bg); border: 1px solid var(--border-light);">
                <div class="w-16 h-16 rounded-full flex items-center justify-center mb-4 transition-colors" style="background: rgba(46,125,50,0.1); color: var(--brand-green);">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
                <h3 class="text-lg font-bold" style="color: var(--text-primary);">Staff Portal</h3>
                <p class="text-xs text-center mt-2" style="color: var(--text-muted);">Manage operations and view student reports.</p>
                <span class="mt-4 text-sm font-semibold opacity-0 group-hover:opacity-100 transition-opacity" style="color: var(--brand-yellow);">Login &rarr;</span>
            </a>

            <!-- Donor Portal -->
            <a href="/donor/login" class="flex flex-col items-center justify-center p-8 rounded-2xl transition-all duration-300 hover:-translate-y-2 hover:shadow-xl group" style="background: var(--surface-bg); border: 1px solid var(--border-light);">
                <div class="w-16 h-16 rounded-full flex items-center justify-center mb-4 transition-colors" style="background: rgba(246,178,25,0.1); color: var(--brand-yellow);">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                </div>
                <h3 class="text-lg font-bold" style="color: var(--text-primary);">Donor Portal</h3>
                <p class="text-xs text-center mt-2" style="color: var(--text-muted);">Track your donations and sponsored students.</p>
                <span class="mt-4 text-sm font-semibold opacity-0 group-hover:opacity-100 transition-opacity" style="color: var(--brand-yellow);">Login &rarr;</span>
            </a>

        </div>
    </div>
</div>
@endsection
