@extends('layouts.app')

@section('title', (app()->getLocale() === 'sw' ? 'Omba Msaada wa Masomo' : 'Apply for Educational Aid') . ' — Hope for Students Tanzania')
@section('description', 'Submit an online application for education support, school fees, books, and uniforms through Hope for Students Tanzania.')

@section('content')

{{-- Hero --}}
<div class="relative overflow-hidden" style="background: linear-gradient(135deg, var(--brand-blue-dark) 0%, var(--brand-blue) 55%, var(--brand-green) 100%);">
    <div class="absolute inset-0" style="background: radial-gradient(circle at 75% 25%, rgba(246,178,25,0.2) 0%, transparent 50%);"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24 text-center text-white">
        <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider mb-4"
              style="background: rgba(255,255,255,0.15); color: #fff; border: 1px solid rgba(255,255,255,0.3);">
            🎓 {{ app()->getLocale() === 'sw' ? 'Fomu ya Maombi ya Msaada' : 'Beneficiary Aid Application' }}
        </span>
        <h1 class="text-3xl sm:text-5xl font-black tracking-tight leading-tight">
            {{ app()->getLocale() === 'sw' ? 'Omba Msaada wa Masomo (HFST)' : 'Apply for Educational Support' }}
        </h1>
        <p class="mt-4 text-base sm:text-lg text-blue-100 max-w-2xl mx-auto leading-relaxed">
            {{ app()->getLocale() === 'sw' 
                ? 'Je, wewe ni mwanafunzi au mlezi mwenye uhitaji wa ada, sare, au vitabu vya masomo? Jaza fomu hii kwa umakini ili timu yetu iweze kukagua na kukusaidia.' 
                : 'Are you a student or guardian in need of tuition fees, books, or uniform assistance? Complete this form to submit your application for review.' }}
        </p>
    </div>
</div>

