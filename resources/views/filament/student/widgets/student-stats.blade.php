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
                'desc'    => $student->education_level . ' · ' . $student->school,
                'color'   => $student->status === 'Active' ? 'green' : ($student->status === 'Graduated' ? 'blue' : 'red'),
                'icon'    => 'heroicon-m-academic-cap',
            ],
            [
                'label'   => 'Miradi Inayonisaidia',
                'value'   => (string)$activeProjects,
                'desc'    => 'Miradi ya elimu inayoniunga mkono',
                'color'   => 'blue',
                'icon'    => 'heroicon-m-folder-open',
            ],
            [
                'label'   => 'Maombi Yanayosubiri',
                'value'   => (string)$pendingApplications,
                'desc'    => 'Yanapitiwa na wafanyakazi',
                'color'   => 'yellow',
                'icon'    => 'heroicon-m-clock',
            ],
            [
                'label'   => 'Maombi Yaliyoidhinishwa',
                'value'   => (string)$approvedApplications,
                'desc'    => $totalApplications . ' jumla ya maombi',
                'color'   => 'green',
                'icon'    => 'heroicon-m-check-badge',
            ],
        ] : [];

        $colorMap = [
            'green'  => ['bg' => 'bg-green-50 dark:bg-green-900/20',  'icon' => 'text-green-600 dark:text-green-400',  'value' => 'text-green-700 dark:text-green-300'],
            'blue'   => ['bg' => 'bg-blue-50 dark:bg-blue-900/20',    'icon' => 'text-blue-600 dark:text-blue-400',    'value' => 'text-blue-700 dark:text-blue-300'],
            'yellow' => ['bg' => 'bg-yellow-50 dark:bg-yellow-900/20','icon' => 'text-yellow-600 dark:text-yellow-400','value' => 'text-yellow-700 dark:text-yellow-300'],
            'red'    => ['bg' => 'bg-red-50 dark:bg-red-900/20',      'icon' => 'text-red-600 dark:text-red-400',      'value' => 'text-red-700 dark:text-red-300'],
        ];
    @endphp

    @if(!$student)
        <div class="rounded-xl border border-red-200 dark:border-red-900/40 bg-red-50 dark:bg-red-900/20 p-4 text-sm text-red-700 dark:text-red-300">
            Akaunti haijakamilika. Wasiliana na wafanyakazi wa HFST.
        </div>
    @else
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach($stats as $stat)
                @php $c = $colorMap[$stat['color']]; @endphp
                <div class="rounded-2xl border border-gray-100 dark:border-white/10 bg-white dark:bg-gray-900 p-5 shadow-sm hover:-translate-y-1 hover:shadow-lg transition-all duration-200">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg {{ $c['bg'] }} flex-shrink-0">
                            <x-dynamic-component :component="$stat['icon']" class="w-4 h-4 {{ $c['icon'] }}" />
                        </span>
                        <span class="text-xs font-medium text-gray-500 dark:text-gray-400 leading-tight">{{ $stat['label'] }}</span>
                    </div>
                    <div class="text-2xl font-black tracking-tight {{ $c['value'] }} mb-1">
                        {{ $stat['value'] }}
                    </div>
                    <p class="text-[11px] text-gray-400 dark:text-gray-500 leading-snug truncate" title="{{ $stat['desc'] }}">
                        {{ $stat['desc'] }}
                    </p>
                </div>
            @endforeach
        </div>
    @endif
</x-filament-widgets::widget>
