@extends('layouts.app')

@section('title', (app()->getLocale() === 'sw' ? 'Shule Zinazoshirikiana Nasi' : 'Partner Schools Network') . ' — Hope for Students Tanzania')
@section('description', 'Discover our network of partner primary, secondary, high schools, and vocational colleges across Tanzania where HFST sponsors vulnerable students.')

@section('content')

{{-- ======================================================
     1. HERO SECTION WITH MODERN GRADIENT & BADGE
====================================================== --}}
<div class="relative overflow-hidden" style="background: linear-gradient(135deg, var(--brand-blue-dark) 0%, var(--brand-blue) 60%, var(--brand-blue-light) 100%);">
    <div class="absolute inset-0" style="background: radial-gradient(ellipse at 80% 20%, rgba(246,178,25,0.18) 0%, transparent 55%), radial-gradient(ellipse at 20% 80%, rgba(46,125,50,0.25) 0%, transparent 55%);"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24 text-center text-white">
        <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider mb-4 shadow-sm"
              style="background: rgba(246,178,25,0.22); color: var(--brand-yellow); border: 1px solid rgba(246,178,25,0.4);">
            <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
            <span>🏫 {{ app()->getLocale() === 'sw' ? 'Mtandao wa Elimu Tanzania' : 'Tanzania Educational Network' }}</span>
        </span>
        <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-tight">
            {{ app()->getLocale() === 'sw' ? 'Shule Zinazoshirikiana Nasi' : 'Our Partner Schools' }}
        </h1>
        <p class="mt-4 text-base sm:text-lg text-blue-100 max-w-3xl mx-auto leading-relaxed">
            {{ app()->getLocale() === 'sw' 
                ? 'Tunashirikiana bega kwa bega na walimu wakuu na uongozi wa shule za msingi, sekondari, na vyuo kufuatilia mahudhurio, maendeleo ya kitaaluma na ustawi wa wanafunzi wanaofadhiliwa.' 
                : 'Collaborating directly with headteachers and administrators across primary, secondary, and vocational institutions to track student attendance, academic excellence, and welfare.' }}
        </p>
    </div>
</div>

