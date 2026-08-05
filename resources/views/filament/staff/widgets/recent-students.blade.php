<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            <div class="flex items-center gap-2">
                <x-heroicon-o-users class="w-5 h-5 text-primary-500" />
                <span>Wanafunzi Waliojisajili Hivi Karibuni</span>
            </div>
        </x-slot>
        <x-slot name="headerEnd">
            <a href="/staff/students/create" class="text-xs font-semibold text-primary-600 hover:underline">+ Sajili Mpya</a>
        </x-slot>

        <div class="divide-y divide-gray-100 dark:divide-white/5">
            @forelse($this->getRecentStudents() as $student)
                <div class="flex items-center gap-4 py-3">
                    {{-- Avatar initials --}}
                    <div class="w-10 h-10 rounded-full flex items-center justify-center text-white font-bold text-sm flex-shrink-0"
                         style="background: linear-gradient(135deg, #13385E, #2E7D32);">
                        {{ strtoupper(substr($student->first_name, 0, 1) . substr($student->last_name, 0, 1)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-gray-900 dark:text-white truncate">
                            {{ $student->first_name }} {{ $student->last_name }}
                        </p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 truncate">
                            {{ $student->school }} · {{ $student->education_level }}
                        </p>
                    </div>
                    <span class="px-2 py-0.5 rounded-full text-xs font-semibold
                        {{ $student->status === 'Active' ? 'bg-green-100 text-green-700 dark:bg-green-900/40 dark:text-green-400' : ($student->status === 'Graduated' ? 'bg-blue-100 text-blue-700 dark:bg-blue-900/40 dark:text-blue-400' : 'bg-red-100 text-red-700 dark:bg-red-900/40 dark:text-red-400') }}">
                        {{ $student->status }}
                    </span>
                </div>
            @empty
                <div class="text-center py-10 text-gray-400">
                    <x-heroicon-o-user-plus class="w-10 h-10 mx-auto mb-2 opacity-40" />
                    <p class="text-sm">Hakuna wanafunzi bado. Sajili wa kwanza!</p>
                    <a href="/staff/students/create" class="mt-2 inline-block text-xs font-bold text-primary-600 hover:underline">Sajili Mwanafunzi</a>
                </div>
            @endforelse
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
