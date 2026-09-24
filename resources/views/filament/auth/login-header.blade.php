@php
    $locale = app()->getLocale();
    $isSw = ($locale === 'sw');
@endphp

<div class="hfst-login-topbar" x-data="{
    theme: localStorage.getItem('theme') || 'system',
    init() {
        this.theme = localStorage.getItem('theme') || 'system';
        const syncActiveTheme = () => {
            this.theme = localStorage.getItem('theme') || 'system';
        };
        window.addEventListener('theme-changed', syncActiveTheme);
    },
    setTheme(newTheme) {
        this.theme = newTheme;
        window.dispatchEvent(new CustomEvent('theme-changed', { detail: newTheme }));
        try {
            localStorage.setItem('theme', newTheme);
            localStorage.setItem('hfst_theme', newTheme);
            if (newTheme === 'dark') {
                document.documentElement.classList.add('dark');
            } else if (newTheme === 'light') {
                document.documentElement.classList.remove('dark');
            } else {
                if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
            }
        } catch(e) {}
    }
}">
    {{-- Left: Navigation Links --}}
    <div class="hfst-login-nav-left">
        <a href="/" class="hfst-login-nav-link" title="{{ $isSw ? 'Rudi kwenye tovuti kuu' : 'Back to Public Homepage' }}">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            <span>{{ $isSw ? 'Rudi Mwanzo' : 'Back to Home' }}</span>
        </a>

        <span class="hfst-login-sep hidden sm:inline">&bull;</span>

        <a href="/login" class="hfst-login-nav-link hfst-login-nav-portal" title="{{ $isSw ? 'Chagua mlango mwingine wa mfumo' : 'Select another stakeholder portal' }}">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
            </svg>
            <span>{{ $isSw ? 'Chagua Lango' : 'Switch Portal' }}</span>
        </a>
    </div>

    {{-- Right: Language & Theme Controls --}}
    <div class="hfst-login-nav-right">
        {{-- Language Switcher Pill --}}
        <div class="hfst-lang-pill" role="group" aria-label="Language selection">
            <a href="/language/sw" 
               class="hfst-lang-btn {{ $locale === 'sw' ? 'hfst-lang-active' : '' }}" 
               title="Badili kwenda Kiswahili">
                <span>🇹🇿</span>
                <span class="hfst-lang-label">SW</span>
            </a>
            <span class="hfst-pill-divider"></span>
            <a href="/language/en" 
               class="hfst-lang-btn {{ $locale === 'en' ? 'hfst-lang-active' : '' }}" 
               title="Switch to English">
                <span>🇬🇧</span>
                <span class="hfst-lang-label">EN</span>
            </a>
            <span class="hfst-pill-divider"></span>
            <a href="/language/fr" 
               class="hfst-lang-btn {{ $locale === 'fr' ? 'hfst-lang-active' : '' }}" 
               title="Passer au Français">
                <span>🇫🇷</span>
                <span class="hfst-lang-label">FR</span>
            </a>
        </div>

        {{-- Theme Switcher Pill --}}
        <div class="hfst-theme-pill" role="group" aria-label="Theme mode switcher">
            <button type="button" 
                    x-on:click="setTheme('light')"
                    x-bind:class="{ 'hfst-theme-active': theme === 'light' }"
                    class="hfst-theme-btn" 
                    title="{{ $isSw ? 'Mwonekano wa Mchana (Light)' : 'Light Mode' }}">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            </button>
            <button type="button" 
                    x-on:click="setTheme('dark')"
                    x-bind:class="{ 'hfst-theme-active': theme === 'dark' }"
                    class="hfst-theme-btn" 
                    title="{{ $isSw ? 'Mwonekano wa Usiku (Dark)' : 'Dark Mode' }}">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                </svg>
            </button>
            <button type="button" 
                    x-on:click="setTheme('system')"
                    x-bind:class="{ 'hfst-theme-active': theme === 'system' }"
                    class="hfst-theme-btn" 
                    title="{{ $isSw ? 'Kulingana na Kifaa (Auto)' : 'System Mode' }}">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </button>
        </div>
    </div>
</div>
