@php
    $current = app()->getLocale();
@endphp

<div class="hfst-topbar-lang-pill" role="group" aria-label="Language Selector">
    <a href="/language/sw" 
       title="Badili kwenda Kiswahili"
       class="hfst-topbar-lang-btn {{ $current === 'sw' ? 'hfst-topbar-lang-active' : '' }}">
        <span class="hfst-flag">🇹🇿</span>
        <span class="hfst-code">SW</span>
    </a>
    <span class="hfst-topbar-divider"></span>
    <a href="/language/en" 
       title="Switch to English"
       class="hfst-topbar-lang-btn {{ $current === 'en' ? 'hfst-topbar-lang-active' : '' }}">
        <span class="hfst-flag">🇬🇧</span>
        <span class="hfst-code">EN</span>
    </a>
    <span class="hfst-topbar-divider"></span>
    <a href="/language/fr" 
       title="Passer au Français"
       class="hfst-topbar-lang-btn {{ $current === 'fr' ? 'hfst-topbar-lang-active' : '' }}">
        <span class="hfst-flag">🇫🇷</span>
        <span class="hfst-code">FR</span>
    </a>
</div>
