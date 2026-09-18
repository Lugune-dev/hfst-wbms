@php
    $current = app()->getLocale();
@endphp
<div class="flex items-center gap-1.5 mr-2">
    <a href="/language/sw" 
       title="Badili kwenda Kiswahili"
       class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-bold transition-all {{ $current === 'sw' ? 'bg-amber-400/20 text-amber-500 border border-amber-400/40' : 'text-slate-400 hover:text-slate-200 hover:bg-white/5' }}">
        <span>🇹🇿</span>
        <span class="hidden sm:inline">SW</span>
    </a>
    <span class="text-slate-600 text-xs">|</span>
    <a href="/language/en" 
       title="Switch to English"
       class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-bold transition-all {{ $current === 'en' ? 'bg-blue-400/20 text-blue-400 border border-blue-400/40' : 'text-slate-400 hover:text-slate-200 hover:bg-white/5' }}">
        <span>🇬🇧</span>
        <span class="hidden sm:inline">EN</span>
    </a>
</div>
