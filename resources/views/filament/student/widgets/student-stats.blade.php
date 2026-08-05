<x-filament-widgets::widget>
    @php
        $student = auth()->user()->student;
        $activeProjects = $student?->projects()->where('project_student.status', 'Active')->count() ?? 0;
        $pendingApplications = $student ? \App\Models\AidApplication::where('student_id', $student->id)->where('status', 'Pending')->count() : 0;
        $approvedApplications = $student ? \App\Models\AidApplication::where('student_id', $student->id)->where('status', 'Approved')->count() : 0;
        $totalApplications = $student ? \App\Models\AidApplication::where('student_id', $student->id)->count() : 0;

        $stats = $student ? [
            [
                'label'   => 'Hali Yangu',
                'value'   => $student->status,
                'desc'    => 'Darasa: ' . $student->education_level . ' · ' . $student->school,
                'color'   => $student->status === 'Active' ? 'green' : ($student->status === 'Graduated' ? 'blue' : 'red'),
                'icon_path' => 'M12 14l9-5-9-5-9 5 9 5z M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z',
            ],
            [
                'label'   => 'Miradi Inayonisaidia',
                'value'   => (string)$activeProjects,
                'desc'    => 'Miradi ya elimu inayoniunga mkono',
                'color'   => 'blue',
                'icon_path' => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4',
            ],
            [
                'label'   => 'Maombi Yanayosubiri',
                'value'   => (string)$pendingApplications,
                'desc'    => 'Yanapitiwa na wafanyakazi',
                'color'   => 'yellow',
                'icon_path' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
            ],
            [
                'label'   => 'Maombi Yaliyoidhinishwa',
                'value'   => (string)$approvedApplications,
                'desc'    => $totalApplications . ' jumla ya maombi',
                'color'   => 'green',
                'icon_path' => 'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z',
            ],
        ] : [];

        $colorMap = [
            'green'  => ['bg' => 'bg-green-50 dark:bg-green-900/20',  'icon' => 'text-green-600 dark:text-green-400',  'badge' => 'bg-green-100 text-green-700 dark:bg-green-900/40 dark:text-green-300',  'value' => 'text-green-700 dark:text-green-300'],
            'blue'   => ['bg' => 'bg-blue-50 dark:bg-blue-900/20',    'icon' => 'text-blue-600 dark:text-blue-400',    'badge' => 'bg-blue-100 text-blue-700 dark:bg-blue-900/40 dark:text-blue-300',    'value' => 'text-blue-700 dark:text-blue-300'],
            'yellow' => ['bg' => 'bg-yellow-50 dark:bg-yellow-900/20','icon' => 'text-yellow-600 dark:text-yellow-400','badge' => 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/40 dark:text-yellow-300','value' => 'text-yellow-700 dark:text-yellow-300'],
            'red'    => ['bg' => 'bg-red-50 dark:bg-red-900/20',      'icon' => 'text-red-600 dark:text-red-400',      'badge' => 'bg-red-100 text-red-700 dark:bg-red-900/40 dark:text-red-300',      'value' => 'text-red-700 dark:text-red-300'],
        ];
    @endphp

    @if(!$student)
        <div class="rounded-xl border border-red-200 dark:border-red-900/40 bg-red-50 dark:bg-red-900/20 p-4 text-sm text-red-700 dark:text-red-300">
            Akaunti haijakamilika. Wasiliana na wafanyakazi wa HFST.
        </div>
    @else
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3">
            @foreach($stats as $stat)
                @php $c = $colorMap[$stat['color']]; @endphp
                <div class="rounded-xl border border-gray-100 dark:border-white/10 bg-white dark:bg-gray-900 p-4 shadow-sm hover:-translate-y-0.5 hover:shadow-md transition-all duration-200">
                    {{-- Icon + Label row --}}
                    <div class="flex items-center gap-2 mb-3">
                        <span class="inline-flex items-center justify-center w-4 h-4 rounded-lg {{ $c['bg'] }} flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-2.5 h-2.5 {{ $c['icon'] }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $stat['icon_path'] }}" />
                            </svg>
                        </span>
                        <span class="text-xs font-medium text-gray-500 dark:text-gray-400 leading-tight">{{ $stat['label'] }}</span>
                    </div>
                    {{-- Value --}}
                    <div class="text-2xl font-black tracking-tight {{ $c['value'] }} mb-1">
                        {{ $stat['value'] }}
                    </div>
                    {{-- Description --}}
                    <p class="text-[11px] text-gray-400 dark:text-gray-500 leading-snug truncate" title="{{ $stat['desc'] }}">
                        {{ $stat['desc'] }}
                    </p>
                </div>
            @endforeach
        </div>
    @endif
</x-filament-widgets::widget>
