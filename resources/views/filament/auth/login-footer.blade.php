<div class="mt-8 pt-6 border-t border-white/10 dark:border-white/10 text-center space-y-3">
    <div class="flex items-center justify-center gap-4 text-xs font-semibold">
        <a href="/" 
           class="inline-flex items-center gap-1 text-slate-400 hover:text-amber-400 dark:text-slate-400 dark:hover:text-amber-300 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>{{ app()->getLocale() === 'sw' ? 'Rudi Mwanzo' : 'Back to Home' }}</span>
        </a>
        <span class="text-slate-600 dark:text-slate-600">•</span>
        <a href="/login" 
           class="inline-flex items-center gap-1 text-slate-400 hover:text-emerald-400 dark:text-slate-400 dark:hover:text-emerald-300 transition-colors">
            <span>{{ app()->getLocale() === 'sw' ? 'Chagua Lango Jingine' : 'Switch Portal' }}</span>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
        </a>
    </div>

    <div class="text-[11px] text-slate-400 dark:text-slate-500 font-medium">
        <span>Hope for Students Tanzania</span> &bull; <span>Arusha, Tanzania</span>
        <div class="text-[10px] text-slate-500 mt-1">
            🔒 {{ app()->getLocale() === 'sw' ? 'Mfumo Salama wenye Usimbaji wa Kisasa' : 'Protected by Enterprise Grade Encryption' }}
        </div>
    </div>
</div>
