<x-filament-widgets::widget>
    <div class="rounded-2xl overflow-hidden shadow-sm border border-gray-100 dark:border-white/10">
        {{-- Header --}}
        <div class="px-5 py-4 flex items-center justify-between"
             style="background: linear-gradient(135deg, #1e5080, #13385E);">
            <div class="flex items-center gap-2.5">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center" style="background: rgba(246,178,25,0.2);">
                    <x-heroicon-o-users class="w-5 h-5 text-yellow-300" />
                </div>
                <div>
                    <h3 class="text-base font-bold text-white">Wanafunzi Hivi Karibuni</h3>
                    <p class="text-xs text-blue-200">Waliojisajili hivi karibuni</p>
                </div>
            </div>
            <a href="/teacher/students/create" class="text-xs font-bold px-3 py-1.5 rounded-lg transition-all hover:scale-105" style="background: #F6B219; color: #13385E;">
                + Sajili Mpya
            </a>
        </div>

        {{-- Body --}}
        <div class="p-4 bg-white dark:bg-gray-900">
            <div class="divide-y divide-gray-50 dark:divide-white/5">
                @forelse($this->getRecentStudents() as $student)
                    <div class="flex items-center gap-4 py-3 first:pt-0 last:pb-0">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center text-white font-bold text-sm flex-shrink-0 shadow-sm"
                             style="background: linear-gradient(135deg, #1e5080, #2E7D32);">
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
                        <span class="px-2.5 py-1 rounded-full text-xs font-bold flex-shrink-0
                            {{ $student->status === 'Active' ? 'bg-green-100 text-green-700 dark:bg-green-900/40 dark:text-green-400' : ($student->status === 'Graduated' ? 'bg-blue-100 text-blue-700 dark:bg-blue-900/40 dark:text-blue-400' : 'bg-red-100 text-red-700 dark:bg-red-900/40 dark:text-red-400') }}">
                            {{ $student->status }}
                        </span>
                    </div>
                @empty
                    <div class="text-center py-10 text-gray-400">
                        <x-heroicon-o-user-plus class="w-12 h-12 mx-auto mb-3 opacity-30" />
                        <p class="text-sm font-medium">Hakuna wanafunzi bado.</p>
                        <a href="/teacher/students/create" class="mt-3 inline-block text-xs font-bold text-primary-600 hover:underline">Sajili Mwanafunzi</a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-filament-widgets::widget>