{{-- Main Form Container --}}
<div class="py-16 sm:py-20" style="background: var(--surface-bg);">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        @if ($errors->any())
        <div class="mb-8 p-5 rounded-2xl bg-red-50 border border-red-200 text-red-700 dark:bg-red-950/40 dark:border-red-800 dark:text-red-300">
            <h4 class="font-bold mb-2 text-sm">{{ app()->getLocale() === 'sw' ? 'Tafadhali rekebisha makosa yafuatayo:' : 'Please fix the errors below:' }}</h4>
            <ul class="list-disc list-inside text-xs space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="glass-card rounded-3xl p-6 sm:p-12 shadow-2xl"
             style="background: var(--surface-card); border: 1px solid var(--border-light);">
            
            <form method="POST" action="{{ route('apply.submit') }}" enctype="multipart/form-data" class="space-y-8">
                @csrf

                {{-- Section 1: Student Information --}}
                <div>
                    <h3 class="text-lg font-black pb-3 border-b flex items-center gap-2" style="color: var(--brand-blue); border-color: var(--border-light);">
                        <span>1.</span> {{ app()->getLocale() === 'sw' ? 'Taarifa za Mwanafunzi (Student Information)' : 'Student Details' }}
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label class="block text-xs font-semibold mb-1.5" style="color: var(--text-primary);">
                                {{ app()->getLocale() === 'sw' ? 'Jina la Kwanza' : 'First Name' }} *
                            </label>
                            <input type="text" name="first_name" required value="{{ old('first_name') }}"
                                   class="w-full px-4 py-3 rounded-xl text-sm font-medium"
                                   style="background: var(--surface-bg); border: 1.5px solid var(--border-light); color: var(--text-primary); outline: none;">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold mb-1.5" style="color: var(--text-primary);">
                                {{ app()->getLocale() === 'sw' ? 'Jina la Ukoo' : 'Last Name' }} *
                            </label>
                            <input type="text" name="last_name" required value="{{ old('last_name') }}"
                                   class="w-full px-4 py-3 rounded-xl text-sm font-medium"
                                   style="background: var(--surface-bg); border: 1.5px solid var(--border-light); color: var(--text-primary); outline: none;">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label class="block text-xs font-semibold mb-1.5" style="color: var(--text-primary);">
                                {{ app()->getLocale() === 'sw' ? 'Jinsia (Gender)' : 'Gender' }} *
                            </label>
                            <select name="gender" required class="w-full px-4 py-3 rounded-xl text-sm font-medium"
                                    style="background: var(--surface-bg); border: 1.5px solid var(--border-light); color: var(--text-primary); outline: none;">
                                <option value="Male" {{ old('gender') === 'Male' ? 'selected' : '' }}>Male (Mvulana)</option>
                                <option value="Female" {{ old('gender') === 'Female' ? 'selected' : '' }}>Female (Msichana)</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold mb-1.5" style="color: var(--text-primary);">
                                {{ app()->getLocale() === 'sw' ? 'Umri (Age in years)' : 'Age (Years)' }} *
                            </label>
                            <input type="number" name="age" required min="5" max="35" value="{{ old('age', 14) }}"
                                   class="w-full px-4 py-3 rounded-xl text-sm font-medium"
                                   style="background: var(--surface-bg); border: 1.5px solid var(--border-light); color: var(--text-primary); outline: none;">
                        </div>
                    </div>
                </div>

                {{-- Section 2: School & Education --}}
                <div>
                    <h3 class="text-lg font-black pb-3 border-b flex items-center gap-2" style="color: var(--brand-blue); border-color: var(--border-light);">
                        <span>2.</span> {{ app()->getLocale() === 'sw' ? 'Taarifa za Shule & Ngazi ya Elimu' : 'School & Education Level' }}
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label class="block text-xs font-semibold mb-1.5" style="color: var(--text-primary);">
                                {{ app()->getLocale() === 'sw' ? 'Chagua Shule Washirika' : 'Select Partner School' }}
                            </label>
                            <select name="school_id" id="school-select" onchange="toggleCustomSchool(this.value)"
                                    class="w-full px-4 py-3 rounded-xl text-sm font-medium"
                                    style="background: var(--surface-bg); border: 1.5px solid var(--border-light); color: var(--text-primary); outline: none;">
                                <option value="">— {{ app()->getLocale() === 'sw' ? 'Shule Nyingine (Chagua hapa kuandika)' : 'Other School (Write manually)' }} —</option>
                                @foreach($schools as $sch)
                                <option value="{{ $sch->id }}" {{ old('school_id') == $sch->id ? 'selected' : '' }}>{{ $sch->name }} ({{ $sch->region }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold mb-1.5" style="color: var(--text-primary);">
                                {{ app()->getLocale() === 'sw' ? 'Ngazi ya Elimu' : 'Education Level' }} *
                            </label>
                            <select name="education_level" required class="w-full px-4 py-3 rounded-xl text-sm font-medium"
                                    style="background: var(--surface-bg); border: 1.5px solid var(--border-light); color: var(--text-primary); outline: none;">
                                <option value="Primary">Primary (Shule ya Msingi)</option>
                                <option value="Secondary" selected>Secondary (Kidato cha 1 - 4)</option>
                                <option value="High School">High School (Kidato cha 5 - 6)</option>
                                <option value="Vocational">Vocational / VETA</option>
                                <option value="University">University (Chuo Kikuu)</option>
                            </select>
                        </div>
                    </div>

                    <div id="custom-school-wrapper" class="mt-4">
                        <label class="block text-xs font-semibold mb-1.5" style="color: var(--text-primary);">
                            {{ app()->getLocale() === 'sw' ? 'Jina la Shule (Ikiwa si ya washirika hapo juu)' : 'School Name (If not listed above)' }}
                        </label>
                        <input type="text" name="school_name" value="{{ old('school_name') }}" placeholder="e.g. Arusha Secondary School"
                               class="w-full px-4 py-3 rounded-xl text-sm font-medium"
                               style="background: var(--surface-bg); border: 1.5px solid var(--border-light); color: var(--text-primary); outline: none;">
                    </div>
                </div>

                {{-- Section 3: Parent/Guardian & Contacts --}}
                <div>
                    <h3 class="text-lg font-black pb-3 border-b flex items-center gap-2" style="color: var(--brand-blue); border-color: var(--border-light);">
                        <span>3.</span> {{ app()->getLocale() === 'sw' ? 'Taarifa za Mzazi au Mlezi' : 'Parent / Guardian Contacts' }}
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label class="block text-xs font-semibold mb-1.5" style="color: var(--text-primary);">
                                {{ app()->getLocale() === 'sw' ? 'Jina Kamili la Mzazi/Mlezi' : 'Guardian Full Name' }} *
                            </label>
                            <input type="text" name="parent_name" required value="{{ old('parent_name') }}"
                                   class="w-full px-4 py-3 rounded-xl text-sm font-medium"
                                   style="background: var(--surface-bg); border: 1.5px solid var(--border-light); color: var(--text-primary); outline: none;">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold mb-1.5" style="color: var(--text-primary);">
                                {{ app()->getLocale() === 'sw' ? 'Nambari ya Simu ya Mzazi/Mlezi' : 'Guardian Phone Number' }} *
                            </label>
                            <input type="text" name="parent_phone" required value="{{ old('parent_phone') }}" placeholder="+255..."
                                   class="w-full px-4 py-3 rounded-xl text-sm font-medium"
                                   style="background: var(--surface-bg); border: 1.5px solid var(--border-light); color: var(--text-primary); outline: none;">
                        </div>
                    </div>

                    <div class="mt-4">
                        <label class="block text-xs font-semibold mb-1.5" style="color: var(--text-primary);">
                            {{ app()->getLocale() === 'sw' ? 'Barua Pepe ya Mawasiliano (Hiari)' : 'Email Address (Optional)' }}
                        </label>
                        <input type="email" name="email" value="{{ old('email') }}"
                               class="w-full px-4 py-3 rounded-xl text-sm font-medium"
                               style="background: var(--surface-bg); border: 1.5px solid var(--border-light); color: var(--text-primary); outline: none;">
                    </div>
                </div>

                {{-- Section 4: Assistance Type & Hardship Description --}}
                <div>
                    <h3 class="text-lg font-black pb-3 border-b flex items-center gap-2" style="color: var(--brand-blue); border-color: var(--border-light);">
                        <span>4.</span> {{ app()->getLocale() === 'sw' ? 'Aina ya Msaada & Sababu za Uhitaji' : 'Aid Requirements & Hardship Details' }}
                    </h3>

                    <div class="mt-4">
                        <label class="block text-xs font-semibold mb-2" style="color: var(--text-primary);">
                            {{ app()->getLocale() === 'sw' ? 'Chagua Mahitaji Unayoomba (Chagua yote yanayohusika):' : 'Select Aid Types Needed:' }} *
                        </label>
                        
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                            @foreach([
                                'fees'       => ['label' => 'Ada ya Shule (Tuition Fees)', 'icon' => '💵'],
                                'books'      => ['label' => 'Vitabu & Daftari (Books)',    'icon' => '📚'],
                                'uniform'    => ['label' => 'Sare za Shule (Uniform)',     'icon' => '👔'],
                                'food'       => ['label' => 'Chakula (Nutrition)',        'icon' => '🍲'],
                                'stationery' => ['label' => 'Vifaa vya Kujifunzia',       'icon' => '✏️'],
                            ] as $key => $item)
                            <label class="flex items-center gap-2.5 p-3 rounded-xl border cursor-pointer transition-all hover:border-emerald-500"
                                   style="background: var(--surface-bg); border-color: var(--border-light);">
                                <input type="checkbox" name="types[]" value="{{ $key }}" class="rounded text-emerald-600 focus:ring-emerald-500"
                                       {{ is_array(old('types')) && in_array($key, old('types')) ? 'checked' : ($key === 'fees' ? 'checked' : '') }}>
                                <span class="text-xs font-bold" style="color: var(--text-primary);">{{ $item['icon'] }} {{ $item['label'] }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="mt-5">
                        <label class="block text-xs font-semibold mb-1.5" style="color: var(--text-primary);">
                            {{ app()->getLocale() === 'sw' ? 'Eleza Hali ya Uhitaji wa Familia (Family Situation & Reason)' : 'Explanation of Financial Need' }} *
                        </label>
                        <textarea name="description" required rows="4" minlength="20"
                                  placeholder="{{ app()->getLocale() === 'sw' ? 'Eleza kwa ufupi changamoto za kifedha, idadi ya wategemezi, na sababu zinazomfanya mwanafunzi astahili msaada...' : 'Describe your financial situation, why the student needs aid, and how this will support their education...' }}"
                                  class="w-full px-4 py-3 rounded-xl text-sm font-medium resize-none"
                                  style="background: var(--surface-bg); border: 1.5px solid var(--border-light); color: var(--text-primary); outline: none;">{{ old('description') }}</textarea>
                    </div>

                    <div class="mt-5">
                        <label class="block text-xs font-semibold mb-1.5" style="color: var(--text-primary);">
                            {{ app()->getLocale() === 'sw' ? 'Pakia Nyaraka za Uthibitisho (Barua ya shule, cheti cha kuzaliwa, au barua ya serikali ya mtaa - PDF/Picha max 5MB)' : 'Supporting Documents (Birth Cert, Admission Letter - PDF/Image max 5MB)' }}
                        </label>
                        <input type="file" name="document" accept=".pdf,.jpg,.jpeg,.png"
                               class="w-full px-4 py-2.5 rounded-xl text-xs font-medium file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-blue-900/40 dark:file:text-blue-200"
                               style="background: var(--surface-bg); border: 1.5px solid var(--border-light); color: var(--text-primary);">
                    </div>
                </div>

                {{-- Legal Consent Checkbox --}}
                <div class="p-4 rounded-xl border flex items-start gap-3" style="background: var(--surface-bg); border-color: var(--border-light);">
                    <input type="checkbox" required id="consent" class="mt-1 rounded text-emerald-600 focus:ring-emerald-500">
                    <label for="consent" class="text-xs leading-relaxed" style="color: var(--text-muted);">
                        {{ app()->getLocale() === 'sw' 
                            ? 'Nathibitisha kuwa taarifa zote nilizotoa ni za kweli. Ninatoa ridhaa kwa Hope for Students Tanzania (HFST) kuchakata data hii kulingana na Sheria ya Ulinzi wa Taarifa Binafsi ya Tanzania (Tanzania Personal Data Protection Act, 2022).' 
                            : 'I certify that all details provided are accurate. I consent to Hope for Students Tanzania processing this data in accordance with the Tanzania Personal Data Protection Act, 2022.' }}
                    </label>
                </div>

                {{-- Submit Button --}}
                <button type="submit"
                        class="w-full py-4 rounded-2xl font-bold text-base text-white flex items-center justify-center gap-2 transition-all duration-300 shadow-xl hover:scale-[1.01]"
                        style="background: linear-gradient(135deg, var(--brand-blue), var(--brand-blue-light)); box-shadow: 0 8px 24px rgba(19,56,94,0.35);">
                    <span>📤 {{ app()->getLocale() === 'sw' ? 'Wasilisha Maombi ya Msaada' : 'Submit Application for Review' }}</span>
                </button>
            </form>

        </div>

    </div>
</div>

@endsection

@push('scripts')
<script>
function toggleCustomSchool(val) {
    const customWrapper = document.getElementById('custom-school-wrapper');
    if (val) {
        customWrapper.style.opacity = '0.5';
    } else {
        customWrapper.style.opacity = '1';
    }
}
</script>
@endpush
