<x-filament-panels::page>
    <div class="space-y-6">
        {{-- Header --}}
        <div class="rounded-xl bg-gradient-to-r from-indigo-600 to-purple-700 p-6 text-white">
            <h2 class="text-xl font-bold">🎓 Students You Are Supporting</h2>
            <p class="mt-1 text-indigo-100">These are the students whose education you have helped fund through your confirmed donations.</p>
        </div>

        @php $students = $this->getSponsoredStudents(); @endphp

        @if($students->isEmpty())
            <div class="rounded-lg border border-dashed border-gray-300 p-12 text-center dark:border-gray-600">
                <div class="text-5xl">🎒</div>
                <p class="mt-4 text-lg font-medium text-gray-600 dark:text-gray-400">No sponsored students yet</p>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-500">When you donate to a specific student, they will appear here.</p>
            </div>
        @else
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($students as $student)
                    <div class="rounded-lg border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                        <div class="flex items-start gap-3">
                            <div class="flex h-12 w-12 items-center justify-center rounded-full bg-indigo-100 text-2xl dark:bg-indigo-900">
                                {{ $student->gender === 'Female' ? '👧' : '👦' }}
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 dark:text-white">
                                    {{ $student->first_name }} {{ $student->last_name }}
                                </h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $student->school }}</p>
                                <span class="mt-1 inline-block rounded-full px-2 py-0.5 text-xs font-medium
                                    {{ $student->status === 'Active' ? 'bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-300' : 'bg-gray-100 text-gray-600' }}">
                                    {{ $student->status }} • {{ $student->education_level }}
                                </span>
                            </div>
                        </div>

                        @if($student->progress_notes)
                            <div class="mt-4 rounded border-l-4 border-indigo-400 bg-indigo-50 p-3 dark:bg-indigo-900/20">
                                <p class="text-xs font-semibold text-indigo-700 dark:text-indigo-300">Latest Progress Notes:</p>
                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">{{ $student->progress_notes }}</p>
                            </div>
                        @else
                            <p class="mt-3 text-sm italic text-gray-400">No progress notes yet.</p>
                        @endif

                        @if(!empty($student->documents))
                            <div class="mt-3">
                                <p class="text-xs font-semibold text-gray-700 dark:text-gray-300">Progress Reports (Nyaraka):</p>
                                <div class="mt-1 flex flex-wrap gap-2">
                                @foreach((array) $student->documents as $doc)
                                    <a href="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($doc) }}" target="_blank" class="inline-flex items-center gap-1 rounded bg-gray-100 px-2 py-1 text-xs font-medium text-gray-700 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                                        📄 View Doc
                                    </a>
                                @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-filament-panels::page>