{{-- ======================================================
     2. MAIN CONTENT WITH ALPINE SEARCH & FILTER
====================================================== --}}
<div class="py-16 sm:py-20" style="background: var(--surface-bg);" 
     x-data="{ 
         search: '', 
         level: 'all',
         matches(school) {
             const searchLower = this.search.toLowerCase().trim();
             const matchesSearch = !searchLower || 
                 school.name.toLowerCase().includes(searchLower) ||
                 school.region.toLowerCase().includes(searchLower) ||
                 school.district.toLowerCase().includes(searchLower) ||
                 school.code.toLowerCase().includes(searchLower);
             const matchesLevel = this.level === 'all' || school.level.toLowerCase() === this.level.toLowerCase();
             return matchesSearch && matchesLevel;
         }
     }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Stats Overview Bar --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-12">
            <div class="rounded-3xl p-5 sm:p-6 border border-slate-200/80 dark:border-white/10 shadow-sm transition-all hover:shadow-md hover:-translate-y-1" 
                 style="background: var(--surface-card);">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                        {{ app()->getLocale() === 'sw' ? 'Shule Washirika' : 'Partner Schools' }}
                    </span>
                    <span class="w-8 h-8 rounded-xl bg-blue-50 dark:bg-blue-950/50 text-blue-600 flex items-center justify-center text-sm font-bold">🏫</span>
                </div>
                <div class="text-2xl sm:text-3xl font-black text-blue-600 dark:text-blue-400">{{ $schools->count() }}</div>
                <div class="text-xs text-slate-500 dark:text-slate-400 mt-1">
                    {{ app()->getLocale() === 'sw' ? 'Zinazofanya kazi na HFST' : 'Active institutions' }}
                </div>
            </div>

            <div class="rounded-3xl p-5 sm:p-6 border border-slate-200/80 dark:border-white/10 shadow-sm transition-all hover:shadow-md hover:-translate-y-1" 
                 style="background: var(--surface-card);">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                        {{ app()->getLocale() === 'sw' ? 'Wanafunzi Wanaosaidiwa' : 'Sponsored Students' }}
                    </span>
                    <span class="w-8 h-8 rounded-xl bg-emerald-50 dark:bg-emerald-950/50 text-emerald-600 flex items-center justify-center text-sm font-bold">🎓</span>
                </div>
                <div class="text-2xl sm:text-3xl font-black text-emerald-600 dark:text-emerald-400">
                    {{ $schools->sum('students_count') > 0 ? $schools->sum('students_count') : '25+' }}
                </div>
                <div class="text-xs text-slate-500 dark:text-slate-400 mt-1">
                    {{ app()->getLocale() === 'sw' ? 'Wamepewa karo & vifaa' : 'Enrolled in classes' }}
                </div>
            </div>

            <div class="rounded-3xl p-5 sm:p-6 border border-slate-200/80 dark:border-white/10 shadow-sm transition-all hover:shadow-md hover:-translate-y-1" 
                 style="background: var(--surface-card);">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                        {{ app()->getLocale() === 'sw' ? 'Mikoa Inayofikiwa' : 'Regions Covered' }}
                    </span>
                    <span class="w-8 h-8 rounded-xl bg-amber-50 dark:bg-amber-950/50 text-amber-600 flex items-center justify-center text-sm font-bold">📍</span>
                </div>
                <div class="text-2xl sm:text-3xl font-black text-amber-500">
                    {{ $schools->pluck('region')->unique()->count() }}
                </div>
                <div class="text-xs text-slate-500 dark:text-slate-400 mt-1">
                    {{ $schools->pluck('region')->unique()->join(', ') }}
                </div>
            </div>

            <div class="rounded-3xl p-5 sm:p-6 border border-slate-200/80 dark:border-white/10 shadow-sm transition-all hover:shadow-md hover:-translate-y-1" 
                 style="background: var(--surface-card);">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                        {{ app()->getLocale() === 'sw' ? 'Uwazi & Ufuatiliaji' : 'Monitoring Rate' }}
                    </span>
                    <span class="w-8 h-8 rounded-xl bg-purple-50 dark:bg-purple-950/50 text-purple-600 flex items-center justify-center text-sm font-bold">📊</span>
                </div>
                <div class="text-2xl sm:text-3xl font-black text-purple-600 dark:text-purple-400">100%</div>
                <div class="text-xs text-slate-500 dark:text-slate-400 mt-1">
                    {{ app()->getLocale() === 'sw' ? 'Ripoti za mara kwa mara' : 'Quarterly audit & grades' }}
                </div>
            </div>
        </div>

        {{-- Filter & Search Toolbar --}}
        <div class="rounded-3xl p-4 sm:p-6 mb-10 border border-slate-200/80 dark:border-white/10 shadow-sm"
             style="background: var(--surface-card);">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                
                {{-- Search Box --}}
                <div class="relative flex-1 max-w-md">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </span>
                    <input type="text" 
                           x-model="search"
                           placeholder="{{ app()->getLocale() === 'sw' ? 'Tafuta kwa jina la shule, mkoa au wilaya...' : 'Search by school name, region or district...' }}"
                           class="w-full pl-10 pr-4 py-2.5 rounded-2xl text-sm bg-slate-100 dark:bg-white/5 border border-slate-200/80 dark:border-white/10 text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-600 transition-all">
                    <button x-show="search.length > 0" 
                            @click="search = ''" 
                            class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 dark:hover:text-white text-xs font-bold"
                            style="display: none;">
                        ✕
                    </button>
                </div>

                {{-- Education Level Filter Buttons --}}
                <div class="flex flex-wrap items-center gap-2">
                    <button @click="level = 'all'"
                            :class="level === 'all' 
                                ? 'bg-blue-600 text-white shadow-sm' 
                                : 'bg-slate-100 dark:bg-white/5 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-white/10'"
                            class="px-3.5 py-1.5 rounded-xl text-xs font-bold transition-all">
                        {{ app()->getLocale() === 'sw' ? 'Zote' : 'All' }} ({{ $schools->count() }})
                    </button>
                    <button @click="level = 'primary'"
                            :class="level === 'primary' 
                                ? 'bg-blue-600 text-white shadow-sm' 
                                : 'bg-slate-100 dark:bg-white/5 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-white/10'"
                            class="px-3.5 py-1.5 rounded-xl text-xs font-bold transition-all">
                        {{ app()->getLocale() === 'sw' ? 'Msingi' : 'Primary' }}
                    </button>
                    <button @click="level = 'secondary'"
                            :class="level === 'secondary' 
                                ? 'bg-blue-600 text-white shadow-sm' 
                                : 'bg-slate-100 dark:bg-white/5 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-white/10'"
                            class="px-3.5 py-1.5 rounded-xl text-xs font-bold transition-all">
                        {{ app()->getLocale() === 'sw' ? 'Sekondari' : 'Secondary' }}
                    </button>
                    <button @click="level = 'high school'"
                            :class="level === 'high school' 
                                ? 'bg-blue-600 text-white shadow-sm' 
                                : 'bg-slate-100 dark:bg-white/5 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-white/10'"
                            class="px-3.5 py-1.5 rounded-xl text-xs font-bold transition-all">
                        {{ app()->getLocale() === 'sw' ? 'Kidato cha 5 & 6' : 'High School' }}
                    </button>
                    <button @click="level = 'vocational'"
                            :class="level === 'vocational' 
                                ? 'bg-blue-600 text-white shadow-sm' 
                                : 'bg-slate-100 dark:bg-white/5 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-white/10'"
                            class="px-3.5 py-1.5 rounded-xl text-xs font-bold transition-all">
                        {{ app()->getLocale() === 'sw' ? 'Ufundi / VETA' : 'Vocational' }}
                    </button>
                </div>

            </div>
        </div>

        {{-- ======================================================
             3. SCHOOLS GRID (3-COLUMN RESPONSIVE LAYOUT)
        ====================================================== --}}
        <div class="grid gap-6 sm:gap-8 sm:grid-cols-2 lg:grid-cols-3">
            @forelse($schools as $school)
            @php
                $schoolImages = ['hope2.jpeg', 'meet.jpeg', 'hope.jpeg', 'new.jpeg'];
                $schoolImg = $schoolImages[$loop->index % count($schoolImages)];
                $activeCount = $school->students_count;
                
                // Color badges per level
                $levelColors = [
                    'Primary'     => 'bg-sky-500 text-white',
                    'Secondary'   => 'bg-amber-500 text-slate-950 font-black',
                    'High School' => 'bg-purple-600 text-white',
                    'Vocational'  => 'bg-emerald-600 text-white',
                    'College'     => 'bg-indigo-600 text-white',
                    'University'  => 'bg-rose-600 text-white',
                ];
                $levelBadgeClass = $levelColors[$school->education_level] ?? 'bg-slate-800 text-white';
            @endphp
            <div x-show="matches({
                    name: '{{ addslashes($school->name) }}',
                    region: '{{ addslashes($school->region ?? '') }}',
                    district: '{{ addslashes($school->district ?? '') }}',
                    code: '{{ addslashes($school->code) }}',
                    level: '{{ addslashes($school->education_level) }}'
                 })"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 class="rounded-3xl overflow-hidden flex flex-col border border-slate-200/80 dark:border-white/10 transition-all duration-500 hover:shadow-2xl hover:-translate-y-2 group shadow-sm"
                 style="background: var(--surface-card);">
                
                {{-- Banner Image with Overlays --}}
                <div class="h-48 w-full overflow-hidden relative">
                    <img src="{{ $school->image_url ?? asset('images/' . $schoolImg) }}" 
                         alt="{{ $school->name }}" 
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-slate-950/30 to-transparent"></div>
                    
                    {{-- Verified Partner Tag --}}
                    <div class="absolute top-3.5 left-3.5">
                        <span class="px-3 py-1 rounded-full text-[10px] font-extrabold text-white bg-emerald-600/90 backdrop-blur-md flex items-center gap-1.5 shadow-sm border border-emerald-400/30">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span>{{ app()->getLocale() === 'sw' ? 'Mshirika Rasmi' : 'Verified Partner' }}</span>
                        </span>
                    </div>

                    {{-- Level Tag --}}
                    <div class="absolute top-3.5 right-3.5">
                        <span class="px-3 py-1 rounded-full text-[11px] font-bold shadow-sm {{ $levelBadgeClass }}">
                            {{ $school->education_level }}
                        </span>
                    </div>

                    {{-- Location & Code overlay --}}
                    <div class="absolute bottom-3 left-4 right-4 flex items-center justify-between text-white">
                        <span class="text-xs font-semibold text-slate-200 flex items-center gap-1.5 drop-shadow-sm">
                            <span>📍</span>
                            <span>{{ $school->district ?? $school->region }}, {{ $school->region }}</span>
                        </span>
                        <span class="text-[11px] font-mono font-bold bg-slate-900/80 backdrop-blur-md text-amber-300 px-2 py-0.5 rounded-md border border-white/10">
                            {{ $school->code }}
                        </span>
                    </div>
                </div>

                {{-- Card Body --}}
                <div class="p-6 flex-1 flex flex-col justify-between">
                    <div>
                        {{-- Title --}}
                        <h3 class="text-xl font-black text-slate-900 dark:text-white leading-snug mb-2 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                            {{ $school->name }}
                        </h3>

                        {{-- Description --}}
                        <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 leading-relaxed line-clamp-2 mb-5">
                            {{ $school->notes ?? ($school->ward ? 'Shule ya kata ya ' . $school->ward . ' inayosaidia watoto wa mazingira magumu.' : 'Shule washirika inayosaidiwa na Hope for Students Tanzania.') }}
                        </p>

                        {{-- Key Metadata Box --}}
                        <div class="rounded-2xl p-4 bg-slate-50 dark:bg-white/5 border border-slate-100 dark:border-white/5 space-y-2.5 text-xs text-slate-600 dark:text-slate-300 mb-5">
                            @if($school->contact_person)
                            <div class="flex items-center gap-2">
                                <span class="text-slate-400">👤</span>
                                <span class="font-medium text-slate-700 dark:text-slate-200 truncate">{{ $school->contact_person }}</span>
                            </div>
                            @endif

                            @if($school->contact_phone)
                            <div class="flex items-center gap-2">
                                <span class="text-slate-400">📞</span>
                                <a href="tel:{{ $school->contact_phone }}" class="hover:text-blue-600 transition-colors font-medium">
                                    {{ $school->contact_phone }}
                                </a>
                            </div>
                            @endif

                            <div class="flex items-center justify-between pt-1 border-t border-slate-200/50 dark:border-white/5 text-[11px]">
                                <span class="text-slate-500 dark:text-slate-400">
                                    {{ app()->getLocale() === 'sw' ? 'Uwezo wa Wanafunzi' : 'Target Capacity' }}:
                                </span>
                                <span class="font-bold text-slate-800 dark:text-slate-200">
                                    {{ $school->student_capacity }} {{ app()->getLocale() === 'sw' ? 'Wanafunzi' : 'Students' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- Card Footer --}}
                    <div class="pt-4 border-t border-slate-100 dark:border-white/5 flex items-center justify-between">
                        <div class="flex items-center gap-2 text-xs font-bold {{ $activeCount > 0 ? 'text-emerald-600 dark:text-emerald-400' : 'text-slate-500' }}">
                            <span class="w-2.5 h-2.5 rounded-full {{ $activeCount > 0 ? 'bg-emerald-500 animate-pulse' : 'bg-slate-400' }}"></span>
                            <span>{{ $activeCount }} {{ app()->getLocale() === 'sw' ? 'Wanaofadhiliwa' : 'Sponsored' }}</span>
                        </div>

                        <a href="{{ route('donate') }}"
                           class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-bold text-white transition-all shadow-xs hover:shadow-md hover:scale-105"
                           style="background: var(--brand-blue);">
                            <span>{{ app()->getLocale() === 'sw' ? 'Fadhili Shule' : 'Support' }}</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </a>
                    </div>
                </div>

            </div>
            @empty
            <div class="col-span-3 text-center py-16 text-slate-400">
                <div class="text-5xl mb-3">🏫</div>
                <p class="text-base font-bold">{{ app()->getLocale() === 'sw' ? 'Hakuna shule zilizoorodheshwa kwa sasa.' : 'No partner schools listed at the moment.' }}</p>
            </div>
            @endforelse
        </div>

        {{-- No Results State for Filter --}}
        <div x-cloak 
             x-show="search.length > 0 && Array.from($el.parentElement.querySelectorAll('[x-show]')).every(el => el.style.display === 'none')" 
             class="text-center py-16 text-slate-500">
            <div class="text-5xl mb-4">🔍</div>
            <h4 class="text-lg font-bold text-slate-800 dark:text-white mb-2">
                {{ app()->getLocale() === 'sw' ? 'Hakuna shule iliyopatikana' : 'No schools found' }}
            </h4>
            <p class="text-xs sm:text-sm text-slate-500 mb-6">
                {{ app()->getLocale() === 'sw' ? 'Jaribu kutafuta kwa neno lingine au badilisha kichujio cha ngazi ya elimu.' : 'Try adjusting your search query or clear the filter.' }}
            </p>
            <button @click="search = ''; level = 'all'" 
                    class="px-5 py-2.5 rounded-xl font-bold text-xs text-white bg-blue-600 hover:bg-blue-700 transition-all shadow-sm">
                {{ app()->getLocale() === 'sw' ? 'Onyesha Shule Zote' : 'Show All Schools' }}
            </button>
        </div>

        {{-- ======================================================
             4. BOTTOM CALL TO ACTION
        ====================================================== --}}
        <div class="mt-20 rounded-3xl p-8 sm:p-12 text-center text-white relative overflow-hidden shadow-2xl"
             style="background: linear-gradient(135deg, var(--brand-blue-dark), var(--brand-green));">
            <div class="absolute -top-24 -right-24 w-72 h-72 rounded-full bg-white/5 pointer-events-none"></div>
            <div class="absolute -bottom-24 -left-24 w-72 h-72 rounded-full bg-white/5 pointer-events-none"></div>
            
            <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider text-amber-300 bg-amber-400/20 border border-amber-300/30 mb-4">
                🤝 {{ app()->getLocale() === 'sw' ? 'Ushirikiano wa Kielimu' : 'Educational Partnerships' }}
            </span>
            <h2 class="text-2xl sm:text-4xl font-black mb-4 leading-tight">
                {{ app()->getLocale() === 'sw' ? 'Je, ungependa shule yako iwe mshirika wetu?' : 'Would you like your school to partner with HFST?' }}
            </h2>
            <p class="text-sm sm:text-base text-blue-100 max-w-2xl mx-auto mb-8 leading-relaxed">
                {{ app()->getLocale() === 'sw' 
                    ? 'Tunawakaribisha wakuu wa shule, walimu wa taaluma, na kamati za shule kujiunga na mtandao wetu ili kusaidia wanafunzi wenye vipaji na uhitaji mkubwa wa karo na vifaa.' 
                    : 'We welcome headteachers, academic coordinators, and school boards to join our network to support talented vulnerable students with scholarships and learning materials.' }}
            </p>
            
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('contact') }}"
                   class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-3.5 rounded-xl font-black text-sm transition-all duration-300 hover:scale-105 shadow-lg"
                   style="background: var(--brand-yellow); color: var(--brand-blue);">
                    <span>{{ app()->getLocale() === 'sw' ? 'Wasiliana Nasi kwa Ushirikiano' : 'Contact Us for Partnership' }}</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
                <a href="{{ route('apply') }}"
                   class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-3.5 rounded-xl font-bold text-sm text-white bg-white/10 hover:bg-white/20 border border-white/20 transition-all duration-300 backdrop-blur-md">
                    <span>{{ app()->getLocale() === 'sw' ? 'Omba Ufadhili wa Wanafunzi' : 'Apply for Student Aid' }}</span>
                </a>
            </div>
        </div>

    </div>
</div>

@endsection
