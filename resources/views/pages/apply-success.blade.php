@extends('layouts.app')

@section('title', (app()->getLocale() === 'sw' ? 'Maombi Yamewasilishwa' : 'Application Received') . ' — Hope for Students Tanzania')

@section('content')
<div class="py-16 sm:py-24" style="background: var(--surface-bg);">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="glass-card rounded-3xl p-8 sm:p-12 shadow-2xl text-center"
             style="background: var(--surface-card); border: 1px solid var(--border-light);">
            
            <div class="w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 text-4xl shadow-lg animate-bounce"
                 style="background: linear-gradient(135deg, var(--brand-blue), var(--brand-blue-light)); color: white;">
                📋
            </div>

            <span class="inline-block px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider mb-2"
                  style="background: rgba(19,56,94,0.1); color: var(--brand-blue);">
                {{ app()->getLocale() === 'sw' ? 'Maombi Yamepokelewa' : 'Application Received' }}
            </span>

            <h1 class="text-3xl sm:text-4xl font-black mb-3" style="color: var(--brand-blue);">
                {{ app()->getLocale() === 'sw' ? 'Maombi Yako Yamewasilishwa Kikamilifu!' : 'Application Successfully Submitted!' }}
            </h1>

            <p class="text-sm sm:text-base mb-8 max-w-lg mx-auto" style="color: var(--text-muted);">
                {{ app()->getLocale() === 'sw'
                    ? 'Timu ya maafisa wa Hope for Students Tanzania itakagua maombi haya, kuthibitisha taarifa na shule husika, na kuwasiliana na mzazi/mlezi.'
                    : 'Our team will review your application, verify with your school administration, and contact your guardian with updates.' }}
            </p>

            {{-- Application Code Card --}}
            <div class="p-5 rounded-2xl mb-8 text-left space-y-2.5" style="background: var(--surface-bg); border: 1px solid var(--border-light);">
                <div class="flex justify-between items-center pb-2 border-b" style="border-color: var(--border-light);">
                    <span class="text-xs uppercase font-bold text-gray-400">{{ app()->getLocale() === 'sw' ? 'Nambari ya Kumbukumbu' : 'Tracking Reference' }}</span>
                    <span class="font-mono font-black text-lg text-blue-600">APP-HFST-{{ str_pad($application->id, 5, '0', STR_PAD_LEFT) }}</span>
                </div>
                <div class="flex justify-between items-center text-xs sm:text-sm">
                    <span style="color: var(--text-muted);">{{ app()->getLocale() === 'sw' ? 'Jina la Mwanafunzi' : 'Student Name' }}:</span>
                    <span class="font-bold" style="color: var(--text-primary);">{{ $application->student->first_name }} {{ $application->student->last_name }}</span>
                </div>
                <div class="flex justify-between items-center text-xs sm:text-sm">
                    <span style="color: var(--text-muted);">{{ app()->getLocale() === 'sw' ? 'Shule' : 'School' }}:</span>
                    <span style="color: var(--text-primary);">{{ $application->student->school_name ?? $application->student->school }}</span>
                </div>
                <div class="flex justify-between items-center text-xs sm:text-sm">
                    <span style="color: var(--text-muted);">{{ app()->getLocale() === 'sw' ? 'Hali ya Maombi' : 'Current Status' }}:</span>
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-100 text-amber-800 dark:bg-amber-950 dark:text-amber-300">
                        {{ $application->status }} (Inakaguliwa)
                    </span>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('home') }}"
                   class="inline-flex items-center justify-center gap-2 px-8 py-3.5 rounded-xl font-bold text-white transition-all duration-300 shadow-lg hover:scale-105"
                   style="background: var(--brand-blue);">
                    {{ app()->getLocale() === 'sw' ? 'Rudi Nyumbani' : 'Back to Home' }}
                </a>
                <a href="{{ route('contact') }}"
                   class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl font-bold transition-all duration-300 border hover:bg-gray-100 dark:hover:bg-gray-800"
                   style="border-color: var(--border-light); color: var(--text-primary);">
                    {{ app()->getLocale() === 'sw' ? 'Wasiliana Nasi' : 'Contact Support' }}
                </a>
            </div>

            <div class="mt-8 pt-6 border-t text-xs" style="border-color: var(--border-light); color: var(--text-muted);">
                ICT OFFICERS: +255 613 005 293 / +255 747 413 379 | hopeforstudentsTanzania25@gmail.com<br>
                P.O. Box 2798, Arusha, Kikwakwaru B
            </div>

        </div>

    </div>
</div>
@endsection
