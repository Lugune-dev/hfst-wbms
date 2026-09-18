<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            <div class="flex items-center justify-between w-full">
                <div class="flex items-center gap-2">
                    <x-heroicon-o-shield-check class="w-5 h-5 text-emerald-500" />
                    <span class="font-bold text-base text-gray-900 dark:text-white">
                        {{ app()->getLocale() === 'sw' ? 'Kumbukumbu za Matukio ya Mfumo (Audit Logs)' : 'System Audit Logs & User Activity' }}
                    </span>
                </div>
                <a href="/admin/activity-logs" 
                   class="text-xs font-semibold text-primary-600 hover:text-primary-500 dark:text-primary-400 flex items-center gap-1">
                    <span>{{ app()->getLocale() === 'sw' ? 'Tazama kumbukumbu zote' : 'View all activity logs' }}</span>
                    <x-heroicon-m-arrow-right class="w-3.5 h-3.5" />
                </a>
            </div>
        </x-slot>

        <div class="divide-y divide-gray-100 dark:divide-white/5">
            @forelse($this->getLogs() as $log)
                @php
                    $roleColor = match (strtolower($log->role ?? '')) {
                        'admin'   => 'bg-rose-500/10 text-rose-500 border border-rose-500/20',
                        'staff'   => 'bg-amber-500/10 text-amber-500 border border-amber-500/20',
                        'donor'   => 'bg-sky-500/10 text-sky-500 border border-sky-500/20',
                        'teacher' => 'bg-indigo-500/10 text-indigo-500 border border-indigo-500/20',
                        'student' => 'bg-emerald-500/10 text-emerald-500 border border-emerald-500/20',
                        default   => 'bg-slate-500/10 text-slate-400 border border-slate-500/20',
                    };

                    $actionColor = match ($log->action) {
                        'LOGIN'            => 'bg-emerald-50 text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-400',
                        'LOGOUT'           => 'bg-slate-50 text-slate-600 dark:bg-slate-900/40 dark:text-slate-400',
                        'LOGIN_FAILED'     => 'bg-rose-50 text-rose-700 dark:bg-rose-950/40 dark:text-rose-400',
                        'AID_APPROVED'     => 'bg-teal-50 text-teal-700 dark:bg-teal-950/40 dark:text-teal-300',
                        'DONATION'         => 'bg-blue-50 text-blue-700 dark:bg-blue-950/40 dark:text-blue-300',
                        'PASSWORD_CHANGED' => 'bg-amber-50 text-amber-700 dark:bg-amber-950/40 dark:text-amber-300',
                        default            => 'bg-indigo-50 text-indigo-700 dark:bg-indigo-950/40 dark:text-indigo-300',
                    };
                @endphp
                <div class="py-3 flex flex-col sm:flex-row sm:items-center justify-between gap-3 hover:bg-gray-50/50 dark:hover:bg-white/[0.02] px-2 rounded-lg transition-colors">
                    <div class="flex items-start gap-3">
                        <div class="mt-0.5 flex-shrink-0">
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-semibold uppercase tracking-wider {{ $actionColor }}">
                                {{ $log->action }}
                            </span>
                        </div>
                        <div class="min-w-0 flex-1">
                            <div class="flex items-center gap-2 flex-wrap">
                                <span class="text-sm font-semibold text-gray-900 dark:text-white">
                                    {{ $log->user_name ?? 'System' }}
                                </span>
                                @if($log->role)
                                    <span class="text-[10px] font-bold uppercase tracking-wider px-1.5 py-0.5 rounded {{ $roleColor }}">
                                        {{ $log->role }}
                                    </span>
                                @endif
                                <span class="text-xs text-gray-400">· IP: {{ $log->ip_address }}</span>
                            </div>
                            <p class="text-xs text-gray-600 dark:text-gray-300 mt-0.5 leading-relaxed">
                                {{ $log->description }}
                            </p>
                        </div>
                    </div>
                    <div class="sm:text-right flex-shrink-0 pl-10 sm:pl-0">
                        <span class="text-xs font-medium text-gray-500 dark:text-gray-400">
                            {{ $log->created_at->diffForHumans() }}
                        </span>
                        <div class="text-[11px] text-gray-400">
                            {{ $log->created_at->format('d M, H:i') }}
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-8 text-gray-400">
                    <x-heroicon-o-shield-check class="w-10 h-10 mx-auto mb-2 opacity-50 text-gray-400" />
                    <p>{{ app()->getLocale() === 'sw' ? 'Hakuna kumbukumbu za matukio kwa sasa.' : 'No audit logs recorded yet.' }}</p>
                </div>
            @endforelse
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
