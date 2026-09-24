@php
    $locale = app()->getLocale();
    $isSw = ($locale === 'sw');
@endphp

<div class="hfst-login-footer">
    <div class="hfst-login-footer-links">
        <a href="/" class="hfst-login-footer-link">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            <span>{{ $isSw ? 'Rudi Tovuti Kuu' : 'Back to Website' }}</span>
        </a>
        <span class="hfst-footer-bullet">&bull;</span>
        <a href="/login" class="hfst-login-footer-link">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
            </svg>
            <span>{{ $isSw ? 'Chagua Lango Jingine' : 'Switch Portal' }}</span>
        </a>
    </div>

    <div class="hfst-login-footer-meta">
        <div class="hfst-org-line">
            <strong>Hope for Students Tanzania</strong> &bull; <span>Arusha, Tanzania</span>
        </div>
        <div class="hfst-security-badge">
            <svg class="w-3 h-3 text-emerald-500 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
            </svg>
            <span>{{ $isSw ? 'Mfumo Salama wenye Usimbaji wa Kisasa (256-bit SSL)' : 'Enterprise Grade 256-bit Encryption & Data Protection' }}</span>
        </div>
    </div>
</div>
