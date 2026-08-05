<x-filament-panels::page>
    <div class="space-y-8">
        {{-- Hero Header --}}
        <div class="relative overflow-hidden rounded-3xl p-7 text-white shadow-xl"
             style="background: linear-gradient(135deg, #13385E 0%, #1e5080 50%, #2E7D32 100%);">
            <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-white/10 blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-24 -left-24 w-72 h-72 rounded-full bg-yellow-400/20 blur-3xl pointer-events-none"></div>
            <div class="relative z-10 flex items-center gap-4">
                <div class="flex-shrink-0 w-9 h-9 rounded-lg bg-white/20 backdrop-blur-md flex items-center justify-center border border-white/30">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-yellow-300" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6zm-1 2l5 5h-5V4zM6 20V4h5v7h7v9H6z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl font-black tracking-tight text-white">Ripoti Zangu (Progress Reports)</h2>
                    <p class="mt-1 text-sm text-blue-100 max-w-2xl">Upload your school report cards and academic documents here. Keep your sponsors updated on your educational journey!</p>
                </div>
            </div>
        </div>

        @php $student = $this->getStudent(); @endphp

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Left Column: Uploaded Documents --}}
            <div class="lg:col-span-2 space-y-4">
                <div class="flex items-center gap-2">
                    <span class="inline-flex items-center justify-center w-6 h-6 rounded bg-blue-100 dark:bg-blue-900/40">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-blue-600 dark:text-blue-400" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M10 4H4a2 2 0 00-2 2v12a2 2 0 002 2h16a2 2 0 002-2V8a2 2 0 00-2-2h-8l-2-2z"/>
                        </svg>
                    </span>
                    <h3 class="text-base font-bold text-gray-900 dark:text-white">Uploaded Documents</h3>
                </div>

                @if($student && !empty($student->documents) && count(array_filter($student->documents, 'is_string')) > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        @foreach($student->documents as $doc)
                            @if(is_string($doc))
                                <a href="{{ Storage::url($doc) }}" target="_blank"
                                   class="group relative overflow-hidden flex items-center gap-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 p-3.5 shadow-sm transition-all hover:shadow-md hover:-translate-y-0.5 hover:border-blue-400">
                                    <span class="flex-shrink-0 inline-flex items-center justify-center w-8 h-8 rounded-lg bg-blue-50 dark:bg-blue-900/20 group-hover:bg-blue-100 dark:group-hover:bg-blue-800/40 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-blue-600 dark:text-blue-400" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6zm-1 2l5 5h-5V4zM6 20V4h5v7h7v9H6zm7-3H9v-2h4v2zm2-4H9v-2h6v2z"/>
                                        </svg>
                                    </span>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-xs font-semibold text-gray-800 dark:text-white truncate group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors" title="{{ basename($doc) }}">{{ basename($doc) }}</p>
                                        <p class="text-[11px] text-gray-400 mt-0.5">Click to view / download</p>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-gray-300 group-hover:text-blue-400 transition-colors flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                    </svg>
                                    <div class="absolute bottom-0 left-0 h-0.5 w-0 bg-blue-500 transition-all duration-300 group-hover:w-full"></div>
                                </a>
                            @endif
                        @endforeach
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center rounded-2xl border-2 border-dashed border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50 py-12 px-6 text-center">
                        <div class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white dark:bg-gray-800 shadow mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-300" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6zm-1 2l5 5h-5V4zM8 16l2.5-3 1.5 2 2-2.5L17 16H8z"/>
                            </svg>
                        </div>
                        <h4 class="text-sm font-bold text-gray-700 dark:text-gray-200">No documents found</h4>
                        <p class="text-xs text-gray-400 dark:text-gray-500 mt-1 max-w-xs">You haven't uploaded any progress reports yet. Use the form to upload your first document.</p>
                    </div>
                @endif
            </div>

            {{-- Right Column: Upload Form --}}
            <div class="lg:col-span-1 space-y-4">
                <div class="flex items-center gap-2">
                    <span class="inline-flex items-center justify-center w-6 h-6 rounded bg-green-100 dark:bg-green-900/40">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-green-600 dark:text-green-400" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M19.35 10.04A7.49 7.49 0 0012 4a7.5 7.5 0 00-7.35 6.04A5.5 5.5 0 005.5 21H19a4.5 4.5 0 00.35-10.96zM14 13v4h-4v-4H7l5-5 5 5h-3z"/>
                        </svg>
                    </span>
                    <h3 class="text-base font-bold text-gray-900 dark:text-white">Upload New</h3>
                </div>

                <div class="rounded-2xl border border-gray-100 dark:border-gray-700 bg-white dark:bg-gray-800 p-5 shadow-lg relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-28 h-28 bg-green-50 dark:bg-green-900/10 rounded-full blur-3xl -mr-14 -mt-14 pointer-events-none"></div>
                    <form wire:submit="save" class="relative z-10 space-y-4">
                        {{ $this->form }}
                        <button type="submit"
                            class="w-full inline-flex items-center justify-center gap-1.5 px-4 py-2.5 rounded-lg text-sm font-semibold text-white shadow transition-all hover:opacity-90 hover:shadow-md active:scale-95"
                            style="background-color: #2E7D32;">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                            </svg>
                            Save Progress Reports
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-filament-panels::page>
