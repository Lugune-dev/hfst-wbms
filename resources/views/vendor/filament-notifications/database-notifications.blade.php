@php
    use Filament\Support\Enums\Alignment;
    use Filament\Support\View\Components\BadgeComponent;
    use Illuminate\View\ComponentAttributeBag;

    $notifications = $this->getNotifications();
    $unreadNotificationsCount = $this->getUnreadNotificationsCount();
    $hasNotifications = $notifications->count();
    $isPaginated = $notifications instanceof \Illuminate\Contracts\Pagination\Paginator && $notifications->hasPages();
    $pollingInterval = $this->getPollingInterval();
@endphp

<div class="fi-no-database">
    <x-filament::modal
        :alignment="$hasNotifications ? null : Alignment::Center"
        close-button
        :description="$hasNotifications ? null : 'Tafadhali angalia tena baadae'"
        :heading="$hasNotifications ? null : 'Hakuna arifa hapa'"
        :icon="$hasNotifications ? null : \Filament\Support\Icons\Heroicon::OutlinedBellSlash"
        :icon-alias="
            $hasNotifications
            ? null
            : \Filament\Notifications\View\NotificationsIconAlias::DATABASE_MODAL_EMPTY_STATE
        "
        :icon-color="$hasNotifications ? null : 'gray'"
        id="database-notifications"
        slide-over
        :sticky-header="$hasNotifications"
        teleport="body"
        width="md"
        class="fi-no-database"
        :attributes="
            new \Illuminate\View\ComponentAttributeBag([
                'wire:poll.' . $pollingInterval => $pollingInterval ? '' : false,
            ])
        "
    >
        @if ($trigger = $this->getTrigger())
            <x-slot name="trigger">
                {{ $trigger->with(['unreadNotificationsCount' => $unreadNotificationsCount]) }}
            </x-slot>
        @endif

        @if ($hasNotifications)
            <x-slot name="header">
                <div class="flex flex-col gap-2.5 w-full">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <h2 class="text-base font-bold text-gray-900 dark:text-white">
                                Taarifa na Arifa
                            </h2>
                            @if ($unreadNotificationsCount)
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-primary-100 text-primary-800 dark:bg-primary-900/60 dark:text-primary-300">
                                    {{ $unreadNotificationsCount }} mpya
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 dark:bg-emerald-950/50 dark:text-emerald-300">
                                    Zote zimesomwa
                                </span>
                            @endif
                        </div>

                        @if ($this->clearNotificationsAction?->isVisible())
                            <button
                                type="button"
                                wire:click="clearNotifications"
                                class="text-xs font-medium text-rose-600 hover:text-rose-700 dark:text-rose-400 hover:underline flex items-center gap-1 transition"
                                title="Futa arifa zote"
                            >
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Futa zote
                            </button>
                        @endif
                    </div>

                    @if ($unreadNotificationsCount)
                        <div class="flex items-center justify-between pt-1">
                            <button
                                type="button"
                                wire:click="markAllNotificationsAsRead"
                                class="w-full inline-flex items-center justify-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold bg-primary-600 hover:bg-primary-700 text-white shadow-sm transition active:scale-[0.99]"
                            >
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7m-14 6l4 4L19 7" />
                                </svg>
                                Tia alama zote kuwa zimesomwa
                            </button>
                        </div>
                    @endif
                </div>
            </x-slot>

            <div class="divide-y divide-gray-100 dark:divide-white/5 -mx-6 -my-6">
                @foreach ($notifications as $notification)
                    @php
                        $data = $notification->data;
                        $title = $data['title'] ?? 'Taarifa';
                        $body = $data['body'] ?? '';
                        $icon = $data['icon'] ?? 'heroicon-o-bell';
                        $iconColor = $data['iconColor'] ?? 'primary';
                        $isUnread = $notification->unread();
                        $diffDate = $notification->created_at ? $notification->created_at->diffForHumans() : '';
                        $exactDate = $notification->created_at ? $notification->created_at->format('d M Y, H:i') : '';

                        $colorTheme = match($iconColor) {
                            'success' => [
                                'bg' => 'bg-emerald-50 text-emerald-600 dark:bg-emerald-950/50 dark:text-emerald-400 ring-1 ring-emerald-500/20',
                                'dot' => 'bg-emerald-500',
                            ],
                            'warning' => [
                                'bg' => 'bg-amber-50 text-amber-600 dark:bg-amber-950/50 dark:text-amber-400 ring-1 ring-amber-500/20',
                                'dot' => 'bg-amber-500',
                            ],
                            'danger' => [
                                'bg' => 'bg-rose-50 text-rose-600 dark:bg-rose-950/50 dark:text-rose-400 ring-1 ring-rose-500/20',
                                'dot' => 'bg-rose-500',
                            ],
                            'info' => [
                                'bg' => 'bg-blue-50 text-blue-600 dark:bg-blue-950/50 dark:text-blue-400 ring-1 ring-blue-500/20',
                                'dot' => 'bg-blue-500',
                            ],
                            default => [
                                'bg' => 'bg-primary-50 text-primary-600 dark:bg-primary-950/50 dark:text-primary-400 ring-1 ring-primary-500/20',
                                'dot' => 'bg-primary-500',
                            ],
                        };
                    @endphp

                    <div
                        wire:key="notif-item-{{ $notification->id }}"
                        x-data="{
                            expanded: false,
                            toggle() {
                                this.expanded = !this.expanded;
                                if (this.expanded && {{ $isUnread ? 'true' : 'false' }}) {
                                    $wire.markNotificationAsRead('{{ $notification->id }}');
                                }
                            }
                        }"
                        @class([
                            'group relative flex flex-col p-4 transition-all duration-200 select-none border-b border-gray-100 dark:border-white/5',
                            'bg-primary-50/40 dark:bg-primary-950/20 border-l-4 border-l-primary-600' => $isUnread,
                            'bg-white dark:bg-transparent hover:bg-gray-50/80 dark:hover:bg-white/5 border-l-4 border-l-transparent' => ! $isUnread,
                        ])
                    >
                        <!-- Top Summary Row -->
                        <div
                            class="flex items-start gap-3.5 w-full cursor-pointer"
                            x-on:click="toggle()"
                        >
                            <!-- Icon -->
                            <div class="flex-shrink-0 mt-0.5">
                                <span class="inline-flex items-center justify-center w-9 h-9 rounded-xl {{ $colorTheme['bg'] }}">
                                    <x-filament::icon
                                        :icon="$icon"
                                        class="w-5 h-5"
                                    />
                                </span>
                            </div>

                            <!-- Content Preview -->
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between gap-2 mb-1">
                                    <h3 @class([
                                        'text-sm',
                                        'font-bold text-gray-900 dark:text-white' => $isUnread,
                                        'font-semibold text-gray-800 dark:text-gray-200' => ! $isUnread,
                                    ])>
                                        {{ $title }}
                                    </h3>

                                    @if ($isUnread)
                                        <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider bg-primary-100 text-primary-800 dark:bg-primary-900/70 dark:text-primary-300 flex-shrink-0">
                                            <span class="w-1.5 h-1.5 rounded-full bg-primary-600 animate-pulse"></span>
                                            Mpya
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-medium bg-gray-100 text-gray-500 dark:bg-gray-800 dark:text-gray-400 flex-shrink-0">
                                            Imesomwa
                                        </span>
                                    @endif
                                </div>

                                <!-- Collapsed Preview -->
                                <p
                                    x-show="!expanded"
                                    class="text-xs text-gray-600 dark:text-gray-400 line-clamp-2 leading-relaxed"
                                >
                                    {{ $body }}
                                </p>

                                <div class="mt-2 flex items-center justify-between text-[11px] text-gray-400 dark:text-gray-500">
                                    <span class="flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        {{ $diffDate }}
                                    </span>

                                    <span class="font-semibold text-primary-600 dark:text-primary-400 flex items-center gap-0.5 hover:underline">
                                        <span x-text="expanded ? 'Funga maelezo &uarr;' : 'Bofya kusoma &darr;'"></span>
                                    </span>
                                </div>
                            </div>

                            <!-- Delete Button -->
                            <div class="flex-shrink-0 -mr-1">
                                <button
                                    type="button"
                                    x-on:click.stop="$wire.removeNotification('{{ $notification->id }}')"
                                    class="p-1 text-gray-400 hover:text-rose-600 dark:hover:text-rose-400 rounded-lg hover:bg-gray-100 dark:hover:bg-white/10 transition"
                                    title="Futa taarifa hii"
                                >
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Expanded Full Message Box -->
                        <div
                            x-show="expanded"
                            x-cloak
                            x-collapse
                            class="mt-3 pt-3 border-t border-gray-100 dark:border-white/5 space-y-3"
                        >
                            <div class="p-3.5 rounded-xl bg-gray-50 dark:bg-gray-900/90 shadow-sm border border-gray-200 dark:border-white/10">
                                <div class="text-[11px] font-semibold text-gray-500 dark:text-gray-400 mb-1.5 flex items-center justify-between">
                                    <span class="uppercase tracking-wider">Ujumbe Kamili</span>
                                    <span class="font-normal text-gray-500 dark:text-gray-400">{{ $exactDate }}</span>
                                </div>
                                <p class="text-sm font-medium text-gray-900 dark:text-gray-100 leading-relaxed whitespace-pre-line">
                                    {{ $body }}
                                </p>
                            </div>

                            <div class="flex items-center justify-between pt-1">
                                <div class="flex items-center gap-2">
                                    @if ($isUnread)
                                        <button
                                            type="button"
                                            x-on:click.stop="$wire.markNotificationAsRead('{{ $notification->id }}')"
                                            class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-semibold text-emerald-700 bg-emerald-50 hover:bg-emerald-100 dark:bg-emerald-950/40 dark:text-emerald-300 transition"
                                        >
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                                            </svg>
                                            Weka imesomwa
                                        </button>
                                    @else
                                        <button
                                            type="button"
                                            x-on:click.stop="$wire.markNotificationAsUnread('{{ $notification->id }}')"
                                            class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-semibold text-amber-700 bg-amber-50 hover:bg-amber-100 dark:bg-amber-950/40 dark:text-amber-300 transition"
                                        >
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                            </svg>
                                            Weka kama haijasomwa
                                        </button>
                                    @endif
                                </div>

                                <button
                                    type="button"
                                    x-on:click.stop="expanded = false"
                                    class="px-2.5 py-1 text-xs font-semibold rounded-lg bg-gray-100 hover:bg-gray-200 text-gray-700 dark:bg-white/10 dark:text-gray-200 transition shadow-sm"
                                >
                                    Funga &uarr;
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($broadcastChannel = $this->getBroadcastChannel())
                @script
                    <script>
                        window.addEventListener('EchoLoaded', () => {
                            window.Echo.private(@js($broadcastChannel)).listen(
                                '.database-notifications.sent',
                                () => {
                                    setTimeout(
                                        () => $wire.call('$refresh'),
                                        500,
                                    )
                                },
                            )
                        })

                        if (window.Echo) {
                            window.dispatchEvent(new CustomEvent('EchoLoaded'))
                        }
                    </script>
                @endscript
            @endif

            @if ($isPaginated)
                <x-slot name="footer">
                    <x-filament::pagination :paginator="$notifications" />
                </x-slot>
            @endif
        @endif
    </x-filament::modal>
</div>
